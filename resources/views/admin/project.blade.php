@extends('layouts.master')
@section('content')
<div>@livewire('project.add-project',['id' => $projectId])</div>

@endsection