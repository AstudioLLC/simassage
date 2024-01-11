<?php

namespace App\Models;



class MembersCategory extends AbstractModel
{


    public static function addOrEdit($department_id, $request)
    {
        self::where(['department_id' => $department_id])->delete();

        $insertData = [];
        if (!empty($request)) {
            foreach ($request as $department) {
                $insertData[] = [
                    'department_id' => $department_id,
                    'members_id' => $department,
                ];
            }
            self::insert($insertData);
        }

        return true;
    }

}
