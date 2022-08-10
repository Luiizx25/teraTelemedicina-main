@extends('_layout.side-menu',[
    'title' => __('System Admin'),
    'useJquery' => true,
    'useDataTable' => true,
    'useInputmask' => true,
])


@section('subcontent')

    <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">

        <!-- BEGIN: Ticket -->
        @php
            switch (session('tabActive')) {
                case 'system_users':
                    $details = null;
                    $system_users = 'active';
                    break;
                default:
                    $details = 'active';
                    $system_users = null;
            }
        @endphp

        <div class="col-span-12 lg:col-span-12">
            <div class="intro-y pr-1">
                <div class="box p-2">
                    <div class="pos__tabs nav-tabs justify-center flex">
                        <a data-toggle="tab" data-target="#details" href="javascript:;" class="{{$details}} flex-1 py-2 rounded-md text-center">{{__('Details')}}</a>
                        <a data-toggle="tab" data-target="#system_users" href="javascript:;" class="{{$system_users}} flex-1 py-2 rounded-md text-center">{{__('System Users')}}</a>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <!-- -->
                <div class="tab-content__pane {{$details}}" id="details">
                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2 px-4">
                        <div class="mr-auto">
                            <h2 class="text-2xl font-medium mr-5">{{__('Details')}}</h2>
                        </div>
                    </div>
                    <div class="box p-5 mt-2">

                        <div class="flex items-center border-b dark:border-dark-5 pb-5">
                            <div class="">
                                <div class="text-gray-600">{{__('System Users')}}</div>
                                <div>{{ $customerSys->user->count() - 1 }}</div>
                            </div>
                            <i data-feather="users" class="w-4 h-4 text-gray-600 ml-auto"></i>
                        </div>

                        <div class="flex items-center border-b dark:border-dark-5 py-5">
                            <div class="">
                                <div class="text-gray-600">{{__('Customers')}}</div>
                                <div>{{ $customerSys->customer->count() }}</div>
                            </div>
                            <i data-feather="users" class="w-4 h-4 text-gray-600 ml-auto"></i>
                        </div>

                        <div class="flex items-center border-b dark:border-dark-5 py-5">
                            <div class="">
                                <div class="text-gray-600">{{__('Providers')}}</div>
                                <div>{{ $customerSys->provider->count() }}</div>
                            </div>
                            <i data-feather="users" class="w-4 h-4 text-gray-600 ml-auto"></i>
                        </div>

                    </div>
                </div>
                <!-- -->
                <div class="tab-content__pane {{$system_users}}" id="system_users">
                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2 px-4">
                        <div class="mr-auto">
                            <h2 class="text-2xl font-medium mr-5">{{__('Users')}}</h2>
                        </div>
                        <div class="ml-auto">
                            <a href="javascript:;" id="btn-service-open-modal" data-toggle="modal" data-target="#modal-system-user-add" class="button-sm py-1 px-2 rounded inline-block bg-theme-1 text-white">
                                <div class="flex items-center justify-center text-white">
                                    <i data-feather="plus-square" class="flex w-4 h-4 mr-1 text-white"></i> {{__('Add')}}
                                </div>
                            </a>
                        </div>
                        <!-- MODAL -->
                        <div class="modal" id="modal-system-user-add">
                            <div class="modal__content modal__content--xl">
                                <form id="form_service_add" action="{{route('toManager.UserCustomerSys.store')}}" method="post">
                                    @csrf
                                    <div class="intro-y col-span-12 sm:col-span-12 lg:col-span-4 box shadow-md border border-solid border-gray-300">
                                        <div class="flex items-center px-5 py-2 border-b border-gray-200 dark:border-dark-5">
                                            <div class="mr-auto">
                                                <h2 class="font-medium text-base mr-auto">{{__('Add System User')}}</h2>
                                            </div>
                                            @if (session('service_error'))
                                            <div class="mt-2 px-2 py-1 bg-theme-6 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                                                <span class="flex rounded-full bg-indigo-100 text-theme-6 uppercase px-2 py-1 text-xs font-bold mr-3">Ops!</span>
                                                <span class="font-semibold mr-2 text-left flex-auto">{{ __(session('service_error')) }}</span>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="p-5">
                                            <div class="grid grid-cols-12 gap-2">
                                                <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-12">
                                                    <label class="mb-2">{{__('Active')}}</label>
                                                    <select id="active" name="active" class="input w-full border flex-1" aria-required="" required>
                                                        <option value="" selected>--</option>
                                                        <option value="1" @if (old('active') == strval(1)) selected @endif>Sim</option>
                                                        <option value="0" @if (old('active') == strval(0)) selected @endif>Não</option>
                                                    </select>
                                                    @error('active')
                                                    <div id="" class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                                    @enderror
                                                </div>
                                                <div class="intro-y col-span-12 lg:col-span-5 sm:col-span-12">
                                                    <label class="mb-2">{{__('Name')}}</label>
                                                    <input id="input_name" name="name" type="text" class="input w-full border col-span-4 @error('name') border-theme-6 @enderror" placeholder="{{__('Name')}}" value="{{old('name')}}" required>
                                                    @error('name')
                                                    <div id="error-name" class="name__input-error w-5/6 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                                    @enderror
                                                </div>
                                                <div class="intro-y col-span-12 lg:col-span-4 sm:col-span-12">
                                                    <label class="mb-2">{{__('Email')}}</label>
                                                    <input id="input_email" name="email" type="email" class="input w-full border @error('email') border-theme-6 @enderror" placeholder="{{__('Email')}}" value="{{old('email')}}" required>
                                                    @error('email')
                                                    <div id="error-email" class="email__input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-12 gap-2 mt-4">
                                                <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-6">
                                                    <label class="mb-2">{{__('Mobile')}}</label>
                                                    <input id="input_phone_mobile" name="phone_mobile" type="text" class="input w-full border @error('phone_mobile') border-theme-6 @enderror" placeholder="{{__('Phone Mobile')}}" value="{{old('phone_mobile')}}" required>
                                                    @error('phone_mobile')
                                                    <div id="error-name" class="phone_mobile__input-error w-5/6 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                                    @enderror
                                                </div>
                                                <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-6">
                                                    <label class="mb-2">{{__('Phone')}}</label>
                                                    <input id="input_phone" name="phone" type="text" class="input w-full border @error('phone') border-theme-6 @enderror" placeholder="{{__('Phone')}}" value="{{old('phone')}}" required>
                                                    @error('phone')
                                                    <div id="error-name" class="phone_mobile__input-error w-5/6 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                                    @enderror
                                                </div>
                                                <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-6">
                                                    <label class="mb-2">{{__('Password')}}</label>
                                                    <input id="input_password" name="password" type="password" class="input w-full border col-span-4 @error('password') border-theme-6 @enderror" placeholder="{{__('New Password')}}" value="" required>
                                                    @error('password')
                                                        <div id="error-current-password" class="password__input-error w-5/6 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                                    @enderror
                                                </div>
                                                <div class="intro-y col-span-12 lg:col-span-3 sm:col-span-6">
                                                    <label class="mb-2">{{__('Confirm Password')}}</label>
                                                    <input id="input_password-confirmation" name="password_confirmation" type="password" class="input w-full border col-span-4" placeholder="{{__('Confirm New Password')}}" value="" required>
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-12 gap-2 mt-4">
                                                <div class="intro-y col-span-12 lg:col-span-12 sm:col-span-12">
                                                    <label class="mb-2 w-48">{{__('Admin Permissions')}}</label>
                                                    <div class="flex flex-col sm:flex-row mt-2">
                                                        <div class="flex items-center text-gray-700 mr-2"> <input type="checkbox" value="1" name="admin_system" class="input border mr-2" id="checkbox_admin_system">
                                                            <label class="flex cursor-pointer select-none" for="checkbox_admin_system"> <i data-feather="settings" class="w-4 h-4 mr-1"></i>{{__('system')}}</label>
                                                        </div>
                                                        <div class="flex items-center text-gray-700 mr-2 mt-2 sm:mt-0"> <input type="checkbox" value="1" name="admin_customer" class="input border mr-2" id="checkbox_admin_customer">
                                                            <label class="flex cursor-pointer select-none" for="checkbox_admin_customer"> <i data-feather="briefcase" class="w-4 h-4 mr-1"></i>{{__('customers')}}</label>
                                                        </div>
                                                        <div class="flex items-center text-gray-700 mr-2 mt-2 sm:mt-0"> <input type="checkbox" value="1" name="admin_provider" class="input border mr-2" id="checkbox_admin_provider">
                                                            <label class="flex cursor-pointer select-none" for="checkbox_admin_provider"> <i data-feather="pen-tool" class="w-4 h-4 mr-1"></i>{{__('providers')}}</label>
                                                        </div>
                                                        <div class="flex items-center text-gray-700 mr-2 mt-2 sm:mt-0"> <input type="checkbox" value="1" name="admin_patient" class="input border mr-2" id="checkbox_admin_patient">
                                                            <label class="flex cursor-pointer select-none" for="checkbox_admin_patient"> <i data-feather="smile" class="w-4 h-4 mr-1"></i>{{__('patients')}}</label>
                                                        </div>
                                                        <div class="flex items-center text-gray-700 mr-2 mt-2 sm:mt-0"> <input type="checkbox" value="1" name="admin_financial" class="input border mr-2" id="checkbox_admin_financial">
                                                            <label class="flex cursor-pointer select-none" for="checkbox_admin_financial"> <i data-feather="dollar-sign" class="w-4 h-4 mr-1"></i>{{__('financial')}}</label>
                                                        </div>
                                                        <div class="flex items-center text-gray-700 mr-2 mt-2 sm:mt-0"> <input type="checkbox" value="1" name="admin_billing" class="input border mr-2" id="checkbox_admin_billing">
                                                            <label class="flex cursor-pointer select-none" for="checkbox_admin_billing"> <i data-feather="zap" class="w-4 h-4 mr-1"></i>{{__('billing')}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-12 gap-2 mt-4">
                                                <div class="intro-y col-span-12 mt-2 text-right">
                                                    <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1">{{__('Cancel')}}</button>
                                                    <button class="button bg-theme-1 text-white">{{__('Add User')}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- MODAL -->
                    </div>
                    <div class="box p-4 mt-2">
                        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                            <table id="tableSystemUsers" class="table table-report -mt-4 display">
                                <thead>
                                    <tr>
                                        <th class="text-center whitespace-no-wrap">{{__('Status')}}</th>
                                        <th class="whitespace-no-wrap">{{__('Name')}}</th>
                                        <th class="whitespace-no-wrap">{{__('Email')}}</th>
                                        <th class="text-center whitespace-no-wrap">{{__('Registred in')}}</th>
                                        <th class="text-center whitespace-no-wrap" title="{{__('system')}}"><i data-feather="settings" class="w-4 h-4 mr-1"></i> <span class="sr-only">{{__('system')}}</span> </th>
                                        <th class="text-center whitespace-no-wrap" title="{{__('customers')}}"><i data-feather="briefcase" class="w-4 h-4 mr-1"></i> <span class="sr-only">{{__('customers')}}</span> </th>
                                        <th class="text-center whitespace-no-wrap" title="{{__('providers')}}"><i data-feather="pen-tool" class="w-4 h-4 mr-1"></i> <span class="sr-only">{{__('providers')}}</span> </th>
                                        <th class="text-center whitespace-no-wrap" title="{{__('patients')}}"><i data-feather="smile" class="w-4 h-4 mr-1"></i> <span class="sr-only">{{__('patients')}}</span> </th>
                                        <th class="text-center whitespace-no-wrap" title="{{__('financial')}}"><i data-feather="dollar-sign" class="w-4 h-4 mr-1"></i> <span class="sr-only">{{__('financial')}}</span> </th>
                                        <th class="text-center whitespace-no-wrap" title="{{__('billing')}}"><i data-feather="zap" class="w-4 h-4 mr-1"></i> <span class="sr-only">{{__('billing')}}</span> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($customerSys->user as $user)
                                        @if ($user->id < 1000)
                                            @continue
                                        @endif
                                        {{--  --}}
                                        <tr class="intro-x shadow hover:shadow-lg hover:text-yellow-700">
                                            <td class="" title="{{$user->active?'Ativo':'Inativo'}}">
                                                <div class="flex items-center justify-center {{ $user->active ? 'text-theme-9' : 'text-theme-6' }}" title="{{$user->active?'Ativo':'Inativo'}}">
                                                    <i data-feather="{{ $user->active?'activity':'slash'}}" class="w-4 h-4 mr-1"></i>
                                                </div>
                                            </td>
                                            <td class="text-left">
                                                @if ($user->id == Auth::user()->id)
                                                    <a href="#" class="cursor-not-allowed"><p class="font-medium">{{$user->name}}</p></a>
                                                @else
                                                    <a href="{{route('toManager.UserCustomerSys.edit',['UserCustomerSy'=>$user->email])}}"><p class="font-medium">{{$user->name}}</p></a>
                                                @endif
                                            </td>
                                            <td class="text-left">
                                                {{$user->email}}
                                            </td>
                                            <td class="text-center">
                                                <p class="text-center text-xs whitespace-normal">{{$user->created_at->format('d/m/Y H:i')}}</p>
                                            </td>
                                            <td class="text-center" title="{{ $user->admin_system?'Sim':'Não'}}">
                                                @if($user->admin_system) X @else <i data-feather="minus" class="w-4 h-4 ml-3"></i> @endif
                                            </td>
                                            <td class="text-center" title="{{ $user->admin_customer?'Sim':'Não'}}">
                                                @if($user->admin_customer) X @else <i data-feather="minus" class="w-4 h-4 ml-3"></i> @endif
                                            </td>
                                            <td class="text-center" title="{{ $user->admin_provider?'Sim':'Não'}}">
                                                @if($user->admin_provider) X @else <i data-feather="minus" class="w-4 h-4 ml-3"></i> @endif
                                            </td>
                                            <td class="text-center" title="{{ $user->admin_patient?'Sim':'Não'}}">
                                                @if($user->admin_patient) X @else <i data-feather="minus" class="w-4 h-4 ml-3"></i> @endif
                                            </td>
                                            <td class="text-center" title="{{ $user->admin_financial?'Sim':'Não'}}">
                                                @if($user->admin_financial) X @else <i data-feather="minus" class="w-4 h-4 ml-3"></i> @endif
                                            </td>
                                            <td class="text-center" title="{{ $user->admin_billing?'Sim':'Não'}}">
                                                @if($user->admin_billing) X @else <i data-feather="minus" class="w-4 h-4 ml-3"></i> @endif
                                            </td>
                                        </tr>
                                    @empty
                                        {{-- <tr class="intro-x shadow rounded"><td colspan="8">{{__('No items registered in the database')}}</td></tr> --}}
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- -->
            </div>
        </div>
        <!-- END: Ticket -->
    </div>

@endsection

@section('script')
    <script>
        $(document).ready( function () {
            $('#tableSystemUsers').DataTable({
                dom: 'Bfrtip',
                language: dataOptionsLanguage, pageLength: 50,
                buttons: dataOptionsButtons,
                bAutoWidth: true,
                ordering: true,
                order: [],
            });
        } );

        mobile.mask(input_phone_mobile);
        phone.mask(input_phone);

        if("{{$errors->any()??false}}")
        {
            // OPEN MODAL
            cash('#modal-system-user-add').modal('show')
        }
    </script>
@endsection
