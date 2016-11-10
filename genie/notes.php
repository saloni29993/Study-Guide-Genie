<?php session_start(); ?>

<?php 
//echo "printing name : " .$_SESSION['username'];
if(empty($_SESSION['username']))
{
    header("Location: index.php?msg=login");
}


?>
<!DOCTYPE html>
<html>
    <head>

        <script type="text/javascript" src="jquery-2.2.1.min.js">
</script>
        <meta name="generator" content="HTML Tidy for HTML5 (experimental) for Windows https://github.com/w3c/tidy-html5/tree/c63cc39">
        <title>
            Notes
        </title>
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
        <script type="text/javascript" src="bootstrap/js/bootstrap.js">
</script>
        <script type="text/javascript" src="packery.pkgd.min.js">
</script>
        <script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js">
</script>
        <link rel="stylesheet" href="animate.css">
        <style>


        body{
            background-color: white;
        }




        .main{
             padding-top: 52px;
        }

        .nav-sidebar > li{
            font-size: 18px;
            border-bottom: 1px solid #eee;
        }
        .highlight{
            background-color: red;
        }

        .headings{
            background-color: #F8F8F8;
            font-size: 1.5em  ;
            font-style: bold;
            color: #777;
        }

        .textbook{
            overflow: auto;
            height: 350px;
            overflow-x:hidden; 
            background-color: white ;
        }

        .usernotes{
            overflow-y: auto;
            height: 400px;
            overflow-x: hidden; 
            background-color: white;
        }

        .stackoverflow{
            overflow: auto;
            height: 280px;
        }

        .codescroll{
            overflow-x: auto;
        }

        .createnote{
            height: 550px;
            background-color: white;
        }

        .recommend{
            height: 930px;
            overflow-y: auto;
            overflow-x: hidden; 
            background-color: #8b9dc3;// #dfe3ee;
        }

        .missing{
            height: 370px;
            overflow-y: auto;
            overflow-x: hidden; 
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

         .horizontal .carousel-inner {
                  height: 100%;
                }

                .carousel.horizontal .item {
                   -webkit-transition: 0.6s ease-in-out top;
                   -moz-transition: 0.6s ease-in-out top;
                   -ms-transition: 0.6s ease-in-out top;
                   -o-transition: 0.6s ease-in-out top;
                   transition: 0.6s ease-in-out top;
                }

                .carousel.horizontal .active {
                   top: 0;
                }

                .carousel.horizontal .next {
                   top: 400px;
                }

                .carousel.horizontal .prev {
                   top: -400px;
                }

                .carousel.horizontal .next.left,
                .carousel.horizontal .prev.right {
                   top: 0;
                }

                .carousel.horizontal .active.left {
                   top: -400px;
                }

                .carousel.horizontal .active.right {
                   top: 400px;
                }

                .carousel.horizontal .item {
                   left: 0;
                }

                .carousel-control.right{
                 background-image: none;
                }

                .carousel-control.left{
                background-image: none;
                }

        /*.screensizer{
            //margin-top: 51px;
            height: 100vh;
            background-color: red;
        }*/

        </style>
    </head>
    <body>
         <script type="text/javascript">
        
    </script>
        <script>
        

        $(function() {
            $('.carousel').carousel({
         interval: 7000,
        })
            //alert($(window).height());
                $("#testname").focus();
                //$('.screensizer').css({ height: ($(window).height()) });
                // $('.stackoverflow').css({ height: ($(window).height()/2.1) });

                $.ajax({
                    type: 'post',
                    url: 'aggtemp.php',
                    data: {
                        
                    },
                    success: function (response) {
                
                    $( '#display_recommendation' ).html(response);
                    }
               });


                 $.ajax({
                    type: 'post',
                    url: 'collab.php',
                    data: {
                        
                    },
                    success: function (response) {
                    
                    $( '#display_missing' ).html(response);
                    }
               });

        });

        function createnotes()
        {
            var topic = $("#topicinput").val();
            var content = $("#contentinput").val();
            var code = $("#codeinput").val();

            

            if(topic != "" && content !="")
            {
                $.ajax({
                    type: 'post',
                    url: 'createnotes.php',
                    data: {
                    note_topic:topic,
                    note_content:content,
                    note_code:code,
                    },
                    success: function (response) {
                    
                    //alert("chala");
                    // We get the element having id of display_info and put the response inside it
                    //$( '#stackcontent' ).html(response1);
                    //alert(response1);
                    alert("Note has been Inserted : " +response)

                    if(response=="success")
                    {
                        $("#topicinput").val("");
                        $("#contentinput").val("");
                        $("#codeinput").val("");

                    }
                    
                    }
               });
                
            }

            else{
                alert("Please Enter Topic/Content for the Note");
            }

            




        }

        function loaddata()
        {
        var name;
        if(document.getElementById( "testname" ).value)
        {
        name=document.getElementById( "testname" ).value;
        }

        else if(document.getElementById( "topicinput" ).value)
        {
          name=document.getElementById( "topicinput" ).value;  
        }
        else
        {
        name = " ";
        }

        if(name)
        {
        //alert(name);

        //Displays Stack overflow content
        $.ajax({
            type: 'post',
            url: 'srcapestack.php',
            data: {
            user_name:name,
            },
            success: function (response1) {
            
            //alert("chala");
            // We get the element having id of display_info and put the response inside it
            $( '#stackcontent' ).html(response1);
            //alert(response1);

            }
           });

        //Display textbook
        $.ajax({
            type: 'post',
            url: 'searchtextbook.php',
            data: {
            user_name:name,
            },
            success: function (response) {
            
            // We get the element having id of display_info and put the response inside it
            $( '#display_info_textbook' ).html(response);
            //alert(response);
            //$('.notranslate').find('br').remove();
            }

           });

        $.ajax({
            type: 'post',
            url: 'searchusernotes.php',
            data: {
            user_name:name,
            },
            success: function (response) {
            
            // We get the element having id of display_info and put the response inside it
            $( '#display_info_usernotes' ).html(response);
            //alert(response);

            }
           });

        }

        }

        </script> <script>

        </script>
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
                    <li class="">
                        <a href="cheatsheet.php">Cheatsheet</a>
                    </li>
                    <li class="active">
                        <a href="#">Notes</a>
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
        <div class="screensizer">
        <div class="container-fluid main">
            <div class="row">
                <div class="wrapper">
                    <!-- To fix the Overlapping of side bar we fill that area with below div -->
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        <div class="well animated fadeInLeft" style="background-color:#dfe3ee;">
                            
                        
                                <h4>Your CLassmates are noting...</h4>
                        
                            <div class="panel-body usernotes">
                                <div class="grid"  id="display_info_usernotes">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="well animated fadeInDown" style="background-color:#3b5998;">
                            
                               <h4 style="color:white;">Reference Book says...</h4> 
                            
                            <div class="panel-body textbook">
                                <div class="grid" data-masonry='{"itemSelector": ".grid-item","columnWidth": ".grid-sizer","percentPosition": "true"}' id="display_info_textbook">
                                    <!-- Text book notes are bieng displayed here -->
                                </div>
                            </div>
                        </div>
                        <!-- <div class="panel panel-default">
                            <div class="panel-heading">
                                Your classmates are noting...
                            </div>
                            <div class="panel-body usernotes">
                                <div class="grid"  id="display_info_usernotes">
                                    
                                </div>
                            </div>
                        </div> -->
                        
                        <!-- <div class="panel panel-warning">
                            <div class="panel-heading">
                                Frequently asked Questions
                            </div>
                            <div id="stackcontent" class="panel-body stackoverflow">
                                <i>Search to get Related links...</i>
                            </div>
                        </div>   -->
                        <!-- <div class="panel panel-info">
                            <div class="panel-heading">
                                You might have missed...
                            </div>
                            <div class="panel-body missing">
                                <div class="grid" data-masonry='{"itemSelector": ".grid-item","columnWidth": ".grid-sizer","percentPosition": "true"}' id="display_missing">
                                    
                                </div>
                            </div>
                        </div> -->
                        
                    </div>
                    <div class="col-md-5 col-sm-5 col-xs-5">
                        <!-- <div class="well animated fadeInDown">
                            <div class="panel-heading">
                                Reference Book says...
                            </div>
                            <div class="panel-body textbook">
                                <div class="grid" data-masonry='{"itemSelector": ".grid-item","columnWidth": ".grid-sizer","percentPosition": "true"}' id="display_info_textbook">
                                
                                </div>
                            </div>
                        </div> -->
                        <div class="well recommend notecard animated fadeInUp carousel slide vertical" id="myCarousel" style="background-color:#white;">
                            <h4>Recommended for you</h4>
                            <div class="carousel-inner" id='display_recommendation' style="background-color:white;">
                                
                            </div>
                            <a class="carousel-control left" href="#myCarousel" data-slide="prev"></a>
                                <a class="carousel-control right" href="#myCarousel" data-slide="next"></a>
                        </div>
                        <!-- <div class="panel panel-danger">
                            <div class="panel-heading">
                                You should consider adding
                            </div>
                            <div class="panel-body recommend">
                                <div class="grid" data-masonry='{"itemSelector": ".grid-item","columnWidth": ".grid-sizer","percentPosition": "true"}' id="display_recommendation">
                                    
                                </div>
                            </div>
                        </div> -->

                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <div class="container-fluid notecard animated fadeInRight createnote" style="background-color:#3b5998;color:white;">
                            
                                <h4>&nbsp;&nbsp;Take Notes</h4>
                                <hr>
                            
                            <div class="container-fluid">

                                <form>
                                  <fieldset class="form-group">
                                    <label for="formGroupExampleInput">Topic</label>
                                    <input type="text" class="form-control" id="topicinput" onkeyup="loaddata();" placeholder="Add Topic...">
                                  </fieldset>
                                  <fieldset class="form-group">
                                    <label for="formGroupExampleInput2">Content</label>
                                    <textarea class="form-control" rows="6" id="contentinput" placeholder="Add content..."></textarea>
                                  </fieldset>
                                  <fieldset class="form-group">
                                    <label for="formGroupExampleInput2">Code</label>
                                    <textarea class="form-control" rows="6" id="codeinput" placeholder="Add code..."></textarea>
                                  </fieldset>
                                  <fieldset class="form-group">
                                    <input type="submit" class="btn btn-md btn-default" value="Create" onclick="createnotes();">
                                  </fieldset>

                                </form>

                            </div>
                        </div>

                        <br>
                        <div class="well animated fadeInUp" style="background-color:#dfe3ee;">
                            
                              <h4>Frequently asked Questions</h4>  
                            
                            <div class="panel-body stackoverflow" style="background-color:white;">
                                <div class="grid" id="stackcontent" style="background-color:#white;">
                                    <i>Search to get Related links...</i>
                                </div>
                            </div>
                        </div> 
                        
                    </div>
                </div>
            </div>
                
        </div>
        </div>
    </body>
</html>
