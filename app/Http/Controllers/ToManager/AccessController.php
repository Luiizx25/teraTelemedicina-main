<?php

namespace App\Http\Controllers\ToManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\UserLog;

class AccessController extends Controller
{
    public function index(){
        if(auth()->user()->admin_system===true){
            
            $cycle=date("Y-m");
            // REGISTROS DO LOG DE ACESSO
            $user_log = UserLog::where('created_at',">=","$cycle-01")
            ->get();

            return view('app.toManager.access.index', compact(['user_log','cycle']));
        }
        else
            return redirect()->back()->withStatusError("Access Denied");
    }
    
    public function show(Request $request){
        if(auth()->user()->admin_system===true){
            $cycle=$request->month_search;
            if(empty($cycle))
                $cycle=date("Y-m");
                
            $cycle2=date("Y-m",strtotime("$cycle-01 +1 Month"));
            $user_log = UserLog::whereBetween('created_at', ["$cycle-01", "$cycle2-01"])
            ->get();

            return view('app.toManager.access.index', compact(['user_log','cycle']));
        }
        else{
            return redirect()->back()->withStatusError("Access Denied");
        }
    }
}
