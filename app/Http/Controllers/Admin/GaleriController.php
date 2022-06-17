<?php

namespace App\Http\Controllers\Admin;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

use function Symfony\Component\String\b;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.galeri.index',['galeri'=>Galeri::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.galeri.create');
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
            'foto' => 'required',
            'keterangan' => 'required',
        ]);
        $file = $request->file('foto');
        $ext_file = $file->getClientOriginalExtension();
		// $ext_file_pria = $file_pria->getClientOriginalExtension();
 
		$nama_file = time()."_".$file->getClientOriginalName().".".$ext_file;
		// $nama_file_pria = time()."_".$file_pria->getClientOriginalName().".".$ext_file_pria;

 
      	// isi dengan nama folder tempat kemana file diupload
		$tujuan_story = 'data_file';
		$file->move($tujuan_story,$nama_file);
		// $file_pria->move($tujuan_upload,$nama_file_pria);
 
        Galeri::create([
    		'foto' => $nama_file,
    		'keterangan' => $request->keterangan,   
    	]);
        return redirect()->route('galeri.index');

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
        $galeri=Galeri::find($id);
        return view('admin.pages.galeri.edit',['galeri'=>$galeri]);
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
            "foto" => "nullable|sometimes|image",
            "keterangan" => "required",
        ]);
        $galeri = Galeri::find($id);

        // cek foto apakah sudah ada
        $foto = !empty($galeri->foto) ? true : false;

        if ($request->foto) {
        if ($foto) {
            File::delete($galeri->foto);
        }

        $file = $request->file('foto');
        $ext_file = $file->getClientOriginalExtension();
		// $ext_file_pria = $file_pria->getClientOriginalExtension();
 
		$nama_file = time()."_".$file->getClientOriginalName().".".$ext_file;
		// $nama_file_pria = time()."_".$file_pria->getClientOriginalName().".".$ext_file_pria;

 
      	// isi dengan nama folder tempat kemana file diupload
		$tujuan_story = 'data_file';
		$file->move($tujuan_story,$nama_file);
		// $file_pria->move($tujuan_upload,$nama_file_pria);

        $galeri->update([
            'foto' => $nama_file,
        ]);
    }
    $galeri->update([
        'keterangan' => $request->keterangan,
    ]);

        return redirect()->route('galeri.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $galeri = Galeri::find($id);
        $galeri->delete();

        return redirect()->route('galeri.index');
    }
    public function uplod($id)
    {
        $galeri = Galeri::find($id);
        $galeri->uplod();

        return redirect()->route('galeri.index');
    }

    public function getGaleri(Request $request) {
        if (!$request->ajax()) {
            return '';
        }

        $data = Galeri::all();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('foto', function($row) {
                return '<img width="100px" src="/data_file/'. $row->foto . '" alt="">';
            })
            ->addColumn('action', function($row) {
                $editBtn = '<a href="' . route('galeri.edit', $row) . '" class="btn btn-md btn-info mr-2 mb-2 mb-lg-0"><i class="far fa-edit"></i> Edit</a>';
                $deleteBtn = '<a href="' . route('galeri.destroy', $row) . '/delete" onclick="notificationBeforeDelete(event, this)" class="btn btn-md btn-danger btn-delete"><i class="fas fa-trash">Delete</a>';
                return $editBtn . $deleteBtn;
            })
            ->rawColumns(['foto', 'action'])
            ->make(true);
    }
}