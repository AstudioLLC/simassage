<?php

namespace App\Http\Controllers\Admin;

use App\Constants\UserRole;
use App\Http\Controllers\Controller;
use App\Models\Children;
use App\Models\Country;
use App\Models\Database;
use App\Models\File;
use App\Models\Gallery;
use App\Models\Gift;
use App\Models\Language;
use App\Models\Need;
use App\Models\News;
use App\Models\User;
use App\Models\UserOptions;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class DatabaseController extends AdminBaseController
{
    public function index()
    {
        dd(123);
        if (!session()->get('donation_id')) {
            $session_donation_id = 246600;
            session()->put('donation_id', $session_donation_id);
        } else {
            $session_donation_id = session()->get('donation_id');
        }
        //dd(session()->all(), $session_donation_id);
        $items = DB::table('donation')->where('id', '>=', $session_donation_id ?? 1)->get();
        ini_set('max_execution_time', 360); //3 minutes
        if ($items) {
            foreach ($items as $row => $item) {
                $inserted = DB::table('donations')->where('id', $item->id)->get();
                if (count($inserted)) {
                    continue;
                }

                if ($item->personal_acc) {
                    $sponsor = UserOptions::where('sponsor_id', $item->personal_acc)->select('user_id')->get();
                    if (count($sponsor)) {
                        $sponsor_id = $sponsor->first()->user_id ?? null;
                    } else {
                        $sponsor_id = null;
                    }
                } else {
                    $sponsor_id = null;
                }

                if ($item->childs_ids) {
                    $children = Children::where('child_id', $item->childs_ids)->select('id')->get();
                    if (count($children)) {
                        $children_id = $children->first()->id ?? null;
                    } else {
                        $children_id = null;
                    }
                } else {
                    $children_id = null;
                }

                if ($item->comments) {
                    $message = htmlspecialchars($item->comments);
                } elseif ($item->comments_2) {
                    $message = htmlspecialchars($item->comments_2);
                } else {
                    $message = null;
                }

                $created_at = isset($item->date) ? date('Y-m-d H:i:s', $item->date) : null;
                $insert = [
                    'id' => $item->id,
                    'order_id' => $item->order_id,
                    'mdorder' => $item->MDORDER,
                    'status' => $item->status,
                    'fundraiser_id' => $item->project_id,
                    'gift_id' => $item->gift_id,
                    'is_binding' => $item->is_binding,
                    'bindingId' => $item->bindingId,
                    'sponsor_id' => $sponsor_id,
                    'children_id' => $children_id,
                    'amount' => $item->amount,
                    'email' => $item->email,
                    'fullname' => $item->fullname,
                    'message' => $message,
                    'message_admin' => htmlspecialchars($item->comments_admin),
                    'created_at' => $created_at,
                ];
                DB::table('donations')->insert($insert);
                session()->put('donation_id', $item->id);
            }
        }
        dd(count($items));
    }

    public function fundraisers()
    {
        dd(1);
        $path = storage_path('app/public/media/fundraisers/thumbnail/oldFiles');
        $path2 = storage_path('app/public/media/fundraisers/thumbnail');
        $files = scandir($path);
        $allFiles = DB::table('fundraisers')->select('imageSmall')->get()->toArray();
        $count = 0;
        foreach ($allFiles as $row => $allFile) {
            if (in_array($allFile->imageSmall, $files)) {
                $count++;
                //rename($path . '/' . $allFile->imageSmall, $path2 . '/' . $allFile->imageSmall);
                unset($allFiles[$row]);
            }
        }

        dd($count);

        dd(1);

        $urlLang = Language::getUrlLang();
        $items = Database::query()->with('content')->get();
        //dd($items);
        if ($items) {
            foreach ($items as $row => $item) {
                $title = [];
                $short = [];
                $content = [];
                $url = '';
                $created_at = isset($item->creation_date) ? date('Y-m-d H:i:s', $item->creation_date) : null;
                if ($item->content) {
                    foreach ($item->content as $itemContent) {
                        if ($itemContent->lang == $urlLang) {
                            $url = to_url($itemContent->title);
                        }
                        if ($itemContent->lang == 'am') {
                            $title['hy'] = $itemContent->title;
                            $short['hy'] = $itemContent->short_title;
                            $content['hy'] = $itemContent->text;
                        }
                        $title[$itemContent->lang] = $itemContent->title;
                        $short[$itemContent->lang] = htmlspecialchars($itemContent->short_title);
                        $content[$itemContent->lang] = htmlspecialchars($itemContent->text);
                    }
                }
                $insert = [
                    'id' => $item->id,
                    'url' => $url,
                    'child_id' => null,
                    'cost' => $item->project_cost ?? 0,
                    'collected' => 0,
                    'unlimit' => 1,
                    'title' => json_encode($title),
                    'imageSmall' => $item->tumb,
                    'imageBig' => $item->content_img,
                    'short' => json_encode($short),
                    'content' => json_encode($content),
                    'active' => $item->status,
                    'ordering' => 12,
                    'created_at' => $created_at,
                ];
                //DB::table('fundraisers')->insert($insert);
                echo "<pre>"; print_r($insert);
            }
        }

        dd($items, $urlLang);
    }

    public function ChatZayob()
    {
        $path = storage_path('app/public/media/chat/thumbnail/oldFiles');
        $path2 = storage_path('app/public/media/chat/thumbnail');
        $files = scandir($path);

        $count = 0;
        $notExistingPaths = [];
        $existingFiles = [];
        $notExistingFiles = [];
        $existingFileIds = [];
        $notExistingFileIds = [];

        $allFiles = DB::table('chat')->select('id', 'sponsor_id', 'children_id', 'file')->whereNotNull('file')->get()->toArray();
        foreach ($allFiles as $row => $allFile) {
            $lettersPath = storage_path('app/public/media/chat/letters' . '/' . $allFile->sponsor_id);
            $testPath = storage_path('app/public/media/chat/test');
            try {
                $files = scandir($testPath);
                if (in_array(strtolower($allFile->file), array_map('strtolower', $files))) {
                    $count++;
                    unset($allFiles[$row]);
                }
                /*if (in_array(strtolower($allFile->file), array_map('strtolower', $files))) {
                    if (file_exists($lettersPath . '/' . $allFile->file)) {
                        $chat = DB::table('chat')->where('id', $allFile->id)->first();
                        $fileName = $allFile->file;
                        $fileNameArray = explode('.', $allFile->file);
                        $fileNameArray[0] = $fileNameArray[0] . '-' . Str::random(10) . '-' .$chat->id;
                        $fileName = implode('.', $fileNameArray);
                        rename($lettersPath . '/' . $allFile->file, $testPath . '/' . $fileName);
                        DB::table('chat')->where('id', $allFile->id)->update(['file' => $fileName]);
                        $count++;
                    }
                }*/

                /*if (!in_array(strtolower($allFile->file), array_map('strtolower', $files))) {
                    array_push($notExistingFiles, $allFile->file . '----' . $allFile->sponsor_id);
                    array_push($notExistingFileIds, $allFile->id);
                } else {
                    array_push($existingFiles, $allFile->file);
                }*/
                //dd($allFile, $files);
            } catch (\Exception $e) {
                if (!in_array($allFile->sponsor_id, $notExistingPaths)) {
                    array_push($notExistingPaths, $allFile->sponsor_id);
                }
                //continue;
                //dd($e);
            }
            //$files = scandir($lettersPath);
            //echo "<pre>"; print_r($files);
        }
        /*foreach ($allFiles as $allFile) {
            $chat = DB::table('chat')->where('id', $allFile->id)->first();
            if (!$chat->message) {
                DB::table('chat')->where('id', $allFile->id)->delete();
            } else {
                DB::table('chat')->where('id', $allFile->id)->update(['file' => null]);
            }
            //DB::table('chat')->where('id', $allFile->id)->update(['file' => null]);
            //dd($chat->message);
        }*/
        dd($count, $allFiles);

        $chat = DB::table('chat')->whereIn(DB::raw('BINARY `file`'), $existingFiles)->get();
        dd($chat[0]);

        dd($existingFiles, $notExistingFileIds, $notExistingFiles, $notExistingPaths);

        foreach ($notExistingPaths as $path) {
            $allFiles = DB::table('chat')
                ->select('id', 'sponsor_id', 'children_id', 'file')->where('children_id', $path)
                ->whereNotNull('file')
                ->get()
                ->toArray();
            dd($allFiles);
        }

        dd($notExistingPaths);

        dd($allFiles);
        $count = 0;
        foreach ($allFiles as $row => $allFile) {
            $duplicateFiles = DB::table('chat')->where('file', $allFile->file)->where('id', '!=', $allFile->id)->get();
            if (count($duplicateFiles)) {
                dd($duplicateFiles, $allFile);
                foreach ($duplicateFiles as $duplicateFile) {
                    $count++;
                    echo "<pre>"; print_r($duplicateFile);
                }
            }
            /*if (file_exists($path2 . '/' . $allFile->file)) {
                //rename($path . '/' . $allFile->file, $path2 . '/' . $allFile->file);
                $count++;
            }*/
        }

        dd($count, count($allFiles));

        /**
         * for chat database migration
         */
        $items = Database::query()->get();
        $count = 0;
        foreach ($items as $row => $item) {
            /*if ($item->sponsor_id == 0) {
                $sponsorId = 1;
            } else {
                $sponsorId = $item->sponsor_id;
            }*/
            $sponsorId = $item->sponsor_id;
            if (!empty($item->file)) {
                $fileNameArray = explode('/', $item->file);
                $fileName = end($fileNameArray);
            } else {
                $fileName = null;
            }
            //dd($fileName);

            $created_at = isset($item->date) ? date('Y-m-d H:i:s', $item->date) : null;
            $children = Children::where('id', $item->child_id)->first();
            if ($children) {
                $sponsor = User::where('id', $sponsorId)->first();
                if (!$sponsor) {
                    $deleted_at = $created_at;
                } else {
                    $deleted_at = null;
                }
                $insert = [
                    'id' => $item->id,
                    'sponsor_id' => $sponsorId,
                    'children_id' => $item->child_id,
                    'file' => $fileName,
                    'message' => !empty($item->text) ? $item->text : null,
                    'message_from' => $item->owner,
                    'is_read' => $item->is_read,
                    'created_at' => $created_at,
                    'deleted_at' => $deleted_at,
                ];
                $count++;
                DB::table('chat')->insert($insert);
                //echo "<pre>"; print_r($insert);
                //dd($created_at, $item);
            }
        }
        dd($count, $items);

        /**
         * For files path change from child id folders to oldFiles
         */
        $path = storage_path('app/public/media/chat/thumbnail/oldFiles');
        $path2 = storage_path('app/public/media/chat/thumbnail');
        $files = scandir($path);
        foreach ($files as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            }
            $files2 = scandir($path . '/' . $file);
            foreach ($files2 as $file2) {
                if ($file2 == '.' || $file2 == '..') {
                    continue;
                }
                rename($path . '/' . $file . '/' . $file2, $path . '/' . $file2);
            }
        }
        dd($files);
    }

    public function letters()
    {
        /**
         * test
         */
        $path = storage_path('app/public/media/letters/thumbnail/oldFiles');
        $path2 = storage_path('app/public/media/letters/thumbnail');
        $files = scandir($path);
        $allFiles = DB::table('letters')->select('id', 'children_id', 'file')->whereNotNull('file')->get()->toArray();
        $count = 0;
        foreach ($allFiles as $row => $allFile) {

            $fileNameArray = explode('/', $allFile->file);
            $fileName = end($fileNameArray);
            //dd($fileName, $allFile);
            DB::table('letters')->where('id', $allFile->id)->update(['file' => $fileName]);
            if (!file_exists($path2 . '/' . $fileName)) {
                echo "<pre>"; print_r($allFile);
                //dd($allFile);
                $count++;
            }
            /*$fileNameArray = explode('/', $allFile->file);
            $fileName = end($fileNameArray);
            if (in_array($fileName, $files)) {
                $count++;
                if (file_exists($path . '/' . $fileName)) {
                    rename($path . '/' . $fileName, $path2 . '/' . $fileName);
                    unset($allFiles[$row]);
                }
            }*/
        }
        dd($count);
        dd($count, $files, $allFiles);


        $path = storage_path('app/public/media/letters/thumbnail/oldFiles');
        $path2 = storage_path('app/public/media/letters/thumbnail');
        $files = scandir($path);
        $allFiles = DB::table('letters')->select('id', 'children_id', 'file')->whereNotNull('file')->get()->toArray();
        //dd($allFiles);
        $count = 0;
        foreach ($allFiles as $row => $allFile) {
            //$files = scandir($path . '/' . $allFile->id);
            if (in_array($allFile->children_id, $files)) {
                $files2 = scandir($path . '/' . $allFile->children_id);
                $fileNameArray = explode('/', $allFile->file);
                $fileName = end($fileNameArray);
                if (in_array($fileName, $files2)) {
                    $count++;
                    unset($allFiles[$row]);
                }
                //dd($files2, $count);
                //rename($path . '/' . $allFile['imageBig'], $path2 . '/' . $allFile['imageBig']);
                //unset($allFiles[$row]);
            }
        }

        dd($count, $allFiles);
        //dd($files, $allFiles);

        $items = DB::table('letters')->get();
        dd($items);

        /*$items = Database::query()->get();
        foreach ($items as $row => $item) {
            $created_at = isset($item->date) ? date('Y-m-d H:i:s', $item->date) : null;

            $insert = [
                'id' => $item->id,
                'sponsor_id' => $item->sponsor_id + 6,
                'children_id' => $item->child_id,
                'file' => !empty($item->file) ? $item->file : null,
                'message' => !empty($item->text) ? $item->text : null,
                'message_from' => $item->owner,
                'is_read' => $item->is_read,
                'created_at' => $created_at,
            ];
            DB::table('letters')->insert($insert);
            //echo "<pre>"; print_r($insert);
            //dd($created_at, $item);
        }
        dd($items);*/
    }

    public function gifts()
    {
        $path = storage_path('app/public/media/gifts/thumbnail/oldImages');
        $path2 = storage_path('app/public/media/gifts/thumbnail');
        $files = scandir($path);
        $allFiles = Gift::query()->select('imageBig')->get()->toArray();
        $count = 0;
        foreach ($allFiles as $row => $allFile) {
            if (in_array($allFile['imageBig'], $files)) {
                $count++;
                rename($path . '/' . $allFile['imageBig'], $path2 . '/' . $allFile['imageBig']);
                unset($allFiles[$row]);
            }
        }
        dd($count, $allFiles);
        dd($files, $allFiles);

        $urlLang = Language::getUrlLang();
        $items = Database::query()->with('content')->get();
        if ($items) {
            foreach ($items as $row => $item) {
                $title = [];
                $content = [];
                $url = '';
                $created_at = now()->toDateTimeString();
                if ($item->content) {
                    foreach ($item->content as $itemContent) {
                        if ($itemContent->lang == 'am') {
                            $url = to_url($itemContent->title);
                            $title['hy'] = $itemContent->title;
                            $content['hy'] = $itemContent->text;
                        } else {
                            $title[$itemContent->lang] = $itemContent->title;
                            $content[$itemContent->lang] = htmlspecialchars($itemContent->text);
                        }
                    }
                }
                $insert = [
                    'id' => $item->id,
                    'url' => $url,
                    'title' => json_encode($title),
                    'imageSmall' => null,
                    'imageBig' => $item->img,
                    'content' => json_encode($content),
                    'cost' => (int)$item->cost,
                    'active' => $item->status,
                    'ordering' => $row,
                    'created_at' => $created_at,
                ];
                //DB::table('gifts')->insert($insert);
                echo "<pre>"; print_r($insert);
            }
        }
        dd($items);
    }

    public function countries()
    {
        dd(123);
        $items = DB::table('country_filters2')->get();
        if ($items) {
            foreach ($items as $item) {
                $insert = [
                    'title' => $item->name,
                    'image' => $item->image,
                ];
                //DB::table('countries')->insert($insert);
            }
        }
        //$items = Database::query()->get();
        dd($items);
    }

    public function childrenVideos()
    {
        $path = storage_path('app/public/media/childrens/thumbnail/oldImages');
        $files = scandir($path);
        $allFiles = Video::query()->select('name', 'id')->where('type', 1)->get()->toArray();
        $count = 0;
        //1337
        foreach ($allFiles as $row => $allFile) {
            if (in_array($allFile['name'], $files)) {
                $count++;
                rename($path . '/' . $allFile['name'], $path . '/videos/' . $allFile['name']);
                unset($allFiles[$row]);
            }
        }
        dd($count, $allFiles);
        dd($files, $allFiles);


        $items = Database::query()->get();
        if ($items) {
            $rowVal = 0;
            foreach ($items as $row => $item) {
                $childrenExistsInDB = Children::query()->where('id', $item->child_id)->first();
                if ($childrenExistsInDB) {
                    $title = [];
                    if ($item->type == 'mp4') {
                        $type = 1;
                        $name = $item->video;
                        $link = null;
                    } else {
                        $type = 0;
                        $name = null;
                        $link = $item->video;
                    }
                    $rowVal++;
                    $title['hy'] = explode('.', $item->video)[0];
                    $title['ru'] = explode('.', $item->video)[0];
                    $title['en'] = explode('.', $item->video)[0];
                    $title['de'] = explode('.', $item->video)[0];
                    $title['fr'] = explode('.', $item->video)[0];
                    $insert = [
                        'type' => $type,
                        'video' => 'childrens',
                        'key' => $item->child_id,
                        'name' => $name,
                        'link' => $link,
                        'title' => json_encode($title),
                        'ordering' => $rowVal,
                        'created_at' => now()->toDateTimeString(),
                    ];
                    DB::table('videos')->insert($insert);
                }
            }
        }
        dd($items);
    }

    public function childrenFiles()
    {
        $path = storage_path('app/public/media/childrens/thumbnail/oldImages');
        $files = scandir($path);
        $allFiles = File::query()->select('name', 'id')->get()->toArray();
        $count = 0;
        //1786
        foreach ($allFiles as $row => $allFile) {
            if (in_array($allFile['name'], $files)) {
                $count++;
                //rename($path . '/' . $allFile['name'], $path . '/file/' . $allFile['name']);
                unset($allFiles[$row]);
            }
        }
        dd($count, $allFiles);
        dd($files, $allFiles);

        $items = Database::query()->with('content')->get();
        if ($items) {
            $rowVal = 0;
            $title = [];
            foreach ($items as $row => $item) {
                if (!empty($item->doc)) {
                    $rowVal++;
                    $title['hy'] = explode('.', $item->doc)[0];
                    $title['ru'] = explode('.', $item->doc)[0];
                    $title['en'] = explode('.', $item->doc)[0];
                    $title['de'] = explode('.', $item->doc)[0];
                    $title['fr'] = explode('.', $item->doc)[0];
                    $insert = [
                        'id' => $rowVal,
                        'file' => 'childrens',
                        'key' => $item->id,
                        'name' => $item->doc,
                        'title' => json_encode($title),
                        'imageSmall' => null,
                        'imageBig' => null,
                        'ordering' => $rowVal,
                        'created_at' => now()->toDateTimeString(),
                    ];
                    DB::table('files')->insert($insert);
                }

                if ($item->word_doc) {
                    $rowVal++;
                    $title['hy'] = explode('.', $item->word_doc)[0];
                    $title['ru'] = explode('.', $item->word_doc)[0];
                    $title['en'] = explode('.', $item->word_doc)[0];
                    $title['de'] = explode('.', $item->word_doc)[0];
                    $title['fr'] = explode('.', $item->word_doc)[0];
                    $insert = [
                        'id' => $rowVal,
                        'file' => 'childrens',
                        'key' => $item->id,
                        'name' => $item->word_doc,
                        'title' => json_encode($title),
                        'imageSmall' => null,
                        'imageBig' => null,
                        'ordering' => $rowVal,
                        'created_at' => now()->toDateTimeString(),
                    ];
                    DB::table('files')->insert($insert);
                }

                if (count($item->content)) {
                    foreach ($item->content as $itemContent) {
                        $rowVal++;
                        $title['hy'] = explode('.', $itemContent->file)[0];
                        $title['ru'] = explode('.', $itemContent->file)[0];
                        $title['en'] = explode('.', $itemContent->file)[0];
                        $title['de'] = explode('.', $itemContent->file)[0];
                        $title['fr'] = explode('.', $itemContent->file)[0];
                        $insert = [
                            'id' => $rowVal,
                            'file' => 'childrens',
                            'key' => $itemContent->child_id,
                            'name' => $itemContent->file,
                            'title' => json_encode($title),
                            'imageSmall' => null,
                            'imageBig' => null,
                            'ordering' => $rowVal,
                            'created_at' => $itemContent->created_at,
                        ];
                        DB::table('files')->insert($insert);
                    }
                }

            }
        }
        dd($rowVal, $items);
    }

    public function childrenGallery()
    {
        /*$path = storage_path('app/public/media/childrens/thumbnail/oldImages');
        $files = scandir($path);
        $allFiles = Gallery::query()->select('image', 'id')->get()->toArray();
        $count = 0;
        foreach ($allFiles as $row => $allFile) {
            if (in_array($allFile['image'], $files)) {
                $count++;
                rename($path . '/' . $allFile['image'], $path . '/gallery/' . $allFile['image']);
                unset($allFiles[$row]);
            }
        }
        dd($count, $allFiles);
        dd($files, $allFiles);*/
        $items = Database::query()->get();
        if ($items) {
            foreach ($items as $row => $item) {
                $insert = [
                    'id' => $row+1,
                    'gallery' => 'childrens',
                    'key' => $item->child_id,
                    'image' => $item->img,
                    'alt' => null,
                    'title' => null,
                    'ordering' => $item->pos,
                ];
                //DB::table('galleries')->insert($insert);
            }
        }
        dd($items);
    }
    public function users()
    {
        $urlLang = Language::getUrlLang();
        $items = Database::query()->get();
        $old = [
            'id',
            'full_name',
            'sponsor_id',
            'email',
            'password',
            'recurring_payment',
            'status',
            'is_send_email',
            'children_gender',
            'children_age_beetwen',
            'children_area',
            'children_program_approach',
            'creation_date',
            'want_recive_letters',
        ];
        $new = [
            'id',
            'role',
            'type',
            'name',
            'email',
            'phone',
            'email_verified_at',
            'password',
            'remember_token',
            'watched',
            'active',
            'last_activity_at',
            'created_at',
            'updated_at'
        ];
        if ($items) {
            foreach ($items as $row => $item) {
                if (!$item->creation_date || $item->creation_date == 0) {
                    $created_at = now()->toDateTimeString();
                } else {
                    $created_at = isset($item->creation_date) ? date('Y-m-d H:i:s', $item->creation_date) : null;
                }
                $insert = [
                    'id' => $item->id,
                    'role' => UserRole::SPONSOR,
                    'type' => 0,
                    'name' => $item->full_name,
                    'email' => $item->email,
                    'phone' => null,
                    'email_verified_at' => now()->toDateTimeString(),
                    'password' => bcrypt('12345678'),
                    'remember_token' => Str::random(10),
                    'watched' => 1,
                    'active' => $item->status,
                    'last_activity_at' => null,
                    'created_at' => $created_at,
                ];
                DB::table('users')->insert($insert);
                $userOptionsInsert = [
                    'user_id' => $item->id,
                    'sponsor_id' => $item->sponsor_id,
                    'recurring_payment' => $item->recurring_payment ?? null,
                    'is_send_email' => $item->is_send_email ?? null,
                    'children_age_beetwen' => $item->children_age_beetwen == 0 ? null : $item->children_age_beetwen,
                    'children_gender' => $item->children_gender == 0 ? null : $item->children_gender,
                    'children_region' => $item->children_area == 0 ? null : $item->children_area,
                    'children_program_approach' => $item->children_program_approach == 0 ? null : $item->children_program_approach,
                    'want_recive_letters' => $item->want_recive_letters ?? null,
                ];
                DB::table('user_options')->insert($userOptionsInsert);
            }
        }
        dd($items);
    }

    public function news()
    {
        /*$path = storage_path('app/public/media/news/thumbnail');
        $files = scandir($path);
        $allFiles = News::query()->select('imageBig')->get()->toArray();*/

        $urlLang = Language::getUrlLang();
        $items = Database::query()->with('content')->get();
        if ($items) {
            foreach ($items as $row => $item) {
                $title = [];
                $short = [];
                $content = [];
                $url = '';
                if ($item->date == 0) {
                    $created_at = now()->toDateTimeString();
                } else {
                    $created_at = isset($item->date) ? date('Y-m-d H:i:s', $item->date) : null;
                }
                if ($item->content) {
                    foreach ($item->content as $itemContent) {
                        if ($itemContent->lang == $urlLang) {
                            $url = to_url($itemContent->title);
                        }
                        if ($itemContent->lang == 'am') {
                            $title['hy'] = $itemContent->title;
                            $short['hy'] = $itemContent->short;
                            $content['hy'] = $itemContent->text;
                        }
                        $title[$itemContent->lang] = $itemContent->title;
                        $short[$itemContent->lang] = htmlspecialchars($itemContent->short);
                        $content[$itemContent->lang] = htmlspecialchars($itemContent->text);
                    }
                }
                $insert = [
                    'id' => $item->id,
                    'url' => $url,
                    'active' => $item->status,
                    'title' => json_encode($title),
                    'imageSmall' => null,
                    'imageBig' => $item->img,
                    'short' => json_encode($short),
                    'content' => json_encode($content),
                    'ordering' => $row,
                    'created_at' => $created_at,
                    //'title' => json_encode(['ru' => $row['title_ru'], 'hy' => $row['title_hy'], 'en' => $row['title_en']]),
                ];
                DB::table('news')->insert($insert);
                //echo "<pre>"; print_r($insert);
            }
        }
        dd($items);
    }

    public function childrensWithSameId()
    {
        $childrens = [
            //IJ-0030
            [
                'id' => 192,
                'child_id' => 'IJ-0030', //Same Child ID
                'region_id' => 6, // Existing region ids in db 1,2,3,7,8,9
                'sponsor_id' => 0, //No sponsor
                'name' => 'Էրիկ',
                'image' => 'e0a022ced9d717dc63ee149def20312e.JPG',
                'story' => '',
                'date_of_birth' => '8/25/2012', // m/d/y
                'active' => 0,// 0 - Not Active, 1 - Active
                'ordering' => 122,
                'created_at' => '2021-09-20 12:47:02' //if Null in db, set carbon->now()
            ],
            [
                'id' => 648,
                'child_id' => 'IJ-0030',
                'region_id' => 1,
                'sponsor_id' => 400, // Sponsor name Rafik Avalyan, sponsor_id LS_331
                'name' => 'Էրիկ',
                'image' => '1f9519fa9ad76cb2697fad5e0de4f97e.JPG',
                'story' => '',
                'date_of_birth' => '25/08/2012',
                'active' => 1,
                'ordering' => 318,
                'created_at' => '2021-09-20 12:47:02',
            ],
            //NM-5131
            [
                'id' => 586,
                'child_id' => 'NM-5131',
                'region_id' => 1,
                'sponsor_id' => 267, // No sposnor in db with 267 ID
                'name' => 'Manuchar',
                'image' => '248aa0bf422926aab24cf423fe40172c.JPG',
                'story' => '',
                'date_of_birth' => '08/04/2009',
                'active' => 1,
                'ordering' => 260,
                'created_at' => '2021-09-20 12:47:02'
            ],
            [
                'id' => 642,
                'child_id' => 'NM-5131',
                'region_id' => 1,
                'sponsor_id' => 392, // No sposnor in db with 392 ID
                'name' => 'Մանուչար',
                'image' => '10a61f4943c6b36c4521e58ebbd9e708.jpg',
                'content' => '',
                'date_of_birth' => '03/04/2009',
                'active' => 1,
                'ordering' => 312,
                'created_at' => '2021-09-20 12:47:02'
            ],
            //VR-0058
            [
                'id' => 614,
                'child_id' => 'VR-0058',
                'region_id' => 3,
                'sponsor_id' => 330, // Sponsor name Armine Aloian, sponsor_id LS_275
                'name' => 'Արման',
                'image' => 'ab6935bd7d008c14bf83095e673bbd51.JPG',
                'story' => '',
                'date_of_birth' => '26/06/2012',
                'active' => 1,
                'ordering' => 285,
                'created_at' => '2021-09-20 12:47:02'
            ],
            [
                'id' => 827,
                'child_id' => 'VR-0058',
                'region_id' => 3,
                'sponsor_id' => 2699, // Sponsor name Ani Afyan, sponsor_id LS_496
                'name' => 'Arman',
                'image' => '9f30edd195c39a66a499fafc49ddcd48.jpg',
                'story' => '',
                'date_of_birth' => '06/26/2012',
                'active' => 1,
                'ordering' => 478,
                'created_at' => '2021-07-01 14:39:58'
            ],
        ];
    }
}
