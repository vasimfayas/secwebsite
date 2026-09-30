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
                ->each->append(['description_html', 'description_text'])
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
            Project::with(['category', 'client', 'consultant', 'images'])->findOrFail($id)
                ->append(['description_html', 'description_text'])
        );
    }
    public function projects()
    {
        return response()->json(
            Project::with(['category', 'client', 'consultant', 'images'])->get()
                ->each->append(['description_html', 'description_text'])
        );
    }
}