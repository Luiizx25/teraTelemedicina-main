@extends('_layout.side-menu',[
    'title' => __('Contract Generate Cycles'),
    'useJquery' => true,
    'useInputmask' => true,
])

@section('subcontent')
    <div class="flex items-center">
        <div class="mr-auto">
            <h2 class="text-2xl font-medium my-2 mr-5 mt-2">{{__('Generate Cycles')}}</h2>
        </div>
    </div>
    <div class="grid grid-cols-12 gap-2 intro-y box p-2">
        <div class="col-span-12 lg:col-span-12 xxl:col-span-12 flex lg:block flex-col-reverse">
            <div class="relative flex items-between">
                <div class="mr-2">
                    <div class="font-medium text-base">{{$contract->customer->cus_name??'--'}}
                        @if ($contract->customer->cus_name_company)
                            <div class="text-gray-600 text-sm">{{$contract->customer->cus_name_company}}</div>
                        @endif
                    </div>
                    <p class="inline-block text-xs text-white px-1 bg-theme-1 rounded">{{__('Customer')}} {{$contract->customer->id}}</span>
                </div>
                <div class="ml-auto">
                    <div class="w-16 h-16 image-cover">
                        @empty($contract->customer->cus_logo)
                            <img class="rounded" src="{{asset('/app/images/default_profile.png')}}">
                        @else
                            <img class="rounded" src="{{asset('storage/' . $contract->customer->cus_logo)}}">
                        @endempty
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="intro-y box mt-3">
        <div class="flex items-center px-5 py-2 border-b border-gray-200 dark:border-dark-5">
            <div class="mr-auto">
                <h2 class="font-medium text-base mr-auto">
                    {{__('Contract Information')}}
                </h2>
            </div>
        </div>
        <div class="grid grid-cols-12 gap-4 px-5 py-2">

            <div class="intro-y col-span-12 lg:col-span-4 sm:col-span-12">
                <div class="text-gray-600 text-xs">{{__('Contract Number')}}</div>
                <div class="font-medium">{{$contract->contract_num}}</div>
            </div>

            <div class="intro-y col-span-12 lg:col-span-2 sm:col-span-12">
                <div class="text-gray-600 text-xs">{{__('Signing Date')}}</div>
                <span class="font-medium">{{ $contract->contract_date->format('d/m/Y') }}</span>
            </div>

            <div class="intro-y col-span-12 lg:col-span-4 sm:col-span-12">
                <div class="text-gray-600 text-xs">{{__('Validity')}}</div>
                <span class="text-gray-600">{{ __('From')}}</span>
                <span class="font-medium">{{ $contract->contract_date_start->format('d/m/Y') }}</span>
                <span class="text-gray-600">{{ __('to')}}</span>
                <span class="font-medium">{{ $contract->contract_date_end->format('d/m/Y') }}</span>
            </div>

        </div>
    </div>

    <div class="flex items-center px-2 mt-4">
        <div class="mr-auto">
            <h2 class="font-medium text-base mr-auto">
                {{__('Billing Cycles')}}
            </h2>
        </div>
    </div>

    <div class="intro-y inbox mt-4">
        <div class="overflow-x-auto sm:overflow-x-visible accordion">
            @empty($cycles)
                <h2>{{__('No Cycles')}}</h2>
            @else
            <form action="{{route('toManager.customerContractCusCycle.store')}}" method="post">
                @csrf
                <input type="hidden" name="contract_id" value="{{$contract->id}}">

                @foreach ($cycles as $cycle => $cycleValues)
                    <input type="hidden" name="cycle[{{$cycle}}][cycle_slug]" value="{{$cycleValues['cycleSlug']}}">
                    <input type="hidden" name="cycle[{{$cycle}}][cycle_month]" value="{{$cycleValues['cycleMonth']}}">
                    <input type="hidden" name="cycle[{{$cycle}}][cycle_year]" value="{{$cycleValues['cycleYear']}}">
                    <input type="hidden" name="cycle[{{$cycle}}][cycle_date_start]" value="{{$cycleValues['cycleDateStart']}}">
                    <input type="hidden" name="cycle[{{$cycle}}][cycle_date_end]" value="{{$cycleValues['cycleDateEnd']}}">
                    <div class="">
                        {{-- <div class="accordion__pane inbox__item inbox__item--active inline-block sm:block text-gray-700 dark:text-gray-500 bg-gray-100 dark:bg-dark-1 border-b border-gray-200 dark:border-dark-1"> --}}
                        <div class="mb-2 inline-block sm:block text-gray-700 dark:text-gray-500 border border-gray-400 dark:border-dark-1 bg-white shadow rounded">

                            <div class="flex px-5 py-3 bg-gray-200 border">
                                <div class="w-24 flex-none flex items-center mr-10">
                                    <input id="cycle[{{$cycle}}][register]" name="cycle[{{$cycle}}][register]" class="input flex-none border border-gray-500" type="checkbox" checked="">
                                    <div class="inbox__item--sender truncate ml-3">{{$cycle}}</div>
                                </div>

                                <div class="w-40 flex-none flex items-center mr-10">
                                    <div class="inbox__item--highlight truncate ml-3">{{ __($cycleValues['cycleName'])??'--'}}/{{$cycleValues['cycleYear']??'--'}}</div>
                                </div>

                                <div class="w-64 sm:w-auto truncate inbox__item--highlight">
                                    {{__('From')}} {{$cycleValues['cycleDateStart']??'--'}} {{__('to')}} {{$cycleValues['cycleDateEnd']??'--'}}
                                </div>

                                <div class="inbox__item--time whitespace-no-wrap ml-auto pl-10">
                                    {{-- <a href="javascript:;" class="accordion__pane__toggle">
                                        <i data-feather="edit" class="w-5 h-5 text-gray-700 dark:text-gray-300"></i>
                                    </a> --}}
                                </div>
                            </div>

                            {{-- <div class="accordion__pane__content px-2 pb-2"> --}}
                            <div class="p-2 pb-2">
                                @forelse ($contract->contractService as $contractService)
                                    <div class="grid grid-cols-12 gap-2 flex m-2 bg-gray-200 rounded-sm">

                                        <input type="hidden" name="cycle[{{$cycle}}][services][{{$contractService->service_id}}][service_id]" value="{{$contractService->service_id}}">

                                        <div class="col-span-12 sm:col-span-12 lg:col-span-4 px-3 py-2">
                                            <p class="text-gray-600 text-xs">{{$contractService->service->type->ref_description}} | {{$contractService->service->category->ref_description}}</p>
                                            <p class="font-medium">{{$contractService->service->service_name}}</p>
                                        </div>

                                        <div class="mt-1 col-span-2 sm:col-span-4 lg:col-span-1">
                                            <div class="text-gray-600 text-xs">{{__('Amount')}}</div>
                                            <select id="cycle[{{$cycle}}][services][{{$contractService->service_id}}][cycle_amount_negotiated]" name="cycle[{{$cycle}}][services][{{$contractService->service_id}}][cycle_amount_negotiated]" class="input-sm w-full border py-1" aria-required="" required>
                                                @foreach (range(1, 1000) as $number)
                                                    <option value="{{$number}}" @if (old('cycle[{{$cycle}}][services][{{$contractService->service_id}}][cycle_amount_negotiated]',$contractService->service_negotiated_amount) == $number) selected @endif >{{$number}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mt-1 col-span-2 sm:col-span-4 lg:col-span-2">
                                            <div class="text-gray-600 text-xs">{{__('Value')}}</div>
                                            <div class="relative">
                                                <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 dark:bg-dark-1 dark:border-dark-4 border text-gray-600">R$</div>
                                                <input type="text" id="cycle[{{$cycle}}][services][{{$contractService->service_id}}][cycle_negotiated_price]" name="cycle[{{$cycle}}][services][{{$contractService->service_id}}][cycle_negotiated_price]" value="{{old('cycle_negotiated_price',$contractService->service_negotiated_price)}}" class="input-sm pl-12 pt-1 w-full border col-span-4" />
                                            </div>
                                        </div>

                                        <div class="mt-1 col-span-2 sm:col-span-4 lg:col-span-2">
                                            <div class="text-gray-600 text-xs">{{__('Value Over')}}</div>
                                            <div class="relative">
                                                <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 dark:bg-dark-1 dark:border-dark-4 border text-gray-600">R$</div>
                                                <input type="text" id="cycle[{{$cycle}}][services][{{$contractService->service_id}}][cycle_negotiated_price_over]" name="cycle[{{$cycle}}][services][{{$contractService->service_id}}][cycle_negotiated_price_over]" value="{{old('cycle_negotiated_price_over',$contractService->service_negotiated_price_over)}}" class="input-sm pl-12 pt-1 w-full border col-span-4" />
                                            </div>
                                        </div>

                                        <div class="mt-1 col-span-2 sm:col-span-4 lg:col-span-2">
                                            <div class="text-gray-600 text-xs">{{__('Time')}}</div>
                                            <input type="time" id="cycle[{{$cycle}}][services][{{$contractService->service_id}}][cycle_time_estimated]" name="cycle[{{$cycle}}][services][{{$contractService->service_id}}][cycle_time_estimated]" value="{{old('cycle_time_estimated',$contractService->service_negotiated_time_estimated)}}" class="input-sm px-2 pt-1 w-50 border" aria-required="" required>
                                        </div>
                                    </div>
                                @empty
                                    <h3>{{__('No Service this Cycle')}}</h3>
                                @endforelse
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="p-4 flex flex-col sm:flex-row items-center text-center sm:text-left text-gray-600">
                    <div class="sm:ml-auto mt-2 sm:mt-0 dark:text-gray-300">
                        <button class="button w-auto justify-center block bg-theme-1 text-white ml-2">{{__('Generate Cycles')}}</button>
                    </div>
                </div>

            </form>
            @endempty
        </div>
    </div>

@endsection

@section('script')
    <script>



    </script>
@endsection
