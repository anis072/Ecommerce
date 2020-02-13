@extends('frontLayout.front_design');
@section('content')

<section id="form" style="margin-top: 0px;"><!--form-->
    <div class="container">
            @if (Session::has('flash_message_succ'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{!! Session('flash_message_succ') !!}</strong>
            </div>
            @endif
            @if (Session::has('flash_message_error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{!! Session('flash_message_error') !!}</strong>
            </div>
            @endif
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">

                <div class="login-form"><!--login form-->
                    <h2>Update your account</h2>
                    <form class="registerForm" id="accountForm" action="{{ url('/account') }}" method="post">
                        {{ csrf_field() }}
                    <input name="name" value="{{ $userDetails->name     }}" id="name" type="text" placeholder="Name"/>
                        <input value="{{ $userDetails->adress }}" name="adress" id="adress" type="text" placeholder="Adress"/>
                        <input name="city" id="city" type="text" value="{{ $userDetails->city }}" placeholder="City"/>
                        <input name="state" id="state" type="text" placeholder="State" value="{{ $userDetails->state }}" />
                        <select id="country" name="country">

                          <option>Select Country</option>
                          @foreach ($countries as $countries )
                        <option value="{{ $countries->country_name }}">{{ $countries->country_name }}</option>
                          @endforeach
                        </select>
                        <input style="margin-top:10px;" name="pincode" id="pincode" type="text" placeholder="Pincode" value="{{ $userDetails->pincode }}" />
                        <input name="mobile" id="mobile" type="text" placeholder="Mobile" value="{{ $userDetails->mobile }}" />

                        <button type="submit" class="btn btn-default">Update</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>Update Password</h2>
                    <form class="registerForm" id="passForm" action="{{ url('/update-pass') }}" method="post">
                        {{ csrf_field() }}
                        <input name="c_pass" id="c_pass"id="myPassword" type="password" placeholder="Current Password"/>
                        <span id="check"></span>
                        <input name="n_pass" id="n_pass" type="password" placeholder="New Password"/>
                        <input  name="con_pass" id="myPassword" type="password" placeholder="Confirm Password"/>
                        <button type="submit" class="btn btn-default">Update Password</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><
@endsection
