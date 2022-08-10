<?php

namespace App\Http\Controllers\ToManager;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerSys\ProviderRequest;
use App\Model\ListBank;
use App\Model\ListBankAccountType;
use App\Model\ListUf;
use App\Model\Provider;
use App\Model\RefProviderType;
use App\Model\RefDocTypePvd;
use App\Model\RefIdentityTypePvd;
use App\Model\RefProviderSpecialty;
use App\Traits\UploadTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ProviderController extends Controller
{
    Use UploadTrait;

    private $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }
 
    public function index()
    {
        $customerSys = auth()->user()->customerSys->first();

        $providers = $customerSys->Provider()->orderBy('pvd_slug')->get();

        return view('customerSys.provider.index', compact('providers'));
    }

    public function create()
    {
        $RefProviderType = RefProviderType::all('id','ref_description');

        $RefProviderSpecialty = RefProviderSpecialty::all('id','ref_description');

        $RefDocTypePvd = RefDocTypePvd::all('ref_slug','ref_description');

        $RefIdentityTypePvd = RefIdentityTypePvd::all('ref_slug','ref_description');

        $ListBank = ListBank::all('id','ref_description','ref_options');

        $ListBankAccountType = ListBankAccountType::all('id','ref_description');

        $ListUf = ListUf::all('id','ref_description');

        return view('customerSys.provider.create', compact('RefProviderType','RefProviderSpecialty','RefDocTypePvd','RefIdentityTypePvd','ListBank','ListBankAccountType','ListUf'));
    }

    public function store(ProviderRequest $request)
    {
        try
        {
            DB::beginTransaction();

            $data = $request->all();

            $customerSys = auth()->user()->customerSys->first();

            $users = new User();

            // CRETAE USER
            $user = $users->create($data);
            $data['user_id'] = $user->id;

            // GER SLUG BASEADO NO NAME in USER
            $data['pvd_slug'] = $user->name;
            $data['pvd_genre'] = 1;

            // SAVE LOGO
            if($request->hasFile('pvd_logo'))
                $data['pvd_logo'] = $this->imageUpload($request->file('pvd_logo'),'providerLogo');

            // SAVE LOGO
            if($request->hasFile('pvd_signature'))
                $data['pvd_signature'] = $this->imageUpload($request->file('pvd_signature'),'providerSignature');
                
            // SAVE CERTIFICATE
            if($request->hasFile('certificate')){
                $data['certificate'] = $this->imageUpload($request->file('certificate'),'providerCertificate');
                $novo_nome=str_replace(".txt",".crt",$data['certificate']);
                Storage::move("public/".$data['certificate'], "public/".$novo_nome);
                $data['certificate'] = $novo_nome;
            }

            $provider = $customerSys->provider()->create($data);

            DB::commit();

            return redirect()->route('toManager.provider.show',['provider'=>$provider->pvd_slug])->withStatusSuccess(__('Provider successfully created'));
        }
        catch (\Throwable $th)
        {
            DB::rollBack();


            if(env('APP_DEBUG') && auth()->user()->id < 1000)
            {
                report($th);
                
                dd($th,__('code-'.$th->getCode()));
            }

            return redirect()->back()->withInput($request->all())->withStatusError(__('th'.$th->getCode()));
        }
    }

    public function show($slug)
    {
        $customerSys = auth()->user()->customerSys->first();

        $provider = $customerSys->provider()->wherePvdSlug($slug)->first();

        if(empty($provider))
            return redirect()->route('toManager.provider.index');

        return view('customerSys.provider.show', compact('provider'));
    }

    public function edit($pvdSlug)
    {
        $customerSys = auth()->user()->customerSys->first();

        $provider = $customerSys->provider()->wherePvdSlug($pvdSlug)->get()->first();

        if(empty($provider))
            return redirect()->route('toManager.provider.index');

        $RefProviderType = RefProviderType::all('id','ref_description');

        $RefProviderSpecialty = RefProviderSpecialty::all('id','ref_description');

        $RefDocTypePvd = RefDocTypePvd::all('ref_slug','ref_description');

        $RefIdentityTypePvd = RefIdentityTypePvd::all('ref_slug','ref_description');

        $ListBank = ListBank::all('id','ref_description','ref_options');

        $ListBankAccountType = ListBankAccountType::all('id','ref_description');

        $ListUf = ListUf::all('id','ref_description');

        return view('customerSys.provider.edit', compact('provider','RefProviderType','RefProviderSpecialty','RefDocTypePvd','RefIdentityTypePvd','ListBank','ListBankAccountType','ListUf'));
    }

    public function update(ProviderRequest $request, $pvdSlug)
    {
        try
        {
            DB::beginTransaction();

            $data = $request->all();

            $customerSys = auth()->user()->customerSys->first();

            $provider = $customerSys->provider()->wherePvdSlug($pvdSlug)->get()->first();

            if(empty($provider))
                return redirect()->route('toManager.provider.index');

            // CRETAE USER
            $provider->user->update($data);

            // GER SLUG BASEADO NO NAME in USER
            $data['pvd_slug'] = $provider->user->name;

            // SAVE LOGO
            if($request->hasFile('pvd_logo'))
                $data['pvd_logo'] = $this->imageUpload($request->file('pvd_logo'),'providerLogo');

            // SAVE LOGO
            if($request->hasFile('pvd_signature'))
                $data['pvd_signature'] = $this->imageUpload($request->file('pvd_signature'),'providerSignature');

            // SAVE CERTIFICATE
            if($request->hasFile('certificate')){
                $data['certificate'] = $this->imageUpload($request->file('certificate'),'providerCertificate');
                $novo_nome=str_replace(".txt",".crt",$data['certificate']);
                Storage::move("public/".$data['certificate'], "public/".$novo_nome);
                $data['certificate'] = $novo_nome;
            }   
            $provider->update($data);

            //dd($provider->user,$provider);

            DB::commit();

            return redirect()->route('toManager.provider.show',['provider'=>$provider->pvd_slug])->withStatusSuccess(__('Provider successfully updated'));
        }
        catch (\Throwable $th)
        {
            DB::rollBack();


            if(env('APP_DEBUG') && auth()->user()->id < 1000)
            {
                report($th);
                
                dd($th,__('code-'.$th->getCode()));
            }

            return redirect()->back()->withInput($request->all())->withStatusError(__('th'.$th->getCode()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
