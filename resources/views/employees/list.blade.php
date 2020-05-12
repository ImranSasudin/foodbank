@extends('layouts.sidebaremployee')
@section('title','List Employees')
@section('nav','Employee')
@section('content')

@section('alert')
@if(session('register'))
    Swal.fire({
        position: 'top-end',
        type: 'success',
        title: 'Employee Registered',
        showConfirmButton: false,
        timer: 1500
    })
@endif
@if(session('update'))
    Swal.fire({
        position: 'top-end',
        type: 'success',
        title: 'Employee Updated',
        showConfirmButton: false,
        timer: 1500
    })
@endif
@endsection

<a href="{{ route('employees.registerform') }}" class="btn btn-info">Register Employee</a>
<div class="row">
    <div class="col-lg-8 col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Employees Stats</h4>
                <!-- <p class="card-category">New employees on 15th September, 2016</p> -->
            </div>
            <div class="card-body  table-responsive">
                <table id="" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                    <thead class="text-primary">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                    </thead>
                    <tbody>
                        @foreach($employees as $employee)
                        <tr>
                            <td>{{ $employee->id }}</td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->phone }}</td>
                            <td>{{ $employee->role }}</td>
                            <td><a href="{{ route ( 'employees.editEmployee',['id'=>$employee->id] ) }}" rel="tooltip" title="Edit Employee" class="btn btn-primary btn-link btn-sm">
                                    <i class="material-icons">edit</i>
                                </a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $employees->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
