@extends('_layout/base')

@section('body')
    <body class="login">
        <div class="container sm:px-10">
            <div class="block xl:grid grid-cols-2 gap-4">
                <!-- BEGIN: Login Info -->
                <div class="hidden xl:flex flex-col min-h-screen">
                    <div class="my-auto">
                        <a href="" class="pt-5 ml-10">
                            <img alt="inTera - Sistema de Telemedicina da TeraTelemedicina" class="-intro-x w-1/2 -mt-20 ml-16" src="{{ asset('dist/images/teraTelemedicina.svg') }}">
                        </a>
                    </div>
                </div>
                <!-- END: Login Info -->
                @yield('content')
            </div>
        </div>
        <!-- BEGIN: JS Assets-->
        <script src="{{ mix('dist/js/app.js') }}"></script>
        <!-- END: JS Assets-->

        @hasSection ('script')

            <!-- BEGIN: USE-->
            @if($useJquery??false)
                <script src="{{asset('/app/js/jquery.js')}}"></script>
                <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            @endif
            @if($useInputmask??false)
                <script src="{{asset('/app/js/jquery.inputmask.js')}}"></script>
                <script src="{{asset('/app/js/jquery.inputmask.masks.js')}}"></script>
            @endif
            @if($useDataTable??false)
                <script type="text/javascript" charset="utf8" src="{{asset('/app/js/jquery.dataTables.min.js')}}"></script>
                <script type="text/javascript" charset="utf8" src="{{asset('/app/js/jquery.dataTables.min.custom.js')}}"></script>

                <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
                <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
                <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
                <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
                <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
            @endif
            <!-- END: USE-->

            @yield('script')
        @endif
    </body>
@endsection
