@extends('layouts.app')

@section('title', $project->title.' Project - Shannon Engineering Company')

@section('content')
<x-project-detail
    :project="$project"
    :images="$images"
    :prev="$prev"
    :next="$next"
    :related="$related"
    detail-route="ongoingdetails"
    :back-url="route('ongoingProjects')"
    back-label="Back"
    :crumbs="['Projects' => route('projects'), 'Ongoing' => route('ongoingProjects')]"
/>
@endsection
