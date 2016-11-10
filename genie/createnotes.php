<?php 

session_start(); 

require 'vendor/autoload.php';

use Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->build();

//$noteid = $_POST['user_name'];

$con=mysqli_connect("localhost","root","","javagenie");

$userid = $_SESSION['username'];


$topic =$_POST['note_topic'];
$content=$_POST['note_content'];
$code=$_POST['note_code'];
$notesid='';


$topic = str_replace("'", "", $topic);
$code = str_replace("'", "", $code);
$content = str_replace("'", "", $content);

$uid = $_SESSION['uid'];
$level = $_SESSION['level'];

$query = "INSERT into notessal  VALUES ('','$uid','$topic','$content','$code','1','$level')";

$result1=mysqli_query($con,$query);


$query = "SELECT notesid from notessal where topic='$topic' and content='$content' and uid='$uid'";

$result1=mysqli_query($con,$query);

while($row = mysqli_fetch_array($result1))
{
	$notesid = $row['notesid'];
}

$params = array();

$params['body']  = array(
	'uid' => $_SESSION['uid'],
  'topic' => $topic,
  'content' => $content,
  'code' => $code,
  'likes' => 1,
  'nlevel' => $_SESSION['level']
  
);

$params['index'] = 'notes';

$params['type'] = 'note'; 

//$params['id'] = $notesid;

$result = $client->index($params);

echo "<pre>",print_r($params),"</pre>";

if($result)
{
    echo "success";
}

else{
    echo "failed";
}


 ?>