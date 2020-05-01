<?php

namespace App\Http\Controllers;

use Artistas\PagSeguro\PagSeguro;
use Artistas\PagSeguro\PagSeguroFacade;
use Illuminate\Http\Request;

class PagSeguroController extends Controller
{
    private $pagseguro;
    private $requestUri;

    /**
     * Instancia as dependências.
     */
    public function __construct()
    {
        $this->pagseguro = app('pagseguro');
        $this->request = app('request');
    }

    public function cardPay(Request $request)
    {
        dd($request->all());

        $parcelas = explode('/', $request->qntParcelas);
        $parcelamentoVal = $parcelas['0'];
        $parcelamentoQTD = $parcelas['1'];
        $hash = $request->senderHash;
        $cardToken = $request->creditCardToken;


        $pagseguro = PagSeguroFacade::setReference('1')
        ->setSenderInfo([
        'senderName' => 'CLIENTE TESTE CARD', //Deve conter nome e sobrenome
        'senderPhone' => '(32) 1324-1421', //Código de área enviado junto com o telefone
        'senderEmail' => 'c41893709951070941428@sandbox.pagseguro.com.br',
        'senderHash' => $hash,
        'senderCPF' => '689.032.560-50' //Ou CNPJ se for Pessoa Júridica
        ])
        ->setCreditCardHolder([
        'creditCardHolderName' => 'Adolfo Rodrigues Test da Silva', //Deve conter nome e sobrenome
        'creditCardHolderPhone' => '(32) 1324-1421', //Código de área enviado junto com o telefone
        'creditCardHolderCPF' => '689.032.560-50', //Ou CNPJ se for Pessoa Júridica
        'creditCardHolderBirthDate' => '10/02/1981',
        ])
        ->setShippingAddress([ // OPCIONAL
        'shippingAddressStreet' => 'Rua/Avenida',
        'shippingAddressNumber' => '12',
        'shippingAddressDistrict' => 'RIACHO FUNDO 1',
        'shippingAddressPostalCode' => '71805-720',
        'shippingAddressCity' => 'BRASILIA',
        'shippingAddressState' => 'DF'
        ])
        ->setBillingAddress([
        'billingAddressStreet' => 'Rua/Avenida',
        'billingAddressNumber' => '12',
        'billingAddressDistrict' => 'RIACHO FUNDO 1',
        'billingAddressPostalCode' => '71805-720',
        'billingAddressCity' => 'BRASILIA',
        'billingAddressState' => 'DF'
        ])
        ->setItems([
        [
            'itemId' => '1',
            'itemDescription' => 'LIVRO MERIDIAN',
            'itemAmount' => 250, //Valor unitário
            'itemQuantity' => '1', // Quantidade de itens
        ],
        [
            'itemId' => '2',
            'itemDescription' => 'POSTER MANAKARTS',
            'itemAmount' => 250,
            'itemQuantity' => '1',
        ]
        ])
        ->send([
        'paymentMethod' => 'creditCard',
        'creditCardToken' => $cardToken,
        'noInterestInstallmentQuantity' => 3,
        'installmentQuantity' => $parcelamentoQTD,
        'installmentValue' => $parcelamentoVal,
        ]);

        //dd($pagseguro);
    }


    public function boleto(Request $request)
   {
        dd($request);
        $hash = $request->senderHash;

            $pagseguro = PagSeguroFacade::setReference('1')
            ->setSenderInfo([
               'senderName' => 'CLIENTE TESTE', //Deve conter nome e sobrenome
               'senderPhone' => '(55) 9999-9999', //Código de área enviado junto com o telefone
               'senderEmail' => 'luhquirino96@mail.com',
               'senderHash' => $hash,
               'senderCPF' => '293.955.760-81' //Ou CPF se for Pessoa Física - USE O 4DEVS PARA GERAR
            ])
            ->setShippingAddress([
               'shippingAddressStreet' => 'Rua/Avenida',
               'shippingAddressNumber' => 'Número',
               'shippingAddressDistrict' => 'Bairro',
               'shippingAddressPostalCode' => '12345-678',
               'shippingAddressCity' => 'Cidade',
               'shippingAddressState' => 'DF'
             ])
             ->setItems([
              [
                'itemId' => '1',
                'itemDescription' => 'Telefone',
                'itemAmount' => 99.90, //Valor unitário
                'itemQuantity' => '2', // Quantidade de itens
              ],
            ])
            ->send([
              'paymentMethod' => 'boleto'
            ]);

            // $LINK = $pagseguro->paymentLink; //RETORNA O LINK PARA ENVIAR AO FRONT-END
            // $STATUS = $pagseguro->status; //RETORNA O STATUS DA TRANSAÇÃO PARA ENVIAR AO FRONT-END

        dd($pagseguro);

   }
}
