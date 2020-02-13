@extends('adminLayout.admin_design')
@section('content')
<div id="content">
        <div id="content-header">
                <div id="breadcrumb"> <a href="{{ url('/admin/dashbord') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Banner</a> <a href="#" class="current">View Banner</a> </div>
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
                  <h5>Banner table</h5>
                </div>

                <div class="widget-content nopadding">
                  <table class="table table-bordered data-table">
                    <thead>
                      <tr>
                        <th>Banner ID</th>
                        <th>Bnnaer Image</th>

                        <th>Banner Title</th>
                        <th>Banner Link</th>
                        <th>Action(s)</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($banner as $banner )


                      <tr class="gradeX">
                        <td>{{ $banner->id }}</td>
                        @if(!empty($banner->image))
                             <td><image src="{{ asset('img/frontend_images/dummy/'.$banner->image) }}" style="width:50px;height:50px;"></image></td>

                    @else
                             <td>No image</td>

                   @endif
                        <td>{{ $banner->title }}</td>
                        <td>{{ $banner->link }}</td>

                         <td class="center">
                            <a href="{{ url('/admin/edit-banner',$banner->id)}}"   class="btn btn-info btn-mini">edit</a>


                             <a  rel="{{ $banner->id }}" rel1="delete-bannner" href="{{ url('/admin/delete-banner/'.$banner->id) }}" class="btn btn-danger btn-mini " onclick="return Delcoupon();" href="">
                                Delete</a>

                        </td>
                      </tr>



                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script>
      function Delcoupon(){
        if(confirm('Are you sureto delete this Banner ')){
            return true;
        }
         return false;
    }
              </script>


@endsection
