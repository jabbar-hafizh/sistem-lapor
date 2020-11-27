<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Report</title>
  {{-- responsive --}}
  <meta name="viewport" content="width=device-width, initial-scale=1">

  {{-- link css --}}
  @include('aset.v_link')
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    {{-- nav bar --}}
    @include('layout.v_navbar')

    {{-- side bar --}}
    @include('layout.v_sidebar')

    {{-- content --}}
    @yield('content')

    {{-- footer --}}
    @include('layout.v_footer')  

    <aside class="control-sidebar control-sidebar-dark">
      {{-- Control sidebar content goes here --}}
    </aside>
  </div>

  {{-- script js --}}
  @include('aset.v_script')
</body>
</html>
