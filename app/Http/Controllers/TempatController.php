<?php

namespace App\Http\Controllers;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class TempatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.lokasi',['lokasi'=>Lokasi::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'desa' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required'
        ]);
        Lokasi::create([
    		'desa' => $request->desa,
    		'kecamatan' => $request->kecamatan,
            'kabupaten' => $request->kabupaten,
    	]);
        return redirect()->route('lokasi.index');

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
        $lokasi=Lokasi::find($id);
        return view('admin.pages.edit',['lokasi'=>$lokasi]);
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
        $request->validate([
            "desa" => "required",
            "kecamatan" => "required",
            "kabupaten" => "required",
        ]);
        $lokasi = Lokasi::find($id);

        $lokasi->update([
            'desa' => $request->desa,
            'kecamatan' => $request->kecamatan,
            'kabupaten' => $request->kabupaten,
        ]);

        return redirect()->route('lokasi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lokasi = Lokasi::find($id);
        $lokasi->delete();

        return redirect()->route('lokasi.index');
    }
}
