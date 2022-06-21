<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {

        $testimonis = Testimonial::select('*')->get();

        return view('client.pages.index', compact('testimonis'));
    }
}
