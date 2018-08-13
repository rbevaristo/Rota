<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $company = Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'location' => $request->location,
            'contact' => $request->contact_number,
            'user_id' => auth()->user()->id
        ]);
        
        if(!$company){
            return redirect()->back()->with('error', 'Invalid Data');
        }

        return redirect('/dashboard/manage');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request)
    {
        $company = auth()->user()->company;
        $company->name = $request->name;
        $company->email = $request->email;
        $company->location = $request->location;
        $company->contact = $request->contact;
        $company->save();

        if(!$company){
            return redirect()->back()->with('error', 'Invalid Input Data');
        }

        return redirect()->back()->with('success', 'Update Success!!');
    }

}
