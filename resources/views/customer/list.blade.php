@extends('layout')

@section('title', 'Customer List')

@section('content')

<div class="row">
    <div class="col-12">
        <h1>Customer List</h1>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <form action="/customers" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</p>
                <input class="form-control" type="text" name="name" value="{{ old('name') }}" />
                <div>{{ $errors->first('name') }}</div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="text" name="email" value="{{ old('email') }}" />
                <div>{{ $errors->first('email') }}</div>
                <!-- <input type="submit" name="submit" value="submit" /> -->
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select id="active" name="active" class="form-control">
                    <option value="" disabled="disabled">Please Select Status</option>
                    <option value="1">Active</option>
                    <option value="0">InActive</option>
                </select>
                <div>{{$errors->first('active')}}</div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
<hr>

<div class="row">
    <div class="col-6">
        <h3> Active Customer </h3>
        <ul>
            @foreach($activeCustomers as $customer)
                <li>
                    {{ $customer->name }}<span class="text-muted">({{ $customer->email }})</span>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="col-6">
        <h3> InActive Customer </h3>
        <ul>
            @foreach($inactiveCustomers as $customer)
                <li>
                    {{ $customer->name }}<span class="text-muted">({{ $customer->email }})</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>

@endsection