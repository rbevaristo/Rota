<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Mail\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function send(Request $request)
    {
        $con = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ]);

        if($con) {
            Mail::to('routa.developers@gmail.com')->send(new ContactUs($con));
            return redirect()->back()->with('success', 'Message sent');
        }
        return redirect()->back()->with('error', 'There must be something wrong');
    }
}
