@extends('_layout.side-menu',[
    'title' => 'Settings',
])

@section('subcontent')
    <div class="grid grid-cols-12 gap-6">

        <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-2xl font-medium truncate mr-5">APP - SETTINGS MANAGER</h2>
                    <a href="" class="ml-auto flex text-theme-1 dark:text-theme-10">
                        <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data
                    </a>
                </div>
            </div>
            <!-- END: General Report -->
        </div>
    </div>
@endsection
