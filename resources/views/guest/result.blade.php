@extends('_layout.login')

@section('content')
    <!-- BEGIN: Login Form -->
    <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
        <div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
            <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">{{__('Consulta de Laudo')}}</h2>
            <form id="login-form" method="POST" action="{{route('guestSearch')}}">
                @csrf
                <div class="intro-x mt-2 flex">
                    <input type="text" name="chave" class="intro-x login__input input input--lg border border-gray-300 block" placeholder="Chave">
                </div>
                <div class="intro-x mt-2 text-center xl:text-left mr-auto">
                    <button id="btn-search" class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3 align-top">Pesquisar</button>
                </div>
            </form>
            <div class="intro-x mt-2 block">
                <hr>
                @if (count($orderItem)==0)
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">{{__('Nenhum Registro Encontrado')}}</h2>
                @else
                    <div class="intro-x mt-2 flex">
                        <input type="text" name="chave" class="intro-x login__input input input--lg border border-gray-300 block" placeholder="Chave">
                    </div>
                    <div class="intro-x mt-2 text-center xl:text-left mr-auto">
                        <button id="btn-search" class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3 align-top">Pesquisar</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
