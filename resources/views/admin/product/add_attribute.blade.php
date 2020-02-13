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
                <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('/admin/add-attribute/'.$productdet->id) }}" name="add_product" id="add_product" novalidate="novalidate">
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
                                            <label class="control-label">Product color</label>
                                            <label class="control-label"><center><strong>{{ $productdet->products_color }}</strong></center></label>

                                        </div>

                                        <div class="control-group">

                                            <label class="control-label"></label>

                                            <div class="field_wrapper">
                                                <div>
                                                    <input type="text" name="sku[]" value="" style="width: 120px;"placeholder="Sku"/>
                                                    <input type="text" name="size[]" value=""style="width: 120px;"placeholder="Size"/>
                                                    <input type="text" name="price[]" value=""style="width: 120px;"placeholder="Price"/>
                                                    <input type="text" name="stock[]" value=""style="width: 120px;"placeholder="Stock"/>

                                                    <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
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
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
          <div class="span12">

            <div class="widget-box">
              <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>Attribute table</h5>
              </div>

              <div class="widget-content nopadding">
                    <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('/admin/edit-attribute/'.$productdet->id) }}" name="add_product" id="add_product" novalidate="novalidate">
                        {{ csrf_field() }}
                <table class="table table-bordered data-table">
                  <thead>
                    <tr>
                      <th>Attribut ID</th>
                      <th>Attribute sku</th>
                      <th>Attribute size</th>
                      <th>Attribute price</th>
                      <th>Attribute stock</th>
                      <th>Action(s)</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($productdet['attribute'] as $product )


                    <tr class="gradeX">
                      <td><input type="hidden" name="idAttr[]" value="{{ $product->id }}">{{ $product->id }}</td>
                      <td>{{ $product->sku }}</td>
                      <td>{{ $product->size }}</td>
                      <td><input type="text" name="price[]" value="{{ $product->price }}"   ></td>
                      <td><input type="text" name="stock[]" value="{{ $product->stock }}"   ></td>

                       <td class="center">


                           <a id="delP" rel="{{ $product->id }}" rel1="delete-attribute"   class="btn btn-danger btn-mini deleteRecord" href="javascript:">
                              Delete</a>
                           <input type="submit" value="Update" class="btn btn-info btn-mini ">

                      </td>
                    </tr>
                  </div>
                  @endforeach
                  </tbody>
                </table>
            </form>
              </div>
            </div>
          </div>
        </div>
      </div>

</div>





@endsection
