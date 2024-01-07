<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apply;
use App\Models\Instation;
use App\Models\JobModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $applies = Apply::with('user')->with('job')->with('instation')->get();
        $jobs = $this->getData($applies);

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    protected function getData($data)
    {
        $jobs = JobModel::with('instation')->get();
        $instation_id = $data->pluck('instation_id');

        setlocale(LC_TIME, 'id_ID');
        $result = $jobs->map(function($job) use($instation_id){
            $counted = $instation_id->countBy();
            $total = $counted->all();

            return (object) [
                'id' => $job->id,
                'instation' => $job->instation->name,
                'position' => $job->position,
                'desc' => $job->desc,
                'start' => Carbon::createFromDate($job->start)->isoFormat('D MMMM Y'),
                'end' => Carbon::createFromDate($job->end)->isoFormat('D MMMM Y'),
                'selection' => Carbon::createFromDate($job->selection)->isoFormat('D MMMM Y') ?? null,
                'notes' => $job->notes,
                'total' => $total[$job->id] ?? 0,
            ];
        })->values();

        return $result;
    }
}
