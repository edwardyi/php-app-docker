@extends('layouts.app')

@section('title', 'Detail for'.$customerData->name)

@section('content')

<div class="row">
    <div class="col-12">
        <h1>Customer Detail Page</h1>

        <a href="/customers/{{$customerData->id}}/edit" class="btn btn-primary">Edit</a>

        <form style="display:inline" action="/customers/{{$customerData->id}}" method="POST">
            @method('DELETE')
            <button class="btn btn-danger">delete</button>
            @csrf
        </form>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <p><strong>Name</strong> {{$customerData->name}}</p>
        <p><strong>Email</strong> {{$customerData->email}}</p>
        <p> <strong>Company</strong> {{$customerData->company->name}}</p>
        <p><strong>Status</strong> {{$customerData->active}}</p>
        @if ($customerData->image)
        <p><strong>Image</strong> 
            <img alt="{{$customerData->name}}" 
                src={{asset('/storage/'.$customerData->image)}} class="img-thumbnail" />
        </p>
        @endif
    </div>
</div>
@endsection