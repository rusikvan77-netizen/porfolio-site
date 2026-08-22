<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Reviews;

class AdminController extends Controller
{
    public function index()
    {
        if (!auth()->user()->admin()) {
            abort(403);
        }
        return view('admin.index');
    }
    
}
