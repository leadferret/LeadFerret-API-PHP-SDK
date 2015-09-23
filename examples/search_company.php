<?php

include_once '../bootstrap.php';

use LeadFerret\LFClient;


$client = new LFClient();
$client->authenticate();

$client->
