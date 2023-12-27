<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

            return redirect()->back()->with('success', 'Email Berhasil Diupdate !');

        }elseif(!$request->email && $request->password_new && $request->confirmation_password_new){
            $this->validate($request, [
                'password_new' => 'min:8',
                'confirmation_password_new' => 'same:password_new',
            ]);

            $user = User::find($id);
            $user->password = Hash::make($request->confirmation_password_new);
            $user->update();

            return redirect()->back()->with('success', 'Password Berhasil Diupdate !');

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

            return redirect()->back()->with('success', 'Email & Password Berhasil Diupdate !');

        }else{
            return redirect()->back()->with('fail', 'Email atau Password Baru tidak diisi !');
        }

    }
}
