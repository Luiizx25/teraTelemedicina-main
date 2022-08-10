<html>
    <head>
        <title>
            inTera - {{ __($title??'TELE MEDICINA') }}
        </title>
        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="{{ mix('dist/css/app.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{asset('/app/css/custom.css')}}">
        <!-- END: CSS Assets-->
        <style>
            /**
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
            @page {
                margin: 0cm 0cm;
            }

            /** Define now the real margins of every page in the PDF **/
            html {
                background-color: #ffffff !important;
            }
            body {
                margin-top: 5cm;
                margin-left: 1cm;
                margin-right: 1cm;
                margin-bottom: 2cm;
            }

            /** Define the header rules **/
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 3cm;
            }

            /** Define the footer rules **/
            footer {
                position: fixed;
                bottom: 0cm;
                left: 0cm;
                right: 0cm;
                height: 3cm;
            }
        </style>
    </head>
    <body style="background-color: #ffffff !important;">
        @yield('body')
    </body>
</html>

