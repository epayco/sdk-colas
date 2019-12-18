<?php
include ('src/Colas.php');

use Epayco\Colas\Colas;

$public_key="70efb5772437cc7afbe15b77fe8dea";
$private_key="ef98758224a02e086f74beeaf5bc171f";
$colas=new Colas($public_key,$private_key);
$addCola=$colas->addMessage('movimientos','abonar_transaccion','1234');	
var_dump($addCola);

?>