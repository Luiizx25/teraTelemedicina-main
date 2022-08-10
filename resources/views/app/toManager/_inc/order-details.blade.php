<div class="grid grid-cols-12 gap-2">
    <div class="intro-y col-span-12">
        <div class="grid grid-cols-12 gap-2 p-2">
            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-4">
                <label class="text-xs text-gray-600">{{__('Order')}}</label>
                <p class="font-medium">{{ $order->order_num??'--' }}</p>
            </div>

            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-2">
                <label class="text-xs text-gray-600">{{__('Created At')}}</label>
                <p class="font-medium">{{ $order->created_at->format('d/m/Y H:i')??'--' }}</p>
            </div>

            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-2">
                <label class="text-xs text-gray-600">{{__('User')}}</label>
                <p class="font-medium">{{ $order->user->name??'--' }}</p>
            </div>

            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-2 hidden">
                <label class="text-xs text-gray-600">{{__('Type')}}</label>
                <p class="font-medium">{{ $order->type->ref_description??'--' }}</p>
            </div>

            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-4">
                <label class="text-xs text-gray-600">{{__('Status')}}</label>
                <p class="font-medium">{{ $order->status->ref_description??'--' }}</p>
            </div>


            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-12 lg:col-span-4">
                <label class="text-xs text-gray-600">{{__('Patient')}}</label>
                <p class="font-medium">{{ $order->pat_name??'--' }}</p>
            </div>

            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-2">
                <label class="text-xs text-gray-600">{{__('Genre')}}</label>
                <p class="font-medium">{{ $order->pat_genre??'--' }}</p>
            </div>

            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-2">
                <label class="text-xs text-gray-600">{{__('Age')}}</label>
                <p class="font-medium">{{ getAge($order->pat_date_birth) }} {{__('Years')}}</p>
            </div>

            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-2">
                <label class="text-xs text-gray-600">{{__('Weight')}}</label>
                <p class="font-medium">{{ $order->pat_weight??'--' }}</p>
            </div>

            <div class="bg-gray-100 rounded-sm px-2 py-1 w-full col-span-12 sm:col-span-6 lg:col-span-2">
                <label class="text-xs text-gray-600">{{__('Height')}}</label>
                <p class="font-medium">{{ $order->pat_height??'--' }}</p>
            </div>

        </div>
    </div>
</div>
