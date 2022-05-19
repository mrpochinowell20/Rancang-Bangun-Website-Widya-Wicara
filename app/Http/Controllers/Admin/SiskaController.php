<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class SiskaController extends Controller
{
    public function index()
    {
        return view('admin.pages.siska');
    }
}