<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Auth;

class UserController extends Controller
{
    public function userupdate()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('User.updateuser',compact('user'));
    }

    public function updateuser(Request $request, $id)
    {
           $v = Validator::make($request->all(),[
               'name' => 'required',
               'email' => 'required|unique:users,email,'.$id,
           ],[
                'name.required' => 'Name is required',
                'email.required' => 'Email is required',
                'email.unique' => 'Email has change !',
           ]);
        if ($v->fails()) {
            return back()->withErrors($v)->withInput();
        } else {
            User::find($id)->update($request->only('name','email'));
            return back()->with('sucess','Data Success Update !');
        }
    }

    public function passupdate()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('User.updatepass',compact('user'));
    }

    public function updatepass(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if (Hash::check($request->old_password, $user->password)) {
            $v = Validator::make($request->all(),[
                'old_password' => 'required',
                'new_password' => 'required|confirmed|min:6',
                'new_password_confirmation' => 'required'
            ],[
                'old_password.required' => 'Password Lama Harus diisi !',
                'new_password.required' => 'Password Baru Harus diisi !',
                'new_password_confirmation.required'=> 'Password Baru Harus dikonfirmasi !',
                'new_password.min' => 'Password Minimal 6 Karakter',
                'new_password_confirmation.confirmed' => 'Konfirmasi Password Baru tidak sesuai'
            ]);

            if ($v->fails()) {
                return back()->withErrors($v)->withInput();
            }
            $user = User::find($id)->update(['password' => Hash::make($request->new_password)]);

            if ($user) {
                return back()->with('success','Data has Update !');
            } else{
                return back()->with('fail','Data No Update !');
            }
        } else {
            $v = Validator::make($request->all(),[
                'old_password' => 'required',
            ],[
                'old_password.required' => 'Password Lama Harus diisi !',
            ]);
            if ($v->fails()) {
                return back()->withErrors($v)->withInput();
            }

            return back()->with('fail','Password Lama anda Tidak Sesuai!');
        }
    }
}
