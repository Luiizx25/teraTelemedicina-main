<?php

namespace App\Http\Controllers\ToCustomer\Order;

use App\Http\Controllers\Controller;
use App\Traits\UploadTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Model\LogOrder;

class OrderItemsFileController extends Controller
{
    Use UploadTrait;

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try
        {
            DB::beginTransaction();

            $data = $request->all();

            $customer = auth()->user()->customer->first();

            if(empty($customer))
                return redirect()->back()->withStatusWarning('Customer Not Found');

            $order = $customer->order()->whereOrderNum($data['orderNum'])->first();

            if(empty($order))
                return redirect()->back()->withStatusWarning('Order Not Found');

            $orderItem = $order->itens->find($data['orderItem']);

            if(empty($orderItem))
                return redirect()->back()->withStatusWarning('Order Item Not Found');
    
            // SAVE FILE
            $file = request()->file('file');
                
            if (!$file->isValid())
            {
                $error = $file->getErrorMessage();
                return redirect()->back()->withStatusWarning( $error ?? 'Erro no Upload do arquivo.' );
            }

            if(!$request->hasFile('file'))
                return redirect()->back()->withStatusWarning('You must attach a file');
            
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_type'] = $file->extension();
            $data['file_type'] = $file->getClientOriginalExtension();
            $data['file_size'] = $file->getSize();
            $data['file_mime_type'] = $file->getMimeType();
            //
            $data['file'] = $this->imageUpload($request->file('file'),"order/{$order->id}/orderItem/{$data['orderItem']}");

            $orderItemFile = $orderItem->files()->create($data);

            //dd($data,$file,$file->extension(),$orderItemFile);
            
            LogOrder::create([
                "user_id" => auth()->user()->id,
                "order_id" => $order->id,
                "order_item_id" => $orderItem->id,
                "occurrence" => "Aquivo ".$orderItemFile->id." anexado"
            ]);

            DB::commit();

            return redirect()->back()->withStatusSuccess('File successfully attached');
        }
        catch (\Throwable $th)
        {
            DB::rollBack();

            dd($th,__('code-'.$th->getCode()));

            if(in_array($th->getCode(),[0]))
                $msg = $th->getMessage();
            else
                $msg = 'th'.$th->getCode();

            return redirect()->back()->withInput($request->all())->withStatusError(__($msg));
        }
    }

    public function show($id)
    {
        echo "1";
    }

    public function edit($id)
    {
        //
        echo "2";
    }

    public function update(Request $request, $id)
    {
        //
        echo "3";
    }

    public function destroy(Request $request, $id)
    {
        try
        {
            DB::beginTransaction();

            $now = Carbon::now();

            $data = $request->all();

            $customer = auth()->user()->customer->first();

            if(empty($customer))
                return redirect()->back()->withStatusWarning('Customer Not Found');

            $order = $customer->order()->whereOrderNum($data['orderNum'])->first();

            if(empty($order))
                return redirect()->back()->withStatusWarning('Order Not Found');

            $orderItem = $order->itens()->find($data['orderItem']);

            if(empty($orderItem))
                return redirect()->back()->withStatusWarning('Order Item Not Found');

            $orderItemFile = $orderItem->files()->find($id);

            if(empty($orderItemFile))
                return redirect()->back()->withStatusWarning('Order Item File Not Found');

            LogOrder::create([
                "user_id" => auth()->user()->id,
                "order_id" => $order->id,
                "order_item_id" => $orderItem->id,
                "occurrence" => "Aquivo ".$orderItemFile->id." excluído"
            ]);
            //
            $orderItemFile->delete();

            //
            if(Storage::disk('public')->exists($orderItemFile->file))
                Storage::disk('public')->delete($orderItemFile->file);

            DB::commit();

            return redirect()->back()->withStatusSuccess('Order item file successfully deleted');
        }
        catch (\Throwable $th)
        {
            DB::rollBack();

            dd($th,__('code-'.$th->getCode()));

            if(in_array($th->getCode(),[0]))
                $msg = $th->getMessage();
            else
                $msg = 'th'.$th->getCode();

            return redirect()->back()->withStatusError(__($msg));
        }
    }
}
