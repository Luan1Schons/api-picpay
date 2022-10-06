
# Api PicPay V1.0 PHP 7

Api desenvolvida para processar pagamentos no PicPay por Luan Schons Griebler

Configure suas credenciais em App/Classes/PicPay.PHP



#### Instale com o composer

```php

composer install luanschons/picpay

```

## API Reference

#### Configurar as credenciais de acesso

```php
  $this->picpayToken = 'Key';
  $this->picpaySellerToken = 'Shop Key'; 
```

#### Criar URL de pagamento

```php

$product = [
	'referenceId' 	=> 102040,
	'callbackUrl'  	=> 'http://www.sualoja.com.br/callback',
	'returnUrl'     => 'http://www.sualoja.com.br/cliente/pedido/102030',
	'value' 		=> 20.59,
	'expiresAt' 	=> '2022-05-01T16:00:00-03:00',
	'channel' 		=> 'gram',
	'purchaseMode' 	=> 'in-store',
	'buyer' 		=>
	[
		'firstName' 	=> 'João',
		'lastName' 		=> 'Da Silva',
		'document' 		=> '123.456.789-10',
		'email' 		=> 'teste@picpay.com',
		'phone' 		=> '+55 27 12345-6789'
	]
];

$picpay->payment($product);
```

#### Cancelar um pagamento

```php

$product = [
	'referenceId' 	=> 102040,
];

$cancel = $picpay->cancel($product['referenceId']);

if($cancel['status'] === 'success'){
	print_r($cancel['return']['cancellationId']);
}else{
	print_r($cancel['return']);
}

```

#### Capturar Status de um pagamento

```php

$product = [
	'referenceId' 	=> 102040,
];

$status = $picpay->status($product['referenceId']);

if($status['status'] === 'success'){
	print_r($status['return']);
}else{
	print_r($status['return']);
}

```





O Picpay irá notificar o callbackUrl (fornecido na requisição de pagamento), via método POST, informando que houve uma alteração no status do pedido.

Porém, por questões de segurança, não vai informar o novo status nesta requisição. Para isto, sua loja (a partir do recebimento da notificação) deverá consultar o endpoint de status de pedidos.

Para que o callback seja considerado confirmado, sua loja deve responder com HTTP Status 200.

Para mais informações consulte: https://picpay.github.io/picpay-docs-digital-payments/checkout/resources/api-reference/
