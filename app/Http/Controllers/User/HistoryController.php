<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Apply;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
        
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function history()
    {
        $applies = Apply::where('user_id', Auth::user()->id)
                        ->join('users', 'users.id', 'applies.user_id')
                        ->join('jobs', 'jobs.id', 'applies.job_id')
                        ->join('instations', 'instations.id', 'jobs.instation_id')
                        ->select(
                            'applies.id as id',
                            'instations.name as instation',
                            'instations.address as address',
                            'jobs.position as position',
                            'jobs.start as start',
                            'jobs.end as end',
                            'jobs.selection as selection',
                            'jobs.desc as desc',
                            'jobs.created_at as created_at',
                        )
                        ->get();

        $title = 'Confirmation Delete!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
                        
        $applies = $applies->map(function($data){
            $selection = $data->selection ? Carbon::createFromDate($data->selection)->isoFormat('D MMMM Y') : null;
            return (object) [
                'id' => $data->id,
                'instation' => $data->instation,
                'address' => $data->address,
                'position' => $data->position,
                'desc' => $data->desc,
                'start' => Carbon::createFromDate($data->start)->isoFormat('D MMMM Y'),
                'end' => Carbon::createFromDate($data->end)->isoFormat('D MMMM Y'),
                'selection' =>  $selection,
                'notes' => $data->notes,
                'apply_date' => Carbon::parse($data->created_at)->isoFormat('D MMMM Y'),
            ];
        });
        
        return view('user.history', [
            'applies' => $applies
        ]);
    }

    public function delete(Request $request)
    {
        DB::table('applies')->delete($request->id);
        alert()->success('Success!','Apply Job Deleted Successfully');
        return redirect()->back();
    }
}
