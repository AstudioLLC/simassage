<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Omnipay\Omnipay;
use App\Constants\Idram as IdramConstants;

trait Idram
{
    public static function createIdram(Request $request)
    {
        //dd($request->validated(), $request->all(), $request->session()->get('gift'), 123);
        $gateway = Omnipay::create('Idram');
        $gateway->setAccountId(IdramConstants::EDP_REC_ACCOUNT);
        $gateway->setSecretKey(IdramConstants::SECRET_KEY);
        $purchaseData = $gateway->purchase(); // Call purchase() to get PurchaseRequest instance
        $purchaseData->setLanguage(app()->getLocale()); // Language
        $purchaseData->setAmount(10); // Amount to charge
        $purchaseData->setTransactionId(1000); // Transaction ID from your system
        //$purchaseData->setCustomData(array('EDP_FAIL_URL' => 'fail url', 'EDP_RESULT_URL' => 'result url', 'EDP_SUCCESS_URL' => 'success_url')); // Transaction ID from your system
        $purchaseData->setEmail('gor_harutyunyan_89@mail.ru');
        //dd($purchaseData->getParameters(), $purchaseData->getData(), $request->session()->get('gift'));
        $purchase = $purchaseData->send();
        $purchase->redirect();
    }

    public static function resultIdram()
    {
        $gateway = Omnipay::create('Idram');
        $gateway->setAccountId(IdramConstants::EDP_REC_ACCOUNT);
        $gateway->setSecretKey(IdramConstants::SECRET_KEY);

        $purchase = $gateway->completePurchase()->send();

        // Do the rest with $purchase and response with 'OK'
        if ($purchase->isSuccessful()) {
            dd('success');



        }
        dd('failed');

        //return new Response('OK');
        return false;
    }

    public static function failedIdram()
    {
        $url = 'dprvoci-tchamphan';
        return $url;
    }

    public static function successIdram()
    {
        $url = 'give-a-gift';
        return $url;
    }
}
