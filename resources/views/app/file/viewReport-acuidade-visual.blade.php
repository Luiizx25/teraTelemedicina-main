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
                margin: 1cm 0cm 0cm 0cm;
                padding: 4cm 0cm 1cm 0cm;
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
                width: 800px;
            }
            blockquote, dl, dd, h1, h2, h3, h4, h5, h6, hr, figure, p, pre, span {
                margin: 0;
            }
            img, svg, video, canvas, audio, iframe, embed, object {
                display: block;
                vertical-align: middle;
            }
            .header {
                padding: 0px 0px 0px 0px;
            }
            .main {
                padding: 0px 0px 0px 0px;
            }
            .footer {
                position: fixed;
                bottom: 0;
                padding: 0px 0px 0px 0px;
            }
            .border {
                border: 2px solid #000;
            }
            .border-r {
                border-right: 2px solid #000;
            }
            .border-b {
                border-bottom: 2px solid #000;
            }
            .capitalize {
                text-transform: capitalize;
            }
            .uppercase {
                text-transform: uppercase;
            }
            .bold {
                font-weight: bold;
            }
            * {
                font-size: x-small;
                font-size: small;
            }
            .text-lg {
                font-size: large;
            }
            .text-base {
                font-size: medium;
            }
            .text-xs {
                font-size: x-small;
            }
            .ml-10{
                margin-left: 10px;
            }
        </style>
    </head>
    <body style="background-color: #ffffff !important; width:100%;">
        <div class="main" style="padding: 0 15px; width:100%; text-align: center;">

            <table class="border" cellspacing="0px" cellpadding="0px" style="width:1200px;">
                <tr>
                    <td valign="middle" width="50%" class="border-b" style="padding: 5px; text-align: left;">
                        @if ($orderItem->order->customer->cus_logo_use == 'customerSys')
                            <img src="{{ asset('/app/images/icons/icon.teraLogoTexto.png') }}" class="ml-10" style="max-height: 150px; max-width: 300px;" />
                        @elseif ($orderItem->order->customer->cus_logo_use == 'customer')
                            <img src="{{ base_path().'/storage/app/public/'.$orderItem->order->customer->cus_logo }}" class="ml-10" style="max-height: 150px; max-width: 300px;" />
                        @else
                            {{--  --}}
                        @endif
                    </td>
                    <td valign="middle" width="50%" class="border-b" style="padding: 15px; text-align: right;">
                        <span class="text-base bold">
                            ACUIDADE VISUAL
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="border-b border-r" valign="middle" width="70%" style="padding: 5px; text-align: left;">
                        NOME: <span class="uppercase bold">{{ $orderItem->order->pat_name ?? '--' }}</span>
                    </td>
                    <td class="border-b" valign="middle" width="30%" style="padding: 5px;">
                        {{ $orderItem->order->pat_doc_type ?? 'DOC. N??MERO' }}:
                        <span class="bold">{{ $orderItem->order->pat_doc_num ?? '--' }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="border-b border-r" valign="middle" width="70%" style="padding: 5px; text-align: left;">
                        EMPRESA: <span class="bold uppercase">{{ $orderItem->order->pat_work_company }}</span>
                    </td>
                    <td class="border-b" valign="middle" width="30%" style="padding: 5px;">
                        DATA: <span class="bold">{{ $orderItem->ConclusionReport->updated_at->format('d/m/Y') }}</span>
                    </td>
                </tr>
                <tr>
                    <td valign="middle" width="100%" class="border-b" style="padding: 5px; text-align: left;" colspan="2">
                        @if($orderItem->order->pat_work_position)
                            FUN????O: <span class="bold uppercase">{{ $orderItem->order->pat_work_position }}</span>
                        @endif
                        INDICA????O: <span class="bold uppercase">{{ $orderItem->order->order_description ?? 'Indica????o n??o informada.' }}</span>&nbsp;
                    </td>
                </tr>

                {{-- LAUDO --}}
                {{-- PROCESSA SERIAL --}}
                @php
                    if($orderItem->item_fields != '{}')
                    $fields = unserialize($orderItem->item_fields);
                    else
                    $fields = false;
                    //
                    if($fields)
                    {
                        foreach ($fields as $key => $value) {
                            $fields[$key] = $value ? $value : 'X';
                        }
                    }
                @endphp
                {{-- PROCESSA SERIAL - FIM --}}
                <tr>
                    <td valign="middle" width="50%" style="padding: 15px; text-align: center; border-right: 2px solid #000;">
                        <p style="font-weight: bold;">OLHO ESQUERDO</p>
                    </td>
                    <td valign="middle" width="50%" style="padding: 15px; text-align: center;">
                        <p style="font-weight: bold;">OLHO DIREITO</p>
                    </td>
                </tr>
                <tr>
                    <td valign="middle" style="text-align: center; border-right: 2px solid #000; width:600px">
                        <table style="padding: 5px; text-align: center; width:100%">
                            @foreach (range(1,11) as $n)
                                <tr style="border-bottom: 2px solid #000">
                                    <td width="5%"></td>
                                    <td style="border-top: 0.5px solid #a8a8a8" class=""><img src="{{ base_path().'/public/app/images/exames/tera-acuidade-visual-tabela-de-snellen-'.$n.'.png' }}" /></td>
                                    <td style="border-top: 0.5px solid #a8a8a8" class="text-center">
                                        <h2 style="font-weight: 600; font-family: Arial, Helvetica, sans-serif 'sans-serif',inherit;">
                                            @isset($fields['OE-N'.$n])
                                                (X)
                                            @endisset
                                        </h2>
                                    </td>
                                    <td width="5%"></td>
                                </tr>
                            @endforeach
                        </table>
                    </td>
                    <td valign="middle" style="text-align: center; border-left: 2px solid #000; width:600px">
                        <table style="padding: 5px; text-align: center; width:100%">
                            @foreach (range(1,11) as $n)
                                <tr>
                                    <td width="5%"></td>
                                    <td style="border-top: 0.5px solid #a8a8a8" class=""><img src="{{ base_path().'/public/app/images/exames/tera-acuidade-visual-tabela-de-snellen-'.$n.'.png' }}" /></td>
                                    <td style="border-top: 0.5px solid #a8a8a8" class="text-center px-4 py-6">
                                        <h2 style="font-weight: 600;">
                                            @isset($fields['OD-N'.$n])
                                                (X)
                                            @endisset
                                        </h2>
                                    </td>
                                    <td width="5%"></td>
                                </tr>
                                @endforeach
                        </table>
                    </td>
                </tr>
                <tr>
                    <td valign="middle" width="100%" style="text-align: left; padding:10px 10px; border-top: 2px solid #000; border-bottom: 2px solid #000;" colspan="2">
                        <span>{{__('Paciente faz uso de corre????o?')}}</span>
                        <span class="bold">
                            @isset($fields['correcao'])
                                {{ $fields['correcao'] }}
                            @else
                                --
                            @endisset
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="border-b" valign="middle" width="100%" style="text-align: left; padding:10px 10px;" colspan="2">
                        {!!html_entity_decode($orderItem->ConclusionReport->report_results)!!}
                    </td>
                </tr>
                <tr>
                    <td valign="middle" width="50%" style="text-align: right; padding: 10px 2px;">
                        <div class="text-lg font-semibold p-0">
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
                        <div class="text-xs p-0 uppercase">
                            {{ $orderItem->ConclusionProvider->pvd_identity_type }} - {{ $orderItem->ConclusionProvider->pvd_identity_uf }} {{ $orderItem->ConclusionProvider->pvd_identity_num }}
                        </div>
                    </td>
                    <td valign="middle" width="50%" style="text-align: left; padding: 10px 0px;">
                        <img src="{{ base_path().'/storage/app/public/'.$orderItem->ConclusionProvider->pvd_signature }}" style="max-height: 100px;" />
                    </td>
                </tr>
            </table>

            {{-- N??O REMOVER - MANTER PRA AJUSTE DE TELA --}}
            <table class="mb-2" cellspacing="0px" cellpadding="0px">
                <tr>
                    <td class="p-2 text-xs" valign="top" colspan="4">
                        <table class="table-data" cellspacing="0px" cellpadding="0px">
                            <tr>
                                <td class="border-none" valign="middle" style="padding: 15px 0; text-align: right;">
                                </td>
                                <td class="border-none" valign="middle" style="padding:0 15px; text-align: left;">
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            {{-- N??O REMOVER - MANTER PRA AJUSTE DE TELA --}}
        </div>
        <script>
            document.title = "{{ $orderItem->order->pat_name }} - {{ $orderItem->Service->service_name }} - {{ $orderItem->ConclusionReport->updated_at->format('d-m-Y') }} - {{ 'P'.$orderItem->order->patient_id.'O'.$orderItem->order->id.'I'.$orderItem->id.'R'.$orderItem->ConclusionReport->id }}"
        </script>

    </body>
</html>
