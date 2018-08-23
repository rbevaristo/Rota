<?php

namespace App\Http\Controllers\Api;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
            Mail::to('rota.developers@gmail.com')->send(new ContactUs($con));
            return response()->json(['data' => 'Message Sent!']);
        }

        return response()->json(['data' => 'Error server is down. Try again later.']);

    }
}
