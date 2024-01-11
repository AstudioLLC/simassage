<?php

namespace App\Models;

use App\Constants\UserRole;
use App\Mail\ResetPassword;
use App\Mail\UserEmailVerification;
use App\Mail\UserRegistered;
use App\Models\Traits\Relationships\UserRelationships;
//use App\Notifications\ResetAdminPasswordNotification;
use App\Notifications\RegisteredNotification;
use App\Notifications\UserRegisteredNotification;
use App\Services\BasketService\BasketService;
use App\Services\BasketService\Drivers\SessionDriver;
use App\Services\Support\Str;
use App\ValueObjects\BasketItem;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Laravel\Sanctum\HasApiTokens;
//use Snowfire\Beautymail\Beautymail;

/**
 * Class User
 * @package App\Models
 *
 * @property int $type
 */
class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasFactory, UserRelationships, SoftDeletes;

    const ROLE = [
        0 => 'superadmin',
        1 => 'admin',
        2 => 'content',
        3 => 'moderator',
        4 => 'accountant',
        5 => 'systemadmin',
        6 => 'sponsor',
        7 => 'user'
    ];

    const TYPE = [
        0 => 'user',
        1 => 'company',
    ];

    const ROLEFRONT = [
        0 => 'Главный Администратор',
        1 => 'Администратор',
        2 => 'Контент менеджер',
        3 => 'Модератор',
        4 => 'Бухгалтер',
        5 => 'Системный администратор',
        6 => 'Спонсор',
        7 => 'Пользователь'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
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
        'updated_at',
        'deleted_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @var string[]
     */
    protected $dates = ['last_activity_at'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [];

    /**
     * @param int|null $type
     * @return bool
     */
    public function isAdmin(int $type = null): bool
    {
        if ($type < UserRole::SPONSOR) {
            return true;
        }

        return false;
        //dd($type, $this->type);
        /*if ($type > UserRole::SPONSOR) {
            return $this->type === $type;
        }
        if ($type == null) {
            return $this->type !== UserRole::SPONSOR;
        } else {
            return $this->type === $type;
        }*/
    }





    public static function getByRoles($role)
    {
        return self::where('admin', 1)->where('role', $role)->where('role', '<>', 1)->sort()->get();
    }

    public static function getUser($email)
    {
        return User::query()->where(['email' => $email, 'admin' => 0])->first();
    }

    public static function getUsersByTypeWithOrders($type)
    {
        return self::query()->where('type', $type)->with('orders')->sort()->get();
    }

    public static function getUsersByTypeWithItems($type)
    {
        return self::query()->where('type', $type)->sort()->get();
    }

    public function scopeSort(Builder $query)
    {
        return $query->orderBy('id', 'asc');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order', 'user_id', 'id')->sort();
    }

    /*public function options()
    {
        return $this->hasMany('App\Models\UserOptions', 'user_id', 'id');
    }*/




    public static function checkAdmin($email, $password)
    {
        $user = self::getAdmin($email);
        if (!$user || !Hash::check($password, $user->password)) return false;

        return $user;
    }

    public static function getAdmin($email)
    {
        $user = self::where('email', $email)->where('admin', '>', 0)->first();
        if ($user === null) return false;

        return $user;
    }

    public static function getUsers()
    {
        return self::where('admin', 0)->sort()->get();
    }

    public static function getUsersByType($type)
    {
        return self::where('admin', 0)->where('type', $type)->sort()->get();
    }

    public static function checkRecoverToken($email, $token)
    {
        $result = DB::table('password_resets')->select('token')->where('email', $email)->first();
        if (!$result) return false;

        return Hash::check($token, $result->token);
    }

    public static function action($user, $inputs)
    {
        $user['name'] = $inputs['name'];
        $user['email'] = $inputs['email'];
        if (!empty($inputs['change_password'])) {
            $user['password'] = Hash::make($inputs['new_password']);
        }
        $result = $user->save();
        Auth::login($user);

        return $result;
    }

    public static function recoverPassword($email, $password)
    {
        $user = self::where('email', $email)->first();

        return self::recoverUserPassword($user, $password);
    }

    public static function recoverUserPassword($user, $password)
    {
        DB::table('password_resets')->where('email', $user->email)->delete();
        $user->password = Hash::make($password);
        $user->setRememberToken(Str::random(60));
        if (!empty($user->verification)) $user->verification = null;
        $user->save();

//        event(new PasswordReset($user));
        return $user;
    }

    public static function deleteUser($model)
    {
        return $model->delete();
    }

    public function sendPasswordResetNotification($token)
    {
        dd($token, 123);
        $url = route('password.reset', ['token' => $token, 'email' => $this->email]);
        $data['url'] = route('password.reset', ['token' => $token, 'email' => $this->email]);
        $data['message'] = route('password.reset', ['token' => $token, 'email' => $this->email]);

        //Mail::to('Receiver Email Address')->send(new ResetPassword($data));


        $email = $this->email;
        $data['email'] = $this->email;
        //if (!$email || !is_email($email)) return $redirect->withErrors(['global' => __('app.internal error')])->withInput();
        try {
            Mail::to($email)->send(
                new ResetPassword(
                    $data
                )
            );
        }
        catch (\Exception $exception) {
            dd($exception);

        }
        dd(1);

        try {
            $url = route('password.reset', ['token' => $token, 'email' => $this->email]);
            $data['url'] = route('password.reset', ['token' => $token, 'email' => $this->email]);
            $data['message'] = route('password.reset', ['token' => $token, 'email' => $this->email]);

            //Mail::to('Receiver Email Address')->send(new ResetPassword($data));


            $email = $this->email;
            $data['email'] = $this->email;
            //if (!$email || !is_email($email)) return $redirect->withErrors(['global' => __('app.internal error')])->withInput();
            try {
                Mail::to($email)->send(
                    new ResetPassword(
                        $data
                    )
                );
            }
            catch (\Exception $exception) {
                dd($exception);

            }

            /*app()->make(Beautymail::class)->send('site.notifications.password_reset', ['url' => $url], function ($message) {
                $message->from(env('MAIL_FROM_ADDRESS'))
                    ->to($this->email, $this->name)
                    ->subject('Заявка на восстановление пароля');
            });*/
        } catch (BindingResolutionException $e) {
            dd(3);
        }
        /*if ($this->isAdmin()) {
            try {
                $this->notify(new ResetAdminPasswordNotification($token, $this->email));
            } catch (\Exception $e) {
            }
        } else {
            try {
                $url = route('password.reset', ['token' => $token, 'email' => $this->email]);

                app()->make(Beautymail::class)->send('site.notifications.password_reset', ['url' => $url], function ($message) {
                    $message->from(env('MAIL_FROM_ADDRESS'))
                        ->to($this->email, $this->name)
                        ->subject('Заявка на восстановление пароля');
                });
            } catch (BindingResolutionException $e) {
                dd($e);
            }
        }*/
        dd($token);
    }

    public function sendRegisteredNotification($token)
    {
        $data['url'] = route('verification.email', ['email' => $this->email, 'token' => $token]);

        try {
            Mail::to($this->email)->send(new UserEmailVerification($data));
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
        dd(123);

        /*try {
            return app()->make(Beautymail::class)
                ->send('site.notifications.registered', ['url' => $url], function ($message) {
                    $message->from(env('MAIL_FROM_ADDRESS'))
                        ->to($this->email, $this->name)
                        ->subject('Ссылка подтверждения эл. почты на сайте '.env('APP_NAME'));
                });
        } catch (Exception $e) {
            return true;
        }*/
    }

    public function hasVerifiedEmail()
    {
        return (empty($this->verification) || $this->admin > 0);
    }

    public static function auth()
    {
        if (self::$auth === null) {
            $user = Auth::user();
            if (!$user) {
                self::$auth = false;
            } /*else if (!$user->isVerified()) {
                Auth::logout();
                self::$auth = false;
            } */ else if ($user->active == 0) {
                Auth::logout();
                self::$auth = false;
            } else self::$auth = $user;
        }

        return self::$auth;
    }

    public function items()
    {
        return $this->hasMany('App\Models\CompanyItems', 'user_id');
    }

    public function rates()
    {
        return $this->hasMany(ItemRate::class, 'user_id');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'user_id');
    }

    public function companyItems()
    {
        return $this->belongsToMany(Item::class, 'item_magazine', 'user_id', 'item_id')->orderByDesc('in_stock')->sort();
    }

    public function basketItems()
    {
        return $this->belongsToMany(Item::class, 'basket', 'user_id', 'item_id')->withPivot('count');
    }

    public function favoriteItems()
    {
        return $this->belongsToMany(Item::class, 'user_favorites', 'user_id', 'item_id');
    }

    /**
     * @param string $phone
     */
    public function setFormattedPhone(string $phone)
    {
        $this->phone = preg_replace('/[^0-9]/', '', $phone);
    }

    /**
     * @return string|null
     */
    public function getFormattedPhoneAttribute()
    {
        return $this->phone ? '+' . $this->phone : '';
    }

    /**
     * @return string|null
     */
    public function getPhoneWithoutCountryCodeAttribute()
    {
        return substr($this->phone, 2);
    }

    public function initBasketWithSession()
    {
        $basketService = new BasketService(
            new SessionDriver()
        );

        $basketItems = $basketService->getItems();

        if (!count($basketItems)) {
            return false;
        }

        Basket::query()->where('user_id', $this->id)->forceDelete();

        /** @var BasketItem $basketItem */
        foreach($basketItems as $basketItem) {
            $this->basketItems()->attach($basketItem->getItemId(), [
                'count' => $basketItem->getCount(),
                'size_id' => $basketItem->getSize() ? $basketItem->getSize()->id : null
            ]);
        }

        $this->save();

        Session::forget('basketItems');

        notify('Товары с корзины перенесены в корзину вашего профиля.', 'info');

        return true;
    }


}
