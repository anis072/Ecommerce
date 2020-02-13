@extends('adminLayout.admin_design')
@section('content')
<div id="content">
    <div id="content-header">
      <div id="breadcrumb"> <a href="{{ url('/admin/dashbord') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ url('/admin/view-category') }}">Categories</a> <a href="#" class="current">Edi Category</a> </div>

    </div>
    <div class="container-fluid"><hr>
      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>Edit Category</h5>
            </div>
            <div class="widget-content nopadding">
              <form class="form-horizontal" method="post" action="{{ url('/admin/edit-category/'.$catdetails->id ) }}" name="add_category" id="add_category" novalidate="novalidate">
                {{ csrf_field() }}
                <div class="control-group">
                  <label class="control-label">Category Name</label>
                  <div class="controls">
                    <input type="text" name="name" id="name" value="{{ $catdetails->name }}">
                  </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Description</label>
                    <div class="controls">
                      <textarea name="desc" id="desc">{{ $catdetails->description }}</textarea>
                    </div>
                  </div>
                  <div class="control-group">
                        <label class="control-label">Category Level</label>
                        <div class="controls">
                          <select name="parent_id" style="width:220px !important">
                              <option value="0">Main Category</option>
                              @foreach ($levles as $val)
                              <option value="{{ $val->id }}" @if ($val->id==$catdetails->parent_id) selected


                              @endif>{{ $val->name }}</option>
                              @endforeach
                          </select>
                        </div>
                    </div>
                  <div class="control-group">
                    <label class="control-label">URL </label>
                    <div class="controls">
                      <input type="text" name="url" id="url" value="{{ $catdetails->url }}">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Enable </label>
                    <div class="controls">
                      <input type="checkbox" name="enable" id="enable" @if($catdetails->status="1") checked @endif value="1" >
                    </div>
                  </div>
                </div>

                <div class="form-actions">
                  <input type="submit" value="Update Category" class="btn btn-success">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div





@endsection
