{{-- {{dd(session()->all())}} --}}
@if (session('status'))
<div class="w-full mt-2 p-2 bg-theme-9 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
    <span class="flex rounded-full bg-indigo-100 text-theme-9 uppercase px-2 py-1 text-xs font-bold mr-3">SUCESSO</span>
    <span class="font-semibold mr-2 text-left flex-auto">{{ __(session('status')) }}</span>
</div>
@endif
@if (session('status_success'))
<div class="w-full mt-2 p-2 bg-theme-9 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
    <span class="flex rounded-full bg-indigo-100 text-theme-9 uppercase px-2 py-1 text-xs font-bold mr-3">SUCESSO</span>
    <span class="font-semibold mr-2 text-left flex-auto">{{ __(session('status_success')) }}</span>
</div>
@endif
@if (session('status_warning'))
<div class="w-full mt-2 p-2 bg-theme-1 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
    <span class="flex rounded-full bg-indigo-100 text-theme-1 uppercase px-2 py-1 text-xs font-bold mr-3">Ops!</span>
    <span class="font-semibold mr-2 text-left flex-auto">{{ __(session('status_warning')) }}</span>
</div>
@endif
@if (session('error'))
<div class="w-full mt-2 p-2 bg-theme-6 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
    <span class="flex rounded-full bg-indigo-100 text-theme-6 uppercase px-2 py-1 text-xs font-bold mr-3">Ops!</span>
    <span class="font-semibold mr-2 text-left flex-auto">{{ __(session('error')) }}</span>
</div>
@endif
@if (session('status_error'))
<div class="w-full mt-2 p-2 bg-theme-6 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
    <span class="flex rounded-full bg-indigo-100 text-theme-6 uppercase px-2 py-1 text-xs font-bold mr-3">Ops!</span>
    <span class="font-semibold mr-2 text-left flex-auto">{{ __(session('status_error')) }}</span>
</div>
@endif
<!-- -->
@if (session('status_update_success'))
<div class="w-full mt-2 p-2 bg-theme-9 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
    <span class="flex rounded-full bg-indigo-100 text-theme-9 uppercase px-2 py-1 text-xs font-bold mr-3">SUCESSO</span>
    <span class="font-semibold mr-2 text-left flex-auto">{{ __(session('status_update_success')) }}</span>
</div>
@endif
@if (session('status_update_warning'))
<div class="w-full mt-2 p-2 bg-theme-1 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
    <span class="flex rounded-full bg-indigo-100 text-theme-1 uppercase px-2 py-1 text-xs font-bold mr-3">Ops!</span>
    <span class="font-semibold mr-2 text-left flex-auto">{{ __(session('status_update_warning')) }}</span>
</div>
@endif
@if (session('status_update_error'))
<div class="w-full mt-2 p-2 bg-theme-6 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
    <span class="flex rounded-full bg-indigo-100 text-theme-6 uppercase px-2 py-1 text-xs font-bold mr-3">Ops!</span>
    <span class="font-semibold mr-2 text-left flex-auto">{{ __(session('status_update_error')) }}</span>
</div>
@endif
<!-- -->
<!-- ALERTS -->
@if (false && env('APP_DEBUG'))
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $key => $error)
                <li> -> {{ $key . ' = ' . $error }}</li>
            @endforeach
        </ul>
    @endif
@endif

