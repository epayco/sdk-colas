<?php
include ('src/Colas.php');

use Epayco\Colas\Colas;

$public_key="PUBLIC_KEY_EPAYCO";
$private_key="PRIVATE_KEY_EPAYCO";
$colas=new Colas($public_key,$private_key);
$addCola=$colas->addMessage('movimientos','abonar_transaccion','1234');	
var_dump($addCola);

?>