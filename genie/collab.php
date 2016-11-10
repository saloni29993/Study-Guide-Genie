<?php 

session_start();
require 'vendor/autoload.php';

use Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->build();

//$q = $_GET['q'];
//$q = $_POST['user_name'];
$q = "constructor";

$stopwords = "is|a|the|of|by|was|in|there|when|from|we|and|or";
//$level =0;

$params= [

	"index" => "notes",
	"type" => "note",
	"body"=>[
		"query" => [ 
			"term" => ["nlevel" => $_SESSION['level']],
			"term" => [ "uid" => $_SESSION['uid']]
				],
		"aggs" => [
		"topicindex" => [
			"significant_terms"=> [
				"field" => "content",
				"field" => "topic",
				"exclude" => $stopwords
				]
 			]    

		]
	]
];


$query = $client->search($params);

//echo "<pre>", print_r($query), "</pre>";

$variable = $query['aggregations']['topicindex']['buckets'];

// echo "<pre>", print_r($variable), "</pre>";

$exclude_keys = "";

$count = 1;

/* //The part that print the users keywords
echo "output of user keys:";

foreach ($variable as $v) {
	
	echo $v['key'] ."<br>";
}

*/

foreach ($variable as $v) {
	if($count == 1)
	{
		$exclude_keys = $exclude_keys  .$v['key'];
	}
	else{
		$exclude_keys = $exclude_keys ."|"  .$v['key'];
	}
	
	$count++;
}

//echo "<br>$exclude_keys<br>";

$final_exclusion = $stopwords ."|" .$exclude_keys;

//echo "<br>$final_exclusion<br>";
$params1= [

	"index" => "notes",
	"type" => "note",
	"body"=>[
		"query" => [ 
			"term" => ["nlevel" => $_SESSION['level']]
				],
		"aggs" => [
		"topicindex" => [
			"significant_terms"=> [
				"field" => "content",
				"field" => "topic"//,
				//"exclude" => $final_exclusion
				]
 			]    

		]
	]
];



$query1 = $client->search($params1);

//echo "<pre>", print_r($query1['hits']['hits']), "</pre>";


/* //The part that print keywords of collab

$variable1 = $query1['aggregations']['topicindex']['buckets'];

echo "<pre>", print_r($variable), "</pre>";


echo "<br><br>" ."Final output of Collab:";

foreach ($variable1 as $v1) {
	
	echo $v1['key'] ."<br>";
} */



$recommended = $query1['hits']['hits'];

foreach ($recommended as $r) {
			echo "<div class='grid-item table table-striped'>
                                <table class='table table-striped'>
                                    <tbody>
                                    
                                        <tr>
                                        ";

                                        if($_SESSION['uid'] != $r['_source']['uid'])
                                        {
                                        	echo "<td>
                                                <a target='_blank' href='userprofile.php?user=" .$r['_source']['uid'] ."'><span class='label label-primary'> User: " .$r['_source']['uid'] ." </span></a> &nbsp; <b>" .$r['_source']['topic'] ."</b> 
                                            </td>";
                                        }
                                        else
                                        {
                                        	echo "<td>
                                                <span class='label label-success'> Your Note </span> &nbsp; <b>" .$r['_source']['topic'] ."</b> 
                                            </td>";
                                        }
                                           
                                           echo " 
                                        </tr>
                                        
                                        <tr>
                                            <td>
                                               ".$r['_source']['content'] ." <!-- <span class='label label-danger'> Content</span> -->
                                            </td>
                                        </tr>";

                                        if($r['_source']['code'] != "")
                                        {
                                        	echo "<tr class='codescroll'>
                                            <td>
                                               <div ><pre>".$r['_source']['code'] ."</pre></div> <!-- <span class='label label-danger'> Content</span> -->
                                            </td>
                                        </tr>";
                                        }
                                        

                                    echo    "
                                    </tbody>
                                </table>
                            </div>";
}

 ?> 