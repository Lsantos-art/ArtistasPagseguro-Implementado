@extends('layouts.app')
@section('title', 'Pagar com cartão')


@section('content')

    <h1 class="bg-light p-3 my-3">Pagar com cartão</h1>
    <a class="btn btn-info text-white" href="{{ route('home') }}">
        <i class="fas fa-home"></i>
    </a>

    <div class="my-2 d-flex justify-content-center">

        <form  class="card p-3 bg-light border-info" name="form" action="{{ route('cardPay') }}" method="POST">
            @csrf
            <input type="hidden" id="senderHash" name="senderHash">
            <input type="hidden" name="creditCardToken" id="creditCardToken" value="">
        <div class="form-group p-3">
            <div class="form-group">
                <input type="text" name="cardNumber" id="cardNumber" class="form-control my-2" placeholder="Numero do cartão" value="">
                <input type="hidden" name="cardFlag" id="cardFlag" class="form-control" value="">
                <div class="bandeira-cartao" id="bandeira-cartao"></div>
            </div>
            <span class="aler alert-info" id="msg"></span>
            <input type="text" name="cardCode" id="cardCode" class="form-control my-2" placeholder="CVV" value="123">
            <input type="text" name="cardValidate" id="cardValidate" class="form-control my-2" placeholder="Venc." value="12/2030">

            <div class="my-2 d-flex justify-content-center">
                <select style="display: none" name="qntParcelas" id="qntParcelas" class="form-control">
                    <option value="0" class="disabled">Quantidade de parcelas</option>
                </select>
            </div>

        </div>
            <div class="my-2 d-flex justify-content-center">
              <a id="enviar" onclick="sl();" type="submit" class="btn btn-info my-2 text-white">Pagar com cartão</a>
            </div>
        </form>

    </div>


@endsection





@section('scripts')

    @include('scripts.payment')

@endsection
