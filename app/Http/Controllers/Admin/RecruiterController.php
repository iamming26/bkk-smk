<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class RecruiterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recruiters = User::where('type', 3)
                            ->join('user_details', 'users.id', 'user_details.user_id')
                            ->join('instations', 'user_details.instation_id', 'instations.id')
                            ->select('users.id as id','users.name as name', 'instations.name as instation', 'user_details.phone as phone')
                            ->get();

        $title = 'Confirmation Delete!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('admin.recruiter.index', compact('recruiters'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        $user = User::where('id', $id)->with('detail')->first();

        return view('admin.recruiter.show', compact('user'));
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
        DB::table('users')->delete($id);
        DB::table('user_details')->where('user_id', $id)->delete();

        alert()->success('Success!','User Deleted Successfully');
        return redirect()->back();
    }

    public function updateStatus($id)
    {
        $user = User::find($id);
        if($user->status == 1){
            $user->status = 0;
        }else{
            $user->status = 1;
        }

        Alert::success('Success!', 'Status Has Ben Updated!');
        return redirect()->back();
    }
}
