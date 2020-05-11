@extends('layouts.master')
@section('title','Login')

@section('head')
<style>
    .login-container {
        margin-top: 5%;
        margin-bottom: 5%;
    }

    .login-form-1 {
        padding: 5%;
        box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
    }

    .login-form-1 h3 {
        text-align: center;
        color: #333;
    }

    .login-form-2 {
        padding: 5%;
        background: #9c27b0;
        box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
    }

    .login-form-2 h3 {
        text-align: center;
        color: #fff;
    }

    .login-container form {
        padding: 10%;
    }

    .btnSubmit {
        width: 50%;
        border-radius: 1rem;
        padding: 1.5%;
        border: none;
        cursor: pointer;
    }

    .login-form-1 .btnSubmit {
        font-weight: 600;
        color: #fff;
        background-color: #9c27b0;
    }

    .login-form-2 .btnSubmit {
        font-weight: 600;
        color: #9c27b0;
        background-color: #fff;
    }

    .login-form-2 .ForgetPwd {
        color: #fff;
        font-weight: 600;
        text-decoration: none;
    }

    .login-form-1 .ForgetPwd {
        color: #9c27b0;
        font-weight: 600;
        text-decoration: none;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-6 login-form-1">
        <h3>Staff</h3>
        <form action="{{ route('employees.login') }}" method="post" autocomplete="off">
            @csrf
            <div class="form-group">
                <input type="text" name="id" placeholder="Your ID *" class="form-control" required />
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" autocomplete="new-password" placeholder="Your Password *" class="form-control" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btnSubmit" name="action" value="LoginStaff">Log In</button>
            </div>
        </form>
    </div>
    <div class="col-md-6 login-form-2">
        <h3>Donor</h3>
        <form action="{{ route('users.login') }}" method="post" autocomplete="off">
            @csrf
            <div class="form-group">
                <input type="text" name="email" placeholder="Your Email *" class="form-control" required />
            </div>
            <div class="form-group">
                <input type="password" name="password" autocomplete="new-password" placeholder="Your Password *" class="form-control" required />
            </div>
            <div class="form-group">
                <button type="submit" class="btnSubmit" name="action" value="LoginDonor">Log In</button>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        @isset($message)
        Swal.fire(
            'Invalid!',
            '{{ $message }}!',
            'error'
        )
        @endif
    });
</script>

@endsection
