<div class="grid grid-cols-12 gap-2">
    <div class="intro-y col-span-12">

        <div class="grid grid-cols-12 gap-2">

            <div class="bg-gray-200 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-6">
                <label class="text-xs text-gray-600">{{__('Order')}}</label>
                <div class="flex">
                    <p class="font-medium">{{ $order->order_num??'--' }}</p>
                    @php
                        $profile = session()->get('profile') ?? false;
                    @endphp
                    @if ($profile)
                        <a href="{{ route("{$profile}.order.show",['order'=>$order->order_num]) }}" target="_blank" class="transition duration-300 ease-in-out">
                            <i data-feather="external-link" class="w-5 h-5 text-theme-9 ml-1"></i>
                        </a>
                    @endif
                </div>
            </div>

            <div class="bg-gray-200 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-3">
                <label class="text-xs text-gray-600">{{__('Created At')}}</label>
                <p class="font-medium">{{ $order->created_at->format('d/m/Y H:i')??'--' }}</p>
            </div>

            <div class="bg-gray-200 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-3">
                <label class="text-xs text-gray-600">{{__('User')}}</label>
                <p class="font-medium">{{ $order->user->name??'--' }}</p>
            </div>

            {{-- <div class="bg-gray-200 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-2 hidden">
                <label class="text-xs text-gray-600">{{__('Type')}}</label>
                <p class="font-medium">{{ $order->type->ref_description??'--' }}</p>
            </div> --}}

            {{-- <div class="bg-{{$orderItem->status->ref_color_bg??'gray-100'}} rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-4">
                <label class="text-xs text-gray-600">{{__('Status')}}</label>
                <p class="font-medium">
                    {{ $orderItem->status->ref_description??'--' }}
                    @if ($orderItem->item_conclusion_comment)
                    - {{$orderItem->item_conclusion_comment}}
                    @endif
                </p>
            </div> --}}
        </div>

        <div class="grid grid-cols-12 gap-2 py-2">
            <div class="bg-gray-200 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-4">
                <label class="text-xs text-gray-600">{{__('Patient')}}</label>
                <p class="font-medium">{{ $order->pat_name??'--' }}</p>
            </div>

            <div class="bg-gray-200 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-2">
                <label class="text-xs text-gray-600">{{__('Genre')}}</label>
                <p class="font-medium">{{ $order->pat_genre??'--' }}</p>
            </div>

            <div class="bg-gray-200 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-2">
                <label class="text-xs text-gray-600">{{__('Age')}}</label>
                <p class="font-medium">{{ getAge($order->pat_date_birth) }} {{__('Years')}}</p>
            </div>

            <div class="bg-gray-200 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-2">
                <label class="text-xs text-gray-600">{{__('Weight')}}</label>
                <p class="font-medium">{{ $order->pat_weight??'--' }}</p>
            </div>

            <div class="bg-gray-200 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-2">
                <label class="text-xs text-gray-600">{{__('Height')}}</label>
                <p class="font-medium">{{ $order->pat_height??'--' }}</p>
            </div>

        </div>
    </div>
</div>
