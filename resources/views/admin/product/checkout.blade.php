@extends('frontLayout.front_design');
@section('content')
<div class="row">
    <div class="col-sm-4 col-sm-offset-1">

        <div class="login-form"><!--login form-->
            <h2>Bill To</h2>
            <form class="registerForm" name="accountForm" action="{{ url('/account') }}" method="post">
                {{ csrf_field() }}
            <div class="form-group">
                <input id="billing_name"  name="sname" value="{{ $user_details->name }}" type="text" placeholder="Billing Name"   class="form-control"/>
            </div>
            <div class="form-group">
                <input id="billing_adress"  name="aname" value="{{ $user_details->adress }}" type="text" placeholder="Billing Adress"   class="form-control"/>
            </div>
            <div class="form-group">
                <input id="billing_city"  name="cname" value="{{ $user_details->city }}" type="text" placeholder="Billing City"   class="form-control"/>
            </div>

            <select name="country" id="billing_country">

                <option>Select Country</option>
                @foreach ($country as $countries )
              <option value="{{ $countries->country_name }}"  @if ($countries->country_name ==$user_details->country) selected @endif>{{ $countries->country_name }}</option>
                @endforeach
              </select>
            <div class="form-group">
                <input style="margin-top:10px;" id="billing_pincode"  name="pname"  value="{{ $user_details->pincode }}" type="text" placeholder="Billing pincode"   class="form-control"/>
            </div>
            <div class="form-group">
                <input id="billing_mobile"  name="mname" type="text" value="{{ $user_details->mobile }}" placeholder="Billing Mobile "   class="form-control"/>
            </div>
            <span style="color: red;">Lezzm ta3mel update l table user bl controller</span>
            </form>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="BillToship">
                <label class="form-check-label" for="materialUnchecked">Billing Adress same as Shipping Adress </label>
            </div>
        </div><!--/login form-->
    </div>

    <div class="col-sm-4">
        <div class="signup-form"><!--sign up form-->
            <h2>Ship To</h2>
            <form class="registerForm" id="shippingForm" action="{{ url('/checkout') }}" method="post">
                {{ csrf_field() }}
            <div class="form-group">
            <input name="sname"  id="shipping_name" type="text" placeholder="Shipping Name"   class="form-control"/>
            </div>
            <div class="form-group">
                <input name="aname"  id="shipping_adress"  type="text" placeholder="Shipping Adress"   class="form-control"/>
            </div>
            <div class="form-group">
                <input name="cname"  id="shipping_city"  type="text" placeholder="Shipping City"   class="form-control"/>
            </div>
            <select name="country" id="shipping_country">

                <option>Select Country</option>
                @foreach ($country as $countries )
              <option value="{{ $countries->country_name }}" >{{ $countries->country_name }}</option>
                @endforeach
              </select>


            <div class="form-group">
                <input name="pname" style="margin-top:10px;"  id="shipping_pincode"  type="text" placeholder="Shipping pincode"   class="form-control"/>
            </div>
            <div class="form-group">
                <input name="mname"  id="shipping_mobile" type="text"  placeholder="Shipping Mobile "   class="form-control"/>
            </div>
            <button type="submit" class="btn btn-default"> Checkout</button>
            </form>
        </div><!--/sign up form-->
    </div>
</div>


@endsection
