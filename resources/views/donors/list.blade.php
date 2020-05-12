@extends('layouts.sidebaremployee')
@section('title','List')
@section('nav','Donor')
@section('content')

@section('alert')
    @if(session('register'))
            Swal.fire({
            position: 'top-end',
            type: 'success',
            title: 'Donor Registered',
            showConfirmButton: false,
            timer: 1500
        })
    @endif
    @if(session('update'))
        Swal.fire({
            position: 'top-end',
            type: 'success',
            title: 'Donor Updated',
            showConfirmButton: false,
            timer: 1500
        })
    @endif
@endsection

<a href="{{ route('users.registerform') }}" class="btn btn-info">Register Donor</a>
<div class="row">
    <div class="col-lg-8 col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Donors Stats</h4>
                <!-- <p class="card-category">New employees on 15th September, 2016</p> -->
            </div>
            <div class="card-body  table-responsive">
                <table id="" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                    <thead class="text-primary">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Register Num</th>
                    </thead>
                    <tbody>
                        @foreach($users as $donor)
                        <tr>
                            <td>{{ $donor->id }}</td>
                            <td>{{ $donor->name }}</td>
                            <td>{{ $donor->email }}</td>
                            <td>{{ $donor->phone }}</td>
                            <td>{{ $donor->registerNum }}</td>
                            <td><a href="{{ route ( 'users.edit',['id'=>$donor->id] ) }}" rel="tooltip" title="Edit Donor" class="btn btn-primary btn-link btn-sm">
                                    <i class="material-icons">edit</i>
                                </a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
