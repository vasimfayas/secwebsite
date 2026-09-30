@extends('layouts.master')
@section('content')
<div>@livewire('project.category', ['id' => $id])</div>
@endsection
