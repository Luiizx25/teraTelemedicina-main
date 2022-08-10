@extends('_layout.side-menu',[
    'title' => __('Providers'),
    'useJquery' => true,
    'useDataTable' => true,
])

@section('subcontent')
    <!-- -->
    <div class="mt-2 p-2 intro-y">
        <div class="flex">
            <div class="">
                <div class="text-2xl font-bold leading-8">
                    {{__('Providers')}}
                </div>
            </div>
            <div class="ml-auto">
                <a href="{{route('toManager.provider.create')}}" id="btn-service-open-modal" data-toggle="modal" data-target="#modal-service-add" class="button text-white bg-theme-1 shadow-md ml-auto">
                    {{__('New Provider')}}
                </a>
            </div>
        </div>
    </div>
    <!-- -->
    <div class="grid grid-cols-12 gap-2">
        <!-- BEGIN: Data List -->
        <div class="box intro-y col-span-12 overflow-auto lg:overflow-visible p-4">
            <table id="table" class="table table-report -mt-2 display">
                <thead>
                    <tr>
                        <th class="text-center whitespace-no-wrap">{{__('#')}}</th>
                        <th class="whitespace-no-wrap">{{__('Name')}}</th>
                        <th class="whitespace-no-wrap">{{__('Contact')}}</th>
                        <th class="text-center whitespace-no-wrap">{{__('Type')}}</th>
                        <th class="text-center whitespace-no-wrap">{{__('Specialty')}}</th>
                        <th class="text-center whitespace-no-wrap">{{__('Location')}}</th>
                        <th class="text-center whitespace-no-wrap">{{__('Status')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($providers as $item)
                        @if ($item->user->id < 1000)
                            @continue
                        @endif
                        {{--  --}}
                        <tr class="intro-x shadow hover:shadow-lg">
                            <td class="w-10">
                                <div class="flex">
                                    <div class="w-10 h-10 image-fit zoom-in">
                                        @if ($item->user->photo)
                                            <img class="rounded" src="{{asset('storage/' . $item->user->photo)}}">
                                        @else
                                            <img class="rounded" src="{{asset('dist/images/default_profile.png')}}">
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="text-left">
                                <a href="{{route('toManager.provider.show',[$item->pvd_slug])}}" class="font-medium truncate whitespace-no-wrap">
                                    <p>{{$item->user->name}}</p>
                                    <p class="text-gray-600">{{ strtoupper($item->pvd_identity_type??'--') }} {{ $item->pvd_identity_num??'--' }}</p>
                                    {{-- <p class="text-gray-600 truncate text-xs whitespace-no-wrap">{{$item->pvd_name_company}}</p> --}}
                                </a>
                            </td>
                            <td class="text-left">
                                <a href="mail:to{{$item->user->email}}" class="font-medium whitespace-no-wrap">{{$item->user->email}}</a>
                                <div class="text-gray-600 text-xs whitespace-no-wrap">{{$item->user->phone??'--'}} {{$item->user->phone_mobile??'--'}}</div>
                            </td>
                            <td class="text-center">
                                <p>{{$item->type->ref_description}}</p>
                            </td>
                            <td class="text-center">
                                <p>{{$item->specialty->ref_description}}</p>
                            </td>
                            <td class="text-center">
                                <div class="text-xs whitespace-no-wrap">{{$item->pvd_city}}/{{$item->pvd_state}}</div>
                            </td>
                            <td class="">
                                <div class="flex items-center justify-center {{ false ? 'text-theme-9' : 'text-theme-6' }}">
                                    @if($item->active ?? false)
                                    <i data-feather="activity" class="w-4 h-4 mr-1"></i> Ativo
                                    @else
                                    <i data-feather="slash" class="w-4 h-4 mr-1"></i>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        {{-- <tr class="intro-x shadow rounded"><td colspan="7">{{__('No items registered in the database')}}</td></tr> --}}
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
    </div>
@endsection

@section('script')
    <script>
        $(document).ready( function () {
            $('#table').DataTable({
                dom: 'Bfrtip',
                language: dataOptionsLanguage, pageLength: 50,
                buttons: dataOptionsButtons,
                order: [],
                columnDefs: [
                    { orderable: false, targets: [0] },
                ]
            });
        } );
    </script>
@endsection
