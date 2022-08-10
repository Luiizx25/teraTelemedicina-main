<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Model\OrderItem;
use App\User;

class GuestSearch extends Controller
{
    public function index()
    {
        return view("guest.index");
    }

    public function search(Request $request){
        $chave = $request->chave;
        if(!empty($chave)){
            $orderItem = OrderItem::where("chave", $chave)->first();
            $provider_id = $orderItem->item_conclusion_provider_id;
            $provider = User::where("id",$provider_id)->first();
            die(json_encode($provider));
        }

        return view("guest.result",compact('orderItem'));
    }
}
