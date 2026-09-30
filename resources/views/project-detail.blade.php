@extends('layouts.app')

@section('title', $project->title.' Project - Shannon Engineering Company')

@section('content')
<x-project-detail
    :project="$project"
    :images="$images"
    :prev="$prev"
    :next="$next"
    :related="$related"
    detail-route="detailprojects"
    :back-url="$project->category_id ? route('listprojects', $project->category_id) : route('projects')"
    back-label="Back"
    :crumbs="array_filter([
        'Projects' => route('projects'),
        ($project->category?->category ?? '') => $project->category ? route('listprojects', $project->category_id) : null,
    ])"
/>
@endsection
