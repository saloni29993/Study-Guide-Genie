<?php
// Start the session
session_start();
?>
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

<style>

.btn-block{
    width: 100%;
}


.logindetails{
    background-color: #F7F7F9;
    padding : 5px;
    border-radius: 10px;
}



.notecard{
            padding: 5px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            

        }

       
    @import url(https://fonts.googleapis.com/css?family=Montserrat);

        html, body{
          height: 100%;
          font-weight: 50;
        }

        body{
          background: #2c2c2c;
          font-family: Arial;
        }

        svg {
            display: block;
            font: 6em 'Calibri';
            width: 960px;
            height: 300px;
            margin: 0 auto;
        }

        .text-copy {
            fill: none;
            stroke: white;
            stroke-dasharray: 10% 29%;
            stroke-width: 5px;
            stroke-dashoffset: 0%;
            animation: stroke-offset 5.5s infinite linear;
        }

        .text-copy:nth-child(1){
            stroke:  #3b5998;
            animation-delay: -1;
        }

        .text-copy:nth-child(2){
            stroke: #6d84b4;
            animation-delay: -2s;
        }

        .text-copy:nth-child(3){
            stroke: #afbdd4;
            animation-delay: -3s;
        }

        .text-copy:nth-child(4){
            stroke:  #d8dfea;
            animation-delay: -4s;
        }

       .text-copy:nth-child(5){
            stroke: #ffffff;
            animation-delay: -5s;
        }

        @keyframes stroke-offset{
            100% {stroke-dashoffset: -35%;}
        }
    




</style>
    </head>
    <body style="padding:0px;margin:0px">
        
        <div class="header">
            <div class="row">
            <svg viewBox="0 0 960 300">
            <symbol id="s-text">
                <text text-anchor="middle" x="50%" y="60%">JAVA STUDY GUIDE GENIE</text>
            </symbol>

                <g class = "g-ants">
                    <use xlink:href="#s-text" class="text-copy"></use>
                    <use xlink:href="#s-text" class="text-copy"></use>
                    <use xlink:href="#s-text" class="text-copy"></use>
                    <use xlink:href="#s-text" class="text-copy"></use>
                    <use xlink:href="#s-text" class="text-copy"></use>
                </g>
            </svg>
            </div>
            
            <div class="row">
                </div>
    </div>
        <div class="container" style="border-width:1px;border-radius:4px;">

            <div class="row"><br><br><br><br></div>
            <div class="row">
                <div class="col-md-4 col-sm-3"></div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    
                    <div class="logindetails notecard">
                    <!-- <h1>
                        Java Genie
                    </h1> -->
                    <form action="login.php" method="get"  class="form-group">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label> <input type="text" class="form-control" id="exampleInputEmail1" name="username" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label> <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
                        </div><button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>
                        <br>
                        <?php 
                            if (isset($_GET['msg']))
                            {
                                if($_GET['msg'] == "error")
                                {
                                    echo '<div class="alert alert-danger" role="alert">Username/Password Incorrect</div>';
                                }

                                if($_GET['msg'] == "enter")
                                {
                                    echo '<div class="alert alert-danger" role="alert">Please Enter Username/Password</div>';
                                }
                                if($_GET['msg'] == "userexists")
                                {
                                    echo '<div class="alert alert-danger" role="alert">Username Already Exists</div>';
                                }
                                if($_GET['msg'] == "login")
                                {
                                    echo '<div class="alert alert-warning" role="alert">Please Sign In !</div>';
                                }
                                if($_GET['msg'] == "logout")
                                {
                                    echo '<div class="alert alert-success" role="alert">Logged Out Successfully...</div>';
                                }
                            }
                        

                         ?>
                    </form>
                    <button name="register" class="btn btn-lg btn-block" data-toggle="modal" data-target="#myModal">Register</button>
                    <h1>   </h1>
                    </div>
                </div>
                <div class="col-md-4 col-sm-3"></div>

                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">New User Registration</h4>
                          </div>
                          <div class="modal-body">
                        
                                    <form action="register.php" method="post" class="form-group">
                                       <!--  <div class="form-group">
                                                <label for="exampleInputEmail1">Name</label> <input type="name" name="name_modal" class="form-control" id="exampleInputEmail1" placeholder="Name">
                                            </div> -->
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Username</label> <input type="username" name="username_modal" class="form-control" id="exampleInputEmail1" placeholder="Username">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Password</label> <input type="password" name="password_modal" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                            </div><button type="submit" name="register" class="btn btn-primary btn-lg btn-block">Create</button>
                                        </form>

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                          </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </body>
</html>
