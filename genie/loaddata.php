<?php session_start(); ?>
<?php

        //echo $_GET['username'];
        if(isset($_POST['user_name']))
        {
            //echo $_GET['username'] ." " .$_GET['password'];

            $user = trim($_POST['user_name']);
            $user= str_replace("% ","%",$user);
            $keywords = explode(" ", $user);
            

            $query1 = "SELECT topic,content,code FROM textbook WHERE topic LIKE '%";
            $query1 .= implode("%' or topic LIKE '%", $keywords) ."%'";

            echo "Query 1 : " .$query1;
            $result=mysqli_query($con,$query1);

            // if (!$result) {
            //     printf("Error: %s\n", mysqli_error($con));
            //     exit();
            // }

            //$row = mysqli_fetch_array($result);
            //echo $result;

            while($row=mysqli_fetch_array($result))
            {
                //echo "<p>".$row['topic'] ."</p>";
                //echo "<p>".$row['content'] ."</p>";
                //echo "<p>".$row['password'] ."</p>";
                echo "<div class='grid-item table-responsive'>

                                <table class='table table-striped'>
                                    <tbody>
                                    
                                        <tr>
                                            <td>
                                                <span class='label label-primary'> Topic </span> &nbsp; <b>" .$row['topic'] ."</b> 
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

            // $query3 = "SELECT topic FROM textbook WHERE topic LIKE '%";
            // $query3 .= implode("%' or topic LIKE '%", $keywords) ."%'";

            // $query2 = "SELECT topic,content,code FROM textbook WHERE content LIKE '%";
            // $query2 .= implode("%' or content LIKE '%", $keywords) ."%'"; 
            // $query2 .= " AND topic NOT IN (" .$query3 .") LIMIT 10";    
            // $result=mysqli_query($con,$query2);

            // echo "Query 2 :" .$query2;
            // echo "<br><br><br><br><br>";
            // while($row=mysqli_fetch_array($result))
            // {
            //     //echo "<p>".$row['topic'] ."</p>";
            //     //echo "<p>".$row['content'] ."</p>";
            //     //echo "<p>".$row['password'] ."</p>";
            //     echo "<div class='grid-item'>
            //                     <table class='table table-striped'>
            //                         <tbody>
            //                             <tr>
            //                                 <td>
            //                                     Topic
            //                                 </td>
            //                             </tr>
            //                             <tr>
            //                                 <td>
            //                                     <span class='label label-success'> Topic </span> &nbsp; <b>" .$row['topic'] ."</b> 
            //                                 </td>
            //                             </tr>
            //                             <tr>
            //                                 <td>
            //                                     Content
            //                                 </td>
            //                             </tr>
            //                             <tr>
            //                                 <td>
            //                                    ".$row['content'] ." <!-- <span class='label label-danger'> Content</span> -->
            //                                 </td>
            //                             </tr>
            //                             <tr>
            //                                 <td>
            //                                    ".$row['code'] ." <!-- <span class='label label-danger'> Content</span> -->
            //                                 </td>
            //                             </tr>
            //                         </tbody>
            //                     </table>
            //                 </div>";
                           
            // }

             //echo "<script>$('#display_info').highlight( " .$user .");</script>";
        }

            
        
        
?>