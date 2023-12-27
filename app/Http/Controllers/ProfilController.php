<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('profile', [
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {
        $verify = Hash::check($request->password_old, Auth::user()->password);

        if(!$verify){
            return redirect()->back()->with('fail', 'Verifikasi Password Salah !');
        }
        
        $id = Auth::user()->id;

        if(!$request->password && !$request->confirmation_password_new && $request->email){
            $this->validate($request, [
                'email' => 'email|unique:users,email',
            ]);

            $user = User::find($id);
            $user->email = $request->email;
            $user->update();

            Alert::success('Success!', 'Email updated succesfully.');
            return redirect()->back();

        }elseif(!$request->email && $request->password_new && $request->confirmation_password_new){
            $this->validate($request, [
                'password_new' => 'min:8',
                'confirmation_password_new' => 'same:password_new',
            ]);

            $user = User::find($id);
            $user->password = Hash::make($request->confirmation_password_new);
            $user->update();

            Alert::success('Success!', 'Password updated succesfully.');
            return redirect()->back();

        }elseif($request->email && $request->password_new && $request->confirmation_password_new){
            $this->validate($request, [
                'email' => 'email|unique:users,email',
                'password_new' => 'min:8',
                'confirmation_password_new' => 'same:password_new',
            ]);

            $user = User::find($id);
            $user->email = $request->email;
            $user->password = Hash::make($request->confirmation_password_new);
            $user->update();

            Alert::success('Success!', 'Email & Password updated succesfully.');
            return redirect()->back()->with('success', 'Email & Password Berhasil Diupdate !');

        }else{
            Alert::error('Failed!', 'Email & Password is required.');
            return redirect()->back();
        }

    }
}
