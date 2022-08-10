@extends('_layout.side-menu',[
    'title' => __('Provider'),
    'useJquery' => true,
    'useInputmask' => true,
    'useDataTable' => true,
])

@section('subcontent')
    <!-- -->
    <div class="mt-2 p-2 intro-y">
        <div class="flex">
            <div class="">
                <div class="text-2xl font-bold leading-8">
                    {{__('Provider')}}
                </div>
            </div>
            <div class="ml-auto">
                <div class="dropdown">
                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"> <i data-feather="more-vertical" class="w-5 h-5 text-gray-700 dark:text-gray-300"></i> </a>
                    <div class="dropdown-box">
                        <div class="dropdown-box__content box dark:bg-dark-1">
                            <div class="p-2 w-40">
                                <a href="{{route('toManager.provider.edit',['provider'=>$provider->pvd_slug])}}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="edit-3" class="w-4 h-4 text-gray-700 dark:text-gray-300 mr-2"></i> {{__('Edit')}}</a>
                                <a href="javascript:;" id="btn-provider-open-modal" data-toggle="modal" data-target="#modal-provider-updatePwd" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="lock" class="w-4 h-4 text-gray-700 dark:text-gray-300 mr-2"></i> {{__('Reset Password')}}</a>
                                <!-- MODAL -->
                                <div class="modal" id="modal-provider-updatePwd">
                                    <div class="modal__content modal__content">
                                        <form id="form_provider_add" action="{{route('toManager.provider.updatePwd',['provider'=>$provider->pvd_slug])}}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="intro-y col-span-12 sm:col-span-12 lg:col-span-4 box shadow-md border border-solid border-gray-300">
                                                <div class="flex items-center px-5 py-2 border-b border-gray-200 dark:border-dark-5">
                                                    <div class="mr-auto">
                                                        <h2 class="font-medium text-base mr-auto">{{__('Reset Password')}}</h2>
                                                    </div>
                                                    @if (session('status_error'))
                                                    <div class="mt-2 px-2 py-1 bg-theme-6 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                                                        <span class="flex rounded-full bg-indigo-100 text-theme-6 uppercase px-2 py-1 text-xs font-bold mr-3">Ops!</span>
                                                        <span class="font-semibold mr-2 text-left flex-auto">{{ __(session('status_error')) }}</span>
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="p-5">
                                                    <div class="grid grid-cols-12 gap-2 mt-4">
                                                        <div class="intro-y col-span-6">
                                                            <label class="mb-2">{{__('Password')}}</label>
                                                            <input id="input_password" name="password" type="password" class="input w-full border col-span-4 @error('password') border-theme-6 @enderror" placeholder="{{__('Password')}}" required>
                                                            @error('password')
                                                            <div id="error-password" class="password__input-error w-5/6 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                                            @enderror
                                                            @if (session('status_password'))
                                                                <div class="w-full mb-4 p-2 bg-theme-9 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                                                                    <span class="flex rounded-full bg-theme-1 uppercase px-2 py-1 text-xs font-bold mr-3">SUCESSO</span>
                                                                    <span class="font-semibold mr-2 text-left flex-auto">{{ session('status_password') }}</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="intro-y col-span-6">
                                                            <label class="mb-2">{{__('Password Confirm')}}</label>
                                                            <input id="input_password_confirmation" name="password_confirmation" type="password" class="input w-full border col-span-4 @error('password_confirmation') border-theme-6 @enderror" placeholder="{{__('Repeat Password')}}" required>
                                                        </div>
                                                    </div>
                                                    <div class="grid grid-cols-12 gap-2 mt-4">
                                                        <div class="intro-y col-span-12 mt-2 text-right">
                                                            <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1">{{__('Cancel')}}</button>
                                                            <button class="button bg-theme-1 text-white">{{__('Reset')}}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- MODAL -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- -->
    <!-- BEGIN: Profile Info -->
    <div class="intro-y box">
        <div class="flex flex-col lg:flex-row border-b border-gray-200 dark:border-dark-5">
            <div class="flex flex-1 px-4 py-2 items-center justify-center lg:justify-start">
                <div class="w-20 h-20 flex-none image-fit relative">
                    @if ($provider->user->photo)
                    <img alt="Image Profile" class="border-solid border-2 border-gray-600 shadow rounded-full" src="{{ asset('storage/'.$provider->user->photo) }}">
                    @else
                    <img alt="Image Profile" class="border-solid border-2 border-gray-600 shadow rounded-full" src="{{ asset('app/images/default_profile.png') }}">
                    @endif
                </div>
                <div class="ml-5">
                    <div class="w-auto sm:w-auto sm:whitespace-normal font-medium text-lg">{{ $provider->user->name }}</div>
                    <p class="text-gray-600">{{ strtoupper($provider->pvd_identity_type??'--') }}: {{ $provider->pvd_identity_num??'--' }}</p>
                    <p class="text-gray-600">{{ $provider->type->ref_description??'--' }} - {{ $provider->specialty->ref_description??'--' }}</p>
                </div>
            </div>

            <div class="flex flex-1 px-4 py-2 justify-center lg:justify-start lg:mt-0 border-l border-r border-gray-200 dark:border-dark-5 border-t lg:border-t-0 lg:pt-1">
                <div class="mt-2">
                    <div class=""><a href="mailto:{{ $provider->user->email }}">{{ $provider->user->email }}</a></div>
                    <div class="sm:whitespace-normal flex items-center mt-1">
                        <i data-feather="smartphone" class="w-4 h-4 mr-2"></i> {{ $provider->user->phone_mobile??'--' }}
                    </div>
                    <div class="sm:whitespace-normal flex items-center mt-1">
                        <i data-feather="phone-call" class="w-4 h-4 mr-2"></i> {{ $provider->user->phone??'--' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Profile Info -->

    <div class="grid grid-cols-12 gap-2">
        <!-- BEGIN: Information -->
        <div class="intro-y col-span-12 sm:col-span-8 lg:col-span-8 box mt-4">
            <div class="flex items-center px-5 py-2 border-b border-gray-200 dark:border-dark-5">
                <div class="mr-auto">
                    <h2 class="font-medium text-base mr-auto">
                        {{__('Identification')}}
                    </h2>
                </div>
                <div class="ml-auto">
                    {{__('Joined on')}} <span class="font-medium">{{ $provider->created_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>
            <div class="p-5">
                <div class="grid grid-cols-12 gap-2">
                    <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-4">
                        <div class="text-gray-600 text-xs">{{__('Type')}}</div>
                        <p class="font-medium">{{$provider->type->ref_description??'--'}}</p>
                    </div>
                    <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-4">
                        <div class="text-gray-600 text-xs">{{__('Specialty')}}</div>
                        <p class="font-medium">{{$provider->specialty->ref_description??'--'}}</p>
                    </div>
                    <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-4">
                        <div class="text-gray-600 text-xs">{{strtoupper($provider->pvd_doc_type??'--')}}</div>
                        <p class="font-medium">{{$provider->pvd_doc_num??'--'}}</p>
                    </div>

                    <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-4">
                        <div class="text-gray-600 text-xs">{{strtoupper($provider->pvd_identity_type??'--')}}</div>
                        <p class="font-medium">{{$provider->pvd_identity_num??'--'}}/{{$provider->pvd_identity_uf??'--'}}</p>
                    </div>

                    {{-- <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-2">
                        <div class="text-gray-600 text-xs">{{__('Use Logo')}}</div>
                        <p class="font-medium">{{($provider->pvd_logo_use?'Sim':'Não')??'--'}}</p>
                    </div> --}}

                    {{-- <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-2">
                        <div class="text-gray-600 text-xs">{{__('Use Signature')}}</div>
                        <p class="font-medium">{{($provider->pvd_signature_use?'Sim':'Não')??'--'}}</p>
                    </div> --}}

                    <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-4">
                        <div class="text-gray-600 text-xs">{{__('Mobile')}}</div>
                        <p class="font-medium">{{$provider->user->phone_mobile??'--'}}</p>
                    </div>

                    <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-4">
                        <div class="text-gray-600 text-xs">{{__('Phone')}}</div>
                        <p class="font-medium">{{$provider->user->phone??'--'}}</p>
                    </div>

                    <div class="bg-gray-100 rounded-sm px-2 py-1 col-span-12 sm:col-span-12 lg:col-span-6">
                        <div class="text-gray-600 text-xs">{{__('Address')}}</div>
                        <p class="font-medium">
                            {{$provider->pvd_street??'--'}} {{$provider->pvd_street_num??'--'}} {{$provider->pvd_street_complement??''}}
                            <p>{{$provider->pvd_neighborhood??'--'}} - {{$provider->pvd_city??'--'}}/{{$provider->pvd_state??'--'}} - {{$provider->pvd_postalcode??'--'}}</p>
                        </p>
                    </div>

                    <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-6">
                        <div class="text-gray-600 text-xs">{{__('Email')}}</div>
                        <p class="font-medium"><a href="mailto:{{$provider->user->email??'#'}}" target="_blank">{{$provider->user->email??'--'}}</a></p>
                    </div>

                </div>
            </div>
        </div>
        <!-- END: Information -->

        {{-- <!-- BEGIN: Bank -->
        <div class="intro-y col-span-12 sm:col-span-12 lg:col-span-4 lg:mt-4 box">
            <div class="flex items-center px-5 py-2 border-b border-gray-200 dark:border-dark-5">
                <div class="mr-auto">
                    <h2 class="font-medium text-base mr-auto">
                        {{__('Bank Information')}}
                    </h2>
                </div>
            </div>
            <div class="p-5">
                <div class="grid grid-cols-12 gap-2">
                    <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12">
                        <div class="text-gray-600 text-xs">{{__('Bank')}}</div>
                        <p class="font-medium">{{$provider->bank->ref_options??'--'}} - {{$provider->bank->ref_description??'--'}}</p>
                    </div>
                    <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12">
                        <div class="text-gray-600 text-xs">{{__('Agency')}}</div>
                        <p class="font-medium">{{$provider->bank_agency_num?str_pad($provider->bank_agency_num , 5 , '0' , STR_PAD_LEFT):' -- '}}-{{$provider->bank_agency_dv??' -- '}}</p>
                    </div>
                    <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12">
                        <div class="text-gray-600 text-xs">{{__('Account Type')}}</div>
                        <p class="font-medium">{{$provider->bankAccountType->ref_description??'--'}}</p>
                    </div>
                    <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12">
                        <div class="text-gray-600 text-xs">{{__('Account')}}</div>
                        <p class="font-medium">{{$provider->bank_account_num??' -- '}}-{{$provider->bank_account_dv??' -- '}}</p>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- END: Bank -->

        <!-- BEGIN: Logo -->
        {{-- <div class="intro-y col-span-12 sm:col-span-12 lg:col-span-4 lg:mt-4 box">
            <div class="flex items-center px-5 py-2 border-b border-gray-200 dark:border-dark-5">
                <div class="mr-auto">
                    <h2 class="font-medium text-base mr-auto">
                        {{__('Provider Logo')}}
                    </h2>
                </div>
            </div>
            <div class="p-5">
                <div class="p-5 text-center">
                    @if ($provider->pvd_logo)
                        <img alt="Customer Logo" class="rounded" src="{{asset('storage/'.$provider->pvd_logo)}}">
                    @else
                        {{__('No Image')}}
                    @endif
                </div>
            </div>
        </div> --}}
        <!-- END: Logo -->

        <!-- BEGIN: Singnature -->
        <div class="intro-y col-span-12 sm:col-span-12 lg:col-span-4 lg:mt-4 box">
            <div class="flex items-center px-5 py-2 border-b border-gray-200 dark:border-dark-5">
                <div class="mr-auto">
                    <h2 class="font-medium text-base mr-auto">
                        {{__('Provider Signature')}}
                    </h2>
                </div>
            </div>
            <div class="p-5">
                <div class="p-5 text-center">
                    @if ($provider->pvd_signature)
                        <img alt="Provider Signature Image" class="rounded" src="{{asset('storage/'.$provider->pvd_signature)}}">
                    @else
                        {{__('No Image')}}
                    @endif
                </div>
            </div>
        </div>
        <!-- END: Bank -->

    </div>

    <!-- BEGIN: Contract -->
    <div class="intro-y col-span-12 sm:col-span-12 lg:col-span-12 lg:mt-4 box p-5">
        <div class="relative flex items-center mb-4">
            <div class="mr-auto">
                <h2 class="font-medium text-base mr-auto">
                    {{__('Contracts')}}
                </h2>
            </div>
            <div class="dropdown">
                <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"> <i data-feather="more-vertical" class="w-5 h-5 text-gray-700 dark:text-gray-300"></i> </a>
                <div class="dropdown-box w-56">
                    <div class="dropdown-box__content box dark:bg-dark-1">
                        <div class="p-2">
                            <a href="{{ route('toManager.providerContract.create',['providerSlug'=>$provider->pvd_slug]) }}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="plus-circle" class="w-4 h-4 text-gray-700 dark:text-gray-300 mr-2"></i> {{__('New Contract')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table id="table" class="table table-report -mt-2 display">
                <thead>
                    <tr>
                        <th class="text-center whitespace-no-wrap">{{__('Status')}}</th>
                        <th class="whitespace-no-wrap">{{__('Contract')}}</th>
                        <th class="text-center whitespace-no-wrap">{{__('Type')}}</th>
                        <th class="text-center whitespace-no-wrap">{{__('Signing')}}</th>
                        <th class="text-center whitespace-no-wrap">{{__('Start')}}</th>
                        <th class="text-center whitespace-no-wrap">{{__('End')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($provider->ContractProvider as $item)
                        <tr class="intro-x shadow hover:shadow-lg">
                            <td class="">
                                <div class="flex items-center justify-center {{ $item->active ? 'text-theme-9' : 'text-theme-6' }}">
                                    <i data-feather="{{ $item->active?'activity':'slash'}}" class="w-4 h-4 mr-1"></i> {{$item->active?'Ativo':'Inativo'}}
                                </div>
                            </td>

                            <td class="text-left">
                                <a href="{{route('toManager.providerContract.show',[$item->contract_num])}}" class="flex items-center mr-3 font-medium whitespace-no-wrap">
                                    {{$item->contract_num}}
                                </a>
                            </td>
                            <td class="text-center">
                                {{$item->type->ref_description}}
                            </td>
                            <td class="text-left">
                                <p class="text-center text-xs whitespace-normal">{{$item->contract_date->format('d/m/Y')}}</p>
                            </td>
                            <td class="text-left">
                                <p class="text-center text-xs whitespace-normal">{{$item->contract_date_start->format('d/m/Y')}}</p>
                            </td>
                            <td class="text-left">
                                <p class="text-center text-xs whitespace-normal">{{$item->contract_date_end->format('d/m/Y')}}</p>
                            </td>
                        </tr>
                    @empty
                        {{-- <tr class="intro-x shadow rounded"><td colspan="8">{{__('No items registered in the database')}}</td></tr> --}}
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
    </div>
    <!-- END: Contract -->

@endsection

@section('script')
    <script>
        $('#table').DataTable({
            dom: '',
            language: dataOptionsLanguage, pageLength: 50,
            buttons: dataOptionsButtons,
            ordering: true,
            order: [],
        });

        if("{{$errors->any()??false}}")
        {
            // OPEN MODAL
            cash('#modal-provider-updatePwd').modal('show')
        }
    </script>
@endsection

<!-- -->
