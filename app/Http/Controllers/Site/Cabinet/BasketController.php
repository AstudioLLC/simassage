<?php

namespace App\Http\Controllers\Site\Cabinet;

use App\Http\Controllers\Site\BaseController;
use App\Models\Price;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class BasketController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBasketItems(Request $request)
    {
//         $cookie_data = stripslashes(Cookie::get('shopping_cart'));
//         $cart_data = json_decode($cookie_data, true);
//         $ids = [];
//         foreach ($cart_data as $key) {
//             $ids[] = $key['item_id'];
//         }
//         $items = Items::whereIn('id', $ids)->get();
//        $items = $request->user()->favorites()->pluck('item_id')->toArray();
//
//         return response()->json($items);


    }

    /**
     * @param Request $request
     * @return Response|mixed|object
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function add(Request $request) {
        $this->validate($request, [
            'itemId' => 'required|numeric'
        ]);

        $prod_id = $request->input('itemId');
        $quantity = 1;
        $sessionId = session()->getId();
        $sessionData = DB::table('sessions')->where('id', '=', $sessionId)->value('basket_items');
        $sessionData = $sessionData ? unserialize(base64_decode($sessionData)) : [];

        $item_id_list = array_column($sessionData, 'item_id');

        if (in_array($prod_id, $item_id_list)) {
            foreach ($sessionData as $key => $value) {
                if ($value['item_id'] == $prod_id) {
                    $sessionData[$key]['item_quantity'] += $quantity;
                    $encodedData = base64_encode(serialize($sessionData));
                    DB::table('sessions')->where('id', '=', $sessionId)->update(['basket_items' => $encodedData]);

                    return response()->json(['status' => '"' . $value['item_name'] . '" Already Added to Cart', 'status2' => '2']);
                }
            }
        } else {
            $products = Price::find($prod_id);

            if ($products) {
                $item_array = [
                    'item_id' => $prod_id,
                    'item_name' => $products->title,
                    'item_price' => $products->price,
                    'item_quantity' => $quantity,
                    'item_price_code' => $products->price_code
                ];
                
                $sessionData[] = $item_array;

                $encodedData = base64_encode(serialize($sessionData));
               
                DB::table('sessions')->where('id', '=', $sessionId)->update(['basket_items' => $encodedData]);
                return response()->make('Added')->setStatusCode(Response::HTTP_CREATED);
            }
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|Response|mixed|object
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function destroy(Request $request)
    {
        $this->validate($request, [
            'itemId' => 'required|numeric'
        ]);
    
        $prod_id = $request->input('itemId');
        $sessionId = session()->getId();
        $sessionData = DB::table('sessions')->where('id', '=', $sessionId)->value('basket_items');
        $sessionData = $sessionData ? unserialize(base64_decode($sessionData)) : [];
      
        $item_id_list = array_column($sessionData, 'item_id');
        if (in_array($prod_id, $item_id_list)) {
            foreach ($sessionData as $key => $value) {
                if ($value['item_id'] == $prod_id) {
                    unset($sessionData[$key]);
                    $encodedData = base64_encode(serialize($sessionData));
                    DB::table('sessions')->where('id', '=', $sessionId)->update(['basket_items' => $encodedData]);
    
                    return response()->make('Deleted')->setStatusCode(Response::HTTP_OK);
                }
            }
        }
    }

}

