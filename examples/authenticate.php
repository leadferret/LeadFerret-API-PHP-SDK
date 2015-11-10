<?php

include_once '../bootstrap.php';

use LeadFerret\SDK\LFClient;


$client = new LFClient();
$token = $client->authenticate();

echo $token;

