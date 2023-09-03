<?php 

$client = new \MongoDB\Client('mongodb+srv://root:1234@cluster0.ewl6c.mongodb.net/?retryWrites=true&w=majority');
$db = $client->test;

?>