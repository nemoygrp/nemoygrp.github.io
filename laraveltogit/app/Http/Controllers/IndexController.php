<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Vacation;

class IndexController extends Controller
{


    public function index()
    {
        return view('page')->with([
            'vacations' => Vacation::all(),
            'users' => User::select(['id', 'name', 'email', 'role'])->get()
        ]);
    }

}


