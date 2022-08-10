@extends('_layout.side-menu',[
    'title' => 'Settings',
])

@section('subcontent')
    <div class="grid grid-cols-12 gap-6">

        <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-2xl font-medium truncate mr-5">APP - SETTINGS PROVIDER</h2>
                    <a href="" class="ml-auto flex text-theme-1 dark:text-theme-10">
                        <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data
                    </a>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="shopping-cart" class="report-box__icon text-theme-10"></i>
                                    <div class="ml-auto">
                                        <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="33% Higher than last month">
                                            33% <i data-feather="chevron-up" class="w-4 h-4"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-2xl font-bold leading-8 mt-6">4.510</div>
                                <div class="text-base text-gray-600 mt-1">Item Sales</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="credit-card" class="report-box__icon text-theme-11"></i>
                                    <div class="ml-auto">
                                        <div class="report-box__indicator bg-theme-6 tooltip cursor-pointer" title="2% Lower than last month">
                                            2% <i data-feather="chevron-down" class="w-4 h-4"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-2xl font-bold leading-8 mt-6">3.521</div>
                                <div class="text-base text-gray-600 mt-1">New Orders</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="monitor" class="report-box__icon text-theme-12"></i>
                                    <div class="ml-auto">
                                        <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="12% Higher than last month">
                                            12% <i data-feather="chevron-up" class="w-4 h-4"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-2xl font-bold leading-8 mt-6">2.145</div>
                                <div class="text-base text-gray-600 mt-1">Total Products</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="user" class="report-box__icon text-theme-9"></i>
                                    <div class="ml-auto">
                                        <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="22% Higher than last month">
                                            22% <i data-feather="chevron-up" class="w-4 h-4"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-2xl font-bold leading-8 mt-6">152.000</div>
                                <div class="text-base text-gray-600 mt-1">Unique Visitor</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: General Report -->
        </div>
        <div class="col-span-12 xxl:col-span-3 xxl:border-l border-theme-5 -mb-10 pb-10">
            <div class="xxl:pl-6 grid grid-cols-12 gap-6">
                <!-- BEGIN: Important Notes -->
                <div class="col-span-12 md:col-span-6 xl:col-span-12 xxl:col-span-12 xl:col-start-1 xl:row-start-1 xxl:col-start-auto xxl:row-start-auto mt-3">
                    <div class="intro-x flex items-center h-10">
                        <h2 class="text-2xl font-medium truncate mr-auto">Important Notes</h2>
                        <button data-carousel="important-notes" data-target="prev" class="tiny-slider-navigator button px-2 border border-gray-400 dark:border-dark-5 flex items-center text-gray-700 dark:text-gray-600 mr-2">
                            <i data-feather="chevron-left" class="w-4 h-4"></i>
                        </button>
                        <button data-carousel="important-notes" data-target="next" class="tiny-slider-navigator button px-2 border border-gray-400 dark:border-dark-5 flex items-center text-gray-700 dark:text-gray-600">
                            <i data-feather="chevron-right" class="w-4 h-4"></i>
                        </button>
                    </div>
                    <div class="mt-5 intro-x">
                        <div class="box zoom-in">
                            <div class="tiny-slider" id="important-notes">
                                <div class="p-5">
                                    <div class="text-base font-medium truncate">Lorem Ipsum is simply dummy text</div>
                                    <div class="text-gray-500 mt-1">20 Hours ago</div>
                                    <div class="text-gray-600 text-justify mt-1">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</div>
                                    <div class="font-medium flex mt-5">
                                        <button type="button" class="button button--sm bg-gray-200 dark:bg-dark-5 text-gray-600 dark:text-gray-300">View Notes</button>
                                        <button type="button" class="button button--sm border border-gray-300 dark:border-dark-5 text-gray-600 ml-auto">Dismiss</button>
                                    </div>
                                </div>
                                <div class="p-5">
                                    <div class="font-medium truncate">Lorem Ipsum is simply dummy text</div>
                                    <div class="text-gray-500 mt-1">20 Hours ago</div>
                                    <div class="text-gray-600 text-justify mt-1">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</div>
                                    <div class="font-medium flex mt-5">
                                        <button type="button" class="button button--sm bg-gray-200 dark:bg-dark-5 text-gray-600 dark:text-gray-300">View Notes</button>
                                        <button type="button" class="button button--sm border border-gray-300 dark:border-dark-5 text-gray-600 ml-auto">Dismiss</button>
                                    </div>
                                </div>
                                <div class="p-5">
                                    <div class="font-medium truncate">Lorem Ipsum is simply dummy text</div>
                                    <div class="text-gray-500 mt-1">20 Hours ago</div>
                                    <div class="text-gray-600 text-justify mt-1">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</div>
                                    <div class="font-medium flex mt-5">
                                        <button type="button" class="button button--sm bg-gray-200 dark:bg-dark-5 text-gray-600 dark:text-gray-300">View Notes</button>
                                        <button type="button" class="button button--sm border border-gray-300 dark:border-dark-5 text-gray-600 ml-auto">Dismiss</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Important Notes -->
            </div>
        </div>
    </div>
@endsection
