@extends('_layout/baseFile',[
    'title' => 'File View',
    'useJquery' => false,
])

<div class="w-full mt-2 p-2 bg-theme-6 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
    <span class="flex rounded-full bg-indigo-100 text-theme-6 uppercase px-2 py-1 text-xs font-bold mr-3">Ops!</span>
    <span class="font-semibold mr-2 text-left flex-auto">{{ __('c401') }}</span>
</div>
