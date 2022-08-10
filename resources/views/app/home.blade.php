@extends('_layout.side-menu',[
    'title' => 'Home',
])

@section('subcontent')


<div class="relative bg-white overflow-hidden mt-5 rounded-lg shadow-lg">

    <div class="max-w-screen-xl mx-auto">
      <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-auto lg:pb-28 xl:pb-32">

        <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-64 text-white transform translate-x-1/2" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
          <polygon points="50,0 100,0 50,100 0,100" />
        </svg>

        <div class="relative pt-6 px-4 sm:px-6 lg:px-8">
          <nav class="relative flex items-center justify-between sm:h-10 lg:justify-start">
          </nav>
        </div>


        <main class="mt-10 mx-auto max-w-screen-xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
          <div class="text-center sm:text-center lg:text-left">

            <h2 class="text-4xl tracking-tight leading-10 font-extrabold text-gray-900 sm:text-5xl sm:leading-none md:text-6xl">
                @php
                    $nameArr = explode(' ', Auth::user()->name);
                @endphp
              Olá, {{ $nameArr[0]??'--' }}!
              <p class="mt-2 text-orange-500">{{$greeting??'--'}}</p>
            </h2>
            <p class="hidden mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
              Nós promovemos o melhores resultados.
            </p>
            <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
              <div class="rounded-md shadow">
              </div>
              <div class="mt-3 sm:mt-0 sm:ml-3">
              </div>
            </div>

          </div>
        </main>
      </div>
    </div>

    <div class="visible sm:invisible lg:visible lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
      <!--img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2850&q=80" alt=""-->
      <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="{{ asset('/app/images/'.$gImage) }}" alt="">
    </div>

</div>
@php
  if(isset(Auth::user()->customer->first()->id)){
    @endphp
    <div> 
      <link href="https://widget.binds.co/css/app.css" rel=stylesheet>
    <div>
    <vue-widget widget_position="right" widget_title="feedback" buttons="#010101" width="400" text_buttons="#ffffff" background="#09B0D0" texts="#ffffff" timeout="1" width_metric="px" survey_id="61aa83114e8da227482b91ac" from='{"name": "{{Auth::user()->name}}", "email": "{{Auth::user()->email}}"}' is_to_post="true" metadata='{}'/>
    <script src="https://widget.binds.co/js/app.js"></script>
    @php
  }
@endphp

@endsection
