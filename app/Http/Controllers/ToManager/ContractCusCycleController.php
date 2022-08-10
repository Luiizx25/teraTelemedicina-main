<?php

namespace App\Http\Controllers\ToManager;

use App\Http\Controllers\Controller;
use App\Model\ContractCusService;
use App\Model\ContractCustomer;
use App\Model\ListMonth;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Foreach_;

class ContractCusCycleController extends Controller
{
    public function generate($contractNum)
    {
        $customerSys = auth()->user()->customerSys->first();

        $contract = ContractCustomer::whereContractNum($contractNum)->first();

        if(empty($contract))
            return redirect()->back()->withStatusWarning('Contract Not Found');

        if($contract->customer->customer_sys_id != $customerSys->id)
            return redirect()->back()->withStatusWarning('No authorization to access this contract');

        $cyclesQtd = Carbon::parse($contract->contract_date_start->format('Y-m-d'))->floatDiffInMonths($contract->contract_date_end->format('Y-m-d'));

        Carbon::macro('datePeriod', static function ($startDate, $endDate) {
            return new DatePeriod($startDate, new DateInterval('P1M'), $endDate);
        });

        $ListMonth = ListMonth::all();

        $cycles = [];

        foreach (Carbon::datePeriod($contract->contract_date_start, $contract->contract_date_end) as $date) {
            $cycles[$date->format('Y-m')] = [
                'cycleSlug'  => $date->format('Y-m'),
                'cycleMonth' => $date->format('m'),
                'cycleYear'  => $date->format('Y'),
                'cycleName'  => $date->format('F'),
                'cycleDateStart' => $date->startOfMonth()->format('d/m/Y'),
                'cycleDateEnd'   => $date->endOfMonth()->format('d/m/Y'),
            ];
        }

        return view('customer.contract.cycle.create', compact('contract','cycles'));
    }

    public function reconciliation($contractNum)
    {
        $now = Carbon::now();

        $customerSys = auth()->user()->customerSys->first();

        $contract = ContractCustomer::whereContractNum($contractNum)->first();

        if(empty($contract))
            return redirect()->back()->withStatusWarning('Contract Not Found');

        if($contract->customer->customer_sys_id != $customerSys->id)
            return redirect()->back()->withStatusWarning('No authorization to access this contract');

        if($contract->Additives->count() && $contract->Additives->last()->additive_date_conciliation)
            return redirect()->back()->withStatusWarning('Não existem reconciliações pendentes para esse contrato');

        //$contract->Additives->last()->additive_date_conciliation

        $cyclesQtd = Carbon::parse($contract->contract_date_start->format('Y-m-d'))->floatDiffInMonths($contract->contract_date_end->format('Y-m-d'));

        Carbon::macro('datePeriod', static function ($startDate, $endDate) {
            return new DatePeriod($startDate, new DateInterval('P1M'), $endDate);
        });

        $ListMonth = ListMonth::all();

        $cycles = [];

        foreach (Carbon::datePeriod($contract->contract_date_start, $contract->contract_date_end) as $date)
        {
            // DESCARTA O QUE É MENOR QUE O CICLO ATUAL
            if($date->format('Ym') < $now->format('Ym'))
                continue;

            // SE DATA ADITIVO - DESCARTA CICLOS QUE SEJAM MENORES QUE A DATA DO ADITIVO
            if($contract->additives->count())
            {
                if($date->format('Ym') <= $contract->additives->last()->additive_date->format('Ym'))
                    continue;
            }


            $cycles[$date->format('Y-m')] = [
                'cycleSlug'  => $date->format('Y-m'),
                'cycleMonth' => $date->format('m'),
                'cycleYear'  => $date->format('Y'),
                'cycleName'  => $date->format('F'),
                'cycleDateStart' => $date->startOfMonth()->format('d/m/Y'),
                'cycleDateEnd'   => $date->endOfMonth()->format('d/m/Y'),
            ];
        }

        //dd($cycles);

        return view('customer.contract.cycle.reconcile', compact('contract','cycles','now'));
    }

    public function store(Request $request)
    {
        try
        {
            $now = Carbon::now();

            DB::beginTransaction();

            $this->validate($request, [
                'cycle.*.cycle_slug' => 'required',
                'cycle.*.cycle_month' => 'required',
                'cycle.*.cycle_year' => 'required',
                'cycle.*.cycle_date_start' => 'required',
                'cycle.*.cycle_date_end' => 'required',
                'cycle.*.services.*.service_id' => 'required',
                'cycle.*.services.*.cycle_amount_negotiated' => 'required',
                'cycle.*.services.*.cycle_negotiated_price' => 'required',
                'cycle.*.services.*.cycle_negotiated_price_over' => 'required',
                'cycle.*.services.*.cycle_time_estimated' => 'required',
            ]);

            $data = $request->all();

            // GET CUSTOMERSYS
            $customerSys = auth()->user()->customerSys->first();

            // GET CONTRACT
            $contract = ContractCustomer::findOrFail($data['contract_id']);

            // NOT FOUND
            if(empty($contract))
                return redirect()->back()->withStatusWarning('Contract Not Found');

            // NO CUSTOMER SYS
            if($contract->customer->customer_sys_id != $customerSys->id)
                return redirect()->back()->withStatusError("No authorization to access this contract");

            if($data['reconciliation'] ?? false)
            {
                if($contract->Additives->last()->additive_date_conciliation)
                    return redirect()->back()->withStatusError("O aditivo de contrato já foi reconciliado.");
            }

            // SE CICLOS FORAM ENVIADOS
            if(!empty($data['cycle']))
            {
                $contractCycle = $contract->contractCycle();

                // PERCORRE OS CICLOS
                foreach ($data['cycle'] as $cycle_slug => $cycle)
                {
                    // SE NÃO MARCADO PARA REGISTRO
                    if(!isset($cycle['register']))
                        continue;

                    if( $now->format('Ym') > ($cycle['cycle_year'].$cycle['cycle_month']) )
                        continue;

                    if(empty($cycle['services']))
                        return redirect()->back()->withStatusError("No service selected for this contract");

                    $date = DateTime::createFromFormat('d/m/Y', $cycle['cycle_date_start']);
                    $cycle['cycle_date_start'] = $date->format('Y-m-d');

                    $date = DateTime::createFromFormat('d/m/Y', $cycle['cycle_date_end']);
                    $cycle['cycle_date_end'] = $date->format('Y-m-d');

                    echo "<hr>";
                    echo "CICLO *{$cycle['cycle_slug']}* <br>";

                    //dd($contractCycle->where('cycle_slug','2021-05')->count());

                    // VERIFICA SE JA EXISTE O CICLO
                    if($contract->contractCycle->where('cycle_slug',$cycle['cycle_slug'])->count())
                    {
                        echo "UPD INI <br>";
                        $contractCycleObj = $contract->contractCycle->where('cycle_slug',$cycle['cycle_slug'])->first();
                        $contractCycleObj->update($cycle);
                        echo "UPD FIM <br>";
                    }
                    else
                    {
                        echo "INS INI<br>";
                        $contractCycleObj = $contractCycle->create($cycle);
                        echo "INS FIM<br>";
                    }

                    // INICIA OBJETO CYCLE SERVICE
                    $contractCycleService = $contractCycleObj->cycleService();

                    //dd($cycle['services']);

                    unset($service);

                    foreach ($cycle['services'] as $serviceId => $service)
                    {
                        // VERIFICA SE JA EXISTE O SERVICE
                        if( $contractCycleServiceObj = $contractCycleObj->cycleService->where('service_id',$service['service_id'])->first() )
                        {
                            echo "UPD INI serviceId {$serviceId} <br>";
                            $contractCycleServiceObj->update($service);
                            echo "UPD FIM serv<br>";
                        }
                        else
                        {
                            echo "INS INI serv {$serviceId}<br>";
                            $service['cycle_amount_available'] = $service['cycle_amount_negotiated'];
                            //
                            $contractCycleServiceObj = $contractCycleService->create($service);
                            echo "INS FIM serv<br>";
                        }
                    }

                    if($data['reconciliation'] ?? false)
                    {
                        // SAVA DATA DA RECONCILIACAO
                        echo "SAVE RECONCILIACAO INI<br>";
                        $additive = $contract->Additives->last();
                        $additive->additive_date_conciliation = $now;
                        $additive->save();
                        echo "SAVE RECONCILIACAO FIM<br>";
                    }
                }
            }

            DB::commit();

            if($data['reconciliation'] ?? false)
                return redirect()->route('toManager.customerContract.show',['customerContract'=>$contract->contract_num])->withStatusSuccess(__("Aditivo de contrato reconciliado com sucesso"));
            else
                return redirect()->route('toManager.customerContract.show',['customerContract'=>$contract->contract_num])->withStatusSuccess(__("Billing cycles successfully generated"));
        }
        catch (\Throwable $th)
        {
            DB::rollBack();

            dd($th,$data,__('code-'.$th->getCode()));

            return redirect()->back()->withInput($request->all())->withStatusError(__('th'.$th->getCode()));
        }
    }

    public function update(Request $request, $id)
    {
        try
        {
            $data = $request->all();

            // GET CUSTOMERSYS
            $customerSys = auth()->user()->customerSys->first();

            // GET CONTRACT
            $contract = ContractCustomer::whereContractNum($data['contract_num'])->first();

            // NOT FOUND
            if(empty($contract))
                return redirect()->back()->withStatusWarning('Contract Not Found');

            // NO CUSTOMER SYS
            if($contract->customer->customer_sys_id != $customerSys->id)
                return redirect()->back()->withStatusError("No authorization to access this contract");

            $contractService = ContractCusService::whereId($id)->whereContractId($contract->id)->first();
            $contractService->update($data);

            //dd($contractService, $data,$contract,$contract->customer->customer_sys_id , $customerSys->id);

            return redirect()->back()->withServiceSuccess(__("Service successfully changed to contract"));
        }
        catch (\Throwable $th)
        {
            dd($th,__('code-'.$th->getCode()));

            return redirect()->back()->withInput($request->all())->withServiceError(__('th'.$th->getCode()));
        }
    }

    public function destroy(Request $request, $id)
    {
        try
        {
            $data = $request->all();

            // GET CUSTOMERSYS
            $customerSys = auth()->user()->customerSys->first();

            // GET CONTRACT
            $contract = ContractCustomer::whereContractNum($data['contract_num'])->first();

            // NOT FOUND
            if(empty($contract))
                return redirect()->back()->withStatusWarning('Contract Not Found');

            // NO CUSTOMER SYS
            if($contract->customer->customer_sys_id != $customerSys->id)
                return redirect()->back()->withStatusError("No authorization to access this contract");

            $contractService = ContractCusService::whereId($id)->whereContractId($contract->id)->first();
            $contractService->delete();

            //dd($contractService, $data,$contract,$contract->customer->customer_sys_id , $customerSys->id);

            return redirect()->back()->withServiceSuccess(__("Service successfully deleted"));
        }
        catch (\Throwable $th)
        {
            if(env('APP_DEBUG') && auth()->user()->id < 1000)
            {
                report($th);
                
                dd($th,__('code-'.$th->getCode()));
            }

            return redirect()->back()->withInput($request->all())->withServiceError(__('th'.$th->getCode()));
        }
    }
}
