<?php

namespace App\Http\Controllers\Admin;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

use function Symfony\Component\String\b;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.partner.index',['partner'=>Partner::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.partner.create');
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
            'nama' => 'required',
            'logo' => 'required',
        ]);
        $file = $request->file('logo');
        $ext_file = $file->getClientOriginalExtension();
		// $ext_file_pria = $file_pria->getClientOriginalExtension();

		$nama_file = time()."_".$file->getClientOriginalName().".".$ext_file;
		// $nama_file_pria = time()."_".$file_pria->getClientOriginalName().".".$ext_file_pria;


      	// isi dengan nama folder tempat kemana file diupload
		$tujuan_story = 'data_file';
		$file->move($tujuan_story,$nama_file);
		// $file_pria->move($tujuan_upload,$nama_file_pria);

        Partner::create([
    		'nama' => $request->nama,
            'logo' => $nama_file,
    	]);
        return redirect()->route('partner.index');

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
        $partner=Partner::find($id);
        return view('admin.pages.partner.edit',['partner'=>$partner]);
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
            "logo" => "nullable|sometimes|image",
        ]);
        $partner = Partner::find($id);

        // cek gambar apakah sudah ada
        $logo = !empty($partner->logo) ? true : false;

        if ($request->logo) {
        if ($logo) {
            File::delete($partner->logo);
        }

        $file = $request->file('logo');
        $ext_file = $file->getClientOriginalExtension();
		// $ext_file_pria = $file_pria->getClientOriginalExtension();

		$nama_file = time()."_".$file->getClientOriginalName().".".$ext_file;
		// $nama_file_pria = time()."_".$file_pria->getClientOriginalName().".".$ext_file_pria;


      	// isi dengan nama folder tempat kemana file diupload
		$tujuan_story = 'data_file';
		$file->move($tujuan_story,$nama_file);
		// $file_pria->move($tujuan_upload,$nama_file_pria);

        $partner->update([
            'logo' => $nama_file,
        ]);
    }
    $partner->update([
        'nama' => $request->nama,
    ]);

        return redirect()->route('partner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $partner = Partner::find($id);
        $partner->delete();

        return redirect()->route('partner.index');
    }
    public function uplod($id)
    {
        $partner = Partner::find($id);
        $partner->uplod();

        return redirect()->route('partner.index');
    }

    public function getPartner(Request $request) {
        if (!$request->ajax()) {
            return '';
        }

        $data = Partner::all();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('logo', function($row) {
                return '<img width="100px" src="/data_file/'. $row->logo . '" alt="">';
            })
            ->addColumn('action', function($row) {
                $editBtn = '<a href="' . route('partner.edit', $row) . '" class="btn btn-md btn-info mr-2 mb-2 mb-lg-0"><i class="far fa-edit"></i> Edit</a>';
                $deleteBtn = '<a href="' . route('partner.destroy', $row) . '/delete" onclick="notificationBeforeDelete(event, this)" class="btn btn-md btn-danger btn-delete"><i class="fas fa-trash"></i> Delete</a>';
                return $editBtn . $deleteBtn;
            })
            ->rawColumns(['logo', 'action'])
            ->make(true);
    }
}
