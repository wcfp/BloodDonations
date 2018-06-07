<?php
/**
 * Created by PhpStorm.
 * User: agavrila
 * Date: 2018-06-06
 * Time: 11:01 PM
 */

namespace App\Http\Controllers;


use App\User;

class AdminController extends Controller
{


    public function users()
    {
        return User::all();
    }

}