<?php 


require 'vendor/autoload.php';

use Elasticsearch\ClientBuilder;
    //instantiating the client
//$client = new Elasticsearch\Client(['hosts'=>'localhost:9200']);
// $hosts=['127.0.0.1:9200'];

$client = ClientBuilder::create()->build();
 //$client = ClientBuilder::create()->build();

echo "hello"; 

$params = array();

$params['body']  = array(
  'topic' => 'Java loops',
  'content' => 'they are used to iterate',
  'code' => 'psvm()' 
);

$params['index'] = 'textbook';

$params['type'] = 'text'; 

$result = $client->index($params);

print_r($result['_shards']['successful']);



 ?>