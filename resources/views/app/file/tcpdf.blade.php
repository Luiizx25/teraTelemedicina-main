<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TCPDF</title>
    <style>
        html {
            background-color: #ffffff !important;
            font-family: 'sans-serif';
        }
        body {
            font-family: 'sans-serif',inherit;
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
            margin: 0px 40px 0px 40px;
        }
        .footer {
            position: fixed;
            bottom: 0;
            padding: 0px 0px 0px 0px;
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
            font-size: 8px;
        }
        .text-sm {
            font-size: 0.875rem;
        }
        .text-base {
            font-size: 10px;
        }
        .text-lg {
            font-size: 1.125rem;
        }
        .text-xl {
            font-size: 12px;
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
            margin-left: 8px;
            margin-right: 8px;
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

        .p--1 {
            padding-top: -8px;
        }
        .p--2 {
            padding-top: -16px;
        }
        .p--3 {
            padding-top: -32px;
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
            padding-bottom: 4px;
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
            height: 80px;
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
<body style="font-family: sans-serif;">
        <div class="header">
            <div style="margin: 0px 40px 20px 40px;">
                <table border="0" class="border-b">
                    <tr>
                        <td>
                            <div>
                                @empty($orderItem->order->customer->cus_logo_use)
                                    <img src="{{ asset('/app/images/icons/icon.teraLogoTexto.png') }}" style="max-height: 150px;" />
                                @else
                                    @if ($orderItem->order->customer->cus_logo_use)
                                        <img src="{{ asset("/storage/{$orderItem->order->customer->cus_logo}") }}" style="max-height: 150px;" />
                                    @endif
                                @endempty
                            </div>
                        </td>
                        <td class="text-right">
                            <div class="text-xs">Data</div>
                            <span class="text-base">{{ $orderItem->ConclusionReport->updated_at->format('d/m/Y') }}</div>
                        </td>
                    </tr>
                </table>
                <table border="0" class="border-b mt-1 mb-2 pb-1 p--1">
                    <tr>
                        <td width="45%">
                            <div class="text-xs">Nome</div>
                            <span class="text-base capitalize">{{ strtolower($orderItem->order->pat_name ?? '--') }}</span>
                        </td>
                        <td width="25%">
                            <div class="text-xs">Gênero</div>
                            <span class="text-base p-0 capitalize">{{ strtolower($orderItem->order->pat_genre) }}</span>
                        </td>
                        <td width="40%">
                            <div class="text-xs">Data de nascimento</div>
                            <span class="text-base p-0">{{ $orderItem->order->pat_date_birth->format('d/m/Y') }} - {{ $orderItem->order->pat_date_birth->age }} anos</span>
                        </td>
                    </tr>
                </table>
                <table border="0" class="border-b mt-1 mb-2 pb-1 p--1">
                    <tr>
                        <td width="45%">
                            <div class="text-xs">{{strtoupper($orderItem->order->pat_doc_type ?? 'DOC. NÚMERO')}}</div>
                            <span class="text-base p-0 capitalize">{{$orderItem->order->pat_doc_num??'--'}}</span>
                        </td>
                        <td width="55%">
                            <div class="text-xs">IDENTIDADE {{strtoupper($orderItem->order->pat_identity_emitting ?? NULL)}}</div>
                            <span class="text-base p-0 capitalize">{{$orderItem->order->pat_identity_num??'--'}}</span>
                        </td>
                    </tr>
                </table>
                @if($orderItem->order->pat_work_company || $orderItem->order->pat_work_position)
                <table border="0" class="border-b mt-1 mb-2 pb-1 p--1">
                    <tr>
                        <!--  -->
                        @if($orderItem->order->pat_work_company)
                        <td width="45%">
                            <div class="text-xs">Empresa</div>
                            <span class="text-base p-0 capitalize">{{strtolower($orderItem->order->pat_work_company)}}</span>
                        </td>
                        @endif
                        <!--  -->
                        @if($orderItem->order->pat_work_position)
                        <td width="55%">
                            <div class="text-xs">Função</div>
                            <span class="text-base p-0 capitalize">{{strtolower($orderItem->order->pat_work_position)}}</span>
                        </td>
                        @endif
                        <!--  -->
                    </tr>
                </table>

                @endif
                
                <table border="0" class="border-b mt-1 mb-2 pb-1 p--1">
                    <tr>
                        <td>
                            <div class="text-xs">Data exame / Indicação</div>
                            <span class="m-0 p-0 capitalize truncate">{{$orderItem->item_run_datetime ?$orderItem->item_run_datetime->format('d/m/Y'):'--/--/----'}} - {{$orderItem->order->order_description??'Indicação não informada.'}}</span>
                        </td>
                    </tr>
                </table>

	    <!-- Data do Exame -->
     <table border="0" class="border-b mt-1 mb-2 pb-1 p--1">
                    <tr>
                        <td>
                            <div class="text-xs"> Data exame </div>
                            <span class="m-0 p-0 capitalize truncate">{{$orderItem->item_run_datetime ?$orderItem->item_run_datetime->format('d/m/Y'):'--/--/----'}}</span>
                        </td>
                    </tr>
                </table>
               
                
                    <!-- Indicação -->
                <table border="0" class="border-b mt-1 mb-2 pb-1 p--1">
                    <tr>
                        <td>
                            <div class="text-xs"> Indicação </div>
                            <span class="m-0 p-0 capitalize truncate">{{$orderItem->order->order_description??'---'}}</span>
                        </td>
                    </tr>
                </table>

                <table border="0" class="border-b mb-2 pb-1 p--2">
                    <tr>
                        <td class="text-center">
                            <h1>{{$orderItem->Service->service_name}}</h1>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        {{--  --}}
        <div class="main">
            <table border="0" class="p--3">
                <tr>
                    <td>{!!html_entity_decode($orderItem->ConclusionReport->report_results)!!}</td>
                </tr>
            </table>
            {{--  <div class="">{!!html_entity_decode($orderItem->ConclusionReport->report_results)!!}</div>  --}}
            {{--  --}}
            <table border="0" class="border-t-2">
                <tr>
                    <td class="text-right mx-2 px-2" width="50%">
                        <div class="text-xl font-semibold p-0">
                            @if (in_array($orderItem->ConclusionProvider->pvd_genre ,['M','Masculino']))
                                <span>Dr.</span> {{ $orderItem->ConclusionProvider->user->name }}
                            @else
                                <span>Dra.</span> {{ $orderItem->ConclusionProvider->user->name }}
                            @endif
                        </div>
                        @if ($orderItem->ConclusionProvider->specialty->ref_description)
                            <span class="text-md p-0 capitalize">{{ $orderItem->ConclusionProvider->specialty->ref_description }}</span><br>
                        @endif
                        <span class="text-xs p-0 uppercase">{{ $orderItem->ConclusionProvider->pvd_identity_type }} - {{ $orderItem->ConclusionProvider->pvd_identity_uf }} / {{ $orderItem->ConclusionProvider->pvd_identity_num }}</span>
                    </td>
                    <td class="text-left mx-2 px-2 text-left border-l" width="50%">
                        <div class="">
                            <img src="{{ asset( "/storage/{$orderItem->ConclusionProvider->pvd_signature}") }}" class="h-24 w-28" />
                        </div>
                    </td>
                </tr>
            </table>
            {{--  --}}
            <div class="w-100 border-t-2 mt-2 pt-2">
                <div class="">
                    <div class="text-xs pt-2 font-semibold uppercase">Importante</div>
                    <span class="text-xs m-0 p-0">Este é um exame complementar, e como tal deve ser analisado em conjunto com os dados clínicos do paciente e não isoladamente.</span>
                </div>
            </div>
        </div>
        {{--  --}}
        <div class="footer w-100 p--3">

            <div class="border-t-2 text-gray-500">
                <table border="0" class="w-100">
                    <tr>
                        <td class="text-center uppercase p--1">
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
            <div class="border-t-2 text-gray-500 p--1">
                <div class="text-center text-xs mt-4 p-0">
                    <br>{{ $orderItem->order->order_num.'-'.$orderItem->item_num.'-P'.$orderItem->order->patient_id.'O'.$orderItem->order->id.'I'.$orderItem->id.'R'.$orderItem->ConclusionReport->id}}
                    <br>Identificador: {{$chave}}
                    <br><img src="{{asset('dist/images/validado.png')}}" width="100px" height="25px">
                </div>
            </div>
        </div>
</body>
</html>