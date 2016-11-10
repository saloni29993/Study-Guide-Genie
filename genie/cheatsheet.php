<?php 

session_start();
$con=mysqli_connect("localhost","root","","javagenie");

?>

<!DOCTYPE html>
<html>
    <head>

        <script type="text/javascript" src="jquery-2.2.1.min.js">
</script>
        <meta name="generator" content="HTML Tidy for HTML5 (experimental) for Windows https://github.com/w3c/tidy-html5/tree/c63cc39">
        <title>
            CheatSheet
        </title>
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
        <script type="text/javascript" src="bootstrap/js/bootstrap.js">
        </script>
        <script type="text/javascript" src="packery.pkgd.min.js">
        </script>
        <script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js">
        </script>


        <style>
        .main{
            padding-top: 52px;
        }
        .usernotes{
            height : 400px;
            overflow: auto;
        }

        .cheatsheet{
            height: 885px;
            overflow-y: scroll;
            background-color: white;
        }

        .con{
            text-overflow : ellipsis;
        }

        .textbook{
            height: 400px;
            overflow: auto;
        }

        .missing{
            height: 420px;
            overflow: auto;
        }

        .card{
            padding: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        .notecard{
            padding: 5px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            

        }

        .notranslate{
            white-space:pre-wrap;
        }

        .well {
    background: rgb(255, 255, 255);
}


        </style>
    
    </head>
<script>


$(function(){

//ajax call to add
    $.ajax({
            type: 'post',
            url: 'getmissingkeywords.php',
            //cache: false,
            data: {
            //user_name:id,
            },
            success: function (response1) {
            
            $( '#display_keywords' ).html(response1);

            }
            
           });

    $.ajax({
            type: 'post',
            url: 'agg.php',
            //cache: false,
            data: {
            //user_name:id,
            },
            success: function (response1) {
            
            $( '#display_missingkeywords' ).html(response1);

            }
            
           });

	
    $('button[name=add]').on('click',function(){
        var id= $(this).attr("id");
        //alert("adddddd");
        $.ajax({
            type: 'post',
            url: 'addtocheatsheet.php',
            //cache: false,
            data: {
            user_name:id,
            },
            success: function (response1) {
            
            $( '#display_cheatsheet' ).html(response1);

            }
            
           });
      
            var b = "#" +id;
            $(b).text("ADDED");
            $(b).prop('disabled',true);
       		window.location.reload();
    });

//ajax call to delete
    $('button[name=delete]').on('click',function(){


        var id= $(this).attr("id");

        var b = "#" +id;
            $(b).text("DELETED");
            $(b).prop('disabled',true);
            
        
        $.ajax({
            type: 'post',
            url: 'deletefromcheatsheet.php',
            //cache: false,
            data: {
            user_name:id,
            },
            success: function (response1) {

            
            $('#display_cheatsheet').html(response1);

            $.ajax({
            type: 'post',
            url: 'updatenotesoncheatsheet.php',
            cache: false,
            data: {
            user_name:id,
            },
            success: function (response2) {
            
            $( '#display_notes' ).html(response2);
            
            }
            
           });

            window.location.reload();
            }
            
           });

        
        	
      
    });
});






</script>
<body>
        <nav class="navbar navbar-inverse navbar-fixed-top navbar-collapse">
            <div class="container-fluid">
              
                <ul class="nav navbar-nav navbar-left">
                    <li class="">
                        <a class="navbar-brand" href="#"><b>Java Genie</b></a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                   
                    <li class="active">
                        <form class="navbar-form">
                            <div class="form-group">
                                <input class="form-control" placeholder="Search" type="text" name="username" id="testname" onkeyup="loaddata();">
                            </div>
                        </form>
                    </li>
                    <li class="">
                        <a href="drag.php">Print !</a>
                    </li>
                    <li class="active">
                        <a href="cheatsheet.php">Cheatsheet</a>
                    </li>
                    <li class="">
                        <a href="notes.php">Notes</a>
                    </li>
                    <li>
                        <a href="#">Welcome, <?php echo $_SESSION['username']; ?></a>
                    </li>
                    <li>
                        <a href="logout.php">Sign Out</a>
                    </li>
                </ul>
            </div>
        </nav>

<div class="container-fluid main">

<div class="row">
	<div class="col-md-6" id="display_notes">
        <div class="well" style="">
                            <!-- <div class="panel-heading">
                                Your Notes
                            </div> -->
                            <h4>&nbsp;&nbsp;&nbsp;Your Notes...</h4>
                            <div class="panel-body usernotes">
                                <div class="grid" data-masonry='{"itemSelector": ".grid-item","columnWidth": ".grid-sizer","percentPosition": "true"}' id="display_info_textbook">
                                    <!-- USER notes are bieng displayed here -->
                                    <?php 

                                    $query = "SELECT * from notessal WHERE uid = '" .$_SESSION['uid'] ."' and notesid NOT IN (SELECT notesid from cheatsheet where uid = '" .$_SESSION['uid'] ."' )";

                                    $result=mysqli_query($con,$query);

                                    while($row=mysqli_fetch_array($result))
                                    {

                                        echo "<div class='grid-item notecard'>
                                                        <table class='table table-striped'>
                                                            <tbody>
                                                            
                                                                <tr>
                                                                    <td>
                                                                        <span class='label label-primary'> Topic </span> &nbsp; <b>" .$row['topic'] ."</b> 
                                                                        <button class='pull-right btn btn-primary' id='".$row['notesid'] ."' name='add'>ADD</button>
                                                                    </td>
                                                                </tr>
                                                                
                                                                <tr>
                                                                    <td class='con'>
                                                                       ".$row['content'] ." <!-- <span class='label label-danger'> Content</span> -->
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                       <div style='width:700px;'><pre>".$row['code'] ."</pre></div> <!-- <span class='label label-danger'> Content</span> -->
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>";
                                                   
                                    }


                                 ?>
                                </div>
                            </div>
        </div>

        <div class="row">

        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Keywords: Summarizing the Content
                </div>
                <div class="panel-body textbook">
                    <div class="grid" data-masonry='{"itemSelector": ".grid-item","columnWidth": ".grid-sizer","percentPosition": "true"}' id="display_keywords">
                        

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    You might be missing these topics...
                </div>
                <div class="panel-body missing">
                    <div class="grid" data-masonry='{"itemSelector": ".grid-item","columnWidth": ".grid-sizer","percentPosition": "true"}' id="display_missingkeywords">
                        
                    </div>
                </div>
            </div>
        </div>

        </div>
		
	</div>

	<div class="col-md-6" >

        <div class=" well notecard" style="background-color:#3b5998;">
                            
                               <h4 style="color:white;">&nbsp;&nbsp;CheatSheet</h4>
                            
                            <div class="panel-body cheatsheet table table-responsive">
                                <div class="grid" data-masonry='{"itemSelector": ".grid-item","columnWidth": ".grid-sizer","percentPosition": "true"}' id="display_cheatsheet">
                                    <!-- Cheatsheets are bieng displayed here -->
                                    <?php 

                                    $query = "SELECT * from cheatsheet where uid ='" .$_SESSION['uid'] ."'";

                                        $result=mysqli_query($con,$query);

                                        while($row=mysqli_fetch_array($result))
                                        {
                                        
                                            echo "<div class='grid-item notecard'>
                                                            <table class='table table-striped'>
                                                                <tbody>
                                                                
                                                                    <tr>
                                                                        <td>
                                                                            <span class='label label-success'> Topic </span> &nbsp; <b>" .$row['topic'] ."</b> 
                                                                            <button class='pull-right btn btn-danger' id='".$row['notesid'] ."' name='delete'>Delete</button>
                                                                        </td>
                                                                    </tr>
                                                                    
                                                                    <tr>
                                                                        <td>
                                                                           ".$row['content'] ." <!-- <span class='label label-danger'> Content</span> -->
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                           <div style='width:700px;'><pre>".$row['code'] ."</pre></div> <!-- <span class='label label-danger'> Content</span> -->
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>";
                                                       
                                        }





                                     ?>
                                </div>
                            </div>
        </div>

		


	</div>
</div>
</div>
</body>
</html>