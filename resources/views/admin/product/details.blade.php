@extends('frontLayout.front_design');
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
               @include('frontLayout.front_sidebar')

                    </div><!--/category-products-->


                    <div class="price-range"><!--price-range-->
                        <h2>Price Range</h2>
                        <div class="well text-center">
                             <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                             <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
                        </div>
                    </div><!--/price-range-->

                    <div class="shipping text-center"><!--shipping-->
                        <img src="{{ asset('img/frontend_images/home/shipping.jpg')}}" alt="" />
                    </div><!--/shipping-->

                </div>
            </div>

            <div class="col-sm-9 padding-right">
              <!--product-details-->
              @if (Session::has('flash_message_error'))
              <div class="alert alert-danger alert-block">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>{!! Session('flash_message_error') !!}</strong>
              </div>
              @endif
                    <div class="col-sm-5">
                        <div class="view-product">
                                <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
                                        <a href="{{ asset('img/backend_images/products/large/'.$productdet->image)}}">
                            <img style="height: 300px;"  class="mainImage" src="{{ asset('img/backend_images/products/medium/'.$productdet->image)}}"alt="" />
                                        </a>
                                </div>
                        </div>

                        <div id="similar-product" class="carousel slide" data-ride="carousel">

                              <!-- Wrapper for slides -->
                                <div class="carousel-inner thumbnails">
                                        <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
                                                <a href="{{ asset('img/backend_images/products/small/'.$productdet->image)}}" data-standard="{{ asset('img/backend_images/products/small/'.$productdet->image)}}">
                                    <img style="width: 80px;"  class="changeImage" src="{{ asset('img/backend_images/products/medium/'.$productdet->image)}}"alt="" />
                                                </a>
                                        </div>
                                    <div class="item active">
                                        @foreach ($productAttImage as $image )
                                        <a href="{{ asset('img/backend_images/products/large/'.$productdet->image)}}" data-standard="{{ asset('img/backend_images/products/small/'.$productdet->image)}}">
                                      <a href=""><img  class="changeImage" style="width:80px;cursor:pointer;" src="{{ asset('img/backend_images/products/small/'.$image->image)}}" alt=""></a>
                                      @endforeach
                                    </div>



                                </div>

                        </div>

                    </div>
                    <form action="{{ url('/add-to-cart') }}" method="post" name="addtocart" id="addtocart">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $productdet->id }}">
                        <input type="hidden" name="product_name" value="{{ $productdet->products_name }}">
                        <input type="hidden" name="product_color" value="{{ $productdet->products_color }}">
                        <input type="hidden" name="product_code" value="{{ $productdet->products_code }}">
                        <input type="hidden" id="price" name="product_price" value="{{ $productdet->price }}">
                       <div class="product-details">
                    <div class="col-sm-7">
                        <div class="product-information"><!--/product-information-->
                            <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                            <h2>{{ $productdet->products_name  }}</h2>
                            <p>Web ID: {{ $productdet->products_code  }}</p>

                              <p>
                                    <select id="selsize"  name="size" style="width:150px;">
                                        <option value="0">Select Size</option>
                                        @foreach ($productdet->attribute as $size )
                                          <option  value="{{ $productdet->id }}-{{ $size->size }}">{{ $size->size }}</option>
                                        @endforeach
                                    </select>
                             </p>


                            <img src="images/product-details/rating.png" alt="" />
                            <span>
                                <span id="getprice">US {{ $productdet->price  }}</span>
                                <label>Quantity:</label>
                                <input type="text" name="quantity" value="1" />
                                @if($total_stock>0)
                                <button id="btncart" type="submit" class="btn btn-fefault cart">
                                    <i class="fa fa-shopping-cart"></i>
                                    Add to cart
                                </button>
                                @endif
                            </span>
                            <p ><b>Availability:</b><span id="avail">@if($total_stock>0) In Stock @else Out of Stock @endif</span></p>
                            <p><b>Condition:</b> New </p>
                            <p><b>Brand:</b> E-SHOPPER</p>
                            <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
                        </div><!--/product-information-->
                    </div>
                </form>
                </div><!--/product-details-->

                <div class="category-tab shop-details-tab"><!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li><a href="#description" data-toggle="tab">Description</a></li>
                            <li><a href="#care" data-toggle="tab">material & care </a></li>
                            <li><a href="#del" data-toggle="tab">Delivery option</a></li>

                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active in" id="description" >
                            <div class="col-sm-3">
                                {{ $productdet->description }}
                            </div>

                        </div>

                        <div class="tab-pane fade" id="care" >
                            <div class="col-sm-3">
                                {{ $productdet->care }}

                            </div>
                        </div>

                        <div class="tab-pane fade" id="del" >
                            <div class="col-sm-3">
                               Delivery Free For clients All entire of the World
                            </div>

                        </div>


                    </div>
                </div><!--/category-tab-->

                <div class="recommended_items"><!--recommended_items-->
                    <h2 class="title text-center">recommended items</h2>

                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">

                        <div class="carousel-inner">
                            <?php $count=1; ?>
                          @foreach($related_product->chunk(3) as $chunk)
                        <div <?php if($count==1) { ?> class="item active" <?php } else {

                        ?> class="item" <?php } ?> >
                        @foreach($chunk as $item)
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img style="width:160px;"src="{{ asset('img/backend_images/products/small/'.$item->image)}}" alt="" />
                                                <h2>$ {{ $item->price }}</h2>
                                                <p>{{ $item->products_name }}</p>
                                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                @endforeach
                            </div>

                            <?php $count++;?>

                            @endforeach
                        </div>


                         <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                          </a>
                          <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                          </a>
                    </div>
                </div><!--/recommended_items-->

            </div>
        </div>
    </div>
</section>



@endsection
