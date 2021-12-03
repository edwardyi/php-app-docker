@extends('layout')

@section('title', 'Detail for'.$customerData->name);


@section('content')
<div class="row">
    <div class="col-12">
        <h1>Customer Detail Page</h1>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <p><strong>Name</strong> {{$customerData->name}}</p>
        <p> <strong>Company</strong> {{$customerData->company->name}}</p>
        <p><strong>Status</strong> {{$customerData->active}}</p>
    </div>
</div>
@endsection