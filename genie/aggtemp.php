<?php 

session_start();

require 'vendor/autoload.php';

use Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->build();

//$q = $_GET['q'];
$q = $_SESSION['uid'];
//$q = "constructor";
//echo "$q <br>";

$stopwords = "are|has|as|have|that|is|a|an|the|of|and|by|was|in|there|when|from|we|to|can|it|be|or";


$params = [

"index" => "notes",
"type" => "note",

"body" => [
"query" => [

"bool" => [

"must" => [ "term" => [ "uid" => $_SESSION['uid']] ]


]
]


]];


$q = $client->search($params);




//echo "<pre>", print_r($q), "</pre>";


$rec = $q['hits']['hits'];

$usertopics ="";
$usercontent ="";

$count = 1;
foreach ($rec as  $r) {

    $usertopics .= " " .$r['_source']['topic'] ." ";
    $usercontent .= " " .$r['_source']['content'] ." ";
 
    }

//echo $usertopics ."<br><br>";

//echo $usercontent;

$params = [

"index" => "notes",
"type" => "note",
"body" => [
"query" => [

"bool" => [
"must" => [
                            [
                                'range' => [
                                    'nlevel' => [
                                        'gte' => $_SESSION['level']
                                    ]
                                ]
                            ]
                            ],

//"must" => [ "term" => ["nlevel" => $_SESSION['level']] ],

//"should" => [ "term" => [ "topic" => $usertopics ]],

"must_not" => [ 

                ["match" => [ "topic" => $usertopics ]],
               //["match" => [ "content" => $usercontent ]]

]

]],



// "aggs" => [
//         "topicindex" => [
//             "significant_terms"=> [
//                 "field" => "content",
//                 // "field" => "topic",
//                 "exclude" => $stopwords
//                 ]
//             ]    

//         ],

    // "sort" => [

    // "likes" => [

    // "order" => "desc"


    // ]

    // ]



]






];

$query = $client->search($params);

//echo "<pre>", print_r($query), "</pre>";


//echo "<pre>" ,print_r($query['hits']['hits']), "</pre>";

$recommended = $query['hits']['hits'];

$count = 1;
foreach ($recommended as  $r) {

    if($count == 11)
    {
        break;
    }

    if($count == 1)
    {
        echo "
                    <div class='grid active item'>
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
                                            // echo "<td>
                                            //     <span class='label label-success'> Your Note </span> &nbsp; <b>" .$r['_source']['topic'] ."</b> 
                                            // </td>";
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


    else
    {
        echo "
                    <div class='grid item'>
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

    $count++;
			
}




?> 