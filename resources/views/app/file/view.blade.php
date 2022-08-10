@extends('_layout/baseFile',[
    'title' => 'File View',
    'useJquery' => true,
])
<!-- @php
$listDownload = ['application/zip'];
@endphp -->
<!-- @if(in_array($file->file_mime_type,$listDownload))
@endif -->
<div class="mb-4 text-white font-light flex uppercase">
<div>ARQUIVO <span class="font-medium">

    @if ($file->file_name)
        {{ $file->file_name }}
    @elseif($file->file_description)
        {{ $file->file_description }}
    @endif

</span></div>
<a href="{{ asset("storage/{$file->file}") }}" download="{{ strtoupper($file->file_name) }}" class="ml-2 px-2 rounded text-xs text-white font-light bg-green-500 shadow-md hover:bg-green-700 hover:shadow-lg uppercase">
DOWNLOAD
</a>
</div>
<embed src="{{ asset("storage/{$file->file}")}}" type="{{$file->file_mime_type}}" width="100%" height="100%">


<!-- embed src="http://127.0.0.1:8000/storage/order/1001/orderItem/1/t6SVMij2jTPZkPv3oJ6Jbz3Mk4BQOMg4oOu3aC7U.jpeg" type="image/jpeg" width="100%" height="100%" -->
