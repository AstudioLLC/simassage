<?php

namespace App\Http\Controllers\Site\Cabinet;

use App\Http\Controllers\Site\BaseController;
use App\Models\Basket;
use App\Models\DeliveryRegion;
use App\Models\Order;
use App\Rules\FormattedPhone;
use App\Services\BasketService\BasketFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Zakhayko\Banners\Models\Banner;

class OrdersController extends BaseController
{
    public function order($id)
    {
        $data = [];
        $data['order'] = Order::getOrderSite($id);
        $data['title'] = __('cabinet.order') . ' N' . $data['order']->id;
        $data['seo'] = $this->staticSEO($data['title']);
        $data['status'] = Order::getStatus($data['order']->status);

        return view('site.pages.cabinet.order', $data);
    }

    public function createOrder()
    {
        dd('В разработке...');
        $basketService = BasketFactory::createDriver();

        if (!count(Basket::getUserItems())) {
            return redirect()->route('cabinet.profile.basket');
        }

        if (!auth()->user()->sms_verification) {
            return redirect()->back()->with('phone_verify', 'true');
        }
        $data = [];
        $data['active'] = 'basket';

        $data['seo'] = $this->staticSEO('Оформления заказа');
        $data['regions'] = DeliveryRegion::siteList();
        $data['user'] = authUser();
        $data['basketService'] = $basketService;

        $breadcrumbs = [
            [
                'title' => __('cabinet.profile settings'),
                'url' => ''
            ]
        ];

        $data['breadcrumbs'] = $breadcrumbs;

        return view('site.pages.cabinet.order_form', $data);
    }

    public function submitOrder(Request $request)
    {
        $inputs = $request->all();
        $inputs['delivery'] = 1;

        $rules = [
            'name' => 'required|string|max:255',
            'phone' => ['required', 'string', 'max:255', new FormattedPhone()],
        ];

        if (($inputs['delivery'] ?? 0) != 0) {
            $rules['city_id'] = 'required|integer|exists:delivery_cities,id';
            $rules['address'] = 'required|string|max:255';
        }

        Validator::make($inputs, $rules, [
            'required' => 'Լրացրեք դաշտը',
            'string' => 'Լրացրեք դաշտը',
            'max' => 'Макс. :max символов.',
            'exists' => 'Լրացրեք դաշտը',
            'phone' => 'Լրացրեք հեռախոսահամարը',
            'integer' => 'Լրացրեք դաշտը',
        ])->validate();

        $basketService = BasketFactory::createDriver();

        if (!count($basketService->getItems())) {
            return redirect()->route('cabinet.profile.basket');
        }

        if (!($order = Order::makeOrder($inputs))) {
            return redirect()->route('cabinet.profile.orders.active', ['status' => 'pending']);
        }

        Basket::clear();

        if ($order->payment_method == 'bank') {
            notify('Заказ принят. После подтверждения вы сможете приступить к оплате.');
        } else {
            notify('Заказ принят. Следите за ходом выполнения.');
        }

        return redirect()->route('cabinet.profile.orders.active', ['status' => 'in-process']);
    }
}
