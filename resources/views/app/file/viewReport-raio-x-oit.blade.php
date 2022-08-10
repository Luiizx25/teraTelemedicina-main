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
                margin: 0.5cm 0cm 0cm 0cm;
                padding: 0cm 0cm 0cm 0cm;
                /* header: page-header; */
                /* footer: page-footer; */
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
                padding: -5px 20px 0px 20px;
            }
            .footer {
                position: fixed;
                bottom: 0;
                padding: 5px 0px 5px 0px;
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
            .text-xxs {
                font-size: 0.50rem;
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
            .grid {
                display: grid;
            }
            .m-0 {
                margin: 0px;
            }
            .m-1 {
                margin: 0.25rem;
            }
            .m-2 {
                margin: 0.5rem;
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
                padding: 0px;
            }
            .p-1 {
                padding: 0.25rem;
            }
            .p-2 {
                padding: 0.50rem;
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
            .border {
                border: 2px solid #000;
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
            .border-b-000 {
                border-bottom: 2px solid #000
            }
            .border-r-000 {
                border-right: 2px solid #000
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
            .inline-block {
                display: inline-block;
            }
            .bg-gray {
                background-color: rgb(170, 170, 170);
            }
            table.table-div tr {
                border: 2px solid #000;
            }
            table.table-div td {
                border: 2px solid #000;
            }
            table.table-data tbody,
            table.table-data tr {
                border: 2px solid #000;
            }
            table.table-data td {
                border: 2px solid #000;
            }
            td.border-none,
            table.table-data td.border-none {
                border: 1px solid #fff;
            }
            td.border-t-none {
                border-top: none !important;
                border-top: 1px solid #fff !important;
            }
            td.border-b-none {
                border-bottom: none !important;
                border-bottom: 1px solid #fff !important;
            }
            .capitalize {
                text-transform: capitalize;
            }
            .bold {
                font-weight: bold;
            }
            * {
                font-size: x-small;
            }
            .text-lg {
                font-size: large;
            }
            .text-base {
                font-size: medium;
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
                    <td valign="middle" width="30%" class="border-b-000" style="padding: 5px; text-align: left;" colspan="2">
                        @if ($orderItem->order->customer->cus_logo_use == 'customerSys')
                            <img src="{{ asset('/app/images/icons/icon.teraLogoTexto.png') }}" class="ml-10" style="max-height: 150px; max-width: 300px;" />
                        @elseif ($orderItem->order->customer->cus_logo_use == 'customer')
                            <img src="{{ base_path().'/storage/app/public/'.$orderItem->order->customer->cus_logo }}" class="ml-10" style="max-height: 150px; max-width: 300px;" />
                        @else
                            {{--  --}}
                        @endif
                    </td>
                    <td valign="middle" width="70%" class="border-b-000" style="padding: 15px; text-align: right;" colspan="2">
                        <span class="text-base bold">
                            FOLHA DE LEITURA RADIOLÓGICA CLASSIFICAÇÃO INTERNACIONAL DE RADIOGRAFIAS DE PNEUMOCONIOSE – OIT
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="border-r-000 border-b-000" valign="middle" width="70%" style="padding: 5px; text-align: left;" colspan="2">
                        NOME: <span class="uppercase bold">{{ $orderItem->order->pat_name ?? '--' }}</span>
                    </td>
                    <td class="border-b-000" valign="middle" width="30%" style="padding: 5px;" colspan="2">
                        {{ $orderItem->order->pat_doc_type ?? 'DOC. NÚMERO' }}:
                        <span class="bold">{{ $orderItem->order->pat_doc_num ?? '--' }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="border-b-000 border-r-000" valign="middle" width="70%" style="padding: 5px; text-align: left;" colspan="2">
                        EMPRESA: <span class="bold uppercase">{{ $orderItem->order->pat_work_company }}</span>
                    </td>
                    <td class="border-b-000" valign="middle" width="30%" style="padding: 5px;" colspan="2">
                        DATA: <span class="bold uppercase">{{ $orderItem->ConclusionReport->updated_at->format('d/m/Y') }}</span>
                    </td>
                </tr>
                <tr>
                    <td valign="middle" width="100%" class="border-b-000" style="padding: 5px; text-align: left;" colspan="4">
                        @if($orderItem->order->pat_work_position)
                            FUNÇÃO: <span class="bold uppercase">{{ $orderItem->order->pat_work_position }}</span>
                        @endif
                        INDICAÇÃO: <span class="bold uppercase">{{ $orderItem->order->order_description ?? 'Indicação não informada.' }}</span>&nbsp;
                    </td>
                </tr>
                {{-- LAUDO --}}
                {{-- PROCESSA SERIAL --}}
                @php
                    $reportResults = unserialize($orderItem->conclusionReport->report_results);
                @endphp
                {{-- PROCESSA SERIAL - FIM --}}
                <tr>
                    <td class="p-2 text-xs border-b-000 border-r-000" valign="top" width="25%">
                        LEITOR: <span class="font-semibold">{{ $orderItem->ConclusionProvider->user->name }}</span>
                    </td>
                    <td class="p-2 text-xs border-b-000 border-r-000" valign="top" width="25%">
                        RX DIGITAL?
                        @if ($reportResults['rx_digital'] == 'SIM')
                            <span class="font-semibold mx-2">SIM</span>
                        @else
                            <span class="font-semibold mx-2">NÃO</span>
                        @endif
                    </td>
                    <td class="p-2 text-xs border-b-000" valign="top" width="50%" colspan="2">
                        LEITURA EM NEGATOSCÓPIO?
                        @if ($reportResults['negatoscopio'] == 'SIM')
                            <span class="font-semibold mx-2">SIM</span>
                        @else
                            <span class="font-semibold mx-2">NÃO</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="p-2 text-xs border-b-000 border-r-000" valign="top" width="50%" colspan="2">
                        <div>
                            <span class="font-semibold">1A</span> - QUALIDADE TÉCNICA?
                            @foreach (range(1,4) as $item)
                                @if ($reportResults['1a'] == $item)
                                    <span>[<span class="bg-gray font-semibold">{{$item}}</span>]</span>
                                @else
                                    <span>[{{$item}}]</span>
                                @endif
                            @endforeach
                        </div>
                        <div class="pt-1">
                            Comentário: <span class="font-semibold">{{$reportResults['1a_comentario'] ?? null}}</span>
                            {{-- <span class="font-semibold">{{$reportResults['1a_comentario'] ?? null}}</span><span class="font-semibold">{{$reportResults['1a_comentario'] ?? null}}</span><span class="font-semibold">{{$reportResults['1a_comentario'] ?? null}}</span><span class="font-semibold">{{$reportResults['1a_comentario'] ?? null}}</span><span class="font-semibold">{{$reportResults['1a_comentario'] ?? null}}</span><span class="font-semibold">{{$reportResults['1a_comentario'] ?? null}}</span><span class="font-semibold">{{$reportResults['1a_comentario'] ?? null}}</span><span class="font-semibold">{{$reportResults['1a_comentario'] ?? null}}</span><span class="font-semibold">{{$reportResults['1a_comentario'] ?? null}}</span> --}}
                        </div>
                    </td>
                    <td class="p-2 text-xs border-b-000" valign="top" width="50%" colspan="2">
                        <span class="font-semibold">1B</span> - RADIOGRAFIA NORMAL?
                        @if ($reportResults['1b'] == 'SIM')
                            <span class="font-semibold mx-2">SIM</span> (finalizar a leitura)
                        @else
                            <span class="font-semibold mx-2">NÃO</span> (passe para a seção 2)
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="p-2 text-xs border-b-000" valign="top" colspan="4">
                        <span class="font-semibold">2A</span> - ALGUMA ANORMALIDADE PLEURAL CONSISTENTE COM PNEUMOCONIOSE?
                        @if ($reportResults['2a'] == 'SIM')
                            <span class="font-semibold mx-2">SIM</span> (complete 2B e 2C)
                        @else
                            <span class="font-semibold mx-2">NÃO</span> (Passe para seção 3)
                        @endif

                    </td>
                </tr>
                <tr>
                    <td class="p-2 text-xs border-b-000 border-r-000" valign="top" width="50%" colspan="2">
                        <span class="font-semibold">2B</span> - PEQUENAS OPACIDADES:
                        <div class="pt-1">
                            <table class="table-data mt-2" style="margin-top: 5px; width: 100%;" cellspacing="0px" cellpadding="0px">
                                <tbody>
                                    <tr>
                                        <td class="p-1 text-center text-xs" style="width: 46%;" colspan="4">A) FORMA TAMANHO</td>
                                        <td class="p-1 text-center" style="width: 2%;" rowspan="5">&nbsp;</td>
                                        <td class="p-1 text-center text-xs" style="width: 20%;" colspan="2">B) ZONAS</td>
                                        <td class="p-1 text-center" style="width: 2%;" rowspan="5">&nbsp;</td>
                                        <td class="p-1 text-center text-xs" style="width: 30%;" colspan="3">C) PROFUSAO</td>
                                    </tr>
                                    <tr>
                                        <td class="p-1 text-center text-xs" style="width: 16%;" colspan="2">Prim&aacute;ria</td>
                                        <td class="p-1 text-center text-xs" style="width: 16%;" colspan="2">Secund&aacute;ria</td>
                                        <td class="p-1 text-center align-top">D</td>
                                        <td class="p-1 text-center align-top">E</td>
                                        <td class="p-1 text-center align-top">0/-</td>
                                        <td class="p-1 text-center align-top">0/0</td>
                                        <td class="p-1 text-center align-top">0/1</td>
                                    </tr>
                                    <tr>
                                        <td class="p-1 text-center align-top">
                                            @if ($reportResults['2b']['ftp']['p'] ?? false)
                                                <p class="px-1 bg-gray font-semibold">p</p>
                                            @else
                                                <p class="px-1">p</p>
                                            @endif
                                        </td>
                                        <td class="p-1 text-center align-top">
                                            @if ($reportResults['2b']['ftp']['s'] ?? false)
                                                <p class="px-1 bg-gray font-semibold">s</p>
                                            @else
                                                <p class="px-1">s</p>
                                            @endif
                                        </td>
                                        <td class="p-1 text-center align-top">
                                            @if ($reportResults['2b']['fts']['p'] ?? false)
                                                <p class="px-1 bg-gray font-semibold">p</p>
                                            @else
                                                <p class="px-1">p</p>
                                            @endif
                                        </td>
                                        <td class="p-1 text-center align-top">
                                            @if ($reportResults['2b']['fts']['s'] ?? false)
                                                <p class="px-1 bg-gray font-semibold">s</p>
                                            @else
                                                <p class="px-1">s</p>
                                            @endif
                                        </td>
                                        <td class="p-1 text-center align-top">
                                            @if ($reportResults['2b']['zd']['superior'] ?? false)
                                                <p class="px-1 bg-gray font-semibold">Superior</p>
                                            @else
                                                <p class="px-1">Superior</p>
                                            @endif
                                        </td>
                                        <td class="p-1 text-center align-top">
                                            @if ($reportResults['2b']['ze']['superior'] ?? false)
                                                <p class="px-1 bg-gray font-semibold">Superior</p>
                                            @else
                                                <p class="px-1">Superior</p>
                                            @endif
                                        </td>
                                        <td class="p-1 text-center align-top">
                                            @if ($reportResults['2b']['p']['10'] ?? false)
                                                <p class="px-1 bg-gray font-semibold">1/0</p>
                                            @else
                                                <p class="px-1">1/0</p>
                                            @endif
                                        </td>
                                        <td class="p-1 text-center align-top">
                                            @if ($reportResults['2b']['p']['11'] ?? false)
                                                <p class="px-1 bg-gray font-semibold">1/1</p>
                                            @else
                                                <p class="px-1">1/1</p>
                                            @endif
                                        </td>
                                        <td class="p-1 text-center align-top">
                                            @if ($reportResults['2b']['p']['12'] ?? false)
                                                <p class="px-1 bg-gray font-semibold">1/2</p>
                                            @else
                                                <p class="px-1">1/2</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-1 text-center align-top">
                                            @if ($reportResults['2b']['ftp']['q'] ?? false)
                                                <p class="px-1 bg-gray font-semibold">q</p>
                                            @else
                                                <p class="px-1">q</p>
                                            @endif
                                        </td>
                                        <td class="p-1 text-center align-top">
                                            @if ($reportResults['2b']['ftp']['t'] ?? false)
                                                <p class="px-1 bg-gray font-semibold">t</p>
                                            @else
                                                <p class="px-1">t</p>
                                            @endif
                                        </td>
                                        <td class="p-1 text-center align-top">
                                            @if ($reportResults['2b']['fts']['q'] ?? false)
                                                <p class="px-1 bg-gray font-semibold">q</p>
                                            @else
                                                <p class="px-1">q</p>
                                            @endif
                                        </td>
                                        <td class="p-1 text-center align-top">
                                            @if ($reportResults['2b']['fts']['t'] ?? false)
                                                <p class="px-1 bg-gray font-semibold">t</p>
                                            @else
                                                <p class="px-1">t</p>
                                            @endif
                                        </td>
                                        <td class="p-1 text-center align-top">
                                            @if ($reportResults['2b']['zd']['medio'] ?? false)
                                                <p class="px-1 bg-gray font-semibold">Médio</p>
                                            @else
                                                <p class="px-1">Médio</p>
                                            @endif
                                        </td>
                                        <td class="p-1 text-center align-top">
                                            @if ($reportResults['2b']['ze']['medio'] ?? false)
                                                <p class="px-1 bg-gray font-semibold">Médio</p>
                                            @else
                                                <p class="px-1">Médio</p>
                                            @endif
                                        </td>
                                        <td class="p-1 text-center align-top">
                                            @if ($reportResults['2b']['p']['21'] ?? false)
                                                <p class="px-1 bg-gray font-semibold">2/1</p>
                                            @else
                                                <p class="px-1">2/1</p>
                                            @endif
                                        </td>
                                        <td class="p-1 text-center align-top">
                                            @if ($reportResults['2b']['p']['22'] ?? false)
                                                <p class="px-1 bg-gray font-semibold">2/2</p>
                                            @else
                                                <p class="px-1">2/2</p>
                                            @endif
                                        </td>
                                        <td class="p-1 text-center align-top">
                                            @if ($reportResults['2b']['p']['23'] ?? false)
                                                <p class="px-1 bg-gray font-semibold">2/3</p>
                                            @else
                                                <p class="px-1">2/3</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-1 text-center align-top">
                                            @if ($reportResults['2b']['ftp']['r'] ?? false)
                                                <p class="px-1 bg-gray font-semibold">r</p>
                                            @else
                                                <p class="px-1">r</p>
                                            @endif
                                        </td>
                                        <td class="p-1 text-center align-top">
                                            @if ($reportResults['2b']['ftp']['u'] ?? false)
                                                <p class="px-1 bg-gray font-semibold">u</p>
                                            @else
                                                <p class="px-1">u</p>
                                            @endif
                                        </td>
                                        <td class="p-1 text-center align-top">
                                            @if ($reportResults['2b']['fts']['r'] ?? false)
                                                <p class="px-1 bg-gray font-semibold">r</p>
                                            @else
                                                <p class="px-1">r</p>
                                            @endif
                                        </td>
                                        <td class="p-1 text-center align-top">
                                            @if ($reportResults['2b']['fts']['u'] ?? false)
                                                <p class="px-1 bg-gray font-semibold">u</p>
                                            @else
                                                <p class="px-1">u</p>
                                            @endif
                                        </td>
                                        <td class="p-1 text-center align-top">
                                            @if ($reportResults['2b']['zd']['inferior'] ?? false)
                                                <p class="px-1 bg-gray font-semibold">Inferior</p>
                                            @else
                                                <p class="px-1">Inferior</p>
                                            @endif
                                        </td>
                                        <td class="p-1 text-center align-top">
                                            @if ($reportResults['2b']['ze']['inferior'] ?? false)
                                                <p class="px-1 bg-gray font-semibold">Inferior</p>
                                            @else
                                                <p class="px-1">Inferior</p>
                                            @endif
                                        </td>
                                        <td class="p-1 text-center align-top">
                                            @if ($reportResults['2b']['p']['32'] ?? false)
                                                <p class="px-1 bg-gray font-semibold">3/2</p>
                                            @else
                                                <p class="px-1">3/2</p>
                                            @endif
                                        </td>
                                        <td class="p-1 text-center align-top">
                                            @if ($reportResults['2b']['p']['33'] ?? false)
                                                <p class="px-1 bg-gray font-semibold">3/3</p>
                                            @else
                                                <p class="px-1">3/3</p>
                                            @endif
                                        </td>
                                        <td class="p-1 text-center align-top">
                                            @if ($reportResults['2b']['p']['3'] ?? false)
                                                <p class="px-1 bg-gray font-semibold">3/+</p>
                                            @else
                                                <p class="px-1">3/+</p>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                    <td class="p-2 text-xs border-b-000" valign="top" width="50%" colspan="2">
                        <span class="font-semibold">2C</span> - GRANDES OPACIDADES
                        <div class="pt-1">
                            <table class="table-data mt-2" style="margin-top: 5px; width: 100%;" border="0" cellspacing="0px" cellpadding="0px">
                                <tr>
                                <td class="p-1 text-center" style="width: 25%">
                                    @if ($reportResults['2c']['go']['n0'] ?? false)
                                        <p class="px-1 bg-gray font-semibold">0</p>
                                    @else
                                        <p class="px-1">0</p>
                                    @endif
                                </td>
                                <td class="p-1 text-center" style="width: 25%">
                                    @if ($reportResults['2c']['go']['na'] ?? false)
                                        <p class="px-1 bg-gray font-semibold">A</p>
                                    @else
                                        <p class="px-1">A</p>
                                    @endif
                                </td>
                                <td class="p-1 text-center" style="width: 25%">
                                    @if ($reportResults['2c']['go']['nb'] ?? false)
                                        <p class="px-1 bg-gray font-semibold">B</p>
                                    @else
                                        <p class="px-1">B</p>
                                    @endif
                                </td>
                                <td class="p-1 text-center" style="width: 25%">
                                    @if ($reportResults['2c']['go']['nc'] ?? false)
                                        <p class="px-1 bg-gray font-semibold">C</p>
                                    @else
                                        <p class="px-1">C</p>
                                    @endif
                                </td>
                            </tr>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="p-2 text-xs border-b-000" valign="top" colspan="4">
                        <span class="font-semibold">3A</span> - ALGUMA ANORMALIDADE DE PARÊNQUIMA CONSISTENTE COM PNEUMOCONIOSE?
                        @if (($reportResults['3a'] ?? false) == 'SIM')
                            <span class="font-semibold mx-2">SIM</span> (complete 3B, 3C e 3D)
                        @else
                            <span class="font-semibold mx-2">NÃO</span> (passe para seção 4)
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="p-2 text-xs border-b-000" valign="top" colspan="4">
                        <span class="font-semibold">3B</span> - PLACAS PLEURAIS?
                        <div class="pt-1">
                            <table class="table-data bg-white" style="margin-top: 5px; width: 100%;" cellspacing="0px" cellpadding="0px">
                                <tr>
                                    <td class="p-1 text-center text-xs" style="width: 20%" colspan="4">LOCAL</td>
                                    <td class="p-1 text-center" style="width: 2%" rowspan="5">&nbsp;</td>
                                    <td class="p-1 text-center text-xs" style="width: 20%" colspan="3">CALCIFICA&Ccedil;&Atilde;O</td>
                                    <td class="p-1 text-center" style="width: 2%" rowspan="5">&nbsp;</td>
                                    <td class="p-1 text-center text-xs" style="width: 22%" colspan="7">
                                        <p>EXTENS&Atilde;O PAREDE</p>
                                        <p>(combinado com perfil e frontal)</p>
                                    </td>
                                    <td class="p-1 text-center" style="width: 2%;" rowspan="5">&nbsp;</td>
                                    <td class="p-1 text-center text-xs" style="width: 22%;" colspan="8">
                                        <p>LARGURA "OPCIONAL"</p>
                                        <p>(min de 3 mm para marca&ccedil;&atilde;o)</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1 text-center text-xs">Parede em perfil</td>
                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['ppl']['n0'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">0</p>
                                        @else
                                            <p class="px-1">0</p>
                                        @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['ppl']['nd'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">D</p>
                                        @else
                                            <p class="px-1">D</p>
                                        @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['ppl']['ne'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">E</p>
                                        @else
                                            <p class="px-1">E</p>
                                        @endif
                                    </td>

                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['ppc']['n0'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">0</p>
                                        @else
                                            <p class="px-1">0</p>
                                        @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['ppc']['nd'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">D</p>
                                        @else
                                            <p class="px-1">D</p>
                                        @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['ppc']['ne'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">E</p>
                                        @else
                                            <p class="px-1">E</p>
                                        @endif
                                    </td>

                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['ppep']['c1n0'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">0</p>
                                        @else
                                            <p class="px-1">0</p>
                                        @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['ppep']['c2nd'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">D</p>
                                        @else
                                            <p class="px-1">D</p>
                                        @endif
                                    </td>

                                    <td class="p-1 text-center" colspan="3">
                                        &nbsp;
                                    </td>

                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['ppep']['c6n0'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">0</p>
                                        @else
                                            <p class="px-1">0</p>
                                        @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['ppep']['c7ne'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">E</p>
                                        @else
                                            <p class="px-1">E</p>
                                        @endif
                                    </td>

                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['pplo']['c1nd'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">D</p>
                                        @else
                                            <p class="px-1">D</p>
                                        @endif
                                    </td>
                                    <td class="p-1 text-center" colspan="6">
                                        &nbsp;
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['pplo']['c7ne'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">E</p>
                                        @else
                                            <p class="px-1">E</p>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1 text-center text-xs">Frontal</td>
                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['fl']['n0'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">0</p>
                                        @else
                                            <p class="px-1">0</p>
                                        @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['fl']['nd'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">D</p>
                                        @else
                                            <p class="px-1">D</p>
                                        @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['fl']['ne'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">E</p>
                                        @else
                                            <p class="px-1">E</p>
                                        @endif
                                    </td>

                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['fc']['n0'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">0</p>
                                        @else
                                            <p class="px-1">0</p>
                                        @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['fc']['nd'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">D</p>
                                        @else
                                            <p class="px-1">D</p>
                                        @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['fc']['ne'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">E</p>
                                        @else
                                            <p class="px-1">E</p>
                                        @endif
                                    </td>

                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['fep']['c1n1'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">1</p>
                                        @else
                                            <p class="px-1">1</p>
                                        @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['fep']['c2n2'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">2</p>
                                        @else
                                            <p class="px-1">2</p>
                                        @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['fep']['c3n3'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">3</p>
                                        @else
                                            <p class="px-1">3</p>
                                        @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        &nbsp;
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['fep']['c5n1'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">1</p>
                                        @else
                                            <p class="px-1">1</p>
                                        @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['fep']['c6n2'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">2</p>
                                        @else
                                            <p class="px-1">2</p>
                                        @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['fep']['c7n3'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">3</p>
                                        @else
                                            <p class="px-1">3</p>
                                        @endif
                                    </td>

                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['flo']['c1na'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">A</p>
                                        @else
                                            <p class="px-1">A</p>
                                        @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['flo']['c2nb'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">B</p>
                                        @else
                                            <p class="px-1">B</p>
                                        @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['flo']['c3nc'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">C</p>
                                        @else
                                            <p class="px-1">C</p>
                                        @endif
                                    </td>
                                    <td class="p-1 text-center" colspan="2">
                                        &nbsp;
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['flo']['c5na'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">A</p>
                                        @else
                                            <p class="px-1">A</p>
                                        @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['flo']['c6nb'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">B</p>
                                        @else
                                            <p class="px-1">B</p>
                                        @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['flo']['c7nc'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">C</p>
                                        @else
                                            <p class="px-1">C</p>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td class="p-1 text-center text-xs">Diafragma</td>
                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['dl']['n0'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">0</p>
                                        @else
                                            <p class="px-1">0</p>
                                        @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['dl']['nd'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">D</p>
                                        @else
                                            <p class="px-1">D</p>
                                        @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['dl']['ne'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">E</p>
                                        @else
                                            <p class="px-1">E</p>
                                        @endif
                                    </td>

                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['dc']['n0'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">0</p>
                                        @else
                                            <p class="px-1">0</p>
                                        @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['dc']['nd'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">D</p>
                                        @else
                                            <p class="px-1">D</p>
                                        @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['dc']['ne'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">E</p>
                                        @else
                                            <p class="px-1">E</p>
                                        @endif
                                    </td>
                                    <td class="p-1 text-center text-xxs" colspan="7" rowspan="2">
                                        <p>At&eacute; 1/4 da parede lateral = 1</p>
                                        <p>1/4 a 1/2 da parede lateral = 2</p>
                                        <p>&gt; 1/2 da parede lateral = 3</p>
                                    </td>
                                    <td class="p-1 text-center text-xxs" colspan="8" rowspan="2">
                                        <p>3 a 5mm = a</p>
                                        <p>5 a 10mm = b</p>
                                        <p>&gt; 10mm = c</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1 text-center text-xs">Outros locais</td>
                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['oll']['n0'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">0</p>
                                        @else
                                            <p class="px-1">0</p>
                                        @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['oll']['nd'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">D</p>
                                        @else
                                            <p class="px-1">D</p>
                                        @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['oll']['ne'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">E</p>
                                        @else
                                            <p class="px-1">E</p>
                                        @endif
                                    </td>

                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['olc']['n0'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">0</p>
                                        @else
                                            <p class="px-1">0</p>
                                        @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['olc']['nd'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">D</p>
                                        @else
                                            <p class="px-1">D</p>
                                        @endif
                                    </td>
                                    <td class="p-1 text-center align-top">
                                        @if ($reportResults['3b']['olc']['ne'] ?? false)
                                            <p class="px-1 bg-gray font-semibold">E</p>
                                        @else
                                            <p class="px-1">E</p>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="p-2 text-xs border-b-000" valign="top" colspan="4">
                        <span class="font-semibold">3C</span> - OBLITERAÇÃO DO SEIO COSTOFRÊNICO.
                        @if ($reportResults['3c']['n0'] ?? false)
                            <span class="p-1 bg-gray font-semibold">&nbsp;0&nbsp;</span>
                        @else
                            <span class="p-1">&nbsp;0&nbsp;</span>
                        @endif
                        <span class="mx-1">/</span>
                        @if ($reportResults['3c']['nd'] ?? false)
                            <span class="p-1 bg-gray font-semibold">&nbsp;D&nbsp;</span>
                        @else
                            <span class="p-1">D</span>
                        @endif
                        <span class="mx-1">/</span>
                        @if ($reportResults['3c']['ne'] ?? false)
                            <span class="p-1 bg-gray font-semibold">&nbsp;E&nbsp;</span>
                        @else
                            <span class="p-1">&nbsp;E&nbsp;</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="p-2 text-xs border-b-000" valign="top" colspan="4">
                        <span class="font-semibold">3D</span> - ESPESSAMENTO PLEURAL DIFUSO?
                        <span class="font-bold">
                            @if (in_array(($reportResults['3d']['check'] ?? false),['S','SIM']))
                                SIM
                            @elseif (in_array(($reportResults['3d']['check'] ?? false),['N','NÃO']))
                                NÃO
                            @else
                                --
                            @endif
                        </span>
                        <table class="table-data mt-2" style="margin-top:5px; width: 100%;" border="0" cellspacing="0px" cellpadding="0px">
                            <tr>
                                <td class="p-1 text-center text-xs" style="width: 20%" colspan="4">LOCAL</td>
                                <td class="p-1 text-center" style="width: 2%" rowspan="5">&nbsp;</td>
                                <td class="p-1 text-center text-xs" style="width: 20%" colspan="3">CALCIFICA&Ccedil;&Atilde;O</td>
                                <td class="p-1 text-center" style="width: 2%" rowspan="5">&nbsp;</td>
                                <td class="p-1 text-center text-xs" style="width: 22%" colspan="7">
                                    <p>EXTENS&Atilde;O PAREDE</p>
                                    <p>(combinado com perfil e frontal)</p>
                                </td>
                                <td class="p-1 text-center" style="width: 2%;" rowspan="5">&nbsp;</td>
                                <td class="p-1 text-center text-xs" style="width: 22%;" colspan="8">
                                    <p>LARGURA "OPCIONAL"</p>
                                    <p>(min de 3 mm para marca&ccedil;&atilde;o)</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-1 text-center text-xs">Parede em perfil</td>
                                <td class="p-1 text-center align-top">
                                    @if ($reportResults['3d']['ppl']['n0'] ?? false)
                                        <p class="px-1 bg-gray font-semibold">0</p>
                                    @else
                                        <p class="px-1">0</p>
                                    @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    @if ($reportResults['3d']['ppl']['nd'] ?? false)
                                        <p class="px-1 bg-gray font-semibold">D</p>
                                    @else
                                        <p class="px-1">D</p>
                                    @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    @if ($reportResults['3d']['ppl']['ne'] ?? false)
                                        <p class="px-1 bg-gray font-semibold">E</p>
                                    @else
                                        <p class="px-1">E</p>
                                    @endif
                                </td>

                                <td class="p-1 text-center align-top">
                                    @if ($reportResults['3d']['ppc']['n0'] ?? false)
                                        <p class="px-1 bg-gray font-semibold">0</p>
                                    @else
                                        <p class="px-1">0</p>
                                    @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    @if ($reportResults['3d']['ppc']['nd'] ?? false)
                                        <p class="px-1 bg-gray font-semibold">D</p>
                                    @else
                                        <p class="px-1">D</p>
                                    @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    @if ($reportResults['3d']['ppc']['ne'] ?? false)
                                        <p class="px-1 bg-gray font-semibold">E</p>
                                    @else
                                        <p class="px-1">E</p>
                                    @endif
                                </td>

                                <td class="p-1 text-center align-top">
                                    @if ($reportResults['3d']['ppep']['c1n0'] ?? false)
                                        <p class="px-1 bg-gray font-semibold">0</p>
                                    @else
                                        <p class="px-1">0</p>
                                    @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    @if ($reportResults['3d']['ppep']['c2nd'] ?? false)
                                        <p class="px-1 bg-gray font-semibold">D</p>
                                    @else
                                        <p class="px-1">D</p>
                                    @endif
                                </td>
                                <td class="p-1 text-center" colspan="3">
                                    &nbsp;
                                </td>
                                <td class="p-1 text-center align-top">
                                    @if ($reportResults['3d']['ppep']['c6n0'] ?? false)
                                        <p class="px-1 bg-gray font-semibold">0</p>
                                    @else
                                        <p class="px-1">0</p>
                                    @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    @if ($reportResults['3d']['ppep']['c7ne'] ?? false)
                                        <p class="px-1 bg-gray font-semibold">E</p>
                                    @else
                                        <p class="px-1">E</p>
                                    @endif
                                </td>

                                <td class="p-1 text-center align-top">
                                    @if ($reportResults['3d']['pplo']['c1nd'] ?? false)
                                        <p class="px-1 bg-gray font-semibold">D</p>
                                    @else
                                        <p class="px-1">D</p>
                                    @endif
                                </td>
                                <td class="p-1 text-center" colspan="6">
                                    &nbsp;
                                </td>
                                <td class="p-1 text-center align-top">
                                    @if ($reportResults['3d']['pplo']['c7ne'] ?? false)
                                        <p class="px-1 bg-gray font-semibold">E</p>
                                    @else
                                        <p class="px-1">E</p>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="p-1 text-center text-xs">Frontal</td>
                                <td class="p-1 text-center align-top">
                                    @if ($reportResults['3d']['fl']['n0'] ?? false)
                                        <p class="px-1 bg-gray font-semibold">0</p>
                                    @else
                                        <p class="px-1">0</p>
                                    @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    @if ($reportResults['3d']['fl']['nd'] ?? false)
                                        <p class="px-1 bg-gray font-semibold">D</p>
                                    @else
                                        <p class="px-1">D</p>
                                    @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    @if ($reportResults['3d']['fl']['ne'] ?? false)
                                        <p class="px-1 bg-gray font-semibold">E</p>
                                    @else
                                        <p class="px-1">E</p>
                                    @endif
                                </td>

                                <td class="p-1 text-center align-top">
                                    @if ($reportResults['3d']['fc']['n0'] ?? false)
                                        <p class="px-1 bg-gray font-semibold">0</p>
                                    @else
                                        <p class="px-1">0</p>
                                    @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    @if ($reportResults['3d']['fc']['nd'] ?? false)
                                        <p class="px-1 bg-gray font-semibold">D</p>
                                    @else
                                        <p class="px-1">D</p>
                                    @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    @if ($reportResults['3d']['fc']['ne'] ?? false)
                                        <p class="px-1 bg-gray font-semibold">E</p>
                                    @else
                                        <p class="px-1">E</p>
                                    @endif
                                </td>

                                <td class="p-1 text-center align-top">
                                    @if ($reportResults['3d']['fep']['c1n1'] ?? false)
                                        <p class="px-1 bg-gray font-semibold">1</p>
                                    @else
                                        <p class="px-1">1</p>
                                    @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    @if ($reportResults['3d']['fep']['c2n2'] ?? false)
                                        <p class="px-1 bg-gray font-semibold">2</p>
                                    @else
                                        <p class="px-1">2</p>
                                    @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    @if ($reportResults['3d']['fep']['c3n3'] ?? false)
                                        <p class="px-1 bg-gray font-semibold">3</p>
                                    @else
                                        <p class="px-1">3</p>
                                    @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    &nbsp;
                                </td>
                                <td class="p-1 text-center align-top">
                                    @if ($reportResults['3d']['fep']['c5n1'] ?? false)
                                        <p class="px-1 bg-gray font-semibold">1</p>
                                    @else
                                        <p class="px-1">1</p>
                                    @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    @if ($reportResults['3d']['fep']['c6n2'] ?? false)
                                        <p class="px-1 bg-gray font-semibold">2</p>
                                    @else
                                        <p class="px-1">2</p>
                                    @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    @if ($reportResults['3d']['fep']['c7n3'] ?? false)
                                        <p class="px-1 bg-gray font-semibold">3</p>
                                    @else
                                        <p class="px-1">3</p>
                                    @endif
                                </td>

                                <td class="p-1 text-center align-top">
                                    @if ($reportResults['3d']['flo']['c1na'] ?? false)
                                        <p class="px-1 bg-gray font-semibold">A</p>
                                    @else
                                        <p class="px-1">A</p>
                                    @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    @if ($reportResults['3d']['flo']['c2nb'] ?? false)
                                        <p class="px-1 bg-gray font-semibold">B</p>
                                    @else
                                        <p class="px-1">B</p>
                                    @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    @if ($reportResults['3d']['flo']['c3nc'] ?? false)
                                        <p class="px-1 bg-gray font-semibold">C</p>
                                    @else
                                        <p class="px-1">C</p>
                                    @endif
                                </td>
                                <td class="p-1 text-center" colspan="2">
                                    &nbsp;
                                </td>
                                <td class="p-1 text-center align-top">
                                    @if ($reportResults['3d']['flo']['c5na'] ?? false)
                                        <p class="px-1 bg-gray font-semibold">A</p>
                                    @else
                                        <p class="px-1">A</p>
                                    @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    @if ($reportResults['3d']['flo']['c6nb'] ?? false)
                                        <p class="px-1 bg-gray font-semibold">B</p>
                                    @else
                                        <p class="px-1">B</p>
                                    @endif
                                </td>
                                <td class="p-1 text-center align-top">
                                    @if ($reportResults['3d']['flo']['c7nc'] ?? false)
                                        <p class="px-1 bg-gray font-semibold">C</p>
                                    @else
                                        <p class="px-1">C</p>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="p-1 text-center text-xs" colspan="4" rowspan="2">&nbsp;</td>
                                <td class="p-1 text-center text-xs" colspan="3" rowspan="2">&nbsp;</td>
                                <td class="p-1 text-center text-xxs" colspan="7" rowspan="2">
                                    <p>At&eacute; 1/4 da parede lateral = 1</p>
                                    <p>1/4 a 1/2 da parede lateral = 2</p>
                                    <p>&gt; 1/2 da parede lateral = 3</p>
                                </td>
                                <td class="p-1 text-center text-xxs" colspan="8" rowspan="2">
                                    <p>3 a 5mm = a</p>
                                    <p>5 a 10mm = b</p>
                                    <p>&gt; 10mm = c</p>
                                </td>
                            </tr>
                            <tr>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="p-2 text-xs border-b-000" valign="top" colspan="4">
                        <span class="font-semibold">4A</span> - OUTRAS ANORMALIDADES?
                        @if ($reportResults['4a'] == 'SIM')
                            <span class="font-semibold mx-2">SIM</span> (complete 4B)
                        @else
                            <span class="font-semibold mx-2">NÃO</span> (finalizar leitura)
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="p-2 text-xs border-b-000" valign="top" colspan="4">
                        <span class="font-semibold">4B</span> - SÍMBOLOS (vide legenda no verso)
                        <div class="mt-2 text-center" style="padding: 15px;">
                            <table>
                                <tr>
                                    @foreach ($reportResults['4b'] ?? [] as $field => $item)
                                        @if ($field == 'ME')
                                            </tr>
                                            <tr>
                                        @endif
                                        @if ($item == 1)
                                            <td class="p-1 border text-center" valign="middle">
                                                <p class="p-1 font-semibold bg-gray">{{$field}}</p>
                                            </td>
                                        @else
                                            <td class="p-2 border text-center" valign="middle">
                                                {{$field}}
                                            </td>
                                        @endif
                                    @endforeach
                                </tr>
                            </table>
                        </div>
                        <div class="font-semibold">
                            (*) “od”: Necessário um comentário.
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="p-2 text-xs border-b-000" valign="top" colspan="4">
                        <span class="font-semibold">4C</span> - COMENTÁRIOS:
                        <span class="font-semibold">{{$reportResults['4c_comentarios'] ?? null}}</span>
                    </td>
                </tr>
                <tr>
                    <td valign="middle" width="50%" style="text-align: right;" colspan="2">
                        <div style="text-align: right; padding: 2px;" style="font-family: Arial, Helvetica, sans-serif">
                            <div class="text-base font-semibold p-0">
                                @if (in_array($orderItem->ConclusionProvider->pvd_genre ,['M','Masculino']))
                                <!-- <span>Dr.</span> -->
                                    {{ $orderItem->ConclusionProvider->user->name }}
                                @else
                                <!-- <span>Dra.</span> -->
                                    {{ $orderItem->ConclusionProvider->user->name }}
                                @endif
                            </div>

                            @if ($orderItem->ConclusionProvider->specialty->ref_description)
                                <div class="text-xs">
                                    {{ $orderItem->ConclusionProvider->specialty->ref_description }}
                                </div>
                            @endif

                            <div class="text-xs p-0 uppercase">
                                {{ $orderItem->ConclusionProvider->pvd_identity_type }} - {{ $orderItem->ConclusionProvider->pvd_identity_uf }} {{ $orderItem->ConclusionProvider->pvd_identity_num }}
                            </div>
                        </div>
                    </td>
                    <td valign="middle" width="50%" style="text-align: left; padding: 0px;" colspan="2">
                        <img src="{{ base_path().'/storage/app/public/'.$orderItem->ConclusionProvider->pvd_signature }}" style="max-height: 80px;" />
                    </td>
                </tr>
            </table>
            @php
                $document_title = $orderItem->order->pat_name ?? 'pat_name'.' - '.$orderItem->Service->service_name ?? 'service_name' .' - '. $orderItem->ConclusionReport->updated_at->format('d-m-Y') .' - '. 'P'.($orderItem->order->patient_id ?? 0).'O'.($orderItem->order->id ?? 0).'I'.($orderItem->id ?? 0).'R'.($orderItem->ConclusionReport->id ?? '0');
            @endphp
        </div>
        <script>
            document.title = $document_title
        </script>
    </body>
</html>
