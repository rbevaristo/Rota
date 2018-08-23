<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function profile()
    {
        return response()->json([
            'data' => new ProfileResource(auth()->user())
        ]);
    }

    public function update(Request $request)
    {
        // Update User's Name
        $user = auth()->user();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->save();

        // Update User's Profile
        $profile = auth()->user()->profile;
        $profile->avatar = $request->hasFile('file') ? $this->upload($request) : auth()->user()->profile->avatar;
        $profile->gender = ($request->gender == 'Male') ? 1 : 0;
        $profile->birthdate = $request->birthdate;
        $profile->contact = $request->contact_number;
        $profile->save();

        // Update User's Address
        $address = auth()->user()->profile->address;
        $address->number = $request->number;
        $address->street = $request->street;
        $address->city = $request->city;
        $address->state = $request->state;
        $address->country = $request->country;
        $address->zip = $request->zip;
        $address->save();

        if($user && $profile && $address)
            return response()->json(['data' => new ProfileResource(auth()->user())]);
         return response()->json(['data' => 'Error']);

    }
}
