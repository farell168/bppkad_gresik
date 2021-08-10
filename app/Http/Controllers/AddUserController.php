<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Session;
use App\User;


class AddUserController extends Controller
{
    public function showFormRegister()
    {
        return view('view_add_user');
    }
    
    public function register(Request $request)
    {
        $rules = [
            'nip'                   => 'required|min:3|max:35|unique:users,nip',
            'name'                  => 'required|min:3|max:35',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|confirmed'
        ];
 
        $messages = [
            'nip.required'          => 'NIP Lengkap wajib diisi',
            'nip.unique'          => 'NIP sudah terdaftar',
            'name.required'         => 'Nama Lengkap wajib diisi',
            'name.min'              => 'Nama lengkap minimal 3 karakter',
            'name.max'              => 'Nama lengkap maksimal 35 karakter',
            'email.required'        => 'Email wajib diisi',
            'email.email'           => 'Email tidak valid',
            'email.unique'          => 'Email sudah terdaftar',
            'password.required'     => 'Password wajib diisi',
            'password.confirmed'    => 'Password tidak sama dengan konfirmasi password'
        ];
 
        $validator = Validator::make($request->all(), $rules, $messages);
 
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }
 
        $user = new User;
        $user->nip = ucwords(strtolower($request->nip));
        $user->name = ucwords(strtolower($request->name));
        $user->email = strtolower($request->email);
        $user->password = Hash::make($request->password);
        $user->email_verified_at = \Carbon\Carbon::now();
        $simpan = $user->save();
        
 
        if($simpan){
            Session::flash('success', 'Register berhasil!');
            return redirect()->route('daftaruser');
        } else {
            Session::flash('errors', ['' => 'Register gagal! Silahkan ulangi beberapa saat lagi']);
            return redirect()->route('view_add_user');
        }
    }

    public function edit_user(User $user)
    {
        
        return view('view_edit_data_user', compact('user'));
    }

    public function update_user(Request $request, User $user)
    {
        
        $rules = [            
            'name'                  => 'required|min:3|max:35',
            'email'                 => 'required|email',
            'password'              => 'confirmed'
        ];
 
        $messages = [            
            'name.required'         => 'Nama Lengkap wajib diisi',
            'name.min'              => 'Nama lengkap minimal 3 karakter',
            'name.max'              => 'Nama lengkap maksimal 35 karakter',
            'email.required'        => 'Email wajib diisi',
            'email.email'           => 'Email tidak valid',
            'email.unique'          => 'Email sudah terdaftar',
        ];
 
        $validator = Validator::make($request->all(), $rules, $messages);
 
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $user = User::find($request->nip)->first();
        
        if($request->password == '' || $request->password == null) {
            $simpan = $user->update([
                'name' => $request->name,
                'email' => $request->email
            ]);
        } else {
            $simpan = $user->update($request->all());

        } 

 
        if($simpan){
            Session::flash('success', 'Register berhasil!');
            return redirect()->route('daftaruser');
        } else {
            Session::flash('errors', ['' => 'Register gagal! Silahkan ulangi beberapa saat lagi']);
            return redirect()->route('view_edit_data_user');
        }
    }

    public function delete_user(User $user){
        $user->delete();
        return redirect()->route('daftaruser');
    }
}