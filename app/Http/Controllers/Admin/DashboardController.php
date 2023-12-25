<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apply;
use App\Models\JobModel;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $applies = Apply::with('user')->with('job')->get();
        $jobs = $this->getData($applies);

        return view('admin.dashboard', compact('jobs'));
    }

    protected function getData($data)
    {
        $jobs = JobModel::all();
        $job_id = $data->pluck('job_id');

        setlocale(LC_TIME, 'id_ID');
        $result = $jobs->map(function($job) use($job_id){
            $counted = $job_id->countBy();
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
