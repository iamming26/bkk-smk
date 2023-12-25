<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    public function apply(Request $request)
    {
        $job_id = $request->job_id;
        $user_id = Auth::user()->id;

        DB::table('applies')->insert([
            'user_id' => $user_id,
            'job_id' => $job_id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Berhasil melamar !');
    }
}
