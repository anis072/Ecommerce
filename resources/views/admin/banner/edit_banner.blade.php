@extends('adminLayout.admin_design')
@section('content')
<div id="content">
    <div id="content-header">
      <div id="breadcrumb"> <a href="{{ url('/admin/dashbord') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ url('/admin/view-category') }}">Categories</a> <a href="#" class="current">Edi Banner</a> </div>

    </div>
    <div class="container-fluid"><hr>
      <div class="row-fluid">
        <div class="span12">
                @if (Session::has('flash_message_succ'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{!! Session('flash_message_succ') !!}</strong>
                </div>
                @endif
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>Edit Banner</h5>
            </div>
            <div class="widget-content nopadding">
              <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('/admin/edit-banner/'.$bannerdet->id ) }}" name="add_category" id="add_category" novalidate="novalidate">
                {{ csrf_field() }}
                <div class="control-group">
                    <label class="control-label">Banner image</label>
                    <div class="controls">
                            <input type="file" name="image" id="image">
                            <input type="hidden" name="current_image" id="image">
                            <image src="{{ asset('img/frontend_images/dummy/'.$bannerdet->image)}}" style="width: 50px; height: 50px;"></image> |
                             <a href="{{ url('/admin/delete-image/'.$bannerdet->id) }}">Delete</a>
                  </div>

            </div>
                <div class="control-group">
                  <label class="control-label">Banner Title</label>
                  <div class="controls">
                    <input type="text" name="title" id="title" value="{{ $bannerdet->title }}">
                  </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Banner Link</label>
                    <div class="controls">
                      <input type="text" name="link" id="link" value="{{ $bannerdet->title }}">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Enable </label>
                    <div class="controls">
                      <input type="checkbox" name="enable" id="enable" @if($bannerdet->status="1") checked @endif value="1" >
                    </div>
                  </div>
                </div>


                <div class="form-actions">
                  <input type="submit" value="Update Banner" class="btn btn-success">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
</div>





@endsection
