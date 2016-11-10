<?php 

include('simple_html_dom.php');

$html = new simple_html_dom();


if($_POST['user_name'])
{


    

$query = trim($_POST['user_name']);


$query = str_replace(" ", "+", $query);

if($query)
{
        $html->load_file('http://stackoverflow.com/search?q=' .$query ."+java");

//echo $html;

        $element = $html->find("a");
        //echo "<span class='label label-primary'> Getting Data  </span>" .$query; 
        //echo "<ul class='nav nav-pills'>";

        echo "<div class='notecard'><table class='table table-striped'><tbody>";

        foreach ($element as $value) 
        {
                
                $pos = strpos($value->href,"/questions");
                $pos1 = strpos($value->innertext, "Q:");
                if($pos !== false && $pos1 !== false)
                {
                        //echo "<li role='presentation'><a target='_blank' href='http://stackoverflow.com/" .$value->href ."'>" .$value->innertext ."</a></li>";
                        //echo "<br>";
                        //echo $value->innertext;
                        //echo "<br>";
                    echo "<tr><td><a target='_blank' href='http://stackoverflow.com/" .$value->href ."'>" .$value->innertext ."</a></td></tr>";
                        
                }
                
                
        }

//echo "</ul>";
        echo "</tbody></table><div>";

}

else
{
    echo "<i>Search to get Related links...</i>";
}








}





 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="generator" content="HTML Tidy for HTML5 (experimental) for Windows https://github.com/w3c/tidy-html5/tree/c63cc39">
        <title></title>
    </head>
    <body>
    </body>
</html>
