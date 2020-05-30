@extends('layouts.sidebardonor')
@section('title','Donation List')
@section('nav','Donation')
@section('content')

@section('alert')
@if(session('create'))
Swal.fire({
position: 'top-end',
type: 'success',
title: 'Campaign Created',
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
text: 'Food inventory will be deducted based on required foods!',
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

<a href="{{ route('campaigns.create') }}" class="btn btn-info">Create Campaign</a>
<div class="row mb-3">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Upcoming Campaigns</h4>
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
                        <th>Name</th>
                        <th>Created By</th>
                        <th>Place</th>
                        <th>Required Food</th>
                        <th>Date</th>
                        <th>Time</th>
                    </thead>
                    <tbody>
                        @foreach($foodDonation as $campaign)
                        <tr>
                            <td>{{ $campaign->name }}</td>
                            <td>{{ $campaign->employee()->first()->name }}</td>
                            <td>{{ $campaign->place }}</td>
                            <td>
                                @foreach($campaign->foods as $food)
                                <div class="row justify-content-between">
                                    <div class="col-md-6">
                                        {{ $food->food()->first()->name }}
                                        : {{ $food->required_quantity }} Unit
                                    </div>
                                    <div class="col-md-6">
                                        @if ($food->status == 'enough')
                                        <span class="badge badge-success">Enough</span>
                                        @else
                                        <span class="badge badge-danger">Not Enough</span>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </td>
                            <td>{{ $campaign->format_date($campaign->date) }}</td>
                            <td>{{ $campaign->format_time($campaign->time) }}</td>
                            @if( $campaign->date <= Carbon\Carbon::today() ) <td><a href="{{ route ( 'campaigns.updateStatus',['id'=>$campaign->id] ) }}" rel="tooltip" data-html="true" title="Update Campaign Status" class="btn btn-danger btn-link btn-sm update-status">
                                    Completed?</a></td>
                                @else
                                <td></td>
                                @endif
                                <td><a href="{{ route ( 'campaigns.edit',['id'=>$campaign->id] ) }}" rel="tooltip" title="Edit Campaign" class="btn btn-primary btn-link btn-sm">
                                        <i class="material-icons">edit</i>
                                    </a></td>
                                <td><button href="{{ route ( 'campaigns.delete',['id'=>$campaign->id] ) }}" rel="tooltip" data-html="true" title="Delete Campaign" class="btn btn-primary btn-link btn-sm delete-confirm">
                                        <i class="material-icons">close</i>
                                    </button></td>
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