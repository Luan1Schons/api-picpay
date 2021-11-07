<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "vendor/autoload.php";

use App\Classes\PicPay;

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


$picpay = new PicPay();

$payment = $picpay->payment($product);

if($payment['status'] === 'success'){
	echo $payment['url'];
}else{
	print_r($payment['return']['message']);
}

/*
$cancel = $picpay->cancel($product['referenceId']);

if($cancel['status'] === 'success'){
	print_r($cancel['return']['cancellationId']);
}else{
	print_r($cancel['return']);
}
*/

/*
$status = $picpay->status($product['referenceId']);

if($status['status'] === 'success'){
	print_r($status['return']);
}else{
	print_r($status['return']);
}
*/