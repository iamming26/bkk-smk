<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apply;
use App\Models\Instation;
use App\Models\JobModel;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $applies = Apply::with('user')->with('job')->with('instation')->get();
        $all_job = JobModel::with(['instation'])->get();
        $all_apply = Apply::with('user')->get();

        $jobs = $this->getData($all_job, $all_apply);

        $title = 'Confirmation Delete!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('admin.job.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $instations = Instation::orderBy('name')->get();
        return view('admin.job.create', compact('instations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'instation_id' =>'required',
            'position' =>'required',
            'start' =>'required',
            'end' =>'required',
            'desc' =>'required',
            'selection' =>'required',
        ]);

        JobModel::create($data);
        Alert::success('Success!', 'Data has been created.');
        return redirect('/admin/job');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $job = JobModel::where('id', $id)
                            ->with('instation')
                            ->first();
        $applies = DB::table('applies')
                    ->where('job_id', $job->id)
                    ->rightJoin('users', 'applies.user_id', '=', 'users.id')
                    ->get();
                    
        return view('admin.job.show', compact('job', 'applies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //delete job
        $job = JobModel::findOrFail($id);
        $job->delete();

        //delete applies
        Apply::where('job_id', $id)->delete();
        
        alert()->success('Success!','Job Deleted Successfully');
        return redirect()->back();
    }

    protected function getData($jobs, $applies)
    {
        $instation = $applies->pluck('job_id');

        setlocale(LC_TIME, 'id_ID');
        $result = $jobs->map(function($job) use($instation){
            $counted = $instation->countBy();
            $total = $counted->all();

            return (object) [
                'id' => $job->id,
                'instation' => $job->instation->name,
                'position' => $job->position,
                'desc' => $job->desc,
                'start' => Carbon::createFromDate($job->start)->isoFormat('D MMMM Y'),
                'end' => Carbon::createFromDate($job->end)->isoFormat('D MMMM Y'),
                'label_end' => Carbon::now() > $job->end ? 'bg-danger text-white' : 'bg-success text-white',
                'selection' => Carbon::createFromDate($job->selection)->isoFormat('D MMMM Y') ?? null,
                'notes' => $job->notes,
                'total' => $total[$job->id] ?? 0,
            ];
        })->values();

        return $result;
    }
}
