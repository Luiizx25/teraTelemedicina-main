@if (session('cycle_success'))
<div class="col-span-12 sm:col-span-12 lg:col-span-12">
    <div class="w-full p-2 bg-theme-9 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex mt-2" role="alert">
        <span class="flex rounded-full bg-indigo-100 text-theme-9 uppercase px-2 py-1 text-xs font-bold mr-3">SUCESSO</span>
        <span class="font-semibold mr-2 text-left flex-auto">{{ __(session('cycle_success')) }}</span>
    </div>
</div>
@endif
@if (session('cycle_warning'))
<div class="col-span-12 sm:col-span-12 lg:col-span-12">
    <div class="w-full p-2 bg-theme-1 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex mt-2" role="alert">
        <span class="flex rounded-full bg-indigo-100 text-theme-1 uppercase px-2 py-1 text-xs font-bold mr-3">Ops!</span>
        <span class="font-semibold mr-2 text-left flex-auto">{{ __(session('cycle_warning')) }}</span>
    </div>
</div>
@endif
@if (session('cycle_error'))
<div class="col-span-12 sm:col-span-12 lg:col-span-12">
    <div class="w-full p-2 bg-theme-6 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex mt-2" role="alert">
        <span class="flex rounded-full bg-indigo-100 text-theme-6 uppercase px-2 py-1 text-xs font-bold mr-3">Ops!</span>
        <span class="font-semibold mr-2 text-left flex-auto">{{ __(session('cycle_error')) }}</span>
    </div>
</div>
@endif
