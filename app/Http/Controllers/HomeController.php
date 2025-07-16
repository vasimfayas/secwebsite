<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page
     */
    public function index()
    {
        $featuredprojects = Project::with('category')->where('featured', true)->get();
        return view('home', compact('featuredprojects'));
    }

    /**
     * Display the about us page
     */
    public function about()
    {
        return view('about');
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
        $category = ProjectCategory::findorfail($cat);
        $projects = Project::where('category_id', $cat)->get();
        return view('project-list', compact('category', 'projects'));
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
        return view('careers');
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
