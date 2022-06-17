<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comp;
use App\Models\Mediasosial;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;


class MedsosController extends Controller
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
                ->addColumn('icon', function($row) {
                    return '<img width="100px" src="/data_file/'. $row->icon . '" alt="">';
                })
                ->addColumn('action', function ($item) {
                    return '<div class="d-flex align-items-center">
                        <a href="'.route('mediasosial.edit', $item->id).'" class="btn btn-md btn-info mr-2 mb-2 mb-lg-0"><i class="far fa-edit"></i> Edit</a>
                        <a id="btn-delete" data-id="'.$item->id.'"  data-remote="" class="btn btn-md btn-danger btn-delete"><i class="fas fa-trash"></i> Delete</a>
                        </div>';
                })
                ->rawColumns(['icon', 'action'])
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
        return view('admin.pages.mediasosial.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     *  @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all0());
        $request->validate([
            'icon' => 'required',
            'name' => 'required',
            'tipe' => 'required',
            'url' => 'required',
        ]);
        $file = $request->file('icon');
        $ext_file = $file->getClientOriginalExtension();
		// $ext_file_pria = $file_pria->getClientOriginalExtension();

		$nama_file = time()."_".$file->getClientOriginalName().".".$ext_file;
		// $nama_file_pria = time()."_".$file_pria->getClientOriginalName().".".$ext_file_pria;


      	// isi dengan nama folder tempat kemana file diupload
		$tujuan_story = 'data_file';
		$file->move($tujuan_story,$nama_file);
		// $file_pria->move($tujuan_upload,$nama_file_pria);

        Mediasosial::create([
    		'icon' => $nama_file,
    		'name' => $request->name,
            'tipe' => $request->tipe,
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
            "name" => "required",
            "tipe" => "required",
            "url" => "required",
            "icon" => "nullable|sometimes|image",
        ]);
        $mediasosial = Mediasosial::find($id);

        // cek icon apakah sudah ada
        $icon = !empty($mediasosial->icon) ? true : false;

        if ($request->icon) {
        if ($icon) {
            File::delete($mediasosial->icon);
        }

        $file = $request->file('icon');
        $ext_file = $file->getClientOriginalExtension();
		// $ext_file_pria = $file_pria->getClientOriginalExtension();

		$nama_file = time()."_".$file->getClientOriginalName();
		// $nama_file_pria = time()."_".$file_pria->getClientOriginalName().".".$ext_file_pria;


      	// isi dengan nama folder tempat kemana file diupload
		$tujuan_story = 'data_file';
		$file->move($tujuan_story,$nama_file);
		// $file_pria->move($tujuan_upload,$nama_file_pria);


        $mediasosial->update([
            'icon' => $nama_file ,
        ]);
    }


        $mediasosial->update([
            'name' => $request->name,
            'tipe' => $request->tipe,
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
