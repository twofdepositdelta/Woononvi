<?php

namespace App\Traits;

trait FormatUserArray
{
    private function formatUserArray($user)
    {
        $userArray = $user->toArray();

        unset($userArray['roles']);

        $userArray['username'] = $userArray['username'] ?? '';
        $userArray['role'] = $user->roles->first() ? $user->roles->first()->name : null;
        $userArray['country_name'] = $user->country_name;
        $userArray['city_name'] = $user->city_name;
        $userArray['indicatif'] = $user->country_code;
        $userArray['phone_number'] = $user->phone_number;

        return $userArray;
    }
}
