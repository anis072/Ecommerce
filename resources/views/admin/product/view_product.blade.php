@extends('adminLayout.admin_design')
@section('content')
<div id="content">
        <div id="content-header">
                <div id="breadcrumb"> <a href="{{ url('/admin/dashbord') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Categories</a> <a href="#" class="current">View Category</a> </div>
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
                  <h5>Product table</h5>
                </div>

                <div class="widget-content nopadding">
                  <table class="table table-bordered data-table">
                    <thead>
                      <tr>
                        <th>Product ID</th>
                        <th>Category ID</th>
                        <th>Category name</th>
                        <th>Product name</th>
                        <th>Product code</th>
                        <th>Product color</th>
                        <th>Product description</th>
                        <th>Product price</th>
                        <th>Product image</th>
                        <th>Action(s)</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($product as $product )


                      <tr class="gradeX">
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->category_name }}</td>
                        <td>{{ $product->category_id }}</td>
                        <td>{{ $product->products_name }}</td>
                        <td>{{ $product->products_code }}</td>
                        <td>{{ $product->products_color }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                       @if(!empty($product->image))
                             <td><image src="{{ asset('img/backend_images/products/small/'.$product->image) }}" style="width:50px;height:50px;"></image></td>

                    @else
                             <td>No image</td>

                   @endif
                         <td class="center">
                            <a href="#myModal{{ $product->id }}" data-toggle="modal"  class="btn btn-success btn-mini">View</a>
                            <a href="{{ url('/admin/edit-product',$product->id)}}"   class="btn btn-info btn-mini">edit</a>
                            <a href="{{ url('/admin/add-attribute',$product->id)}}"   class="btn btn-success btn-mini">Add</a>
                            <a href="{{ url('/admin/add-image',$product->id) }}" class="btn btn-info btn-mini">images</a>
                             <a id="delP" rel="{{ $product->id }}" rel1="delete-product"   class="btn btn-danger btn-mini deleteRecord" href="javascript:">
                                Delete</a>

                        </td>
                      </tr>



                    <div id="myModal{{ $product->id }}" class="modal hide">
                        <div class="modal-header">
                          <button data-dismiss="modal" class="close" type="button">×</button>
                          <h3>{{ $product->products_name }}</h3>
                        </div>
                        <div class="modal-body">
                          <p>Product ID :{{ $product->id }}</p>
                           <p>Product name :{{ $product->products_name }}</p>
                            <p>Product code :{{ $product->products_code }}</p>
                            <p>Product color :{{ $product->products_color}}</p>
                            <p>Product description :{{ $product->description }}</p>
                            <p>Product price :{{ $product->price }}</p>
                        </div>
                      </div>

                    </div>
                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

@endsection
