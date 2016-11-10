<?php 

$folder = "scraper\scraper-data";
$idcount = 0;
if(is_dir($folder))
{
	//echo "exits!";

	if($dh = opendir($folder))
	{
		while(($file = readdir($dh)) !== false)
		{
			try
			{
				//echo "<br>" .$file ."";
				$handle = fopen(__DIR__ ."\\$folder\\" .$file, "r");
				//echo "<br>" .$handle ."<br>";
			}

			catch(Exception $e)
			{
				continue;
			}

			if($handle)// && is_file($file)) 
			{

				while (($buffer = fgets($handle, 4096)) !== false) 
				{
					$buffer = trim(preg_replace('/\s\s+/', ' ', $buffer));
					$buffer = str_replace("'", "", $buffer);

					//lets  remove .txt from file name so that
			        //we can add it as Topic in msql db

					$topic = substr($file,0,-4);
			        echo "<br>Topic : " . $topic ."<br>";

					//we get the data of $file
			        echo "<br>" .$buffer ."<br>";
			  		if($topic != "" && $buffer!="" )
			  		{
			  			$con=mysqli_connect("localhost","root","","javagenie");

            			$result=mysqli_query($con,"INSERT INTO textbook (textid,topic,content,code) values('','$topic','$buffer','')");

			  		}

			        
            			
            			if($result)
            			{
            				echo "<br>SUCCESS<br>";
            			}
            			else
            			{
            				echo "<br>ERROR<br>";
            				echo mysqli_error($con);
            			}


			        
			    }
			}


		}
	}
}

else
{
	echo "The Folder Scraper doesn't exist!";
}

mysqli_close($con);


 ?>