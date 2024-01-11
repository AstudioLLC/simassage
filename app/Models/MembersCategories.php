<?php

namespace App\Models;



class MembersCategories extends AbstractModel
{


    public static function addOrEdit($parent_id, $request)
    {
        self::where(['department_page_id' => $parent_id])->delete();

        $insertData = [];
        if (!empty($request)) {
            foreach ($request as $service) {
                $insertData[] = [
                    'department_page_id' => $parent_id,
                    'members_id' => $service,
                ];
            }
            self::insert($insertData);
        }

        return true;
    }

}
