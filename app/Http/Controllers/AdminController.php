<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function test()
    {
        return view('admin.test');
    }
    public function existingprojects()
    {
        return view('admin.projectview');
    }
    public function category()
    {
        return view('admin.category');
    }
    public function addproject($id = null)
    {
        return view('admin.project', ['projectId' => $id]);
    }
}
