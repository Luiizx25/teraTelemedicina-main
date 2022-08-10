<?php

namespace App\Console\Commands;

use App\User;
use App\Model\Order;
use App\Model\AppNotification;
use App\Model\Financial;
use Illuminate\Console\Command;

class FinancialClosure extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'financial:month';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gerar o fechamento financeiro do mês';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $consulta=Financial::where('created_at', '>=', date("Y-m-01"))
        ->selectRaw('count(*) as total')
        ->get()
        ->first();
        if($consulta->total>0){
            echo "Fechamento já foi realizado esse mês";
        }
        else{
            $orders=Order::join('tb_orders_items', 'tb_orders.id', '=', 'tb_orders_items.order_id')
            ->join('tb_services', 'tb_services.id', '=', 'item_service_id')
            ->selectRaw('tb_orders.customer_id, tb_orders.user_id, tb_orders.contract_cycle_id, tb_orders.status_id, tb_orders.type_id, tb_orders.order_num, tb_orders.order_num_cus, tb_orders.order_comments, tb_orders.order_description, tb_orders.patient_id, tb_orders.pat_name, tb_orders_items.id, finished_at, tb_orders_items.id_control as id_control_item, item_service_id, item_type_id, item_status_id, service_name, item_run_datetime, item_fields, item_conclusion_datetime, item_start_datetime, item_end_datetime, item_conclusion_provider_id, item_conclusion_report_id, item_conclusion_price, item_conclusion_comment')
            ->where('tb_orders_items.item_conclusion_datetime', '<', date("Y-m-01"))
            ->where('tb_orders_items.item_status_id', '>=', "100")
            ->whereRaw("tb_orders_items.id not in (select order_item_id from tb_financial) ")
            ->get();
            
            foreach($orders as $order){
                $financial = [];
                $financial = array(
                    "customer_id" => $order->customer_id,
                    "user_id" => $order->user_id,
                    "contract_cycle_id" => $order->contract_cycle_id,
                    "financial_cycle" => date("Y-m-01"),
                    "status_id" => $order->status_id,
                    "type_id" => $order->type_id,
                    "order_num" => $order->order_num,
                    "order_num_cus" => $order->order_num_cus,
                    "order_comments" => $order->order_comments,
                    "order_description" => $order->order_description,
                    "patient_id" => $order->patient_id,
                    "pat_name" => $order->pat_name,
                    "order_item_id" => $order->id,
                    "finished_at" => $order->finished_at,
                    "id_control_item" => $order->id_control_item,
                    "item_service_id" => $order->item_service_id,
                    "item_type_id" => $order->item_type_id,
                    "item_status_id" => $order->item_status_id,
                    "service_name" => $order->service_name,
                    "item_run_datetime" => $order->item_run_datetime,
                    "item_fields" => $order->item_fields,
                    "item_conclusion_datetime" => $order->item_conclusion_datetime,
                    "item_start_datetime" => $order->item_start_datetime,
                    "item_end_datetime" => $order->item_end_datetime,
                    "item_conclusion_provider_id" => $order->item_conclusion_provider_id,
                    "item_conclusion_report_id" => $order->item_conclusion_report_id,
                    "item_conclusion_price" => $order->item_conclusion_price,
                    "item_conclusion_comment" => $order->item_conclusion_comment,
                );
                Financial::create($financial);
            }
    
            $orders=Order::join('tb_orders_items', 'tb_orders.id', '=', 'tb_orders_items.order_id')
            ->where('tb_orders.status_id', '110')
            ->where('tb_orders_items.item_conclusion_datetime', '<', date("Y-m-01"))
            ->update(['tb_orders.status_id'=>120]);
    
            //ADICIONA NA TABELA PARA ENVIO DE EMAIL
            $users=User::where('admin_financial', '=', 1)
            ->get();
            foreach($users as $user){
                $user->send=0;
                AppNotification::create(array("user_id"=>$user->id, "send"=>0));
            }
    
            $users=User::join('tb_customers_users', 'user_id','=','id')
            ->selectRaw("id")
            ->where('financial',1)
            ->get();
            foreach($users as $user){
                $user->send=0;
                AppNotification::create(array("user_id"=>$user->id, "send"=>0));
            }
        }
    }
}
