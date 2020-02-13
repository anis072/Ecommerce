@extends('adminLayout.admin_design')
@section('content')
<div id="content">
    <div id="content-header">
      <div id="breadcrumb"> <a href="{{ url('/admin/dashbord') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Coupons</a> <a href="#" class="current">Edit Coupon</a> </div>

    </div>
    <div class="container-fluid"><hr>
      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>Edit Coupon</h5>
            </div>
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
            <div class="widget-content nopadding">
              <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('/admin/edit-coupon/'.$coupon->id) }}" name="add_coupon" id="add_coupon" >
                {{ csrf_field() }}
                <div class="widget-box">
                        <div class="widget-box">


                                    <div class="control-group">
                                            <label class="control-label">Coupon code</label>
                                            <div class="controls">
                                                    <input type="text"  value="{{ $coupon->coupon_code }}"name="couponcode" id="couponcode" minlength="5" maxlength="15" required>
                                          </div>
                                    </div>
                                    <div class="control-group">
                                            <label class="control-label">Amount</label>
                                            <div class="controls">
                                                    <input type="number" name="amount" value="{{ $coupon->amount }}" id="amount" required min="0">
                                          </div>
                                    </div>
                                    <div class="control-group">
                                            <label class="control-label">Amount Type</label>
                                            <div class="controls">
                                              <select name="amount_type"  id="amount_type" style="width:220px;" >
                                                 <option value="Percentage" @if($coupon->amount_type=="Persentage") Selected @endif>Persentage</option>
                                                 <option value="Fixed" @if($coupon->amount_type=="Fixed") Selected @endif>Fixed</option>
                                              </select>
                                            </div>
                                          </div>

                                    <div class="control-group">
                                            <label class="control-label">Expiry Date</label>
                                            <div class="controls">
                                                    <input type="text" value="{{ $coupon->expiry_date }}" name="exdate" id="exdate" autocomplete="off">
                                          </div>
                                          <div class="control-group">
                                                <label class="control-label">Enable</label>
                                                <div class="controls">
                                                  <input type="checkbox" @if($coupon->status=="1") checked @endif  name="status" id="enable"  value="1">
                                                </div>
                                              </div>
                                        </div>

                   <div class="form-actions">
                    <input type="submit" value="edit" class="btn btn-success">
                  </div>

                                  </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div





@endsection
