<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update($id, $setting, $value)
    {
        $s = Setting::where('user_id', $id)->first()->update([
            $setting => $value
        ]);

        if(!$s){
            return response()->json(['success' => false, 'message' => 'Error']);
        }
        return response()->json(['success' => true, 'message' => 'Updated']);
    }
}
