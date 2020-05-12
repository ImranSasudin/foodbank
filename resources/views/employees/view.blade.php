@extends('layouts.sidebaremployee')
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
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#changepassword">Change Password</button>
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
<!-- Modal -->
<div class="modal fade" id="changepassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Change Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

@endsection
