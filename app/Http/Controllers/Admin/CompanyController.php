<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->all());
        if ($request->ajax()) {
            $data = Comp::get();
            return DataTables::of($data)
                    ->addColumn('action', function ($item) {
                        return '<div class="d-flex align-items-center">
                            <a href="'.route('company.detail', $item->id).'" class="btn btn-md btn-warning mr-2 mb-2 mb-lg-0"><i class="fas fa-hand-point-up"></i> Detail</a>
                            <a href="'.route('company.edit', $item->id).'" class="btn btn-md btn-info mr-2 mb-2 mb-lg-0"><i class="far fa-edit"></i> Edit</a>
                            </div>';
                    })
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('admin.pages.company.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        // dd($request->all0());
        $request->validate([
            'kebutuhan' => 'required',
            'keterangan' => 'required',
        ]);
        // $file = $request->file('icon');
        // $ext_file = $file->getClientOriginalExtension();
		// $ext_file_pria = $file_pria->getClientOriginalExtension();

		// $nama_file = time()."_".$file->getClientOriginalName().".".$ext_file;
		// $nama_file_pria = time()."_".$file_pria->getClientOriginalName().".".$ext_file_pria;


      	// isi dengan nama folder tempat kemana file diupload
		// $tujuan_story = 'data_file';
		// $file->move($tujuan_story,$nama_file);
		// $file_pria->move($tujuan_upload,$nama_file_pria);

        Comp::create([
    		'kebutuhan' => $request->kebutuhan,
            'keterangan' => $request->keterangan,
    	]);
        return redirect()->route('company.index');

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

    public function detail($id)
    {
        $data = [
            'company' => Comp::find($id)];
        return view('admin.pages.company.detail',$data);
    }


    public function edit($id)
    {
        // dd($request->ajax());
        $company = Comp::find($id);
        return view('admin.pages.company.edit',['company'=>$company]);
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
        // if exist return error
        $request->validate([
            'kebutuhan' => 'required',
            'keterangan' => 'required',
        ]);
        $company = Comp::find($id);

        // proses simpan
        $company->update([
            'kebutuhan' => $request->kebutuhan,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('company.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Comp::find($id);
        $company->delete();

        return redirect()->route('company.index');
    }

    public function getCompanyDetail(Request $request) {
        if ($request->ajax()) {
            $data = Comp::get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                $editBtn = '<a href="' . route('company.edit', $row) . '" class="btn btn-md btn-info mr-2 mb-2 mb-lg-0"><i class="far fa-edit"></i> Update </a>';
                $deleteBtn = '<a href="' . route('company.destroy', $row) . '"  onclick="notificationBeforeDelete(event, this)" class="btn btn-success float-right mb-1" data-toggle="modal" data-target="#modalTambahBarang"> Detail </button></a>';

                return $editBtn . $deleteBtn ;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }

}
