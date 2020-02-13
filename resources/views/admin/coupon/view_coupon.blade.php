@extends('adminLayout.admin_design')
@section('content')
<div id="content">
        <div id="content-header">
                <div id="breadcrumb"> <a href="{{ url('/admin/dashbord') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Coupons</a> <a href="#" class="current">View Coupon</a> </div>
                @if (Session::has('flash_message_succ'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{!! Session('flash_message_succ') !!}</strong>
                </div>
                @endif
              </div>
        <div class="container-fluid">
          <hr>
          <div class="row-fluid">
            <div class="span12">

              <div class="widget-box">
                <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                  <h5>Coupon table</h5>
                </div>
                <table class="table table-bordered data-table">
                    <thead>
                      <tr>
                        <th>Coupon ID</th>
                        <th>Product code</th>
                        <th>Amount</th>
                        <th>Amount Type</th>
                        <th>Expiry Date</th>
                        <th>Status</th>
                        <th>Created date</th>
                        <th>Action(s)</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($coupon as $coupon )
                        <tr class="gradeX">
                        <td>{{ $coupon->id }}</td>
                        <td>{{  $coupon->coupon_code }}</td>
                        <td>{{ $coupon->amount}}
                        @if($coupon->amount=="percentage") % @else $ @endif </td>
                         <td>{{ $coupon->amount_type }}</td>
                        <td>{{$coupon->expiry_date }}</td>
                        <td>
                        @if($coupon->status==1) Actif @else In Actif @endif
                        </td>
                        <td>{{ $coupon->created_at }}</td>


                      <td class="center">

                            <a href="{{ url('/admin/edit-coupon',$coupon->id)}}"   class="btn btn-info btn-mini">edit</a>
                            <a id="delcoupon" onclick="return Delcoupon();" rel="{{ $coupon->id }}" rel1="delete-coupon"   class="btn btn-danger btn-mini deleteRecord" href="{{ url('/delete-coupon/'.$coupon->id) }}">
                                Delete</a>

                        </td>
                      </tr>




                    @endforeach
                    </tbody>
                  </table>

                <div class="widget-content nopadding">

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script>
          function Delcoupon(){
    if(confirm('Are you sureto delete this coupon ')){
        return true;
    }
     return false;
}
          </script>

@endsection
