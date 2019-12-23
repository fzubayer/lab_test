<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\Http\Requests\StoreJobsRequest;
use Auth;

class JobController extends Controller
{
    public $jobs;
    dd($jobs);
    function __construct(Job $jobs)
    {
        $this->jobs = $jobs;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Auth::user()->jobs->sortByDesc('created_at');
        return view('jobs/index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jobs.form', compact('job'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $job = new Job;
        $job->user_id = $request->user_id;
        $job->title = $request->title;
        $job->category = $request->category;
        $job->description = $request->description;
        $job->save();
        return redirect(route('jobs.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job = $this->jobs->findOrFail($id);
        return view('jobs.form', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $job = $this->jobs->findOrFail($id);
        $job->user_id = $request->user_id;
        $job->title = $request->title;
        $job->category = $request->category;
        $job->description = $request->description;
        $job->save();
        return redirect(route('jobs.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job = $this->jobs->findOrFail($id);
        $job->delete();
        return redirect(route('jobs.index'));
    }
}
