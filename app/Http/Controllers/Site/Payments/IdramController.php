<?php

namespace App\Http\Controllers\Site\Payments;

use App\Http\Controllers\Site\BaseController;
use Illuminate\Http\Request;
use App\Traits\Idram;

class IdramController extends BaseController
{
    use Idram;

    public function result(/*Request $request*/)
    {
        $this->resultIdram();
    }

    public function success()
    {
        return redirect()->route('page', ['url' => $this->successIdram() ?? null])->with('success_payment' , 'true');
    }

    public function failed()
    {
        return redirect()->route('gifts.create.step3', ['url' => $this->failedIdram() ?? null]);
    }
}
