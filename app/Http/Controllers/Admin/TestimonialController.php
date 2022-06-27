<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class TestimonialController extends Controller
{

    public function index()
    {
        return view('admin.pages.testimonial.index',['testimonial'=>Testimonial::all()]);
    }

    public function create()
    {
        return view('admin.pages.testimonial.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required',
            'name' => 'required',
            'job' => 'required',
            'testimonial' => 'required',
            'date' => 'required'
        ]);

        // Menampung seluruh data
        // $todayTime = \Carbon\Carbon::now()->format('Y/m/d');
        $data = [
            'image' => $request->image,
            'name' => $request->name,
            'job' => $request->job,
            'testimonial' => $request->testimonial,
            'date' => $request->date
        ];

        // Olah data gambar
        if ($image = $request->file('image')) {

            $destionation = 'data_file/';
            $nameImage = date('YmdHis').".".$image->getClientOriginalExtension();
            $image->move($destionation, $nameImage);
            $data['image'] = $nameImage;
        }

        // Insert Data to database
        $testimonial = Testimonial::create($data);

        // Alert dan pemberitauan
        if ($testimonial->save()) {
            return back()->with('success', 'Data has been created');
        }else {
            return back()->with('failed', 'Data Fail');
        }

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $testimonial=Testimonial::find($id);
        return view('admin.pages.testimonial.edit',['testimonial'=>$testimonial]);
    }

    public function update(Request $request, $id)
    {

        if ($image = $request->file('image')) {

            $destionation = 'data_file/';
            $nameImage = date('YmdHis').".".$image->getClientOriginalExtension();
            $image->move($destionation, $nameImage);
            $dataImage = $nameImage;

            $testimonial = Testimonial::where('id', $id)->update([
                "image" => $dataImage,
                "name" => $request->name,
                "job" => $request->job,
                "testimonial" => $request->testimonial,
                "date" => $request->date,
            ]);

        }else {
            $testimonial = Testimonial::where('id', $id)->update([
                "name" => $request->name,
                "job" => $request->job,
                "testimonial" => $request->testimonial,
                "date" => $request->date,
            ]);

        }



        if ($testimonial) {

            return redirect()->route('testimonial.index')->with('success', 'Data Has Been Update');

        }else {
            return back()->with('failed', 'Data failed');
        }

    }


    public function destroy($id)
    {
        $testimonial = Testimonial::find($id);
        $testimonial->delete();

        return redirect()->route('testimonial.index');
    }
    public function uplod($id)
    {
        $testimonial = Testimonial::find($id);
        $testimonial->uplod();

        return redirect()->route('testimonial.index');
    }

    public function getTestimonial(Request $request) {
        if (!$request->ajax()) {
            return '';
        }

        $data = Testimonial::all();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                $editBtn = '<a href="' . route('testimonial.edit', $row) . '" class="btn btn-md btn-info mr-2 mb-2 mb-lg-0"><i class="far fa-edit"></i> Edit</a>';
                $deleteBtn = '<a href="' . route('testimonial.destroy', $row) . '" onclick="notificationBeforeDelete(event, this)" class="btn btn-md btn-danger btn-delete"><i class="fas fa-trash"></i> Delete</a>';
                return $editBtn . $deleteBtn;
            })
            ->rawColumns(['gambar', 'action'])
            ->make(true);

    }
}
