<?php


namespace App\Traits;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

trait InteractsWithSortable
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function sort(Request $request)
    {
        $this->validate($request, [
            'data' => ['required', 'array'],
            'data.*' => ['required', 'exists:'.$this->model->getTable().',id'],
        ]);

        return $this->modelClass::sortable();
    }
}
