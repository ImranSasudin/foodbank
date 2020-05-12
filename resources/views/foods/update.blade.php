@extends('layouts.sidebaremployee')
@section('title','Update Food')
@section('nav','Food')
@section('content')

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Update Food</h4>
                <p class="card-category">Food Detail</p>
            </div>
            <div class="card-body">
                <form action="{{ route('foods.update') }}" method="POST">
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
                    <input type="hidden" name="id" value="{{ $food->id }}" />
                    <div class="row my-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $food->name }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-md-6">
                            <label class="bmd-label-floating">Preferable</label>
                            <div class="form-check form-check-radio">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="preferable" id="exampleRadios1"
                                        value="Yes" {{ $food->preferable == 'Yes' ? 'checked' : '' }} required>
                                    Yes
                                    <span class="circle">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                            <div class="form-check form-check-radio">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="preferable" id="exampleRadios2"
                                        value="No" {{ $food->preferable == 'No' ? 'checked' : '' }}>
                                    No
                                    <span class="circle">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <hr>
                    <a href="{{ route ( 'foods.list' ) }}" class="btn btn-info">Back</a>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
