<?php

namespace App\Http\Controllers;

use App\Models\JobModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $jobs = JobModel::with('instation')->get();
        $applied = (Auth::user()) ? DB::table('applies')->where('user_id', Auth::user()->id)->pluck('instation_id')->toArray() : [];

        $jobs = $jobs->map(function($job) use ($applied){
            return (object) [
                'id' => $job->id,
                'instation' => $job->instation->name,
                'address' => $job->instation->address,
                'position' => $job->position,
                'desc' => $job->desc,
                'start' => Carbon::createFromDate($job->start)->isoFormat('D MMMM Y'),
                'end' => Carbon::createFromDate($job->end)->isoFormat('D MMMM Y'),
                'selection' => Carbon::createFromDate($job->selection)->isoFormat('D MMMM Y') ?? null,
                'notes' => $job->notes,
                'status' => (in_array($job->id, $applied)) ? true : false
            ];
        });
        
        return view('home', [
            'jobs' => $jobs
        ]);
    }
}
