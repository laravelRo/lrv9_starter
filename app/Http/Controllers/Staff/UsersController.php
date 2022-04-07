<?php

namespace App\Http\Controllers\Staff;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Staff\UpdateMemberRequest;

class UsersController extends Controller
{
    //Listam utilizatorii
    public function listUsers()
    {
        if (request('blocked')) {
            $users = User::onlyTrashed()->orderBy('name')->paginate(15);
        } else {

            $users = User::orderBy('name')->paginate(15);
            Session::put('users_url', request()->fullUrl());
        }

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

    public function updateUsers(UpdateMemberRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->role = $request->role;
        $user->phone = $request->phone;



        $mess = 'Datele utilizatorului au fost actualizate!';
        //verificare email
        if ($request->verified == 'mark') {
            $user->email_verified_at = now();
            $mess = "Datele utilizatorului au fost actualizate si emailul a fost validat cu succes ";
        }
        if ($request->verified == 'invalid') {
            $user->email_verified_at = null;
            $mess = "Datele utilizatorului au fost actualizate si emailul a fost invalidat!";
        }
        if ($request->verified == 'send') {
            $user->email_verified_at = null;
            $user->sendEmailVerificationNotification();
            $mess = "Datele utilizatorului au fost actualizate, emailul a fost invalidat si a fost trimisa o notificare prin email!";
        }


        $user->save();
        return back()->with('success', $mess);
    }

    public function blockUser($id)
    {
        $user = User::findOrFail($id);
        $user_name = $user->name;
        $user->delete();
        return back()->with('success', 'User-ul extern ' . $user_name . ' a fost blocat');
    }

    public function deleteUser($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user_name = $user->name;
        $user->forceDelete();
        return back()->with('success', 'User-ul extern ' . $user_name . ' a fost sters definitiv din baza de date');
    }

    public function restoreUser($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user_name = $user->name;
        $user->restore();
        return back()->with('success', 'User-ul extern ' . $user_name . ' a fost reactivat!');
    }
}
