<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    //Listam utilizatorii
    public function listUsers()
    {
        $users = User::orderBy('name')->paginate(15);
        return view('staff.staf.users-list')

            ->with('users', $users);
    }

    //afisam formularul de editare pentru un uitlizator
    public function editUsers($id)
    {
        $user = User::findOrFail($id);
        return view('staff.staf.users-edit')
            ->with('user', $user);
    }
}
