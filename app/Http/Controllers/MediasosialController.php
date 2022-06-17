<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Mediasosial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;

class MediasosialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->ajax());
        if ($request->ajax()) {
            $data = Mediasosial::all();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('gambar', function($row) {
                    return '<img width="100px" src="/data_file/'. $row->gambar . '" alt="">';
                })
                ->addColumn('action', function($row) {
                    $editBtn = '<a href="' . route('mediasosial.edit', $row) . '" class="btn btn-primary btn-xs">Edit</a>';
                    $deleteBtn = '<a href="' . route('mediasosial.destroy', $row) . '" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">Delete</a>';
                    return $editBtn . $deleteBtn;
                })
                ->rawColumns(['gambar', 'action'])
                ->make(true);
        }

        return view('admin.pages.mediasosial.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.mediasosial.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     *  @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required',
            'url' => 'required',
            'gambar'=> 'required',
        ]);
        $file = $request->file('gambar');
        $ext_file = $file->getClientOriginalExtension();

		$nama_file = time()."_".$file->getClientOriginalName();
		// $nama_file_pria = time()."_".$file_pria->getClientOriginalName().".".$ext_file_pria;


      	// isi dengan nama folder tempat kemana file diupload
		$tujuan_story = 'data_file';
		$file->move($tujuan_story,$nama_file);
		// $file_pria->move($tujuan_upload,$nama_file_pria);

		// return redirect()->back();
        Mediasosial::create([
    		'nama' => $request->nama,
    		'url' => $request->url,
            'gambar' => $nama_file,
        ]);
        return redirect()->route('mediasosial.index');

    Mediasosial::create([
        'nama' => $request->nama,
        'url' => $request->url,
    ]);
    return redirect()->route('mediasosial.index');
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
        $mediasosial=Mediasosial::find($id);
        return view('admin.pages.mediasosial.edit',['mediasosial'=>$mediasosial]);
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
            "nama" => "required",
            "url" => "required",
            "gambar" => "nullable|sometimes|image",
        ]);
        $mediasosial = Mediasosial::find($id);

        // cek gambar apakah sudah ada
        $gambar = !empty($mediasosial->gambar) ? true : false;

        if ($request->gambar) {
        if ($gambar) {
            File::delete($mediasosial->gambar);
        }

        $file = $request->file('gambar');
        $ext_file = $file->getClientOriginalExtension();
		// $ext_file_pria = $file_pria->getClientOriginalExtension();

		$nama_file = time()."_".$file->getClientOriginalName();
		// $nama_file_pria = time()."_".$file_pria->getClientOriginalName().".".$ext_file_pria;


      	// isi dengan nama folder tempat kemana file diupload
		$tujuan_story = 'data_file';
		$file->move($tujuan_story,$nama_file);
		// $file_pria->move($tujuan_upload,$nama_file_pria);


        $mediasosial->update([
            'gambar' => $nama_file ,
        ]);
    }


        $mediasosial->update([
            'nama' => $request->nama,
            'url' => $request->url,
        ]);

        return redirect()->route('mediasosial.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mediasosial = Mediasosial::find($id);
        $mediasosial->delete();

        return redirect()->route('mediasosial.index');
    }

    public function uplod($id)
    {
        $mediasosial = Mediasosial::find($id);
        $mediasosial->uplod();

        return redirect()->route('mediasosial.index');
    }

}
