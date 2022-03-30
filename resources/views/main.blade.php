
@include('head')
<script>
    let modalTitle = '@lang('main.modal_title')';
    let modalBody = '@lang('main.modal_body')';
</script>
<body>
<div class="container">

    <div class="row">
        <div class="col-12">
            @include('header')
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
