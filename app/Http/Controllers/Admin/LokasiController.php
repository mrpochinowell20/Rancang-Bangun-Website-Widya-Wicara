<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lokasi;
use Illuminate\Http\Request;
class LokasiController extends Controller
{
    public function index()
    {
        return view('admin.pages.lokasi',['lokasi'=>Lokasi::all()]);
    }
    public function edit($id)
    {
        return view('admin.pages.edit',['lokasi'=>Lokasi::find($id)]);
    }
    public function tambah()
    {
        return view('admin.pages.tambah');
    }
    public function editdata($id)
    {
        return view('admin.pages.edit');
    }
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
        return redirect("/lokasi");
    }

}