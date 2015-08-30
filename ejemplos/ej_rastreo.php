<?php
require '../vendor/autoload.php';

use Ivansabik\Estafeta\Estafeta;

$estafeta = new Estafeta();
$estafeta->rastrear('0785310483');
$infoEnvio = $estafeta->infoEnvio;
var_dump($infoEnvio);
