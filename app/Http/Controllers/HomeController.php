<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page
     */
    public function index()
    {
        return view('home');
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
        return view('projects');
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

