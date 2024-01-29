<?php

namespace App\Http\Controllers\syndash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class AdminController extends Controller
{
    public function dashboard(){
        $users = User::get();
        return view('dashboard',['users'=>$users]);
    }
   
}
