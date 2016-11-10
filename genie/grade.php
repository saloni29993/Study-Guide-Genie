<?php session_start(); ?>
<?php

define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASSWORD', '');
   define('DB_NAME', 'javagenie');

$score = 0;

if(isset($_POST['submit']))
{
	if(!empty($_POST['ans1']))
	{
		if($_POST['ans1'] == 'option3')
		{
		//echo $_POST['ans1'];	
		$score++;
		}
	}
	else
	{
	echo "Please answer question 1";
	}

	if(!empty($_POST['ans2']))
	{
		if($_POST['ans2'] == 'option1')
		{
		//echo $_POST['ans2'];	
		$score++;
		}
	}
	else
	{
	echo "Please answer question 2";
	}

	if(!empty($_POST['ans3']))
	{
		if($_POST['ans3'] == 'option2')
		{
		//echo $_POST['ans3'];	
		$score = $score + 1;
		}
	}
	else
	{
	echo "Please answer question 3";
	}


	if(!empty($_POST['ans4']))
	{
		if($_POST['ans4'] == 'option1')
		{
		//echo $_POST['ans3'];	
		$score = $score + 1;
		}
	}
	else
	{
	echo "Please answer question 4";
	}

	if(!empty($_POST['ans5']))
	{
		if($_POST['ans5'] == 'option2')
		{
		//echo $_POST['ans3'];	
		$score = $score + 1;
		}
	}
	else
	{
	echo "Please answer question 5";
	}

	if(!empty($_POST['ans6']))
	{
		if($_POST['ans6'] == 'option3')
		{
		//echo $_POST['ans3'];	
		$score = $score + 1;
		}
	}
	else
	{
	echo "Please answer question 6";
	}

	if(!empty($_POST['ans7']))
	{
		if($_POST['ans7'] == 'option3')
		{
		//echo $_POST['ans3'];	
		$score = $score + 1;
		}
	}
	else
	{
	echo "Please answer question 7";
	}

	if(!empty($_POST['ans8']))
	{
		if($_POST['ans8'] == 'option1')
		{
		//echo $_POST['ans3'];	
		$score = $score + 1;
		}
	}
	else
	{
	echo "Please answer question 8";
	}

	if(!empty($_POST['ans9']))
	{
		if($_POST['ans9'] == 'option1')
		{
		//echo $_POST['ans1'];	
		$score++;
		}
	}
	else
	{
	echo "Please answer question 9";
	}

	if(!empty($_POST['ans10']))
	{
		if($_POST['ans10'] == 'option2')
		{
		//echo $_POST['ans1'];	
		$score++;
		}
	}
	else
	{
	echo "Please answer question 10";
	}

//echo "You scored $score";
}
else
{
	echo "Please submit the form";
}

$con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

// UPDATE table_name
// SET column1=value1,column2=value2,...
// WHERE some_column=some_value;


if($score <=4 || $_POST['ans1'] != 'option3' || $_POST['ans2'] != 'option1' || $_POST['ans3'] != 'option2' || $_POST['ans4'] != 'option1')
{

	$query = "UPDATE userinfo SET prequiz='1',level='0' WHERE username='" .$_SESSION['username'] ."'";
	$result = mysqli_query($con,$query);
	if($result)
	{
		//echo $query ." ".$_SESSION['username'];
		header("Location: notes.php?level=1");
	}
	else
	{
		echo "Error!";
	}

	//echo "beginner";

}
else if(($score > 4 && $score <8) || $_POST['ans5'] != 'option2' || $_POST['ans6'] != 'option3' || $_POST['ans7'] != 'option3')
{
	$query = "UPDATE userinfo SET prequiz='1',level='1' WHERE username='" .$_SESSION['username'] ."'";
	$result = mysqli_query($con,$query);
	if($result)
	{
		//echo $query ." ".$_SESSION['username'];
		header("Location: notes.php?level=2");
	}
	else
	{
		echo "Error!";
	}
		//echo "intermediate";
	}
else
{
	$query = "UPDATE userinfo SET prequiz='1',level='2' WHERE username='" .$_SESSION['username'] ."'";
	$result = mysqli_query($con,$query);
	if($result)
	{
		//echo $query ." ".$_SESSION['username'];
		header("Location: notes.php?level=3");
	}
	else
	{
		echo "Error!";
	}
		//echo "Advanced";
}



?>