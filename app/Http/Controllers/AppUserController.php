<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppUserController extends Controller
{
    public function appuserReport()
    {


        $users = DB::table('app_users')
            ->select('app_users.id', 'app_users.FirstName', 'app_users.LastName', 'app_users.Address', 'app_users.City', 'app_users.PhoneNumber', 'app_users.Email', 'app_users.created_at')
            ->get();


        return $users;
    }
}
