<script>
    {{-- PUXA UMA NOVA SESSÃO DE CHECKOUT --}}
    window.onload = function() {
	// códigos JavaScript a serem executados quando a página carregar
    PagSeguroDirectPayment.setSessionId('{{ PagSeguro::startSession() }}');
    }


    {{-- RECUPERA A BANDEIRA --}}
    $('#cardNumber').on('keyup', function () {

        //Receber o número do cartão digitado pelo usuário
        var numCartao = $(this).val();


        //Contar quantos números o usuário digitou
        var qntNumero = numCartao.length;

        //Validar o cartão quando o usuário digitar 6 digitos do cartão
        if (qntNumero == 6) {
            //Instanciar a API do PagSeguro para validar o cartão
            PagSeguroDirectPayment.getBrand({
                cardBin: numCartao,
                success: function (response) {
                    $('#msg').empty();

                    //Enviar para o index a imagem da bandeira
                    var imgBand = response.brand.name;
                    var amount = '500'
                    $('#cardFlag').val(imgBand);
                    $('.bandeira-cartao').html("<img src='https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/42x20/" + imgBand + ".png'>");
                    recupParcelas(imgBand);
                },
                error: function (response) {
                    //Enviar para o index a mensagem de erro
                    console.log(response);
                    $('.bandeira-cartao').empty();
                    $('#msg').html("Cartão inválido");
                }
            });
        }
        });

        {{-- RECUPERA AS OPÇÕES DE PARCELAMENTO BANDEIRA --}}
        function recupParcelas(bandeira) {
                //Recuperar a quantidade de parcelas e o valor das parcelas no PagSeguro
                // alert(bandeira)
                PagSeguroDirectPayment.getInstallments({

                    //Valor do produto
                    amount: '500',

                    //Quantidade de parcelas sem juro
                    maxInstallmentNoInterest: 3,

                    //Tipo da bandeira
                    brand: bandeira,

                    success: function (response) {
                        $.each(response.installments, function (ia, obja) {
                            // alert('OK')
                            $.each(obja, function (ib, objb) {

                                //Converter o preço para o formato real com JavaScript
                                var valorParcela = objb.installmentAmount.toFixed(2).replace(".", ",");

                                //Apresentar quantidade de parcelas e o valor das parcelas para o usuário no campo SELECT
                                $('#qntParcelas').show().append("<option value='" + objb.installmentAmount +  "/" + objb.quantity + "'>" + objb.quantity + " parcelas de R$ " + valorParcela + "</option>");
                            });
                        });
                    },
                    error: function (response) {
                        // callback para chamadas que falharam.
                        console.log(response)
                    },
                    complete: function (response) {
                        // Callback para todas chamadas.
                    }
                });
        }


        {{-- INSERE NOS INPUTS O TOKEN DA TRANSAÇÃO E DO CARTÃO --}}
        function sl () {
            $('#senderHash').val(PagSeguroDirectPayment.getSenderHash());

                    cardNumber = $('input[name="cardNumber"]').val();
                    brand = $('select[name="cardFlag"]').val();
                    cvv = $('input[name="cardCode"]').val();
                    expiration = $('input[name="cardValidate"]').val();
                    installments = $('select[name="installments"]').val();
                    if (expiration) {
                        let split = expiration.toString().split("/");
                        expirationMonth = split[0];
                        expirationYear = split[1];
                    }

                    PagSeguroDirectPayment.createCardToken({
                        cardNumber: cardNumber, // Número do cartão de crédito
                        brand: brand, // Bandeira do cartão
                        cvv: cvv, // CVV do cartão
                        expirationMonth: expirationMonth, // Mês da expiração do cartão
                        expirationYear: expirationYear, // Ano da expiração do cartão, é necessário os 4 dígitos.
                        success: function (response) {
                            // Retorna o cartão tokenizado.
                            console.log(response);
                            $('#creditCardToken').val(response.card.token);
                            document.form.submit();
                        },
                        error: function (response) {
                            console.log(response);
                        },
                        complete: function (response) {
                            // Callback para todas chamadas.
                        }
                    });

        }


</script>

 {{-- PUXA A BIBLIOTECA JS DO PAGSEGURO --}}
 <script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
