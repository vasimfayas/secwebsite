<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return response()->json(
            Project::with('category')->where('status', "ongoing")->get()
        );
    }
    public function categories()
    {
        return response()->json(
            ProjectCategory::select('id', 'category')->get()
        );
    }
    public function project($id)
    {
        return response()->json(
            Project::with(['category', 'client', 'consultant'])->findOrFail($id)
        );
    }
    public function projects()
    {
        return response()->json(
            Project::with(['category', 'client', 'consultant'])->get()
        );
    }
}