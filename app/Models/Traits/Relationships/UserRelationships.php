<?php

namespace App\Models\Traits\Relationships;

use App\Models\UserOptions;

trait UserRelationships
{
    public function options()
    {
        return $this->HasOne(UserOptions::class, 'user_id', 'id');
    }

    public function updateOrCreateOptions($request, int $id)
    {
        $option = UserOptions::where('user_id', $id)->first();
        $update = [
            'user_id' => $id,
            'country_id' => (int)$request['country_id'] ?? null,
            'donor_type' => $request['donor_type'] ?? null,
            'date_of_birth' => $request['date_of_birth'] ?? null,
            'recurring_payment' => $request['recurring_payment'] ?? null,
            'is_send_email' => $request['is_send_email'] ?? null,
            'children_age_beetwen' => $request['children_age_beetwen'] ?? null,
            'children_gender' => $request['children_gender'] ?? null,
            'children_region' => $request['children_region'] ?? null,
            'children_program_approach' => $request['children_program_approach'] ?? null,
            'want_recive_letters' => $request['want_recive_letters'] ?? null,
        ];
        if (isset($request['sponsor_id'])) {
            $update['sponsor_id'] = $option && $option->sponsor_id !== $request['sponsor_id'] ? $request['sponsor_id'] : $request['sponsor_id'];
        }
        if (!$option) {
            UserOptions::insert($update);
        } else {
            $option->update($update);
        }
    }

    /**
     * @param int $id
     * @param string|null $dateOfBirth
     */
    public function createOptions(int $id, string $dateOfBirth = null)
    {
        $insert = [
            'user_id' => $id,
            'sponsor_id' => 'AA_' . $id,
            'date_of_birth' => $dateOfBirth,
        ];

        UserOptions::insert($insert);
    }
}
