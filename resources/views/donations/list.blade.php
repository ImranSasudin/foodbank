@extends('layouts.sidebaremployee')
@section('title','Donation List')
@section('nav','Donation')
@section('content')

@section('alert')
@if(session('create'))
Swal.fire({
position: 'top-end',
type: 'success',
title: 'Donation Created',
showConfirmButton: false,
timer: 1500
})
@endif
@if(session('update'))
Swal.fire({
position: 'top-end',
type: 'success',
title: 'Campaign Updated',
showConfirmButton: false,
timer: 1500
})
@endif
@if(session('delete'))
Swal.fire({
position: 'top-end',
type: 'success',
title: 'Campaign Deleted',
showConfirmButton: false,
timer: 1500
})
@endif
@if(session('updateStatus'))
Swal.fire({
position: 'top-end',
type: 'success',
title: 'Campaign Status Updated',
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

$('.update-status').on('click', function (event) {
event.preventDefault();
const url = $(this).attr('href');
swal({
title: 'Are you sure?',
text: 'Food inventory will be added based on foods donated!',
type: 'warning',
buttons: ["Cancel", "Yes!"],
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, confirm!'
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
<div class="row mb-3">
    <div class="col-lg-8 col-md-8">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">List of Donations</h4>
                <!-- <p class="card-category">New employees on 15th September, 2016</p> -->
            </div>
            <div class="card-body  table-responsive">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <table id="" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                    <thead class="text-primary">
                        <th>Created By</th>
                        <th>Food To Be Donated</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Delivered?</th>
                    </thead>
                    <tbody>
                        @foreach($foodDonation as $donation)
                        <tr>
                            <td>{{ $donation->user()->first()->name }}<br>
                            Phone: {{ $donation->user()->first()->phone }}</td>
                            <td>
                                @foreach($donation->foods as $food)
                                {{ $food->food()->first()->name }}
                                : {{ $food->quantity }} Unit<br>
                                @endforeach
                            </td>
                            <td>{{ $donation->format_date($donation->date) }}</td>
                            <td>{{ $donation->format_time($donation->time) }}</td>
                            <td>{{ $donation->status }}</td>
                            @if($donation->status == 'Completed')
                            <td></td>
                            @else
                            <td><a href="{{ route ( 'donations.updateDonation',['id'=>$donation->id] ) }}" rel="tooltip" title="Delivery Confirmation" class="btn btn-primary btn-link btn-sm update-status">
                                    <i class="material-icons">edit</i>
                                </a></td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $foodDonation->links() }}
            </div>
        </div>
    </div>
</div>
@endsection