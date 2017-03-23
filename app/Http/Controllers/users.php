<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

class Users extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function __invoke($id)
    {
        return view('pages.users', ['name' => 'users']);
    }

    public function index()
    {
        return view('pages.users', ['name' => 'users', 'title' => 'User List']);
    }

}