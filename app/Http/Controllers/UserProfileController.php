<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserProfileRequest;

class UserProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update(UserProfileRequest $request)
    {
        // Update User's Name
        $user = auth()->user();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->save();

        // Update User's Profile
        $profile = auth()->user()->profile;
        $profile->avatar = $request->hasFile('file') ? $this->upload($request) : auth()->user()->profile->avatar;
        $profile->gender = $request->gender;
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
            return redirect()->back()->with('success', 'Profile Updated!!');
        return redirect()->back()->with('error', 'Error Updating Please Check Your Inputs');
        
    }

    /**
     * Modify the name of the image by adding current time
     * then uploading the image to the storage
     * @return string
     */
    public function upload(Request $request) 
    {

        $filenameWithExt = $request->file('file')->getClientOriginalName();

        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        
        $extension = $request->file('file')->getClientOriginalExtension();
        
        $fileNameToStore = $filename.'_'.time().date('mdY').'.'.$extension;
        
        $path = $request->file('file')->storeAs('public/avatar', $fileNameToStore);

        return $fileNameToStore;

    }
}
