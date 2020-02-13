@extends('adminLayout.admin_design')
@section('content')
<div id="content">
    <div id="content-header">
      <div id="breadcrumb"> <a href="{{ url('/admin/dashbord') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Products</a> <a href="#" class="current">Add Product</a> </div>

    </div>
    <div class="container-fluid"><hr>
      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>Add Product</h5>
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
              <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('/admin/add-product') }}" name="add_product" id="add_product" novalidate="novalidate">
                {{ csrf_field() }}
                <div class="widget-box">
                        <div class="widget-box">

                                    <div class="control-group">
                                      <label class="control-label">Under Category</label>
                                      <div class="controls">
                                        <select name="category_id" style="width:220px;" >
                                          <?php  echo $category_dropdown; ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="control-group">
                                            <label class="control-label">Product name</label>
                                            <div class="controls">
                                                    <input type="text" name="name" id="name">
                                          </div>
                                    </div>
                                    <div class="control-group">
                                            <label class="control-label">Product code</label>
                                            <div class="controls">
                                                    <input type="text" name="code" id="code">
                                          </div>
                                    </div>

                                    <div class="control-group">
                                            <label class="control-label">Product color</label>
                                            <div class="controls">
                                                    <input type="text" name="color" id="color">
                                          </div>
                                    </div
                                    <div class="control-group">
                                        <label class="control-label">Description</label>
                                        <div class="controls">
                                          <textarea name="desc" id="desc"></textarea>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="control-group">
                                            <label class="control-label">Material & Care</label>
                                            <div class="controls">
                                              <textarea name="care" id="care"></textarea>
                                            </div>
                                          </div>

                                      <div class="control-group">
                                            <label class="control-label">Product price</label>
                                            <div class="controls">
                                                    <input type="text" name="price" id="price">
                                          </div>
                                    </div>
                                    <div class="control-group">
                                            <label class="control-label">Product image</label>
                                            <div class="controls">
                                                    <input type="file" name="image" id="image">
                                          </div>
                                    </div>


                <div class="form-actions">
                    <input type="submit" value="add Coupon" class="btn btn-success">
                  </div>

                                  </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div





@endsection
