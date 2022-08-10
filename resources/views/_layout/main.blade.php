@extends('_layout/base')

@section('body')
    <body class="app">
        @yield('content')
        <!--
        @ include('_layout/components/dark-mode-switcher')
        -->

        <!-- BEGIN: JS Assets-->
        <script src="{{ mix('dist/js/app.js') }}"></script>
        <!-- END: JS Assets-->

        @hasSection ('script')

            <!-- BEGIN: USE-->
            @if($useJquery??false)
                <script src="{{asset('/app/js/jquery.js')}}"></script>
                <script src="{{asset('/app/js/custom.js')}}"></script>
            @endif
            @if($useInputmask??false)
                <script src="{{asset('/app/js/jquery.inputmask.js')}}"></script>
                <script src="{{asset('/app/js/jquery.inputmask.masks.js')}}"></script>
            @endif
            @if($useDataTable??false)
                <script type="text/javascript" charset="utf8" src="{{asset('/app/js/jquery.dataTables.min.js')}}"></script>
                <script type="text/javascript" charset="utf8" src="{{asset('/app/js/jquery.dataTables.min.custom.js')}}"></script>

                <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
                <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
                <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
                <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
                <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
            @endif
            @if($useMaskMoney??false)
                <script src="{{asset('/app/js/jquery.maskMoney.min.js')}}" type="text/javascript"></script>
            @endif
            @if($useToastr??false)
                <script src="{{asset('/app/js/toastr.min.js')}}" type="text/javascript"></script>
            @endif
            @if($useCkeditor??false)
                {{-- <script src="{{asset('/app/js/ckeditor/ckeditor.js')}}"></script> --}}
                <script src="{{asset('/ckeditor/ckeditor.js')}}"></script>
            @endif
            <!-- END: USE-->

            @yield('script')

        @endif
    </body>
@endsection
