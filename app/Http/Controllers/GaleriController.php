<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user()->id;
        $galeri = Galeri::where('user_id', $user)->latest()->get();
        return view('timeline',['galeris'=>$galeri]);
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
        $namafoto = Auth::user()->id.'='.date('YmdHis').$request->file('foto')->getClientOriginalName();
        $request->foto->move(public_path('gambar'),$namafoto);
        $data = [
            'judul' =>$request->judul,
            'deskripsi' =>$request->deskripsi,
            'foto' =>$namafoto,
            'tanggal' =>now(),
            'user_id' =>Auth::user()->id,
        ];
        Galeri::create($data);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        Galeri::where('id','=',$id)->delete();
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function edit(Galeri $galeri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        $file = $request->foto;

        if (isset($file)) {
            $namafoto = date('YmdHis')."-".$request->file('foto')->getClientOriginalExtension();
            $request->foto->move(public_path('gambar'), $namafoto);
            $data = [
                'judul' =>$request->judul,
                'deskripsi' =>$request->deskripsi,
                'foto' =>$namafoto,
                'tanggal' =>now(),
                'user_id' =>Auth::user()->id,
            ];
            Galeri::where('id',$id)->update($data);
        }else {
            $data = [
                'judul' =>$request->judul,
                'deskripsi' =>$request->deskripsi,
                'tanggal' =>now(),
                'user_id' =>Auth::user()->id,
            ];
            Galeri::where('id',$id)->update($data);
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function destroy(Galeri $galeri)
    {
        //
    }
}
