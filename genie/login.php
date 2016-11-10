<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>

        <script type="text/javascript" src="jquery-2.2.1.min.js">
</script>
        <meta name="generator" content="HTML Tidy for HTML5 (experimental) for Windows https://github.com/w3c/tidy-html5/tree/c63cc39">
        <title>
            User Login
        </title>
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
        <script type="text/javascript" src="bootstrap/js/bootstrap.js">
</script>
        <script type="text/javascript" src="masonry.pkgd.min.js">
</script>


<body>

<?php

        //echo $_GET['username'];
        if(!empty($_GET['username']) && !empty($_GET['password']))
        {
            //echo $_GET['username'] ." " .$_GET['password'];

            $user = $_GET['username'];
            $pass = $_GET['password'];
            $con=mysqli_connect("localhost","root","","javagenie");

            $result=mysqli_query($con,"SELECT * FROM userinfo WHERE username = '$user' and password = '$pass'");
            $result1=mysqli_query($con,"SELECT prequiz FROM userinfo WHERE username = '$user' and password = '$pass'");
            // if (!$result) {
            //     printf("Error: %s\n", mysqli_error($con));
            //     exit();
            // }

            $row = mysqli_fetch_array($result);
            $row1 = mysqli_fetch_array($result1);


            if(!empty($row['username']) && !empty($row['password']))
            {   //echo "yolo";
                $_SESSION['username'] = $user;
                $_SESSION['password'] = $pass;
                $_SESSION['uid'] = $row['uid'];
                $_SESSION['level'] = $row['level'];                
                if( $row1['prequiz'] == 0 )
                {
                    header("Location: prequiz.php");
                }
                else
                {
                    header("Location: notes.php");
                }
                
            }


            else
            {
                header("Location: index.php?msg=error");
            }
        }
        else
        {
            //echo "yolo";
            //echo '<script>alert("Incorrect ID/Passowrd!");<script>';
            header("Location: index.php?msg=enter");
        }
?>
            

</body>
</html>



