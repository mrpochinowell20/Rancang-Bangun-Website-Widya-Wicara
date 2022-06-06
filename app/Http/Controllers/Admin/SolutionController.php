<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class SolutionController extends Controller
{
    public function index()
    {
        return view('admin.pages.solution.index');
    }
}
