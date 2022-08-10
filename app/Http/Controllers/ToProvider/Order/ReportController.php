<?php

namespace App\Http\Controllers\ToProvider\Order;

use App\Http\Controllers\Controller;
use App\Model\Provider;
use App\Model\OrderItem;
use App\Model\LogOrder;
use App\Traits\UploadTrait;
use App\Model\Service;
use App\Model\ContractProvider;
use App\Model\OrderItemReport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Redirect;
// use niklasravnsborg\LaravelPdf\Facades\Pdf as PDFm;

// use PDF;
// use PDFSigner;


class ReportController extends Controller
{
    use UploadTrait;

    private $now;
    private $orderItem;

    public function __construct(OrderItem $orderItem)
    {
        $this->now = Carbon::now();
        $this->orderItem = $orderItem;
    }

    public function process(Request $request, $orderItemNum)
    {
        $now = $this->now;

        $orderItem = $this->orderItem->whereItemNum($orderItemNum)->first();

        if (empty($orderItem))
            return redirect()->route('toProvider.orderItem.answer')->withStatusWarning($orderItemNum . ' - ' . __('Item not found'));

        if (auth()->user()->id < 1000) {
            if (!$request->input('providerSlug'))
                return redirect()->back()->withStatusError('Parametro providerSlug nao localizado na Url!');


            $simulated    = true;
            $provider     = Provider::where('pvd_slug', $request->input('providerSlug'))->first();
            $providerSlug = $request->input('providerSlug');
        } else {
            $simulated    = false;
            $provider     = auth()->user()->provider;
            $providerSlug = false;
        }

        if ($orderItem->item_conclusion_provider_id != $provider->id)
            return redirect()->route('toProvider.orderItem.answer')->withStatusError($orderItemNum . ' - ' . __('This item is associated with another provider'));

        $contract = $provider->ContractProvider()->first();

        if (empty($contract))
            return redirect()->route('toProvider.orderItem.answer')->withStatusError(__('Sem contrato associado'));

        $service = $contract->contractService()->where('service_id', $orderItem->item_service_id)->first();

        if (!$service)
            return redirect()->route('toProvider.orderItem.answer')->withStatusError(__('The type of service is not included in your contract'));

        if ($orderItem->item_end_datetime)
            return redirect()->route('toProvider.orderItem.answer')->withStatusWarning(__('This item has already been answered'));

        switch ($orderItem->item_status_id) {
            case 50: // EM ATENDIMENTO
            case 80: // EM REVISAO

                // SE OIT
                if (($orderItem->service->service_slug ?? false) == 'raio-x-oit')
                    return view('app.toProvider.Order.Item.report.create-raio-x-oit', compact('now', 'orderItemNum', 'orderItem', 'provider', 'contract', 'service', 'simulated', 'providerSlug'));

                // SE ACUIDADE
                if (($orderItem->service->service_slug ?? false) == 'acuidade-visual')
                    return view('app.toProvider.Order.Item.report.create-acuidade-visual', compact('now', 'orderItemNum', 'orderItem', 'provider', 'contract', 'service', 'simulated', 'providerSlug'));

                //
                return view('app.toProvider.Order.Item.report.create', compact('now', 'orderItemNum', 'orderItem', 'provider', 'contract', 'service', 'simulated', 'providerSlug'));
                break;

            case 90: // AGUARDANDO ASSINATURA

                // SE OIT
                if (($orderItem->service->service_slug ?? false) == 'raio-x-oit')
                    return view('app.toProvider.Order.Item.report.sign-raio-x-oit', compact('now', 'orderItemNum', 'orderItem', 'provider', 'contract', 'service', 'simulated', 'providerSlug'));

                return view('app.toProvider.Order.Item.report.sign', compact('now', 'orderItemNum', 'orderItem', 'provider', 'contract', 'service', 'simulated', 'providerSlug'));
                break;

            default:
                return redirect()->route('toProvider.orderItem.answer')->withStatusError(__('Atendimento iniciado de forma incorreta'));
        }
    }

    public function conclusion($orderItemNum, Request $request)
    {
        try {
            $now = Carbon::now();

            $data = $request->all();

            DB::beginTransaction();

            $provider = auth()->user()->provider()->first();

            if (!$provider)
                abort(404, 'provider Not Found');

            $orderItem = $this->orderItem->whereItemNum($orderItemNum)->first();

            if (!$orderItem)
                abort(404, 'Order Item Not Found');

            if (auth()->user()->id > 999) {
                if ($orderItem->item_conclusion_provider_id && $orderItem->item_conclusion_provider_id != auth()->user()->provider->id)
                    abort(404, 'Item já está atribuido a outro usuário');
            }

            // SE OIT
            if (($orderItem->service->service_slug ?? false) == 'raio-x-oit')
                $data['order_item_report'] = serialize($data['order_item_report']);

            $report = $orderItem->reports()->create(
                [
                    'item_id'                   => $orderItem->id,
                    'provider_id'               => $provider->id,
                    'report_type_id'            => 2, // 2.LAUDO CONCLUSÃO
                    'report_status_id'          => 3, // 3.CONCLUIDO
                    'report_results'            => $data['order_item_report'],
                    'report_results_comments'   => $data['report_results_comments'],
                    'report_conclusion'         => 'Laudo concluído',
                    'report_comments'           => 'Concluído em ' . $now->format('d/m/Y H:i'),
                    'report_cycle'              => $now->format('Y-m'),
                ]
            );

            //
            $itemStatusId = 90;  // 90.Aguardando Assinatura
            //
            $orderItem->update(
                [
                    'item_status_id'              => $itemStatusId,
                    'item_status_id_ant'          => ($orderItem->item_status_id == $itemStatusId ? $orderItem->item_status_id_ant : $itemStatusId),
                    'item_conclusion_datetime'    => null,
                    'item_conclusion_report_id'   => $report->id,
                    'item_conclusion_provider_id' => $provider->id,
                ]
            );

            
            LogOrder::create([
                "user_id" => auth()->user()->id,
                "order_id" => $orderItem->order_id,
                "order_item_id" => $orderItem->id,
                "occurrence" => "Concluído! Aguardando assinatura"
            ]);

            DB::commit();

            return redirect()->route('toProvider.orderItem.answer',)->withStatusSuccess('Successfully concluded');
            //
        } catch (\Throwable $th) {
            DB::rollBack();

            if (env('APP_DEBUG') && auth()->user()->id < 1000) {
                report($th);

                dd($th, __('code-' . $th->getCode()));
            }


            if (in_array($th->getCode(), [0]))
                $msg = $th->getMessage();
            else
                $msg = 'th' . $th->getCode();

            return redirect()->back()->withInput($request->all())->withStatusError(__($msg));
        }
    }

    public function cancel($orderItemNum, Request $request)
    {
        try {
            DB::beginTransaction();

            $now  = Carbon::now();

            $provider = auth()->user()->provider()->first();

            if (!$provider)
                abort(404, 'provider Not Found');

            $orderItem = $provider->OrderItems()->whereItemNum($orderItemNum)->first();

            if (!$orderItem)
                abort(404, 'Order Item Not Found');

            $orderItem->reports()->create(
                [
                    'item_id'           => $orderItem->id,
                    'provider_id'       => $provider->id,
                    'report_type_id'    => 1, // 1.LEGENDA
                    'report_status_id'  => 3, // 3.CANCELADO
                    'report_conclusion' => 'Laudo devolvido para a fila',
                    'report_comments'   => 'Retornou pra fila as ' . $now->format('d/m/Y H:i'),
                    'report_cycle'      => $now->format('Y-m'),
                ]
            );

            $orderItem->update(
                [
                    'item_conclusion_datetime'    => null,
                    'item_conclusion_report_id'   => null,
                    'item_conclusion_provider_id' => null,
                    'item_status_id_ant'          => $orderItem->item_status_id_ant,
                    'item_status_id'              => 40, // 40.Aguardando Atendiment
                ]
            );

            LogOrder::create([
                "user_id" => auth()->user()->id,
                "order_id" => $orderItem->order_id,
                "order_item_id" => $orderItem->id,
                "occurrence" => "Laudo devolvido para a fila"
            ]);

            DB::commit();

            return redirect()->route('toProvider.orderItem.answer',)->withStatusSuccess('Successfully canceled');
            //
        } catch (\Throwable $th) {
            DB::rollBack();


            if (env('APP_DEBUG') && auth()->user()->id < 1000) {
                report($th);

                dd($th, __('code-' . $th->getCode()));
            }


            if (in_array($th->getCode(), [0]))
                $msg = $th->getMessage();
            else
                $msg = 'th' . $th->getCode();

            return redirect()->back()->withInput($request->all())->withStatusError(__($msg));
        }
    }

    public function return($orderItemNum, Request $request)
    {
        try {
            DB::beginTransaction();

            $now = Carbon::now();

            $data = $request->all();

            $provider = auth()->user()->provider()->first();

            if (!$provider)
                abort(404, 'provider Not Found');

            $orderItem = $provider->OrderItems()->whereItemNum($orderItemNum)->first();

            if (!$orderItem)
                abort(404, 'Order Item Not Found');

            $providersContracts = $orderItem->service->providersContracts->where('active',true);
            // die(json_encode($providersContracts));
            $return=true;
            foreach($providersContracts as $providersContract){
                $contract_id=$providersContract->contract_id;
                $contrato=ContractProvider::where('id',$contract_id)->where('active',true)->where('contract_date_start','<=',$now)->where('contract_date_end','>=',$now)->first();
                if(isset($contrato->provider_id)){
                    if(empty($contrato->active)){

                    }
                    else if($contrato->provider_id==$provider->id){
                        //continue
                    }
                    else{
                        $report_provider=$orderItem->reports->where('provider_id', $contrato->provider_id)->where('report_status_id',6)->first();
                        echo json_encode($report_provider)."<br><br>";
                        if(isset($report_provider->id)){
                            //Médico já devolveu o pedido
                        }
                        else{
                            $return=false;
                            break;
                        }
                    }
                }
                else{
                    
                }
            }

            if($return){
                $report = $orderItem->reports()->create(
                    [
                        'item_id'           => $orderItem->id,
                        'provider_id'       => $provider->id,
                        'report_type_id'    => 1, // 1.LEGENDA
                        'report_status_id'  => 61, // 3.DEVOLVIDO
                        'report_conclusion' => 'Laudo devolvido: ' . $data['reasonReturn'],
                        'report_comments'   => 'Laudo devolvido as ' . $now->format('d/m/Y H:i'),
                        'report_cycle'      => $now->format('Y-m'),
                    ]
                );
                OrderItemReport::where('item_id',$orderItem->id)
                ->where('report_status_id',6)
                ->update(['report_status_id' => 61]);
                //
                $itemStatusId = 60; // 60.devolvido ao solicitante
                //
                $orderItem->update(
                    [
                        'item_status_id'              => $itemStatusId,
                        'item_status_id_ant'          => ($orderItem->item_status_id == $itemStatusId ? $orderItem->item_status_id_ant : $itemStatusId),
                        'item_conclusion_datetime'    => $now,
                        'item_conclusion_report_id'   => $report->id,
                        'item_conclusion_provider_id' => $provider->id,
                        'item_conclusion_comment'     => $data['reasonReturn'],
                    ]
                );
            }
            else{
                $report = $orderItem->reports()->create(
                    [
                        'item_id'           => $orderItem->id,
                        'provider_id'       => $provider->id,
                        'report_type_id'    => 1, // 1.LEGENDA
                        'report_status_id'  => 6, // 3.DEVOLVIDO
                        'report_conclusion' => 'Laudo devolvido: ' . $data['reasonReturn'],
                        'report_comments'   => 'Laudo devolvido as ' . $now->format('d/m/Y H:i'),
                        'report_cycle'      => $now->format('Y-m'),
                    ]
                );

                //
                $itemStatusId = 40; // 40.Aguardando atendimento
                //
                $orderItem->update(
                    [
                        'item_status_id'              => $itemStatusId,
                        'item_status_id_ant'          => ($orderItem->item_status_id == $itemStatusId ? $orderItem->item_status_id_ant : $itemStatusId),
                        'item_conclusion_datetime'    => null,
                        'item_start_datetime'         => null,
                        'item_conclusion_report_id'   => $report->id,
                        'item_conclusion_provider_id' => null,
                        'item_conclusion_comment'     => $data['reasonReturn'],
                    ]
                );
            }
            
            LogOrder::create([
                "user_id" => auth()->user()->id,
                "order_id" => $orderItem->order_id,
                "order_item_id" => $orderItem->id,
                "occurrence" => "Laudo devolvido ao solicitante"
            ]);

            DB::commit();

            return redirect()->route('toProvider.orderItem.answer',)->withStatusSuccess('Successfully returned');
            //
        } catch (\Throwable $th) {
            DB::rollBack();

            if (env('APP_DEBUG') && auth()->user()->id < 1000) {
                report($th);

                dd($th, __('code-' . $th->getCode()));
            }


            if (in_array($th->getCode(), [0]))
                $msg = $th->getMessage();
            else
                $msg = 'th' . $th->getCode();

            return redirect()->back()->withInput($request->all())->withStatusError(__($msg));
        }
    }

    public function sign($orderItemNum, Request $request)
    {
        try {
            $now  = Carbon::now();

            $data = $request->all();

            if (auth()->user()->id < 1000) {
                if (!$request->input('providerSlug'))
                    return redirect()->back()->withStatusError('Parametro providerSlug nao localizado na Url!');

                $provider = Provider::where('pvd_slug', $request->input('providerSlug'))->first();
            } else {
                $provider = auth()->user()->provider;
            }

            if (!$provider)
                abort(404, 'provider Not Found');

            $orderItem = $provider->OrderItems()->whereItemNum($orderItemNum)->first();

            if (!$orderItem)
                abort(404, 'Order Item Not Found');

            // DEF NAME
            $pdfName = "{$orderItem->ConclusionReport->updated_at->format('Ymd')}{$orderItem->ConclusionReport->id}-{$orderItem->order->pat_name}-{$orderItem->Service->service_name}";
            $pdfName = $pdfName . '-P' . $orderItem->order->patient_id . 'O' . $orderItem->order->id . 'I' . $orderItem->id . 'R' . $orderItem->ConclusionReport->id . '-' . $now->timestamp;
            $pdfName = Str::slug($pdfName, '-');
            $pdfName = strtoupper($pdfName) . '.pdf';

            // DEF + CHECK PATH
            $pdfPath = "storage/order/{$orderItem->order->id}/orderItem/{$orderItem->id}/reports/{$orderItem->ConclusionReport->id}";

            // DEF FILE
            $pdfFile = "{$pdfPath}/{$pdfName}";

            $chave = str_shuffle(Str::random(10));

            if (!File::exists($pdfPath))
                File::makeDirectory($pdfPath, 0755, true, true);

            if (in_array(auth()->user()->email, ['medico@webeloja.com11'])) {

                // SET VIEW
                $view = 'app.file.viewReport';

                // SE OIT
                if ($orderItem->service->service_slug == 'raio-x-oit') $view = 'app.file.viewReport-raio-x-oit';

                // SE ACUIDADE
                if ($orderItem->service->service_slug == 'acuidade-visual') $view = 'app.file.viewReport-acuidade-visual';

                // GERA PDF
                $pdf = PDF::loadView($view, compact('orderItem'))->save($pdfFile);
                return $pdf->stream($pdfName);

                echo "<a href='https://app.teratelemedicina.com.br/{$pdfFile}' target='_blank'>clique</a>";

                // dd($pdfFile);

                DB::beginTransaction();

                // UPDATE REPORT
                $orderItem->ConclusionReport->update(
                    [
                        'report_status_id'              => 10, // CONCLUIDO ASSINADO
                        'report_conclusion_file_name'   => $pdfName,
                        'report_conclusion_file_path'   => $pdfPath,
                        'report_conclusion'             => 'Laudo concluído e assinado',
                        'report_comments'               => 'Laudo concluído e assinado em ' . $now->format('d/m/Y H:i'),
                        'report_cycle'                  => $now->format('Y-m'),
                    ]
                );

                // UPDATE ITEM
                $orderItem->update(
                    [
                        'item_status_id'              => 100, // FINALIZADO
                        'item_status_id_ant'          => $orderItem->item_status_id, // 40.Aguardando Atendiment
                        'item_end_datetime'           => $now,
                        'item_conclusion_datetime'    => $now,
                        'item_conclusion_provider_id' => $provider->id,
                        'chave'                       => $chave,
                    ]
                );

                //
                $orderFinalizar = true;

                // PERCORRE OS ITENS
                foreach ($orderItem->order->itens as $item) {
                    // VERIFICA SE NAO FINALIZADO
                    if (!in_array($item->item_status_id, [100])) // 100.FINALIZADO
                        $orderFinalizar = false;
                }

                // FINALIZA ORDEM
                if ($orderFinalizar) {
                    $orderItem->order->update(
                        [
                            'status_id' => 110,
                        ]
                    );
                }

                DB::rollBack();
                // DB::commit();


                // SE OIT
                if ($orderItem->service->service_slug == 'raio-x-oit')
                    return view('app.file.viewReport-raio-x-oit', compact('orderItem'));

                // SE ACUIDADE
                if ($orderItem->service->service_slug == 'acuidade-visual')
                    return view('app.file.viewReport-acuidade-visual', compact('orderItem'));

                //
                return view('app.file.viewReport', compact('orderItem'));
            }

            // dd(
            //     $orderItem->service->toArray(),
            //     $orderItem->toArray(),
            //     auth()->user()->email
            // );

            // if($provider->pvd_signature_use){
            //     // set certificate file
            //     $path = storage_path($provider->certificate);
            //     $path=str_replace("\\","/",$path);
            //     $path=str_replace("/storage","/public/storage",$path);

            //     $file=fopen($path,"r");
            //     $text=fread($file,filesize($path));
            //     $lines=explode("friendlyName: ",$text);
            //     $lines=explode(" Microsoft CSP Name", $lines[1]);
            //     $lines=explode(":", trim($lines[0]));
            //     $nome_certificado=$lines[0];
            //     $cpf_certificado=$lines[1];
            //     $cpf_provider=str_replace(".","",auth()->user()->provider->pvd_doc_num);
            //     $cpf_provider=str_replace("-","",$cpf_provider);

            //     if($nome_certificado<>strtoupper(auth()->user()->name) || $cpf_certificado<>$cpf_provider)
            //         abort(404,"As credenciais são divergentes do certificado");

            //     $certificate = 'file://'.$path;
            //     // set additional information in the signature
            //     $info = array(
            //         'Name' => auth()->user()->name,
            //         'Location' => 'Office',
            //         'Reason' => 'Laudo Médico',
            //         'ContactInfo' => auth()->user()->email,
            //     );

            //     // Realiza a Assinatura
            //     try {
            //         PDFSigner::setSignature($certificate, $certificate, '', '', 2, $info);
            //         $data_assinatura=date("Y-m-d H:i:s");
            //     } catch (\Throwable $th) {
            //         abort(404,"Ocorreu um erro para validar o certificado");
            //     }
            //     PDFSigner::AddPage();
            //     // Custom Footer
            //     PDFSigner::setFooterCallback(function($pdf) {
            //         $hora_assinatura=date("H:i");
            //         $data_assinatura=date("d/m/Y");

            //         // Position at 15 mm from bottom
            //         $pdf->SetY(-15);
            //         // Set font
            //         $pdf->SetFont('helvetica', 'I', 8);
            //         $pdf->writeHTML("Documento assinado digitalmente de acordo com a ICP-Brasil, MP 2.200-2/2001, Resolução CFM 1821/2007, no sistema certificado SBIS-CFM no XXX-Y, por ".auth()->user()->name.", CPF ".auth()->user()->provider->pvd_doc_num.", às $hora_assinatura UTC -3 de $data_assinatura.");
            //         // Page number
            //         $pdf->Cell(0, 10, 'Page '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');

            //     });

            //     $text = view('app.file.tcpdf', compact('orderItem','chave'));
            //     PDFSigner::writeHTML($text, true, false, true, false);

            //     //AJUSTA O CAMINHO PARA SALVAR O ARQUIVO
            //     $path = storage_path();
            //     $path=str_replace("\\","/",$path);
            //     $path=str_replace("/storage","/public/",$path);

            //     //PDFSigner::Output($path.$pdfFile, 'I');
            //     PDFSigner::Output($path.$pdfFile, 'F');
            //     PDFSigner::reset();
            //     //VALIDA SE O DOCUMENTO FOI ASSINADO
            //     $handle = fopen($path.$pdfFile, 'r');
            //     $valid = false; // init as false
            //     while (($buffer = fgets($handle)) !== false) {
            //         if (strpos($buffer, 'adbe.pkcs7.detached') !== false) {
            //             $valid = true;
            //             break;
            //         }
            //     }
            //     fclose($handle);
            //     if(!($valid))
            //         abort(404,"Ocorreu um erro");

            // }
            // else{
            // $pdf = PDF::loadView('app.file.viewReport', compact('orderItem'))->save($pdfFile);
            //}

            // SET VIEW
            $view = 'app.file.viewReport';

            // SE OIT
            if ($orderItem->service->service_slug == 'raio-x-oit') $view = 'app.file.viewReport-raio-x-oit';

            // SE ACUIDADE
            if ($orderItem->service->service_slug == 'acuidade-visual') $view = 'app.file.viewReport-acuidade-visual';

            // GERA PDF
            //return view($view, compact('orderItem'));
            //die($view);
            $pdf = PDF::loadView($view, compact('orderItem'))->save($pdfFile);

            // return $pdf->stream();
            // return $pdf->download('nome-arquivo-pdf-gerado.pdf');

            DB::beginTransaction();

            // UPDATE REPORT
            $orderItem->ConclusionReport->update(
                [
                    'report_status_id'              => 10, // CONCLUIDO ASSINADO
                    'report_conclusion_file_name'   => $pdfName,
                    'report_conclusion_file_path'   => $pdfPath,
                    'report_conclusion'             => 'Laudo concluído e assinado',
                    'report_comments'               => 'Laudo concluído e assinado em ' . $now->format('d/m/Y H:i'),
                    'report_cycle'                  => $now->format('Y-m'),
                ]
            );

            // UPDATE ITEM
            $orderItem->update(
                [
                    'item_status_id'              => 100, // FINALIZADO
                    'item_status_id_ant'          => $orderItem->item_status_id, // 40.Aguardando Atendiment
                    'item_end_datetime'           => $now,
                    'item_conclusion_datetime'    => $now,
                    'item_conclusion_provider_id' => $provider->id,
                    'chave'                       => $chave,
                ]
            );

            //
            $orderFinalizar = true;

            // PERCORRE OS ITENS
            foreach ($orderItem->order->itens as $item) {
                // VERIFICA SE NAO FINALIZADO
                if (!in_array($item->item_status_id, [100])) // 100.FINALIZADO
                    $orderFinalizar = false;
            }

            // FINALIZA ORDEM
            if ($orderFinalizar) {
                $orderItem->order->update(
                    [
                        'status_id' => 110,
                    ]
                );
            }

            LogOrder::create([
                "user_id" => auth()->user()->id,
                "order_id" => $orderItem->order_id,
                "order_item_id" => $orderItem->id,
                "occurrence" => "Laudo assinado"
            ]);

            DB::commit();

            return redirect()->route('toProvider.orderItem.answer',)->withStatusSuccess('Successfully concluded');
            //
        } catch (\Throwable $th) {
            DB::rollBack();

            if (env('APP_DEBUG') && auth()->user()->id < 1000) {
                report($th);

                dd($th, __('code-' . $th->getCode()));
            }

            if (in_array($th->getCode(), [0]))
                $msg = $th->getMessage();
            else
                $msg = 'th' . $th->getMessage();

            return redirect()->back()->withInput($request->all())->withStatusError(__($msg));
        }
    }
    
    public function fileUpload($orderItemNum, Request $request)
    {
        try {

            $data = $request->all();

            $orderItem = $this->orderItem->where('item_num', $orderItemNum)->first();

            // SAVE FILE
            $file = request()->file('file');

            if (!$file->isValid()) {
                $error = $file->getErrorMessage();
                return redirect()->back()->withStatusWarning($error ?? 'Erro no Upload do arquivo.');
            }

            if (!$request->hasFile('file'))
                return redirect()->back()->withStatusWarning('Precisa anexar um arquivo');

            $data['file_description'] = $file->getClientOriginalName();
            $data['file_type']        = $file->getClientOriginalExtension();
            $data['file']             = $this->imageUpload($request->file('file'), "order/{$orderItem->order_id}/orderItem/{$orderItem->id}");

            DB::beginTransaction();

            $reportFile = $orderItem->ConclusionReportFiles()->create($data);
            
            LogOrder::create([
                "user_id" => auth()->user()->id,
                "order_id" => $orderItem->order_id,
                "order_item_id" => $orderItem->id,
                "occurrence" => "Aquivo ".$reportFile->file_description." anexado"
            ]);

            // dd(
            //     $orderItem->toArray(),
            //     $data,
            //     $file,
            //     $reportFile->toArray(),
            // );

            DB::commit();

            return redirect()->back()->withStatusSuccess('Arquivo do médico adicionado com sucesso!');
            //
        } catch (\Throwable $th) {

            DB::rollBack();

            // dd($th, __('code-' . $th->getCode()));

            if (in_array($th->getCode(), [0]))
                $msg = $th->getMessage();
            else
                $msg = 'th' . $th->getCode();

            return redirect()->back()->withInput($request->all())->withStatusError(__($msg));
        }
    }

    public function fileRemove($orderItemNum, $fileId, Request $request)
    {
        try {
            DB::beginTransaction();

            $orderItem  = $this->orderItem->where('item_num', $orderItemNum)->first();
            $reportFile = $orderItem->ConclusionReportFiles->find($fileId);
            $file       = $reportFile->file;

            LogOrder::create([
                "user_id" => auth()->user()->id,
                "order_id" => $orderItem->order_id,
                "order_item_id" => $orderItem->id,
                "occurrence" => "Aquivo ".$reportFile->file_description." excluído"
            ]);

            $reportFile->delete();

            //
            $this->fileDelete('public/' . $file);
            DB::commit();
            return redirect()->back()->withStatusSuccess('Arquivo do médico removido com sucesso!');
            //
        } catch (\Throwable $th) {

            DB::rollBack();

            // dd($th, __('code-' . $th->getCode()));

            if (in_array($th->getCode(), [0]))
                $msg = $th->getMessage();
            else
                $msg = 'th' . $th->getCode();

            return redirect()->back()->withInput($request->all())->withStatusError(__($msg));
        }
    }
}
