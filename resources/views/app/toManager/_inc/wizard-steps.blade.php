<!-- BEGIN:STEPS -->
<div class="hidden wizard flex flex-col lg:flex-row justify-center mx-2 pt-2 lg:pt-4 pb-2 p-5 sm:px-20">
    @php
        $step1 = 'bg-gray-200 text-gray-600';
        $step2 = 'bg-gray-200 text-gray-600';
        $step3 = 'bg-gray-200 text-gray-600';
        $step4 = 'bg-gray-200 text-gray-600';
        //
        $step1Routes = ['toCustomer.order.create'];
        $step1 = in_array(Route::getCurrentRoute()->getName(),$step1Routes)?'bg-theme-1 text-white':'bg-gray-200 dark:bg-dark-1 text-gray-600';
        //
        $step2Routes = ['toCustomer.orderItem.index'];
        $step2 = in_array(Route::getCurrentRoute()->getName(),$step2Routes)?'bg-theme-1 text-white':'bg-gray-200 dark:bg-dark-1 text-gray-600';
        //
        $step3Routes = ['toCustomer.order.show'];
        $step3 = in_array(Route::getCurrentRoute()->getName(),$step3Routes)?'bg-theme-1 text-white':'bg-gray-200 dark:bg-dark-1 text-gray-600';
        //
        $step4Routes = ['toCustomer.order.conclusion'];
        $step4 = in_array(Route::getCurrentRoute()->getName(),$step4Routes)?'bg-theme-1 text-white':'bg-gray-200 dark:bg-dark-1 text-gray-600';
    @endphp

    <div class="intro-x lg:text-center flex items-center lg:block flex-1 z-10">
        <button class="w-5 h-5 m-0 p-0 rounded-full button {{ $step1 }}">1</button>
        <div class="lg:w-10 text-xs lg:mt-1 ml-1 lg:mx-auto">{{__('Patient')}}</div>
    </div>

    <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
        <button class="w-5 h-5 m-0 p-0 rounded-full button {{ $step2 }}">2</button>
        <div class="lg:w-10 text-xs lg:mt-1 ml-1 lg:mx-auto">{{__('Itens')}}</div>
    </div>

    <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
        <button class="w-5 h-5 m-0 p-0 rounded-full button {{ $step3 }}">3</button>
        <div class="lg:w-10 text-xs lg:mt-1 ml-1 lg:mx-auto">{{__('Review')}}</div>
    </div>

    <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
        <button class="w-5 h-5 m-0 p-0 rounded-full button {{ $step4 }}">4</button>
        <div class="lg:w-10 text-xs lg:mt-1 ml-1 lg:mx-auto">{{__('Conclusion')}}</div>
    </div>

    <div class="wizard__line hidden lg:block w-4/5 bg-gray-200 dark:bg-dark-1 absolute mt-2"></div>
</div>
<!-- END:STEPS -->
