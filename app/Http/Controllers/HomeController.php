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
        $featuredprojects = Project::with('category')->ongoing()->displayOrder()->get();
        return view('home', compact('featuredprojects'));
    }

    /**
     * Display the about us page
     */
    public function about()
    {
        return view('about');
    }
    public function culture()
    {
        return view('culture');
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
     * Projects listing. "Ongoing" (yes/no) and category are two independent filters:
     *   /projects                     all projects        (?status=ongoing|delivered)
     *   /projects/cat/{cat}           one category        (?status=ongoing|delivered)
     *   /projects/status/ongoing      ongoing projects    (?category={id})
     */
    public function projects(Request $request)
    {
        return $this->projectListing($request, $request->query('category'), $request->query('status'));
    }

    public function listprojects(Request $request, $cat)
    {
        return $this->projectListing($request, $cat, $request->query('status'));
    }

    public function ongoing(Request $request)
    {
        return $this->projectListing($request, $request->query('category'), 'ongoing');
    }

    private function projectListing(Request $request, $categoryId, $status)
    {
        $status = in_array($status, ['ongoing', 'delivered'], true) ? $status : null;
        $category = $categoryId ? ProjectCategory::findOrFail($categoryId) : null;

        $projects = Project::with('category')
            ->when($category, fn ($q) => $q->where('category_id', $category->id))
            ->withPublicStatus($status)
            ->displayOrder()
            ->get();

        // Counts for the filter controls: status counts within the current category,
        // category counts within the current status.
        $statusCounts = [
            'all' => Project::when($category, fn ($q) => $q->where('category_id', $category->id))->count(),
            'ongoing' => Project::when($category, fn ($q) => $q->where('category_id', $category->id))->ongoing()->count(),
            'delivered' => Project::when($category, fn ($q) => $q->where('category_id', $category->id))->delivered()->count(),
        ];
        $categories = ProjectCategory::orderBy('category')
            ->withCount(['projects' => fn ($q) => $q->withPublicStatus($status)])
            ->get();
        $allCount = Project::withPublicStatus($status)->count();

        return view('projects', compact('projects', 'category', 'status', 'statusCounts', 'categories', 'allCount'));
    }

    public function detailprojects($id)
    {
        $project = Project::with(['client', 'consultant', 'category'])->findOrFail($id);
        $images = ProjectImage::where('project_id', $id)->orderBy('position')->orderBy('id')->get();

        // Neighbours and related projects come from the same category when there is one,
        // otherwise from projects with the same ongoing / delivered state.
        $siblings = fn () => Project::query()
            ->when(
                $project->category_id,
                fn ($q) => $q->where('category_id', $project->category_id),
                fn ($q) => $q->withPublicStatus($project->is_ongoing ? 'ongoing' : 'delivered')
            );

        $next = $siblings()->where('id', '>', $project->id)->orderBy('id')->first();
        $prev = $siblings()->where('id', '<', $project->id)->orderByDesc('id')->first();
        $related = $siblings()->where('id', '!=', $project->id)->inRandomOrder()->take(3)->get();

        return view('project-detail', compact('project', 'images', 'next', 'prev', 'related'));
    }
    /**
     * Display the sister companies page
     */
    public function sisterCompanies()
    {
        return view('sister-companies');
    }

    /**
     * Old ongoing-project URL: there is now a single project page for every project.
     */
    public function ongoingdetails($id)
    {
        return redirect()->route('detailprojects', $id, 301);
    }

    /**
     * Display the careers page
     */
    public function careers()
    {
        $careers = Career::open()
            ->orderByRaw('deadline IS NULL, deadline')
            ->latest()
            ->get();
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
