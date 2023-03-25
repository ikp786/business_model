<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\UpdateBranchRequest;
use App\Models\BranchWorkingHour;
use App\Models\Business;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $businesses = Business::all();        
        return view('branches.create', compact('businesses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBranchRequest $request)
    {       
        try{
        $validatedData = $request->all();
        $branch = new Branch();
        $branch->name = $request->name;        
        $branch->business_id = $request->business_id;
        $branch->save();
        foreach ($validatedData['working_days'] as $key => $workingHourData) {
            for($i = 0; $i< count($validatedData['working_days']); $i++){
                $workingHour = new BranchWorkingHour();
                $workingHour->branch_id = $branch->id;
                $workingHour->day = $workingHourData;
                $workingHour->start_time = $request->start_time[$i];
                $workingHour->end_time = $request->end_time[$i];                
                $workingHour->save();
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {                
                $imagePath = time() . '.' . $image->extension();
                $image->move(public_path('branch_images'), $imagePath);
                $branch->images()->create([
                    'image_name' => $imagePath
                ]);
            }
        }      
        return redirect()->route('branches.show',$branch->id)->with('success', 'Branch created successfully!');
    }catch(\Throwable $e){
        return redirect()->back()->with('failed',$e->getMessage(). "On Line". $e->getLine());
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {

        $workingHours = $branch->workingHours()->get();
    // Creating a 7-element array to hold opening and closing hours for each day of the week
    $workingHoursArray = [
        'Sun' => ['open' => '', 'close' => ''],
        'Mon' => ['open' => '', 'close' => ''],
        'Tue' => ['open' => '', 'close' => ''],
        'Wed' => ['open' => '', 'close' => ''],
        'Thu' => ['open' => '', 'close' => ''],
        'Fri' => ['open' => '', 'close' => ''],
        'Sat' => ['open' => '', 'close' => '']
    ];

    // Populating the array with opening and closing hours from the database
    foreach ($workingHours as $workingHour) {
        $dayOfWeek = $workingHour->day;
        $workingHoursArray[$dayOfWeek]['open'] .= $workingHour->start_time . ' - ' .$workingHour->end_time .' ';
    }

    // Replacing empty opening and closing hours with "Closed" string
    foreach ($workingHoursArray as $dayOfWeek => $hours) {
        if (empty($hours['open']) && empty($hours['close'])) {
            $workingHoursArray[$dayOfWeek]['open'] = 'Closed';
            $workingHoursArray[$dayOfWeek]['close'] = '';
        }
    }
    $workingHours = $workingHoursArray;
    $images = $branch->images()->get();
    return view('branches.show', compact('branch', 'workingHoursArray','workingHours','images'));        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBranchRequest $request, Branch $branch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        //
    }
}
