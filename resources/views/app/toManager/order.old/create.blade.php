@extends('_layout.side-menu',[
    'title' => 'New Order',
    'useJquery' => true,
    'useInputmask' => true,
    'useMaskMoney' => true,
    'useDataTable' => true,
    'useToastr' => true,
    'ckeditor' => true,
])

@section('subcontent')
    <!-- BEGIN: Content -->
    <div class="flex items-center mt-2">
        <h2 class="intro-y text-2xl font-medium mr-auto">
            {{__('New Order')}}
        </h2>
    </div>
    <!-- -->
    <div class="intro-y box p-2 mt-2">
        <div class="grid grid-cols-12 gap-2">
            <div class="intro-y col-span-12 lg:col-span-6">
                <div class="flex flex-1 items-center justify-center lg:justify-start">
                    <div class="m-2">
                        <div class="w-20 h-20 image-fit">
                            @empty($customer->cus_logo)
                            <img class="rounded" src="{{asset('/app/images/default_profile.png')}}">
                            @else
                            <img class="rounded" src="{{asset('storage/' . $customer->cus_logo)}}">
                            @endempty
                        </div>
                    </div>
                    <div class="mr-auto">
                        <div class="font-medium text-base">{{$customer->cus_name??'--'}}
                            @if ($customer->cus_name_company)
                                <p class="text-gray-600 text-xs">{{$customer->cus_name_company}}</p>
                            @endif
                        </div>
                        <p class="text-xs">{{ strtoupper($customer->cus_doc_type) }} {{$customer->cus_doc_num}}</p>
                        <p class="inline-block text-xs text-white px-1 bg-theme-1 rounded">{{__('Customer')}} {{$customer->id}}</p>
                    </div>
                </div>
            </div>
            <div class="intro-y col-span-12 lg:col-span-6 p-2">
                <!-- -->
                <div class="intro-y col-span-12 lg:col-span-6">
                    @include('app.toCustomer._inc.wizard-steps')
                </div>
                <!-- -->
            </div>
        </div>
        <!-- -->
        <div class="intro-y flex flex-col sm:flex-row items-center p-2 mx-2">
            <h2 class="text-2xl font-medium mr-auto">
                {{__('Patient Informations')}}
            </h2>
        </div>
        <!-- -->
        <div class="intro-y p-2 mx-2">
            <form id="thisForm" action="{{route('toCustomer.order.store')}}" method="post">
                @csrf
                <input type="hidden" name="type_id" value="0">
                <input type="hidden" name="status_id" value="0">
                <input type="hidden" name="patient_id" value="0">
                <input type="hidden" name="id_control" value="{{ old('id_control',$idControle) }}">
                <div class="">
                    <!-- -->
                    <div class="grid grid-cols-12 gap-4">
                        <div class="intro-y col-span-12 md:col-span-4 lg:col-span-3">
                            <label>{{__('Document')}}</label>
                            <div class="relative">
                                <div class="absolute top-0 left-0 rounded-l w-20 h-full flex items-center justify-center bg-gray-100 dark:bg-dark-1 dark:border-dark-4 border text-gray-600">CPF</div>
                                <input id="pat_doc_type" name="pat_doc_type" value="CPF" type="hidden">
                                <div class="pl-3">
                                    <input id="pat_doc_num" name="pat_doc_num" value="{{ old('pat_doc_num') }}" type="text" class="input pl-20 w-full border col-span-3" placeholder="" aria-required111="" required111>
                                </div>
                            </div>
                            @error('pat_doc_num')
                            <div class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                            @enderror
                        </div>
                        <div class="intro-y col-span-6 md:col-span-4 lg:col-span-3">
                            <label>{{__('Identity')}}</label>
                            <input id="pat_identity_num" name="pat_identity_num" value="{{ old('pat_identity_num') }}" type="text" class="input order-none sm:order-2 w-full border flex-1" placeholder="" aria-required111="" required111>
                            @error('pat_identity_num')
                            <div class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                            @enderror
                        </div>

                        <div class="intro-y col-span-6 md:col-span-4 lg:col-span-2">
                            <label>{{__('Emitter')}}</label>
                            <input id="pat_identity_emitting" name="pat_identity_emitting" value="{{ old('pat_identity_emitting') }}" type="text" class="input order-none sm:order-2 w-full border flex-1" placeholder="" aria-required111="" required111>
                            @error('pat_identity_emitting')
                            <div class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                            @enderror
                        </div>
                    </div>
                    <!-- -->
                    <div class="grid grid-cols-12 gap-4 border-t mt-4 pt-4">

                        <div class="intro-y col-span-12 lg:col-span-4">
                            <label>{{__('Name')}}</label>
                            <input id="pat_name" name="pat_name" value="{{ old('pat_name') }}" type="text" class="input order-none sm:order-2 w-full border flex-1" placeholder="" aria-required111="" required111>
                            @error('pat_name')
                            <div class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                            @enderror
                        </div>

                        <div class="intro-y col-span-12 lg:col-span-3">
                            <label>{{__('Email')}}</label>
                            <input id="pat_email" name="pat_email" value="{{ old('pat_email') }}" type="text" class="input order-none sm:order-2 w-full border flex-1" placeholder="" aria-required111="" required111>
                            @error('pat_email')
                            <div class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                            @enderror
                        </div>

                        <div class="intro-y col-span-6 lg:col-span-3">
                            <label>{{__('Date of Birth')}}</label>
                            <input id="pat_date_birth" name="pat_date_birth" value="{{ old('pat_date_birth') }}" type="date" class="input order-none sm:order-2 w-full border flex-1" placeholder="" aria-required111="" required111>
                            @error('pat_date_birth')
                            <div class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                            @enderror
                        </div>

                        <div class="intro-y col-span-6 lg:col-span-2">
                            <label>{{__('Genre')}}</label>
                            <select id="pat_genre" name="pat_genre" class="input w-full border flex-1" aria-required="" required>
                                <option value="" selected>--</option>
                                <option value="Feminino" @if (old('pat_genre') == 'Feminino') selected @endif>Feminino</option>
                                <option value="Masculino" @if (old('pat_genre') == 'Masculino') selected @endif>Masculino</option>
                            </select>
                            @error('pat_genre')
                            <div class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                            @enderror
                        </div>

                        <div class="intro-y col-span-6 lg:col-span-2">
                            <label>{{__('Mobile')}}</label>
                            <input id="pat_phone_mobile" name="pat_phone_mobile" value="{{ old('pat_phone_mobile') }}" type="text" class="input order-none sm:order-2 w-full border flex-1" placeholder="" aria-required111="" required111>
                            @error('pat_phone_mobile')
                            <div class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                            @enderror
                        </div>

                        <div class="intro-y col-span-6 lg:col-span-2">
                            <label>{{__('Phone')}}</label>
                            <input id="pat_phone" name="pat_phone" value="{{ old('pat_phone') }}" type="text" class="input order-none sm:order-2 w-full border flex-1" placeholder="" aria-required111="" required111>
                            @error('pat_phone')
                            <div class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                            @enderror
                        </div>

                    </div>
                    <!-- -->
                    <div class="grid grid-cols-12 gap-4 border-t mt-4 pt-4">

                        <div class="intro-y col-span-4 lg:col-span-2">
                            <label>{{__('Postal Code')}}</label>
                            <input id="pat_postalcode" name="pat_postalcode" value="{{ old('pat_postalcode') }}" type="text" class="input order-none sm:order-2 w-full border flex-1" placeholder="" aria-required111="" required111>
                            @error('pat_postalcode')
                            <div class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                            @enderror
                        </div>

                        <div class="intro-y col-span-8 lg:col-span-4">
                            <label>{{__('Address')}}</label>
                            <input id="pat_street" name="pat_street" value="{{ old('pat_street') }}" type="text" class="input order-none sm:order-2 w-full border flex-1" placeholder="" aria-required111="" required111>
                            @error('pat_street')
                            <div class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                            @enderror
                        </div>

                        <div class="intro-y col-span-4 lg:col-span-1">
                            <label>{{__('Number')}}</label>
                            <input id="pat_street_num" name="pat_street_num" value="{{ old('pat_street_num') }}" type="text" class="input order-none sm:order-2 w-full border flex-1" placeholder="" aria-required111="" required111>
                            @error('pat_street_num')
                            <div class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                            @enderror
                        </div>

                        <div class="intro-y col-span-8 lg:col-span-3">
                            <label>{{__('Complement')}}</label>
                            <input id="pat_street_complement" name="pat_street_complement" value="{{ old('pat_street_complement') }}" type="text" class="input order-none sm:order-2 w-full border flex-1" placeholder="">
                            @error('pat_street_complement')
                            <div class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                            @enderror
                        </div>

                        <div class="intro-y col-span-4 lg:col-span-2">
                            <label>{{__('Neighborhood')}}</label>
                            <input id="pat_street_neighborhood" name="pat_street_neighborhood" value="{{ old('pat_street_neighborhood') }}" type="text" class="input order-none sm:order-2 w-full border flex-1" placeholder="" aria-required111="" required111>
                            @error('pat_street_neighborhood')
                            <div class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                            @enderror
                        </div>

                        <div class="intro-y col-span-6 lg:col-span-2">
                            <label>{{__('City')}}</label>
                            <input id="pat_city" name="pat_city" value="{{ old('pat_city') }}" type="text" class="input order-none sm:order-2 w-full border flex-1" placeholder="" aria-required111="" required111>
                            @error('pat_city')
                            <div class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                            @enderror
                        </div>

                        <div class="intro-y col-span-2 lg:col-span-1">
                            <label>{{__('State')}}</label>
                            <input id="pat_state" name="pat_state" value="{{ old('pat_state') }}" type="text" class="input order-none sm:order-2 w-full border flex-1" placeholder="" aria-required111="" required111>
                            @error('pat_state')
                            <div class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                            @enderror
                        </div>

                    </div>
                    <!-- -->
                    <div class="grid grid-cols-12 gap-4 border-t mt-4 pt-4">

                        <div class="intro-y col-span-12 lg:col-span-4">
                            <label>{{__('Work Company')}}</label>
                            <input id="pat_work_company" name="pat_work_company" value="{{ old('pat_work_company') }}" type="text" class="input order-none sm:order-2 w-full border flex-1" placeholder="" aria-required111="" required111>
                            @error('pat_work_company')
                            <div class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                            @enderror
                        </div>

                        <div class="intro-y col-span-12 lg:col-span-4">
                            <label>{{__('Work Position')}}</label>
                            <input id="pat_work_position" name="pat_work_position" value="{{ old('pat_street_num') }}" type="text" class="input order-none sm:order-2 w-full border flex-1" placeholder="" aria-required111="" required111>
                            @error('pat_work_position')
                            <div class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                            @enderror
                        </div>

                        <div class="intro-y col-span-6 lg:col-span-2">
                            <label>{{__('Weight')}}</label>
                            <input id="pat_weight" name="pat_weight" value="{{ old('pat_weight') }}" type="text" class="input order-none sm:order-2 w-full border flex-1" placeholder="">
                            @error('pat_weight')
                            <div class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                            @enderror
                        </div>

                        <div class="intro-y col-span-6 lg:col-span-2">
                            <label>{{__('Height')}}</label>
                            <input id="pat_height" name="pat_height" value="{{ old('pat_height') }}" type="text" class="input order-none sm:order-2 w-full border flex-1" placeholder="">
                            @error('pat_height')
                            <div class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 lg:col-span-12">
                            <label>{{__('Patient Comments')}}</label>
                            <div class="mt-2">
                                <!--textarea class="ckeditor" name="pat_comments" id="pat_comments">{{old('pat_comments')}}</textarea-->
                                <input id="pat_comments" name="pat_comments" value="{{ old('pat_comments') }}" type="text" class="input order-none sm:order-2 w-full border flex-1" placeholder="">
                                @error('pat_comments')
                                <div class="input-error col-span-7 text-theme-6 mt-2"><strong>{{ __($message) }}</strong></div>
                                @enderror
                             </div>
                        </div>

                    </div>
                    <!-- -->
                    <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                        <button type="submit" class="button w-24 justify-center block bg-theme-1 text-white ml-2">{{__('Next')}}</button>
                    </div>
                    <!-- -->
                </div>
            </form>
        </div>
        <!-- -->
    </div>
@endsection


@section('script')
    <script>
        cash('#pat_doc_num').on('blur', function()
        {
            let docType = cash('#pat_doc_type').val();
            let docNum  = cash('#pat_doc_num').val();

            if(docNum == '')
            {
                alert('Número do documento deve ser preenchido!')
                return;
            }

            $("#thisForm").trigger("reset");

            cash('#pat_doc_type').val(docType);
            cash('#pat_doc_num').val(docNum);

            if(confirm('Confirma Número do documento? '+docType+': '+docNum))
            {
                console.log("docType/docNum");
                console.log(docType+'/'+docNum);

                $.getJSON('/api/patient/'+docType+'/'+docNum, function(patient)
                {
                    console.log('patient');
                    console.log(patient);

                    let dataTable = [];

                    $.each(patient, function (key, value)
                    {
                        if(key == 'pat_date_birth')
                        {
                            let pat_date_birth = value.split("T");

                            value = pat_date_birth[0];
                        }

                        /*
                        if(key == 'pat_comments')
                        {
                            CKEDITOR.instances['pat_comments'].setData(value);
                        }
                        else
                        {
                            cash('#'+key).val(value);
                        }
                        */
                        cash('#'+key).val(value);
                    });
                })
                .fail(function()
                {
                    alert('Não localizado na base '+docType+': '+docNum);
                });
            }
        });

        cash(function ()
        {
            cpf.mask(pat_doc_num);
            mobile.mask(pat_phone_mobile);
            phone.mask(pat_phone);
            email.mask(pat_email);
            cep.mask(pat_postalcode);
            uf.mask(pat_state);

            $('#pat_weight').maskMoney({
                allowNegative: false,
                thousands: '', decimal: '.'
            });

            $('#pat_height').maskMoney({
                allowNegative: false,
                thousands: '', decimal: '.'
            });

        });

        /*
        $('#type_id').on('change', function()
        {
            // using the function:
            selectOptionsRemove(document.getElementById('category_id'));

            if($('#type_id').val() == '')
            {
                document.getElementById("category_id").disabled = true;
                $("#category_id").addClass('bg-gray-100 cursor-not-allowed');
                return;
            }

            $("#category_id").removeClass('bg-gray-100 cursor-not-allowed');
            document.getElementById("category_id").disabled = false;

            $.getJSON('/api/serviceCategory/type/'+$('#type_id').val(), function(serviceCategory)
            {
                console.log('serviceCategory');
                console.log(serviceCategory);

                if(serviceCategory == '')
                {
                    toastr.error("{{__('No category to display')}}", 'Ops!')
                    return;
                }

                $.each(serviceCategory, function (i, item) {
                    $('#category_id').append($('<option>', {
                        value: item.id,
                        text : item.ref_description
                    }));
                });
            });
        });

        $('#service_price').maskMoney({
            allowNegative: false,
            thousands: '', decimal: '.'
        });
        $('#service_price_over').maskMoney({
            allowNegative: false,
            thousands: '', decimal: '.'
        });
        $('#service_pvd_price').maskMoney({
            allowNegative: false,
            thousands: '', decimal: '.'
        });
        $('#service_pvd_price_over').maskMoney({
            allowNegative: false,
            thousands: '', decimal: '.'
        });
        */


    </script>
@endsection
