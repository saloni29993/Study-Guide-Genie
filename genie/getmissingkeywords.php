<?php 

session_start();

require 'vendor/autoload.php';

use Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->build();

//$q = $_GET['q'];
$q = $_SESSION['uid'];
//$q = "constructor";
//echo "$q <br>";

$stopwords = "are|has|as|have|that|is|a|an|the|of|and|by|was|in|there|when|from|we|to|can|it|be|or|using";


// $params = [

// "index" => "notes",
// "type" => "note",
// "body" => [
// "query" => [

// "bool" => [

// "must" => [ "term" => ["nlevel" => $_SESSION['level']] ],

// "must_not" => [ "term" => [ "uid" => $_SESSION['uid']] ]


// ]
// ],

// "aggs" => [
//         "topicindex" => [
//             "significant_terms"=> [
//                 "field" => "content",
//                 "field" => "topic",
//                 "exclude" => $stopwords
//                 ]
//             ]    

//         ],

// "sort" => [

// "likes" => [

// "order" => "asc"


// ]

// ]



// ]






// ];

// $query = $client->search($params);

//echo "<pre>", print_r($query), "</pre>";


//echo "<pre>" ,print_r($query['hits']['hits']), "</pre>";


//echo "<pre>", print_r($query), "</pre>";


//echo "<pre>" ,print_r($query['aggregations']['topicindex']['buckets']), "</pre>";

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
                                        'lte' => $_SESSION['level'],
                                        "boost" => 2.0
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



"aggs" => [
        "topicindex" => [
            "significant_terms"=> [
                "field" => "content",
                 "field" => "topic",
                "exclude" => $stopwords
                ]
            ]    

        ],

    "sort" => [

    "likes" => [

    "order" => "asc"


    ]

    ]



]






];

$query = $client->search($params);

//echo "<pre>",print_r($query),"</pre>";
$recommended = $query['aggregations']['topicindex']['buckets'];

echo "<div class='grid-item table table-striped'><table class='table table-striped'><tbody>";
foreach ($recommended as $r) {
			echo "<tr>
                                            <td>
                                                <span class='label label-danger'>   </span> &nbsp; <b>" .$r['key'] ."</b> 
                                            </td>
                                        </tr>
                                    ";
}

echo "</tbody></table></div>";


?> 

