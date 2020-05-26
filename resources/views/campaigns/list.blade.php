@extends('layouts.sidebaremployee')
@section('title','Campaign List')
@section('nav','Campaign')
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

<a href="{{ route('campaigns.create') }}" class="btn btn-info">Create Campaign</a>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Campaigns Stats</h4>
                <!-- <p class="card-category">New employees on 15th September, 2016</p> -->
            </div>
            <div class="card-body  table-responsive">
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
                        @foreach($campaigns as $campaign)
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
                            <td><a href="{{ route ( 'foods.edit',['id'=>$campaign->id] ) }}" rel="tooltip" title="Edit Campaign" class="btn btn-primary btn-link btn-sm">
                                    <i class="material-icons">edit</i>
                                </a></td>
                            <td><button href="{{ route ( 'foods.delete',['id'=>$campaign->id] ) }}" rel="tooltip" data-html="true" title="Delete Campaign" class="btn btn-primary btn-link btn-sm delete-confirm">
                                    <i class="material-icons">close</i>
                                </button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $campaigns->links() }}
            </div>
        </div>
    </div>
</div>
@endsection