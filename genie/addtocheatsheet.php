<?php 

session_start(); 

$noteid = $_POST['user_name'];

$con=mysqli_connect("localhost","root","","javagenie");

$userid = $_SESSION['username'];

$query1 = "SELECT * from notessal where notesid = '$noteid' and uid = " .$_SESSION['uid'];
$result1=mysqli_query($con,$query1);

$topic ="";
$content="";
$code="";
$notesid="";

while($row=mysqli_fetch_array($result1))
{
	$topic = $row['topic'];
	$content = $row['content'];
	$code = $row['code'];
	$notesid = $row['notesid'];
}

$topic = str_replace("'", "", $topic);
$code = str_replace("'", "", $code);
$content = str_replace("'", "", $content);

$uid = $_SESSION['uid'];

$query = "INSERT into cheatsheet  VALUES ('','$topic','$content','$code',$notesid,$uid)";

$result=mysqli_query($con,$query);



$query1 = "SELECT * from cheatsheet where uid = $uid";

$result1=mysqli_query($con,$query1);



while($row=mysqli_fetch_array($result1))
{
 echo "<div class='grid-item'>
                                <table class='table table-striped'>
                                    <tbody>
                                    
                                        <tr>
                                            <td>
                                                <span class='label label-success'> Topic </span> &nbsp; <b>" .$row['topic'] ."</b> 
                                                <button class='pull-right btn btn-danger deletebutton' id='".$row['notesid'] ."' name='delete'>Delete</button>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td>
                                               ".$row['content'] ." <!-- <span class='label label-danger'> Content</span> -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                               <div style='width:700px;'>".$row['code'] ."</div> <!-- <span class='label label-danger'> Content</span> -->
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>";
                           
}



 ?>