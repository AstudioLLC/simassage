<?php

namespace App\Http\Controllers\Site;


use App\Models\Department;
use App\Models\Member;

use App\Models\Page;
use App\Models\Price;
use App\Models\Question;
use Illuminate\Http\Request;

class SearchController extends BaseController
{
    public function search(Request $request): \Illuminate\Http\Response
    {   
        // $request->validate([
        //     'search' => 'string',
        // ]);

        $keyword = $request->input('search');

        $length = strlen($keyword);
      
        if($length <= 2 ) {
            $totalCount = 0;
          
            return response()
            ->view('site.pages.search.search', compact('totalCount'));
        }

        $doctors = Member::where('title', 'LIKE', '%' . $keyword . '%')
            ->where('deleted_at', null)
            ->whereRaw('CHAR_LENGTH(title) >= 3')
            ->get();
    
         $departments = Page::where(['parent_id' => 67, 'active' => true])
            ->where('title', 'LIKE', '%' . $keyword . '%')
            ->where('deleted_at', null)
            ->whereRaw('CHAR_LENGTH(title) >= 3')
            ->get();
    
         $prices = Price::where(function ($query) use ($keyword) {
            $query->where('title', 'LIKE', '%' . $keyword . '%')
                ->orWhere('price', 'LIKE', '%' . $keyword . '%')
                ->orWhere('price_code', 'LIKE', '%' . $keyword . '%');
            })
                ->whereNull('deleted_at')
                ->whereRaw('CHAR_LENGTH(title) >= 3')
                ->get();
    
        // $questions = Question::where('title', 'LIKE', '%' . $keyword . '%')
        //     ->where('deleted_at', null)
        //     ->whereRaw('CHAR_LENGTH(title) >= 3')
        //     ->get();
            

        $totalCount = $doctors->count() + $departments->count() + $prices->count();

        $allData = [
            'doctors' => $doctors,
            'departments' => $departments,
            'prices' => $prices,
            'totalCount' => $totalCount
        ];


        return response()
            ->view('site.pages.search.search', compact('totalCount','allData'));
    }

}
