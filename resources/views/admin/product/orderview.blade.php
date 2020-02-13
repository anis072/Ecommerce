@extends('frontLayout.front_design');
@section('content')
<div class="row">
    <div class="col-sm-4 col-sm-offset-1">

        <div class="login-form">


<h2>Billing  Details</h2>

<div class="form-group">
   {{ $user_details->name }}
</div>
<div class="form-group">
    {{ $user_details->adress }}
 </div>
<div class="form-group">
{{ $user_details->city }}
</div>
<div class="form-group">
    {{ $user_details->state }}
     </div>
<div class="form-group">
    {{ $user_details->pincode }}
</div>
<div class="form-group">
  {{ $user_details->mobile }}
</div>
</div>


        </div><!--/login form-->
    </div>

    </div>
</div>



@endsection
