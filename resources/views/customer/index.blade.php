@extends('layout')

@section('title', 'Customer List')

@section('content')
<div class="row">
    <div class="col-12">
        <h1>Customer List</h1>
        <p><a href="/customers/create">Create Customer</a></p>
    </div>
</div>

<div class="row">
    @foreach($customers as $customer)
        <div class="col-2">
            <span>
                {{$customer->id}}
            </span>
        </div>
        <div class="col-4">
            <span>
                {{$customer->name}}
            </span>
        </div>
        <div class="col-4">
            <span>
                {{$customer->company->name}}
            </span>
        </div>
        <div class="col-2">
            {{$customer->active}}
        </div>
    @endforeach
</div>
@endsection