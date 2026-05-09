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
    public function category($id = null)
    {
        return view('admin.category', ['id' => $id]);
    }
    public function addproject($id = null)
    {
        return view('admin.project', ['projectId' => $id]);
    }
    public function job()
    {
        return view('admin.career');
    }
    public function client()
    {
        return view('admin.client');
    }
    public function consultant()
    {
        return view('admin.consultant');
    }
}
