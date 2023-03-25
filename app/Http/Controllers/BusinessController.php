<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Http\Requests\StoreBusinessRequest;
use App\Http\Requests\UpdateBusinessRequest;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $businesses = Business::all();
        return view('businesses.index', compact('businesses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('businesses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBusinessRequest $request)
    {
        try{
        $logoName = time() . '.' . $request->logo->extension();
        $request->logo->move(public_path('business_logo'), $logoName);

        $business = new Business([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone_number' => $request->get('phone_number'),
            'logo' => $logoName
        ]);

        $business->save();
        return redirect('/business')->with('success', 'Business added successfully.');
    }catch(\Throwable $e){
        return redirect()->back()->with('failed',$e->getMessage() . " On Line ".$e->getLine());
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(Business $business)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Business $business)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBusinessRequest $request, Business $business)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Business $business)
    {
        try{
        $business->delete();
        return redirect('/business')->with('success', 'Business deleted successfully.');
    }catch(\Throwable $e){
        return redirect()->back()->with('failed',$e->getMessage() . " On Line ".$e->getLine());
    }
    }
}
