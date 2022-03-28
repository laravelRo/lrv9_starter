<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    //afisam control panel pentru utilizatori
    public function userSettings()
    {
        return view('admin.settings');
    }
}
