<?php 

session_start(); 

$noteid = $_POST['user_name'];

$con=mysqli_connect("localhost","root","","javagenie");

$userid = $_SESSION['username'];

$uid = $_SESSION['uid'];

$query = "DELETE from cheatsheet where notesid = $noteid and uid = $uid";
$result= mysqli_query($con,$query);

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