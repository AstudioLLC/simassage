<?php

namespace App\Models;



class DepartmentsCategory extends AbstractModel
{


    public static function addOrEdit($parent_id, $request)
    {
        self::where(['department_page_id' => $parent_id])->where(['members_id'=> null, 'price_id'=>null, 'general_information' => null ])->delete();

        $insertData = [];
        if (!empty($request)) {
            foreach ($request as $service) {
                $insertData[] = [
                    'department_page_id' => $parent_id,
                    'service_id' => $service,
                ];
            }
            self::insert($insertData);
        }

        return true;
    }
    public static function addOrEditMembers($parent_id, $request)
    {
        self::where(['department_page_id' => $parent_id])->where(['service_id'=> null, 'price_id'=>null, 'general_information' => null ])->delete();

        $insertData = [];
        if (!empty($request)) {
            foreach ($request as $member) {
                $insertData[] = [
                    'department_page_id' => $parent_id,
                    'members_id' => $member,
                ];
            }
            self::insert($insertData);
        }

        return true;
    }
    public static function addOrEditPrices($parent_id, $request)
    {
        self::where(['department_page_id' => $parent_id])->where(['service_id'=> null, 'members_id'=>null, 'general_information' => null ])->delete();

        $insertData = [];
        if (!empty($request)) {
            foreach ($request as $price) {
                $insertData[] = [
                    'department_page_id' => $parent_id,
                    'price_id' => $price,
                ];
            }
            self::insert($insertData);
        }

        return true;
    }

}
