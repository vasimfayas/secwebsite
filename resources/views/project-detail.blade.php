@extends('layouts.app')

@section('title', $project->title.' Project - Shannon Engineering Company')

@php
    $statusKey = $project->is_ongoing ? 'ongoing' : 'delivered';
    $statusLabel = $project->is_ongoing ? 'Ongoing' : 'Delivered';

    // Back goes to the listing this project belongs to: its category (with its status), or its status.
    $backUrl = $project->category_id
        ? route('listprojects', ['cat' => $project->category_id, 'status' => $statusKey])
        : ($project->is_ongoing ? route('ongoingProjects') : route('projects', ['status' => 'delivered']));

    $crumbs = ['Projects' => route('projects')];
    if ($project->category) {
        $crumbs[$project->category->category] = route('listprojects', $project->category_id);
    }
    $crumbs[$statusLabel] = $backUrl;
@endphp

@section('content')
<x-project-detail
    :project="$project"
    :images="$images"
    :prev="$prev"
    :next="$next"
    :related="$related"
    detail-route="detailprojects"
    :back-url="$backUrl"
    back-label="Back"
    :crumbs="$crumbs"
/>
@endsection
