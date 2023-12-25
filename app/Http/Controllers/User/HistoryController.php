<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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
        $applies = DB::table('applies')
                        ->join('jobs', 'applies.job_id', '=', 'jobs.id')
                        ->where('user_id', Auth::user()->id)
                        ->get();

                        $applies = $applies->map(function($data){
            return (object) [
                'id' => $data->id,
                'instation' => $data->instation,
                'position' => $data->position,
                'desc' => $data->desc,
                'start' => $data->start,
                'end' => $data->end,
                'selection' => $data->selection,
                'apply_date' => Carbon::parse($data->created_at)->format('d-m-Y'),
            ];
        });
        
        return view('user.history', [
            'applies' => $applies
        ]);
    }

    public function delete(Request $request)
    {
        $data = DB::table('applies')->delete($request->id);

        return redirect()->back()->with('success', 'Berhasil Dihapus !');
    }
}
