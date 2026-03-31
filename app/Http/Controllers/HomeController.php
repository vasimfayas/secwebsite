<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectImage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page
     */
    public function index()
    {
        $featuredprojects = Project::with('category')->where('status', "ongoing")->get();
        return view('home', compact('featuredprojects'));
    }

    /**
     * Display the about us page
     */
    public function about()
    {
        return view('about');
    }
    public function vision()
    {
        return view('vision');
    }
    public function safety()
    {
        return view('safety');
    }
    public function team()
    {
        return view('team');
    }
    /**
     * Display the projects page
     */
    public function projects()
    {
        $categories = ProjectCategory::get();
        return view('projects', compact('categories'));
    }

    public function listprojects($cat)
    {
        $categories = ProjectCategory::get();
        $category = ProjectCategory::findorfail($cat);
        $projects = Project::where('category_id', $cat)->get();
        return view('project-list', compact('category', 'projects', 'categories'));
    }

    public function detailprojects($id)
    {
        $project = Project::findorfail($id);
        $images = ProjectImage::where('project_id', $id)->get();
        return view('project-detail', compact('project', 'images'));
    }
    /**
     * Display the sister companies page
     */
    public function sisterCompanies()
    {
        return view('sister-companies');
    }

    /**
     * Display the careers page
     */
    public function careers()
    {
        $careers = Career::all();
        return view('careers', compact('careers'));
    }

    /**
     * Display the clients page
     */
    public function clients()
    {
        return view('clients');
    }

    /**
     * Display the contact page
     */
    public function contact()
    {
        return view('contact');
    }
}
