<?php session_start(); ?>
<?php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASSWORD', '');
   define('DB_NAME', 'javagenie');
   $con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
   
   //$result = mysqli_query($con,"SELECT * FROM userinfo where username='" ."$username" ."'");
   
   if(isset($_POST['register'])) 
   {
      // username and password sent from form 
      $id = rand(300,455);
      //$name = mysqli_real_escape_string($con, $_POST['name_modal']);
      $myusername = mysqli_real_escape_string($con,$_POST['username_modal']);
      $mypassword = mysqli_real_escape_string($con,$_POST['password_modal']); 
      
      $sql = "SELECT username FROM userinfo WHERE username = '$myusername'";
      $result = mysqli_query($con,$sql);

      $row = mysqli_fetch_array($result);

      $count = mysqli_num_rows($result);
      
      //echo "done count";
      // If result matched $myusername and $mypassword, table row must be 1 row
      
      if($count == 1) 
      {
         //echo "reached failed";
         //session_register("myusername");
         echo "SORRY...This username already exists!";
         header("Location: index.php?msg=userexists");
      }
      else 
      {
         //echo "reached";
         $query = mysqli_query($con, "INSERT INTO userinfo(uid,username,password,level,prequiz) VALUES ('$id','$myusername','$mypassword','0','0')");
         if($query)
         {

            //echo "Thank you! Go Ahead and use our system. Its AWESOME";
            $_SESSION['username']=$myusername;
            header("Location: prequiz.php");
         }
         else{
            echo "Error Occured";
         }

      }
    }  

?>