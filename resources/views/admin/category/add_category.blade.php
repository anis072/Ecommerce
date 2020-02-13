@extends('adminLayout.admin_design')
@section('content')
<div id="content">
    <div id="content-header">
      <div id="breadcrumb"> <a href="{{ url('/admin/dashbord') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Categories</a> <a href="#" class="current">Validation</a> </div>

    </div>
    <div class="container-fluid"><hr>
      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>Add Category</h5>
            </div>
            <div class="widget-content nopadding">
              <form class="form-horizontal" method="post" action="{{ url('/admin/add-category') }}" name="add_category" id="add_category" novalidate="novalidate">
                {{ csrf_field() }}
                <div class="control-group">
                  <label class="control-label">Category Name</label>
                  <div class="controls">
                    <input type="text" name="name" id="name">
                  </div>
                </div>
                <div class="control-group">
                        <label class="control-label">Category Level</label>
                        <div class="controls">
                          <select name="parent_id" style="width:220px !important">
                              <option value="0">Main Category</option>
                              @foreach ($levles as $val)
                              <option value="{{ $val->id }}">{{ $val->name }}</option>
                              @endforeach
                          </select>
                        </div>
                      </div>
                <div class="control-group">
                    <label class="control-label">Description</label>
                    <div class="controls">
                      <textarea name="desc" id="desc"></textarea>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">URL</label>
                    <div class="controls">
                      <input type="text" name="url" id="url">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Enable</label>
                    <div class="controls">
                      <input type="checkbox" name="enable" id="enable" value="1">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Enable</label>
                    <div class="controls">
                      <input type="checkbox" name="enable" id="enable" value="1">
                    </div>
                  </div>

                </div>

                <div class="form-actions">
                  <input type="submit" value="Validate" class="btn btn-success">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div





@endsection
