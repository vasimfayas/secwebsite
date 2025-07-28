@extends('layouts.master')
@section('content')
<div>@livewire('project.category',['id' => $id])</div>
<div>@livewire('project.display-cat')</div>
@endsection