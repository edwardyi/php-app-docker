@extends('layout')

@section('title', 'Create A Customer')

@section('content')

<div class="row">
    <div class="col-12">
        <h1>Create A Customer</h1>
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
                <label for="random">Random</label>
                <input class="form-control" type="text" name="random" value="{{old('random')}}"/>
                <div>{{$errors->first('random')}}</div>
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
            <div class="form-group">
                <label for="company">Company</label>
                <select name="company_id" class="form-control">
                    <option disabled="disabled" value="">Please Select Company</option>
                    @foreach($companies as $company)
                        <option value="{{$company->id}}"> {{$company->name}} </option>
                    @endforeach
                </select>

                <div>{{$errors->first('company_id')}}</div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection