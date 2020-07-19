@extends('layouts.sidebaremployee')
@section('title','List')
@section('nav','Food')
@section('content')

@section('alert')
    @if(session('create'))
        Swal.fire({
            position: 'top-end',
            type: 'success',
            title: 'Food Created',
            showConfirmButton: false,
            timer: 1500
        })
    @endif
    @if(session('update'))
        Swal.fire({
            position: 'top-end',
            type: 'success',
            title: 'Food Updated',
            showConfirmButton: false,
            timer: 1500
        })
    @endif
    @if(session('delete'))
        Swal.fire({
            position: 'top-end',
            type: 'success',
            title: 'Food Deleted',
            showConfirmButton: false,
            timer: 1500
        })
    @endif
    $('.delete-confirm').on('click', function (event) {
        event.preventDefault();
        const url = $(this).attr('href');
        swal({
            title: 'Are you sure?',
            text: 'This record and it`s details will be permanantly deleted!',
            type: 'warning',
            buttons: ["Cancel", "Yes!"],
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(function(result) {
            if (result.value) {
                window.location.href = url;
                {{-- Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              ) --}}
            }
            else{

            }
        });
    });
@endsection

<a href="{{ route('foods.create') }}" class="btn btn-info">Create Food</a>
<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Foods Stats</h4>
                <!-- <p class="card-category">New employees on 15th September, 2016</p> -->
            </div>
            <div class="card-body  table-responsive">
                <table id="" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                    <thead class="text-primary">
                        <th>Name</th>
                        <th>Non-perishable?</th>
                        <th>Quantity</th>
                    </thead>
                    <tbody>
                        @foreach($foods as $food)
                        <tr>
                            <td>{{ $food->name }}</td>
                            <td>{{ $food->preferable }}</td>
                            <td>{{ $food->quantity }}</td>
                            <td><a href="{{ route ( 'foods.edit',['id'=>$food->id] ) }}" rel="tooltip" title="Edit Food" class="btn btn-primary btn-link btn-sm">
                                    <i class="material-icons">edit</i>
                                </a></td>
                            <td><button href="{{ route ( 'foods.delete',['id'=>$food->id] ) }}" rel="tooltip" data-html="true" title="Delete Food" class="btn btn-primary btn-link btn-sm delete-confirm">
                                    <i class="material-icons">close</i>
                                </button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $foods->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
