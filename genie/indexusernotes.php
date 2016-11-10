<?php 

require 'vendor/autoload.php';

use Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->build();

$con=mysqli_connect("localhost","root","","javagenie");


$query1 = "SELECT * FROM notesman";


$result = mysqli_query($con,$query1);

$count = 4;

while($row = mysqli_fetch_array($result))
{
	
	
	$notesid = $row['notesid'];
	$uid = $row['uid'];
	$topic = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $row['topic']);
	$content = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $row['content']);
	$code = "<pre>" .$row['code'] ."</pre>";
	$likes = $row['likes'];
	$nlevel = $row['nlevel'];
	echo $row['topic'] ."<br>"; 
	//echo "<br><br>";
	//$count++;

	$params = array();

	$params['body']  = array(
		'uid' => $uid,
	  'topic' => $topic,
	  'content' => $content,
	  'code' => $code,
	  'likes' => $likes,
	  'nlevel' => $nlevel
	  
	);

	$params['index'] = 'notes';

	$params['type'] = 'note'; 

	$params['id'] = $notesid;

	$result1 = $client->index($params);
	
	
}
            

//echo "$count";
 ?>