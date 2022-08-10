<?php

namespace App\Console\Commands;

use App\User;
use App\Model\AppNotification;
use App\Notifications\EnvioEmailFinancialMsg;
use Illuminate\Console\Command;

class EmailFinancial extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:finnacial';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envio de email do fechamento pronto';

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
        $notifications=AppNotification::where('send',0)
        ->get();
    
        if(!empty($notification)){
            foreach ($notifications as $notification) {
                $user=User::find($notification->user_id)->get()->first();
                \Notification::send($user, new EnvioEmailFinancialMsg($user));
                $notification->send=1;
                $notification->save();
            }
    }
    }
}
