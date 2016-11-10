<?php 

require 'vendor/autoload.php';

use Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->build();

$con=mysqli_connect("localhost","root","","javagenie");


$query1 = "SELECT * FROM textbook ORDER BY textid desc";


$result = mysqli_query($con,$query1);

$count = 4;

while($row = mysqli_fetch_array($result))
{
	
	
	$id = $row['textid'];
	$topic = $row['topic'];
	$content = $row['content'];
	$code = $row['code'];
	echo $row['topic']; 
	//echo "<br><br>";
	//$count++;

	$params = array();

	$params['body']  = array(
	  'topic' => $topic,
	  'content' => $content,
	  'code' => $code 
	);

	$params['index'] = 'textbook';

	$params['type'] = 'text'; 

	$params['id'] = $id;

	$result1 = $client->index($params);
	
	
}
            

//echo "$count";
 ?>