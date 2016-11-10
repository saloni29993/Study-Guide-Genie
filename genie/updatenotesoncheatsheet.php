<?php 

session_start(); 

$noteid = $_POST['user_name'];

$con=mysqli_connect("localhost","root","","javagenie");

$userid = $_SESSION['username'];
//echo "$userid <br>";


//$topic = str_replace("'", "", $topic);
$uid = $_SESSION['uid'];
//echo "$topic <br> $content <br> $code";

//('cheatid','topic','content','code','notesid')
$query = "SELECT * from notes WHERE uid = '" .$_SESSION['uid'] ."' and notesid NOT IN (SELECT notesid from cheatsheet)";

$result=mysqli_query($con,$query);


while($row=mysqli_fetch_array($result))
{

//echo "babababab";
 echo "<div class='grid-item'>
                                <table class='table table-striped'>
                                    <tbody>
                                    
                                        <tr>
                                            <td>
                                                <span class='label label-primary'> Topic </span> &nbsp; <b>" .$row['topic'] ."</b> 
                                                <button class='pull-right btn btn-primary addbutton' id='".$row['notesid'] ."' name='add'>ADD</button>
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