<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Models\Feature;
use Yajra\DataTables\DataTables;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.feature.index',['feature'=>Feature::all()]);
    }

    public function detail($id)
    {
        $data = [
            'feature' => Feature::find($id)];
        return view('admin.pages.feature.detail',$data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.feature.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required',
            'subtitle' => 'required',
            'deskriptions' => 'required',
            'icon' => 'required' ,
            'solution_id' => 'sometimes|required',
        ]);

        $solution_id = $request->solution_id ?: 0;

        $file = $request->file('icon');
        $ext_file = $file->getClientOriginalExtension();
		// $ext_file_pria = $file_pria->getClientOriginalExtension();
 
		$nama_file = time()."_".$file->getClientOriginalName().".".$ext_file;
		// $nama_file_pria = time()."_".$file_pria->getClientOriginalName().".".$ext_file_pria;

 
      	// isi dengan nama folder tempat kemana file diupload
		$tujuan_story = 'data_file';
		$file->move($tujuan_story,$nama_file);
		// $file_pria->move($tujuan_upload,$nama_file_pria)

 
		Feature::create([
            'nama' => $request->nama,
            'subtitle' => $request->subtitle,
            'deskriptions' => $request->deskriptions,
            'icon' => $nama_file,
            'solution_id' => $solution_id,
		]);
 
		return redirect()->route('feature.index');

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
        $feature=Feature::find($id);
        return view('admin.pages.feature.edit',['feature'=>$feature]);
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
            "subtitle" => "required",
            "deskriptions" => "required",
            "icon" => "nullable|sometimes|image" ,

        ]);

        $feature = Feature::find($id);

        // cek icon apakah sudah ada 
        $icon = !empty($feature->icon) ? true : false;

        if ($request->icon) {
        if ($icon) {
            File::delete($feature->icon);
        }
        $file = $request->file('icon');
        $ext_file = $file->getClientOriginalExtension();
		// $ext_file_pria = $file_pria->getClientOriginalExtension();
 
		$nama_file = time()."_".$file->getClientOriginalName().".".$ext_file;
		// $nama_file_pria = time()."_".$file_pria->getClientOriginalName().".".$ext_file_pria;

 
      	// isi dengan nama folder tempat kemana file diupload
		$tujuan_story = 'data_file';
		$file->move($tujuan_story,$nama_file);
		// $file_pria->move($tujuan_upload,$nama_file_pria);
 

        $feature->update([ 
            'icon' => $nama_file ,
        ]);
    }

    $feature->update([
        "nama" => $request->nama,
        "subtitle" => $request->subtitle,
        "deskriptions" => $request->deskriptions,
      
    ]);
        return redirect()->route('feature.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feature = Feature::find($id);
        $feature->delete();

        return redirect()->route('feature.index');
    }
    public function uplod($id)
    {
        $feature = Feature::find($id);
        $feature->uplod();

        return redirect()->route('feature.index');
    }

    public function getFeature(Request $request) {
        if (!$request->ajax()) {
            return '';
        }
        
        $data = Feature::all();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('icon', function($row) {
                return '<img width="100px" src="/data_file/'. $row->icon . '" alt="">';
            })
            ->addColumn('action', function($row) {
                $editBtn = '<a href="' . route('feature.edit', $row) . '" class="btn btn-md btn-info mr-2 mb-2 mb-lg-0"><i class="far fa-edit"></i> Update </a>';
                $deleteBtn = '<a href="' . route('feature.destroy', $row) . '"  onclick="notificationBeforeDelete(event, this)" class="btn btn-md btn-danger btn-delete"><i class="fas fa-trash"></i> Delete </a>';
                return $editBtn . $deleteBtn;
            })
            ->rawColumns(['icon', 'action'])
            ->make(true);

    }
}