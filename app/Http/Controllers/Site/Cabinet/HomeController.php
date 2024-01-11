<?php

namespace App\Http\Controllers\Site\Cabinet;

use App\Http\Controllers\Site\BaseController;
use App\Models\Children;

class HomeController extends BaseController
{
    /**
     * View namespace for Cabinet
     * @var string
     */
    protected $viewsNamespace = 'site.pages.cabinet.';

    public function index()
    {

        $this->staticSEO(__('frontend.cabinet.Home'));

        $breadcrumbs = [
            [
                'title' => __('frontend.cabinet.Home'),
                'url' => ''
            ]
        ];

        $user = auth()->user();
        $active = 'home';
        $childrens = Children::where(['sponsor_id' => auth()->user()->id, 'active'=> 1])
            ->with(['gallery', 'files', 'videos'])
            ->sort()
            ->get();

        return response()
            ->view($this->viewsNamespace.'home.index', compact('user', 'breadcrumbs', 'active', 'childrens'));
    }


    /**
     * @IDRAM
     */
    public function success()
    {
        echo 'ok';
        return redirect()->route('cabinet.profile.history')->with('success_payment' , 'true');
    }

    public function failed()
    {
        echo 'Failed';
        return redirect()->route('cabinet.profile.history')->with('error_payment','true');
    }

    public function result(Request $request)
    {

        define("SECRET_KEY", "GC71gCHcx3EgCMyvDGf1OkaiR2QLu8dwaozc"); // Idram Payment System provide it
        define("EDP_REC_ACCOUNT", "110001262"); // Idram Payment System provide it
        $order = Order::where('random_order_id', $_REQUEST['EDP_BILL_NO'])->first();
        $amount = $_REQUEST['EDP_AMOUNT'];
        if (isset($_REQUEST['EDP_BILL_NO']) && isset($_REQUEST['EDP_REC_ACCOUNT']) && isset($_REQUEST['EDP_AMOUNT']) && !isset($_REQUEST['EDP_CHECKSUM'])) {
            if ($_REQUEST['EDP_PRECHECK'] == "YES") {
                if ($_REQUEST['EDP_REC_ACCOUNT'] == EDP_REC_ACCOUNT) {
                    if ($amount == $order->total) {
                        echo 'ok';
                    }
                }
            }
        }
        if (isset($_REQUEST['EDP_PAYER_ACCOUNT']) && isset($_REQUEST['EDP_BILL_NO']) && isset($_REQUEST['EDP_REC_ACCOUNT']) && isset($_REQUEST['EDP_AMOUNT']) && isset($_REQUEST['EDP_TRANS_ID']) && isset($_REQUEST['EDP_CHECKSUM'])){
            $amount = $_REQUEST['EDP_AMOUNT'];
            if ($amount == $order->total) {
                Order::where('random_order_id', $_REQUEST['EDP_BILL_NO'])->update(['paid' => 1]);
                echo 'ok';
            }
        }

    }


    /**
     * @ARCA
     */
    protected static $param = [
        'userName' => 'impharm_test',
        'password' => 'impharm2020***',
        'returnUrl' => ''
    ];

    public function payment($id){
        return redirect()->back();
        $order = Order::where('id',$id)->firstOrFail();
        if($order->payment_method=='bank'&& !(int)$order->paid){
            $bank_order_id=$order->id.'-'.str_random(25);
            self::$param['returnUrl']=route('paymentCheck',['order_id'=>$id,'random_order_id'=>$bank_order_id]);

            $client = new Client();
            $res = $client->get('https://ipaytest.arca.am:8445/payment/rest/register.do?userName='.self::$param["userName"].'&password='.self::$param["password"].'&amount='.(int)$order->total.'00'.'&orderNumber='.$bank_order_id.'&returnUrl='.self::$param["returnUrl"]);
            $res= json_decode($res->getBody());
            if( (int) $res->errorCode === 0){
                return redirect($res->formUrl);
            }else{
                return redirect()->route('cabinet.profile.history')->with('error_payment','true');

            }
        }else{
            abort(404);
        }
    }


    public function paymentWithToken($token){
        return redirect()->back();

        $order = Order::where('order_token',$token)->firstOrFail();
        if($order->payment_method=='bank'&& !(int)$order->paid){
            $bank_order_id=$order->id.'-'.str_random(25);


            self::$param['returnUrl']=route('paymentCheck',['order_id'=>$order->id,'random_order_id'=>$bank_order_id]);
            $client = new Client();
            $res = $client->get('https://ipaytest.arca.am:8445/payment/rest/register.do?userName='.self::$param["userName"].'&password='.self::$param["password"].'&amount='.(int)$order->total.'00'.'&orderNumber='.$bank_order_id.'&returnUrl='.self::$param["returnUrl"]);
            $res= json_decode($res->getBody());
            if( (int) $res->errorCode === 0){
                return redirect($res->formUrl);
            }else{
                return redirect()->route('cabinet.profile.history')->with('error_payment','true');

            }
        }else{
            abort(404);
        }
    }
    public  function  paymentCheck ($id,$random_order_id,Request $request){
        $client1 = new Client();
        $res = $client1->get(  'https://ipaytest.arca.am:8445/payment/rest/getOrderStatus.do?userName='.self::$param["userName"].'&password='.self::$param["password"].'&orderId='.$request->orderId);
        $res= json_decode($res->getBody());
        if( (int) $res->ErrorCode === 0){
            $model=Order::where('id',$id)->firstOrFail();
            $model->paid=1;
            $model->order_id=$request->orderId;
            $model->random_order_id=$random_order_id;
            $model->save();
            return redirect()->route('cabinet.profile.history')->with('success_payment','true');
        }else{
            $notify=t('payment.Произошла системная ошибка');
            return redirect()->route('cabinet.profile.history',compact('notify'));
        }


    }

}
