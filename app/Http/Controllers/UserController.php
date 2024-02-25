<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function postlog(Request $request)
    {
        
         $username = User::where('username',$request->username)->first();
         if (!$username) {
            return back()->with('alert', 'Username Belum Ada');
         }
         if (!Hash::check($request->password, $username->password)) {
            return back()->with('alert', 'Password Anda Salah!!');
         }
        // $data = $request->validate([
        //     'username'=>'required',
        //     'password'=>'required',
        // ]);
        // $data = $request->only(['username','password']);
        if (Auth::attempt($request->only('username','password'))) {
            return redirect('galeri');
        }else {
            return back();
        }

    }

    public function register()
    {
        //
        return view('register');
    }

    public function postreg(Request $request)
    {
        //
        // $data = $request->validate([
        //     'username'=>'required',
        //     'name'=>'required',
        //     'email'=>'required',
        //     'password'=>'required',
        // ]);
        // User::create([
        //     'username'=>$request['username'],
        //     'name'=>$request['name'],
        //     'email'=>$request['email'],
        //     'password'=>Hash::make($request['password']),
        // ]);
        // return redirect('/');
        
           try{
            $username = User::where('username', $request->username)->first();
            if ($username) {
                return back()->with('alert', 'Username Sudah Ada!');
            }
            $email = User::where('email', $request->email)->first();
            if ($email) {
                return back()->with('alert', 'Email Sudah Ada!');
            }
            $data =[
                'username'=>$request->username,
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
            ];
            User::create($data);

            return redirect('/');

           } catch(QueryException){
            return back()->with('alert', 'Terjadi Kesalahan Di Operasi Database');
           }
        
    }

    public function metu()
    {
        //
        Auth::logout();
        return redirect('/');
    }
}
