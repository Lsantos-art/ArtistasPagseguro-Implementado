@extends('layouts.app')
@section('title', 'PagSeguro')


@section('content')
    <div class="my-3 d-flex justify-content-center">
        <div class="my-3 text-center">
            <h3 class="bg-light my-3">Pagamentos com API PagSeguro</h3>
            <img src="{{ url('/banner.png') }}" class="img-fluid" alt="Responsive image" style="max-width: 600px">
        </div>
    </div>
    <div class="my-3 d-flex justify-content-center">
        <div class="p-3">
            <a class="btn btn-info text-white" href="{{ route('card') }}" title="Pagar com cartão">
                <i class="far fa-credit-card"></i>
            </a>
        </div>
        <div class="p-3">
            <a class="btn btn-info text-white" href="{{ route('boleto') }}"  title="Pagar com boleto">
                <i class="fas fa-file-invoice-dollar"></i>
            </a>
        </div>
    </div>
@endsection


