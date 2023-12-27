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
                        ->with('user')
                        ->with('job')
                        ->with('instation')
                        ->get();

        $title = 'Confirmation Delete!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
                        
        $applies = $applies->map(function($data){
            $selection = $data->job->selection ? Carbon::createFromDate($data->job->selection)->isoFormat('D MMMM Y') : null;
            return (object) [
                'id' => $data->id,
                'instation' => $data->instation->name,
                'address' => $data->instation->address,
                'position' => $data->job->position,
                'desc' => $data->desc,
                'start' => Carbon::createFromDate($data->start)->isoFormat('D MMMM Y'),
                'end' => Carbon::createFromDate($data->end)->isoFormat('D MMMM Y'),
                'selection' =>  $selection,
                'notes' => $data->notes,
                'apply_date' => Carbon::parse($data->created_at)->format('d-m-Y'),
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
