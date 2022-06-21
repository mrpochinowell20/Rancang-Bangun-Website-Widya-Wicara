<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Models\Solution;
use Yajra\DataTables\DataTables;

class SolutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.solution.index',['solution'=>Solution::all()]);
    }

    public function detail($id)
    {
        $data = [
            'solution' => Solution::find($id)];
        return view('admin.pages.solution.detail',$data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.solution.create');
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
 
		Solution::create([
            'nama' => $request->nama,
            'subtitle' => $request->subtitle,
            'deskriptions' => $request->deskriptions,
            'icon' => $nama_file,

            
		]);
 
		// return redirect()->route('solution.index');
        return redirect()->back();

        // Solution::create([
        //     'nama' => $request->nama,
        //     'subtitle' => $request->subtitle,
        //     'deskription' => $request->deskription,
        //     'icon' => $request->icon,

    	// ]);
        // return redirect()->route('solution.index');

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
        $solution=Solution::find($id);
        return view('admin.pages.solution.edit',['solution'=>$solution]);
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

        $solution = Solution::find($id);

        // cek icon apakah sudah ada 
        $icon = !empty($solution->icon) ? true : false;

        if ($request->icon) {
        if ($icon) {
            File::delete($solution->icon);
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
 

        $solution->update([ 
            'icon' => $nama_file ,
        ]);
    }

    $solution->update([
        "nama" => $request->nama,
        "subtitle" => $request->subtitle,
        "deskriptions" => $request->deskriptions,
      
    ]);
        return redirect()->route('solution.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $solution = Solution::find($id);
        $solution->delete();

        return redirect()->route('solution.index');
    }
    public function uplod($id)
    {
        $solution = Solution::find($id);
        $solution->uplod();

        return redirect()->route('solution.index');
    }

    public function getSolution(Request $request) {
        if (!$request->ajax()) {
            return '';
        }
        
        $data = Solution::all();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('icon', function($row) {
                return '<img width="100px" src="/data_file/'. $row->icon . '" alt="">';
            })
            ->addColumn('action', function($row) {
                $detailBtn =  '<a href="' . route('solution.detail', $row) . '" class="btn btn-md btn-warning mr-2 mb-2 mb-lg-0"><i class="fas fa-hand-point-up"></i> Detail </a>';
                $editBtn = '<a href="' . route('solution.edit', $row) . '" class="btn btn-md btn-info mr-2 mb-2 mb-lg-0"><i class="far fa-edit"></i> Edit </a>';
                $deleteBtn = '<a href="' . route('solution.destroy', $row) . '"  onclick="notificationBeforeDelete(event, this)" class="btn btn-md btn-danger btn-delete"><i class="fas fa-trash"></i> Delete </a>';
                
                return $detailBtn . $editBtn . $deleteBtn ;
            })
            ->rawColumns(['icon', 'action'])
            ->make(true);

    }

    public function getSolutionDetail(Request $request) {
        if (!$request->ajax()) {
            return '';
        }
        
        $data = Solution::join('feature', 'feature.solution_id', '=', 'solution.id')
            ->select('feature.*')
            ->where('feature.solution_id', $request->id)->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('icon', function($row) {
                return '<img width="100px" src="/data_file/'. $row->icon . '" alt="">';
            })
            ->addColumn('action', function($row) {
                $editBtn = '<a href="' . route('feature.edit', $row) . '" class="btn btn-md btn-info mr-2 mb-2 mb-lg-0"><i class="far fa-edit"></i> Edit </a>';
                $deleteBtn = '<a href="' . route('feature.destroy', $row) . '"  onclick="notificationBeforeDelete(event, this)" class="btn btn-md btn-danger btn-delete"><i class="fas fa-trash"></i> Delete </a>';
                
                return $editBtn . $deleteBtn ;
            })
            ->rawColumns(['icon', 'action'])
            ->make(true);

    }
}