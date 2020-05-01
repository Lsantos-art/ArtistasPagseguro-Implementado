@extends('layouts.app')
@section('title', 'Página de pagamento')


@section('content')

    <h1 class="card p-3 my-3">Pagamento com boleto</h1>
    <a class="btn btn-info text-white" href="{{ route('home') }}">
        <i class="fas fa-home"></i>
    </a>
    <div class="my-3 d-flex justify-content-center">
        <div class="my-2">
            <div class="my-3">
                <img class="img-thumbnail" src="http://placehold.jp/150x150.png" alt="produto">
                <p class="my-3 text-center">Valor a ser pago: 99.90R$</p>
            </div>
            <form action="{{ route('boletoPay') }}" method="GET">
                @csrf
                <input type="hidden" id="senderHash" name="senderHash">
                <button onclick="sl();" type="submit" class="btn btn-primary my-2">Gerar boleto</button>
            </form>
        </div>
    </div>


@endsection





@section('scripts')

    @include('scripts.payment')

@endsection
