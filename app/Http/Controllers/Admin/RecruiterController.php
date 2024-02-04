<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Instation;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class RecruiterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recruiters = User::where('type', 2)
                            ->join('user_details', 'users.id', 'user_details.user_id')
                            ->join('instations', 'user_details.instation_id', 'instations.id')
                            ->select('users.id as id', 'users.email as email', 'users.name as name', 'instations.name as instation', 'user_details.phone as phone')
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
        $instations = Instation::all();

        return view('admin.recruiter.create', compact('instations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'instation' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:user_details,phone',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('bkk_hr_123'),
            'type' => 2,
        ]);

        UserDetail::create([
            'user_id' => $user->id,
            'phone' => $request->phone,
            'instation_id' => $request->instation,
        ]);

        alert()->success('Success!','User Deleted Successfully');
        return redirect('admin/recruiter');
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
