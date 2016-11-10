<?php 


require 'vendor/autoload.php';

use Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->build();

$q = $_POST['user_name'];
//$q = "break statement";

$query = $client->search([
	"index" => "textbook",
	"type" => "text",
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
                                            <td>
                                                <span class='label label-primary'> Topic </span> &nbsp; <b>" .$r['_source']['topic'] ."</b> 
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td>
                                               <p>".$r['_source']['content'] ." </p><!-- <span class='label label-danger'> Content</span> -->
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