<html>
<head>
	<script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
	<title></title>
</head>
<body>


<div style="width:400px;">


<?php

include('simple_html_dom.php');

$con=mysqli_connect("localhost","root","","javagenie");

echo "Starting ... <br>";
 $html = file_get_html('http://www.tutorialspoint.com/java/');

//$url = "http://www.tutorialspoint.com/java/java_basic_operators.htm";
foreach ($html->find('a') as $key) {
	
	$pos = strpos($key->href,"/java/java_");
	if($pos !== false)
	{
		//echo $key->href ."<br>";
		$url = "http://www.tutorialspoint.com" .$key->href;
		//echo $url ."<br>";


// Retrieve the DOM from a given URL
$html = file_get_html($url);

//$url = file_get_contents(''); 
// Find all links 
echo "going to url : $url <br>";

foreach($html->find('div[class=middle-col]') as $element) 
{
	$loader1 = new simple_html_dom();

	$loader1->load($element);

	$para ="";
	$heading ="";
	$prevheading = "";
	$code = "";
	foreach ($element->children as $child) 
	{
		//echo $child->tag ."  " .$child->innertext ."<br>";
		
		if($child->tag == "h1")
		{
			$prevheading = $heading;
			if($heading != "" && $para != "")
			{
				//echo ":::::::::::" .trim($prevheading) .":::::::::<br>-----" .trim($para) ."-----<br><br><br>";
				$prevheading = str_replace("'", "", $prevheading);
				$para = str_replace("'", "", $para);
				$code = str_replace("'", "", $code);
				echo $para ."<br>";
				$result=mysqli_query($con,"INSERT INTO `textbook` (textid,topic,content,code) values('','trim($prevheading)','$para','$code')");

				echo "printing result : " .$result ."<br>";
				if($result)
				{
					echo "<br>:::::DONE::::::" .$prevheading;
				}
				else
				{
					echo "failed... <br>";
				}
				
			}
			$heading = $child->innertext;
			$para = "";
			$code ="";

		}

		if($child->tag == "h2")
		{
			$prevheading = $heading;
			if($heading != "" && $para != "")
			{
				//echo ":::::::::::" .trim($prevheading) .":::::::::<br>-----" .trim($para) ."-----<br><br><br>";
				$prevheading = str_replace("'", "", $prevheading);
				$para = str_replace("'", "", $para);
				$code = str_replace("'", "", $code);

				echo "<i>" .$prevheading ."</i><br>";
				echo $para ."<br>";
				$result=mysqli_query($con,"INSERT INTO `textbook` (textid,topic,content,code) values('','$prevheading','$para','$code')");

				echo "<br>printing result : " .$result ."<br><br>";
				if($result)
				{
					echo "<br>:::::DONE::::::" .$prevheading;
				}
			}
			$heading = $child->innertext;
			$para = "";
			$code ="";
		}

		if($child->tag == "p")
		{
			$para = $para .$child->innertext;
		}

		if($child->tag == "ul")
		{
			$para = $para .$child->innertext;
		}
		if($child->tag == "pre")
		{
			$code = $code ."<br><code>" .$child ."</code><br>";
		}
	}
}
      
		 	}
}

//echo $output;
?>
</div>
</body>
</html>