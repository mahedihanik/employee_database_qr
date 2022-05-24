<?php

namespace App\Http\Helpers;

use App\Models\Employee;
use App\Models\User;

class RoleCheck
{
    public static function permissionCheck($emp_id)
    {
        $role = Employee::select('employee_role')->where('id', $emp_id)->first();

        return $role->employee_role;

    }
    public static function roleCheckByLoggedInUser($user_id)
    {
        $userInfo = User::select('emp_id')->where('id', $user_id)->first();
        return self::permissionCheck($userInfo->emp_id);

    }

}
