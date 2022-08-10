<!DOCTYPE html>
<html lang="pt-br" class="light">
    <!-- BEGIN: Head -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="ref_description" content="Pzn Criativo">
        <meta name="keywords" content="pzn criativo, web app">
        <meta name="author" content="pzncriativo.com">

        <style>
            @page {
                /* margin: 1cm 0cm 0cm 0cm;
                padding: 1cm 0cm 1cm 0cm; */
                margin: 0cm 0cm 0cm 0cm;
                padding: 0cm 0cm 0cm 0cm;
                /* header: page-header;
                footer: page-footer; */
            }

            html {
                background-color: #ffffff !important;
                font-family: 'sans-serif';
                font-family: Arial, Helvetica, sans-serif 'sans-serif',inherit;
            }
            body {
                font-family: 'sans-serif',inherit;
                font-family: Arial, Helvetica, sans-serif 'sans-serif',inherit;
            }
            table {
                width: 100%;
            }
            blockquote, dl, dd, h1, h2, h3, h4, h5, h6, hr, figure, p, pre, span {
                margin: 0;
            }
            ol, ul {
                list-style: none;
                margin: 0;
                padding: 0;
            }
            b, strong {
                font-weight: bolder;
            }

            img, svg, video, canvas, audio, iframe, embed, object {
                display: block;
                vertical-align: middle;
            }
            .header {
                padding: 0px 0px 0px 0px;
            }
            .main {
                padding: 300px 50px 100px 50px;
                padding: 10px 50px 10px 50px;
            }
            .footer {
                position: fixed;
                bottom: 110px;
                color: #666
                /* padding: 10px 0px 5px 0px; */
            }
            .text-center {
                text-align: center;
            }
            .text-left {
                text-align: left;
            }
            .text-right {
                text-align: right;
            }
            .text-xs {
                font-size: 0.75rem;
            }
            .text-sm {
                font-size: 0.875rem;
            }
            .text-base {
                font-size: 1rem;
            }
            .text-lg {
                font-size: 1.125rem;
            }
            .text-xl {
                font-size: 1.25rem;
            }
            .text-gray-500 {
                color: #a0aec0;
            }


            .font-light {
                font-weight: 300;
            }
            .font-semibold {
                font-weight: 600;
            }
            .font-bold {
                font-weight: 900;
            }

            .truncate {
                overflow: hidden;
                white-space: nowrap;
            }
            .capitalize {
                text-transform: capitalize;
            }
            .uppercase {
                text-transform: uppercase;
            }
            .lowercase {
                text-transform: lowercase;
            }
            .capitalize {
                text-transform: capitalize;
            }
            .grid {
                display: grid;
            }

            .m-0 {
                margin: 0px;
            }
            .mt-0 {
                margin-top: 0rem;
            }
            .mt-1 {
                margin-top: 0.25rem;
            }
            .mt-2 {
                margin-top: 0.5rem;
            }
            .mt-3 {
                margin-top: 0.75rem;
            }
            .mt-4 {
                margin-top: 1rem;
            }
            .mt-5 {
                margin-top: 1.25rem;
            }
            .mt-6 {
                margin-top: 1.5rem;
            }

            .mb-1 {
                margin-bottom: 0.25rem;
            }
            .mb-2 {
                margin-bottom: 0.5rem;
            }
            .mb-6 {
                margin-bottom: 1.5rem;
            }
            .mb-10 {
                margin-bottom: 2.5rem;
            }
            .mx-1 {
                margin-left: 0.25rem;
                margin-right: 0.25rem;
            }
            .mx-2 {
                margin-left: 0.50rem;
                margin-right: 0.50rem;
            }
            .mx-4 {
                margin-left: 0.75rem;
                margin-right: 0.75rem;
            }
            .mx-4 {
                margin-left: 1rem;
                margin-right: 1rem;
            }
            .-mt-1 {
                margin-top: -0.25rem;
            }
            .-mt-6 {
                margin-top: -1.5rem;
            }
            .-my-1 {
                margin-top: -0.25rem;
                margin-bottom: -0.25rem;
            }

            .py-2 {
                padding-top: 0.5rem;
                padding-bottom: 0.5rem;
            }
            .py-4 {
                padding-top: 1rem;
                padding-bottom: 1rem;
            }
            .px-2 {
                padding-left: 0.5rem;
                padding-right: 0.5rem;
            }
            .px-4 {
                padding-left: 1rem;
                padding-right: 1rem;
            }


            .p-0 {
                margin: 0px;
            }
            .p-4 {
                padding: 1rem;
            }
            .pt-1 {
                padding-top: 0.25rem;
            }
            .pt-2 {
                padding-top: 0.5rem;
            }
            .pt-3 {
                padding-top: 0.75rem;
            }
            .pt-4 {
                padding-top: 1rem;
            }
            .pb-1 {
                padding-bottom: 0.25rem;
            }
            .pb-2 {
                padding-bottom: 0.5rem;
            }
            .pb-3 {
                padding-bottom: 0.75rem;
            }
            .pb-4 {
                padding-bottom: 1rem;
            }
            .pb-5 {
                padding-bottom: 1.25rem;
            }
            .pb-6 {
                padding-bottom: 1.5rem;
            }

            .w-100 {
                width: 100%;
            }

            .h-24 {
                height: 6rem;
            }

            .left {
                float: left;
            }
            .right {
                float: right;
            }

            .flex {
                display: flex;
            }
            .border-t,
            .border-t-2,
            .border-b,
            .border-b-2,
            .border-l
            {
                border-width: 0;
                border-style: solid;
                border-color: #e2e8f0;
            }
            .border-l {
                border-left-width: 1px;
            }
            .border-r {
                border-right-width: 1px;
            }
            .border-t {
                border-top-width: 1px;
            }
            .border-t-2 {
                border-top-width: 2px;
            }
            .border-t-3 {
                border-top-width: 3px;
            }
            .border-b {
                border-bottom-width: 1px;
            }
            .border-b-2 {
                border-bottom-width: 2px;
            }
            .border-b-3 {
                border-bottom-width: 3px;
            }

            .opacity-25 {
                opacity: 0.25;
            }

            .list-decimal {
                list-style-type: decimal;
            }
            .hidden {
                display: none !important;
            }
        </style>
    </head>
    <body style="background-color: #ffffff !important; font-family: sans-serif;">

        <div class="header">
            <div style="margin: 30px 40px 20px 40px;">
                <table border="0" class="border-b-2">
                    <tr>
                        <td>
                            @if ($orderItem->order->customer->cus_logo_use == 'customerSys')
                                <img src="{{ asset('/app/images/icons/icon.teraLogoTexto.png') }}" style="max-height: 150px; max-width: 300px;" />
                            @elseif ($orderItem->order->customer->cus_logo_use == 'customer')
                                <img src="{{ base_path().'/storage/app/public/'.$orderItem->order->customer->cus_logo }}" style="max-height: 150px; max-width: 300px;" />
                            @else
                                {{--  --}}
                            @endif
                        </td>
                        <td class="text-right">
                            <div class="text-xs">Data</div>
                            <div class="text-lg">{{ $orderItem->ConclusionReport->updated_at->format('d/m/Y') }}</div>
                        </td>
                    </tr>
                </table>
                <table border="0" class="border-b mt-2">
                    <tr>
                        <td width="50%">
                            <div class="text-xs">Nome</div>
                            <div class="text-lg -mt-1 p-0 uppercase">{{ $orderItem->order->pat_name ?? '--' }}</div>
                        </td>
                        <td>
                            <div class="text-xs">Gênero</div>
                            <div class="text-lg -mt-1 p-0 uppercase">{{ $orderItem->order->pat_genre }}</div>
                        <td>
                            <div class="text-xs">Data de nascimento</div>
                            <div class="text-lg p-0">{{ $orderItem->order->pat_date_birth->format('d/m/Y') }} - {{ $orderItem->order->pat_date_birth->age }} anos</div>
                        </td>
                        </td>
                    </tr>
                </table>
                <table border="0" class="border-b mt-1 mb-2 pb-1">
                    <tr>
                        <td width="50%">
                            <div class="text-xs">{{ strtoupper($orderItem->order->pat_doc_type ?? 'DOC. NÚMERO') }}</div>
                            <div class="text-lg p-0 uppercase">
                                {{ $orderItem->order->pat_doc_num ?? '--' }}
                            </div>
                        </td>
                        <td width="50%">
                        <div class="text-xs capitalize">Identidade {{ strtoupper($orderItem->order->pat_identity_emitting ?? NULL) }}</div>
                            <div class="text-lg p-0 uppercase">
                                {{ $orderItem->order->pat_identity_num ?? '--' }}
                            </div>
                        </td>
                    </tr>
                </table>
                @if($orderItem->order->pat_work_company || $orderItem->order->pat_work_position)
                <table border="0" class="border-b mt-1 mb-2 pb-1">
                    <tr>
                        <!--  -->
                        @if($orderItem->order->pat_work_company)
                        <td width="50%">
                            <div class="text-xs">Empresa</div>
                            <div class="text-lg p-0 uppercase">
                                {{ $orderItem->order->pat_work_company }}
                            </div>
                        </td>
                        @endif
                        <!--  -->
                        @if($orderItem->order->pat_work_position)
                        <td width="50%">
                            <div class="text-xs">Função</div>
                            <div class="text-lg p-0 uppercase">
                                {{ $orderItem->order->pat_work_position }}
                            </div>
                        </td>
                        @endif
                        <!--  -->
                    </tr>
                </table>
                @endif
                <!--  -->
                <table border="0" class="border-b-2 mt-1 mb-2 pb-1">
                    <tr>
                        <td>
                            <div class="text-xs">Data exame / Indicação</div>
                            <div class="text-lg p-0">
                                <p class="m-0 p-0 uppercase truncate">
                                    <span>{{ $orderItem->item_run_datetime ? $orderItem->item_run_datetime->format('d/m/Y') : '--/--/----' }}</span>
                                    <span>{{ $orderItem->order->order_description ?? 'Indicação não informada' }}</span>
                                    @if (false && $orderItem->item_comments ?? false)
                                    <span>({{ $orderItem->item_comments ?? ' ' }})</span>
                                    @endif
                                </p>
                            </div>
                        </td>
                    </tr>
                </table>
                <table border="0">
                    <tr>
                        <td class="text-center">
                            <h1 class="mt-5 uppercase">
                                {{ $orderItem->Service->service_name }}
                                @if($orderItem->serviceVariation ?? false)
                                     - {{ $orderItem->serviceVariation->variation_name }}
                                @endif
                            </h1>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        {{--  --}}
        <div class="main">
            <div class="">
                {!!html_entity_decode($orderItem->ConclusionReport->report_results)!!}
            </div>
            {{--  --}}
            <table border="0" class="border-t-2 mt-6 pt-2">
                <tr>
                    <td class="text-right mx-2 px-2" width="50%">
                        <div class="text-xl font-semibold p-0">
                            @if (in_array($orderItem->ConclusionProvider->pvd_genre ,['M','Masculino']))
                                <!-- <span>Dr.</span> -->
                                {{ $orderItem->ConclusionProvider->user->name }}
                            @else
                                <!-- <span>Dra.</span> -->
                                {{ $orderItem->ConclusionProvider->user->name }}
                            @endif
                        </div>
                        @if ($orderItem->ConclusionProvider->specialty->ref_description)
                            <div class="text-md p-0">
                                <span class="capitalize">
                                    {{ $orderItem->ConclusionProvider->specialty->ref_description }}
                                </span>
                            </div>
                        @endif
                        <div class="text-xs p-0">
                            <span class="uppercase">
                                {{ $orderItem->ConclusionProvider->pvd_identity_type }} - {{ $orderItem->ConclusionProvider->pvd_identity_uf }} / {{ $orderItem->ConclusionProvider->pvd_identity_num }}
                            </span>
                        </div>
                    </td>
                    <td class="text-left mx-2 px-2 text-left border-l" width="50%">
                        <div class="">
                            <img src="{{ base_path().'/storage/app/public/'.$orderItem->ConclusionProvider->pvd_signature }}" style="max-height: 100px;" />
                        </div>
                    </td>
                </tr>
            </table>
            {{--  --}}
            <div class="w-100 border-t-2 mt-2 pt-2 mb-6">
                <div class="">
                    <div class="text-xs pt-2 font-semibold uppercase">
                        Importante
                    </div>
                    <div class="text-xs m-0 p-0">
                        Este é um exame complementar, e como tal deve ser analisado em conjunto com os dados clínicos do paciente e não isoladamente.
                    </div>
                </div>
            </div>
        </div>
        {{--  --}}
        <div class="footer w-100">

            <div class="border-t-2">
                <table border="0" class="w-100">
                    <tr>
                        <td class="text-center uppercase">
                            <h4>{{ $orderItem->order->customer->cus_name }}</h4>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            {{ $orderItem->order->customer->cus_street }} {{ $orderItem->order->customer->cus_street_num }} {{ $orderItem->order->customer->cus_street_complement?" - ".$orderItem->order->customer->cus_street_complement:null }} - {{ $orderItem->order->customer->cus_neighborhood }} - {{ $orderItem->order->customer->cus_city }} / {{ $orderItem->order->customer->cus_state }}
                        </td>
                    </tr>
                </table>
            </div>
            {{-- <div class="border-t-2 text-gray-500">
                <div class="text-center text-xs mt-4 p-0">
                    <br>{{ $orderItem->order->order_num.'-'.$orderItem->item_num.'-P'.$orderItem->order->patient_id.'O'.$orderItem->order->id.'I'.$orderItem->id.'R'.$orderItem->ConclusionReport->id}}
                </div>
            </div> --}}
        </div>

        <script>
            document.title = "{{ $orderItem->order->pat_name }} - {{ $orderItem->Service->service_name }} - {{ $orderItem->ConclusionReport->updated_at->format('d-m-Y') }} - {{ 'P'.$orderItem->order->patient_id.'O'.$orderItem->order->id.'I'.$orderItem->id.'R'.$orderItem->ConclusionReport->id }}"
        </script>

    </body>
</html>
