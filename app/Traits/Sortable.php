<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use ReflectionException;
use ReflectionMethod;

trait Sortable
{

    /**
     * @param false $get_ids
     * @return array|JsonResponse
     * @throws ReflectionException
     */
    public static function sortable($get_ids = false)
    {
        if (Request::has('data')) {
            $data = Request::input('data');
            $casesRaw = '';
            $sort = 1 + Session::get('sort') ?? 0;
            $ids = [];
            if (arraySize($data)) foreach ($data as $item) {
                $id = is_id($item) ? $item : null;
                if ($id && !in_array($id, $ids)) {
                    $ids[] = $id;
                    $casesRaw .= ' WHEN `id`=' . $id . ' THEN ' . $sort++;
                }
            }
            if (!empty($ids)) {
                $thisClass = get_class();
                if (
                    method_exists($thisClass, 'clearCaches') &&
                    (new ReflectionMethod($thisClass, 'clearCaches'))->getNumberOfRequiredParameters() == 0
                ) self::clearCaches();
                $result = self::whereIn('id', $ids)->update(['ordering' => DB::raw('CASE' . $casesRaw . ' END')]);
                if ($get_ids) return $ids;

                return response()->json($result);
            }
        }

        return response()->json(false);
    }

    public function scopeSort($query)
    {
        return $query->orderBy('ordering')->orderBy('id', ($this->sortableDesc ?? true) ? 'desc' : 'asc');
    }

    public function sortValue()
    {
        if ($this->sortableDesc ?? true) return 0;

        return DB::raw('(select `sort` from (select ifnull(max(`ordering`),0) as sort from `' . $this->getTable() . '`) as sort)');
    }
}
