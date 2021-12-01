@extends('layout')

@section('content')
<ul>
    @foreach($customers as $customer)
        <li>{{ $customer->name }}</li>
    @endforeach
</ul>
@endsection