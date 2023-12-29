<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Carbon\Carbon;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if(is_null($request->ser))
        {
            $today = Carbon::now()->format('Y-m-d');
        }
        else
        {
            $today = $request->ser;
        }
        // return $request->ser;
        $tasks = Job::where('created_at','LIKE','%'.$today.'%')->latest()->paginate(5);
        return view('jobs.index',compact('tasks'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jobs.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'title' => 'required',
            'description' => 'required',
            'created_by' => 'required',
            'updated_by' => 'required',
            'status'=> 'required',

        ]);
    
        Job::create($request->all());
    
        return redirect()->route('jobs.index')
                        ->with('success','Task created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        return view('jobs.show',compact('job'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        return view('jobs.edit',compact('job'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        request()->validate([
            'title' => 'required',
            'description' => 'required',
            'updated_by' => 'required',
            'status'=> 'required',
        ]);
    
        $job->update($request->all());
    
        return redirect()->route('jobs.index')
                        ->with('success','task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        $job->delete();
    
        return redirect()->route('jobs.index')
                        ->with('error','Task deleted successfully');
    }
}
