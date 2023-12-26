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
        $this->verifyOldPassword($request->password_old, $request->all());
        
        $id = Auth::user()->id;

        $data = $this->validate($request, [
            'email' => 'email:dns|unique:users,email',
            'password_new' => 'min:8',
            'verify_password_new' => 'same:password_new',
        ]);

        if(!$data['email']){
            $user = User::find($id);
            $user->password = Hash::make($data['verify_password_new']);
            $user->save();
        }elseif(!$data['verify_password_new']){
            $user = User::find($id);
            $user->email = $data['email'];
            $user->save();
        }elseif(!$data['email'] && !$data['verify_password_new']){
            $user = User::find($id);
            $user->email = $data['email'];
            $user->password = Hash::make($data['verify_password_new']);
            $user->save();
        }else{
            return redirect()->back()->with('fail', 'Email atau Passwod tidak diisi !.');
        }

    }

    protected function verifyOldPassword($password_old, $req)
    {
        $verify = Hash::check($password_old, Auth::user()->password);

        if(!$verify){
            return redirect()->back()->with('fail', 'Verifikasi Password Salah !.');
        }

        return true;
    }
}
