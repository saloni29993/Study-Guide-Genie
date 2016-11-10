<?php 

session_start();

require 'vendor/autoload.php';

use Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->build();

//$q = $_GET['q'];
$q = $_POST['user_name'];
//$q = "constructor";

$query = $client->search([

	"index" => "notes",
	"type" => "note",
	"body"=>[
		"query"=>[
			"bool"=>[
				"should"=>[
					"match"=>["topic" => $q],
					"match"=>["content"=> $q]
						]
					]
				]
			]
		]);

//"match"=>["content"=> $q], 
//echo "<pre>", print_r($query), "</pre>";
 
if($query['hits']['hits'] >= 1)
{
	$results = $query['hits']['hits'];
}

if(isset($results))
{
	foreach ($results as $r) 
	{
		// echo "Topic : " .$r['_source']['topic'];
		// echo "<br>";
		// echo "Content : " .$r['_source']['content'];
		// echo "<br>";
		// echo "Code : " .$r['_source']['code'];
		// echo "<br><br><br>";


		echo "<div class='grid-item notecard'>
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
                                               <div >".$r['_source']['code'] ."</div> <!-- <span class='label label-danger'> Content</span> -->
                                            </td>
                                        </tr>";
                                        }
                                        

                                    echo    "
                                    </tbody>
                                </table>
                            </div>";
	}
}
 ?> 