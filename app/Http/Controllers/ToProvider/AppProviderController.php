<?php

namespace App\Http\Controllers\ToProvider;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class AppProviderController extends Controller
{
    public function settings()
    {
        return view('app.toProvider.settings');
    }

    public function dashboard()
    {
        $now      = Carbon::now();
        $ciclo    = $now->format('Y-m');
        $cicloAnt = $now->subMonth()->format('Y-m');

        $provider = auth()->user()->provider()->first();
        
        if(empty($provider))
            return redirect()->back()->withStatusWarning('Provider Not Found');

        return view('app.toProvider.dashboard',compact('now','ciclo','cicloAnt','provider'));
    }

    public function showFile($orderNum,$orderItem,$fileId)
    {
        //var_dump($orderItem,$fileId);

        $provider = auth()->user()->provider()->first();

        if(empty($provider))
            return redirect()->back()->withStatusWarning('Provider Not Found');

        $orderItem = $provider->OrderItems()->whereItemNum($orderItem)->first();

        if(!$orderItem)
            return redirect()->back()->withStatusWarning('Order Item Not Found.');

        if($orderItem->item_conclusion_provider_id != $provider->id)
            return view('app.file.401');

        $file = $orderItem->files->find($fileId);

        if(empty($file))
            return redirect()->back()->withStatusWarning('File Not Found.');

        //dd($orderItem->files);

        return view('app.file.view',compact('file'));
    }
    
    public function showFileMedico($orderNum, $orderItem, $fileId)
    {
        // dd($orderItem, $fileId);

        $provider = auth()->user()->provider()->first();

        if (empty($provider))
            return redirect()->back()->withStatusWarning('Provider Not Found');

        $orderItem = $provider->OrderItems()->whereItemNum($orderItem)->first();

        if (!$orderItem)
            return redirect()->back()->withStatusWarning('Order Item Not Found.');

        if ($orderItem->item_conclusion_provider_id != $provider->id)
            return view('app.file.401');

        $file = $orderItem->ConclusionReportFiles->find($fileId);

        if (empty($file))
            return redirect()->back()->withStatusWarning('File Not Found.');

        //dd($orderItem->files);

        return view('app.file.view', compact('file'));
    }

    public function showFileReport($orderNum, $orderItem)
    {
        //var_dump($orderItem,$fileId);

        $provider = auth()->user()->provider()->first();

        if(empty($provider))
            return redirect()->back()->withStatusWarning('Provider Not Found');

        $orderItem = $provider->OrderItems()->whereItemNum($orderItem)->first();

        if(!$orderItem)
            return redirect()->back()->withStatusWarning('Order Item Not Found.');

        if($orderItem->item_conclusion_provider_id != $provider->id)
            return view('app.file.401');

        $file = $orderItem->files->find($fileId);

        if(empty($file))
            return redirect()->back()->withStatusWarning('File Not Found.');

        //dd($orderItem->files);

        return view('app.file.viewReport',compact('file'));
    }
}
