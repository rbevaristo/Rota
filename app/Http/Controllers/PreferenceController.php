<?php

namespace App\Http\Controllers;

use App\Preference;
use Illuminate\Http\Request;

class PreferenceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    public function preference(Request $request)
    {

        if(!auth()->user()->preference)
        {
            $preference = new Preference;
            $preference->emp_id = auth()->user()->id;
            $preference->dayoff = ($request->column == 'dayoff') ? $request->value : null;
            $preference->shift = ($request->column == 'shift') ? $request->value : null;
            $preference->save();
        }
        else 
        {
            auth()->user()->preference->update([
                $request->column => $request->value
            ]);
        }

        return response()->json([
            'success' => true
        ]);
    }
}
