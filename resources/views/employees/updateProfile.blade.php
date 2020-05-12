@extends('layouts.sidebaremployee')
@section('title','Update Profile')
@section('nav','Profile')
@section('content')

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Update Profile</h4>
                <p class="card-category">Your profile</p>
            </div>
            <div class="card-body">
                <form action="{{ route('employees.updateProfile') }}" method="POST">
                    @csrf
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="row my-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $employee->name }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Email</label>
                                <input type="text" name="email" class="form-control" value="{{ $employee->email }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Phone</label>
                                <input type="number" name="phone" class="form-control" value="{{ $employee->phone }}" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <hr>
                    <a href="{{ route ( 'employees.viewProfile' ) }}" class="btn btn-info pull-left">Back</a>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
