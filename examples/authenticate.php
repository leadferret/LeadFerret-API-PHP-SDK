<?php

include_once '../bootstrap.php';

use LeadFerret\LFClient;


$client = new LFClient();
$token = $client->authenticate();

echo $token;

