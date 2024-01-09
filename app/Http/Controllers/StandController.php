<?php

namespace App\Http\Controllers;

use App\Models\Stand;
use Illuminate\Http\Request;

class StandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stands = Stand::all();

        return view('stand', compact('stands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stands = Stand::all();
        return view('tambah', compact('stands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->name;
        $kelas = $request->kelas;
        $jurusan = $request->jurusan;

        $store = Stand::create([
            'name' => $name,
            'kelas' => $kelas,
            'jurusan' => $jurusan
        ]);

        if($store)
        {
            return redirect()->back()->with('status', 'Berhasil Menambah Data Stand');
        }
        else
        {
            return redirect()->back()->with('status', 'Gagal Menambah Data Stand');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stand  $stand
     * @return \Illuminate\Http\Response
     */
    public function show(Stand $stand)
    {
        return view('show',['stand'=> $stand]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stand  $stand
     * @return \Illuminate\Http\Response
     */
    public function edit(Stand $stand)
    {
        $edits = Stand::find($stand->id);

        return view('edit',compact('edits'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stand  $stand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stand $stand)
    {
        $name = $request->name;
        $kelas = $request->kelas;
        $jurusan = $request->jurusan;

        $update = Stand::find($stand->id)->update([
            'name' => $name,
            'kelas' => $kelas,
            'jurusan' => $jurusan
        ]);

        if($update)
        {
            return redirect('/stand')->with('status', 'Berhasil Mengedit Data Stand');
        }
        else
        {
            return redirect('/stand')->with('status', 'Gagal Mengedit Data Stand');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stand  $stand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stand $stand)
    {
        $destroy = Stand::find($stand->id)->delete();
        if($destroy)
        {
            return redirect()->back()->with('status', 'Berhasil Menghapus Data Stand');
        }
        else
        {
            return redirect()->back()->with('status', 'Gagal Menghapus Data Stand');
        }
    }
}
