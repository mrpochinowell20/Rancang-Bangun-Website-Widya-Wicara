<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class UserContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::get();
            return DataTables::of($data)
                    ->addColumn('action', function ($item) {
                        return '<div class="d-flex align-items-center">
                            <a href="'.route('user.edit', $item->id).'" class="btn btn-md btn-info mr-2 mb-2 mb-lg-0"><i class="far fa-edit"></i> Edit</a>
                            <a id="btn-delete" data-id="'.$item->id.'"  data-remote="" class="btn btn-md btn-danger btn-delete"><i class="fas fa-trash"></i> Hapus</a>
                        </div>';
                    })
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('admin.pages.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if exist return error
        $userExist = User::where('username', strtolower($request->username))->first();
        
        if ($userExist) {
            return back()->withErrors([
            'username' => "username telah digunakan"
        ]);
        }

        // proses simpan
        User::create([
            'username' => $request->username,
            'name' => $request->name,
            'level' => $request->level,
            'password' => bcrypt($request->password)
        ]);

        return redirect()->route('user.index');
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
        $user = User::find($id);
        // Load user/createOrUpdate.blade.php view
        return view('admin.pages.user.edit')->with('user', $user);
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
        $userExist = User::where('username', strtolower($request->new_username))->first();

        if ($userExist && $userExist->name != $request->name) {
            return back()->withErrors([
                'username' => "username telah digunakan"
            ]);
        }

        $user = User::find($id);

        $user->update([
            'username' => $request->new_username,
            'name' => $request->name,
            'level' => $request->level,
            'password' => bcrypt($request->password)
        ]);
        
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = User::find($id);

            if ($user->username == Auth::user()->username) {
                throw new Error('Data gagal dihapus');
            }
            return $user->delete();
        } catch (Exception $e) {
            return json_encode(array(
                'error' => "Data gagal dihapus"
            ));
        }
    }
}
