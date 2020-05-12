@extends('layouts.sidebaremployee')
@section('title','View')
@section('nav','Profile')
@section('content')

@section('alert')
@if(session('success'))
    Swal.fire({
        position: 'top-end',
        type: 'success',
        title: 'Profile Updated',
        showConfirmButton: false,
        timer: 1500
    })
@endif
@endsection

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">View Profile</h4>
                <p class="card-category">Your profile</p>
            </div>
            <div class="card-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Name</label>
                                <p class="form-control">{{ $employee->name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Email</label>
                                <p class="form-control">{{ $employee->email }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Password</label><br>
                                <button class="btn btn-success">Change Password</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Phone</label>
                                <p class="form-control">{{ $employee->phone }}</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <a href="{{ route('employees.editProfile') }}" class="btn btn-primary pull-right">Update Profile</a>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
