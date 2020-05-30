@extends('layouts.sidebardonor')
@section('title','View Profile')
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
@if(session('password'))
Swal.fire({
position: 'top-end',
type: 'success',
title: 'Password Updated',
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
                    @if (session('error'))
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            <li>{{ Session::get('error') }}</li>
                        </ul>
                    </div>
                    @endif
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Name</label>
                                <p class="form-control">{{ $user->name }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Register Number</label>
                                <p class="form-control">{{ $user->registerNum }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Email</label>
                                <p class="form-control">{{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Phone Number</label>
                                <p class="form-control">{{ $user->phone }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Password</label><br>
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#changepassword">Change Password</button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="changepassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('users.password') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row my-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Current Password:</label>
                                <input type="password" name="curPass" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">New Password:</label>
                                <input type="password" name="newPass" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Re-enter New Password:</label>
                                <input type="password" name="reNewPass" class="form-control" required>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
