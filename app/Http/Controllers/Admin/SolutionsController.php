<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class SolutionsController extends Controller
{
    public function index()
    {
        return view('admin.pages.solutions');
    }
}