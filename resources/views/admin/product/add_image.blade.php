@extends('adminLayout.admin_design')
@section('content')
<div id="content">
    <div id="content-header">
      <div id="breadcrumb"> <a href="{{ url('/admin/dashbord') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Attributs</a> <a href="#" class="current">Add Attribut</a> </div>

    </div>
    <div class="container-fluid"><hr>
      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>Add Attribut</h5>
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
                <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('/admin/add-image/'.$productdet->id) }}" name="add_product" id="add_product" novalidate="novalidate">
                    {{ csrf_field() }}
                    <div class="widget-box">
                            <div class="widget-box"></div>
                            <input type="hidden" value="{{ $productdet->id }}" name="id">
                                        <div class="control-group">
                                                <label class="control-label">Product name</label>
                                                <label class="control-label"><center><strong>{{ $productdet->products_name }}</strong></center></label>

                                        </div>
                                        <div class="control-group">
                                                <label class="control-label">Product code</label>
                                                <label class="control-label"><center><strong>{{ $productdet->products_code }}</strong></center></label>

                                        </div>


                                        <div class="control-group">
                                                <label class="control-label">Product image</label>
                                                <div class="controls">
                                                        <input type="file" name="image[]" id="image" multiple>
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
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
          <div class="span12">

            <div class="widget-box">
              <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>Image table</h5>
              </div>

              <div class="widget-content nopadding">
                <table class="table table-bordered data-table">
                  <thead>
                    <tr>
                      <th>Image ID</th>
                      <th>Image Product_ID</th>
                      <th>Image </th>
                      <th>Action </th>

                    </tr>
                </thead>
                @foreach ($productImage as $prim )
                    <tbody>

                      <tr>
                       <td>{{ $prim->id }}</td>
                       <td>{{ $prim->product_id }}</td>
                       <td><img src="{{  asset('img/backend_images/products/small/'.$prim->image )}}" style="width:50px;"></img></td>
                       <td><a id="delI" rel="{{ $prim->id}}" rel1="delete-image"   class="btn btn-danger btn-mini deleteRecord" href="javascript:">
                            Delete</a></td>
</td>
                    </tr>


                </tbody>
                @endforeach
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

</div>





@endsection
