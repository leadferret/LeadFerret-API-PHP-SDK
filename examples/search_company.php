<?php

include_once '../bootstrap.php';

use LeadFerret\SDK\LFClient;


$client = new LFClient();
$client->authenticate();

$client->
