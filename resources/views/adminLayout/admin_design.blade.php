<!DOCTYPE html>
<html lang="en">
<head>
<title>Matrix Admin</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="{{ asset('css/Backend_css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/Backend_css/bootstrap-responsive.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/Backend_css/fullcalendar.css') }}" />
<link rel="stylesheet" href="{{ asset('css/Backend_css/uniform.css') }}" />
<link rel="stylesheet" href="{{ asset('css/Backend_css/select2.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css" />

<link rel="stylesheet" href="{{ asset('css/Backend_css/matrix-style.css') }}" />
<link rel="stylesheet" href="{{ asset('css/Backend_css/matrix-media.css') }}" />
<link href="{{ asset('fonts/backend/css/font-awesome.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="css/jquery.gritter.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body>

    @include('adminLayout.admin_header')
    @include('adminLayout.admin_sidebar')


@yield('content')
@include('adminLayout.admin_footer')





</script>
 <script src="{{ asset('js/backend_js/jquery.min.js')}}"></script>
 <!--<script src="{{ asset('js/backend_js/jquery.ui.custom.js')}}"></script>-->
 <script src="{{ asset('js/backend_js/bootstrap.min.js')}}"></script>
 <script src="{{ asset('js/backend_js/jquery.uniform.js')}}"></script>
 <script src="{{ asset('js/backend_js/select2.min.js')}}"></script>
 <script src="{{ asset('js/backend_js/jquery.validate.js')}}"></script>
 <script src="{{ asset('js/backend_js/matrix.js')}}"></script>
 <script src="{{ asset('js/backend_js/matrix.form_validation.js')}}"></script>
 <script src="{{ asset('js/backend_js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/backend_js/matrix.tables.js') }}"></script>
<script src="{{ asset('js/backend_js/matrix.popover.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#exdate" ).datepicker({
        minDate:0,
        dateFormat :'yy-mm-dd'
        });
  } );
  </script>
</body>
</html>
