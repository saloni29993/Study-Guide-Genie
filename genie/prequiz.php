<?php session_start();



 ?>
<!DOCTYPE html>
<html>
    <head>

        <script type="text/javascript" src="jquery-2.2.1.min.js">
</script>
        <script type="text/javascript" src="jquery-2.2.1.min.js">
</script>
        <meta name="generator" content="HTML Tidy for HTML5 (experimental) for Windows https://github.com/w3c/tidy-html5/tree/c63cc39">
        <title>
            Notes
        </title>
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
        <script type="text/javascript" src="bootstrap/js/bootstrap.js">
</script>
        <script type="text/javascript" src="masonry.pkgd.min.js">
</script>
        <style>


        .grid-item {
          float: left;
          width: 30%;
          /*height: 450px;*/
          padding: 1px;
          margin: 5px;
          border: 2px solid hsla(0, 0%, 0%, 0.5);
          /*background-color: #e15a64;*/
        }
        .grid-item--width2 { 
            width: 400px; 

        }

        .sidebar{
            height: 100%;
            background-color: #f5f5f5;
            border-right: 1px solid #eee;
            position: fixed;
            display: block;
            
            padding-top: 20px;
            
        }

        .content{
            height: 100%;
            display: block;
            //position: fixed;
           // overflow-y: scroll;
            float: left; 
            /*background-color: #a0121c;*/

        }

        .wrapper{
            height: 100%;
        }

        .main{
            padding-top: 51px;
        }

        .nav-sidebar > li{
            font-size: 18px;
            border-bottom: 1px solid #eee;
        }

        .prequiz{
            border: solid 1px;
            border-radius: 10px;
            padding: 5px;
        }

        </style>
    </head>
    <body>
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="prequiz">



            
            <h1>
                Pre-Quiz
            </h1>
            <form action="grade.php" id="quiz" method="post" name="quiz">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>
                                <h4>Question 1:</h4>
                                <br>
                                Consider the following code segment:<br>
                                <br>
                                public class MyTester {<br>
                                <br>
                                &nbsp; public static void main(String[] args) {<br>
                                <br>
                                &nbsp; &nbsp; int i = 14;<br>
                                &nbsp; &nbsp; int j = 20;<br>
                                &nbsp; &nbsp; int k;<br>
                                &nbsp; &nbsp; k = j / i * 7 % 4;<br>
                                <br>
                                }<br>
                                <br>
                                What is the Value of k?
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="radio">
                                    <label><input type="radio" name="ans1" id="ans1-1" value="option1"> 5</label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="ans1" id="ans1-2" value="option2"> -6</label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="ans1" id="ans1-3" value="option3"> 3</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Question 2:</h4>
                                <br>
                                Given the declaration int[] nums = {8,12,23,4,15},<br>
                                What expression will display the frst element in the array (i.e. the number 8)
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="radio">
                                    <label><input type="radio" name="ans2" id="ans2-1" value="option1"> System.out.println("The number is: "+nums[0]);</label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="ans2" id="ans2-2" value="option2"> System.out.println("The number is: "+nums[1]);</label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="ans2" id="ans2-3" value="option3"> System.out.println("The number is: "+nums[8]);</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Question 3:</h4>
                                <br>
                                The default statement of switch is always executed
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="radio">
                                    <label><input type="radio" name="ans3" id="ans3-1" value="option1"> True</label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="ans3" id="ans3-2" value="option2"> False</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Question 4:</h4>
                                <br>
                                What is the data type for this value: 0.5
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="radio">
                                    <label><input type="radio" name="ans4" id="ans4-1" value="option1"> Double</label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="ans4" id="ans4-2" value="option2"> String</label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="ans4" id="ans4-3" value="option3"> Int</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Question 5:</h4>
                                <br>
                                A null reference may be used to access a static variable or method
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="radio">
                                    <label><input type="radio" name="ans5" id="ans5-1" value="option1"> True</label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="ans5" id="ans5-2" value="option2"> False</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Question 6:</h4>
                                <br>
                                The following prototype shows that a Cylinder subclass is derived from superclass called Circle:
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="radio">
                                    <label><input type="radio" name="ans6" id="ans6-1" value="option1"> Class Circle extends Cylinder</label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="ans6" id="ans6-2" value="option2"> Class Cylinder derived Circle</label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="ans6" id="ans6-3" value="option3"> class Cylinder extends Circle</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Question 7:</h4>
                                <br>
                                WHich of the following correctly declares that the page is an error page and also enables it to take session?
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="radio">
                                    <label><input type="radio" name="ans7" id="ans7-1" value="option1"> <%@ page isErrorPage ="true" session="mandatory" %></label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="ans7" id="ans7-2" value="option2"> <%@ page pageType="errorPage" session="required" %></label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="ans7" id="ans7-3" value="option3"> <%@ page isErrorPage="true" session="true" %></label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Question 8:</h4>
                                <br>
                                Synchronized is a keyword to tell a thread to grab an Object lock before continuing execution
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="radio">
                                    <label><input type="radio" name="ans8" id="ans8-1" value="option1"> True</label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="ans8" id="ans8-2" value="option2"> False</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Question 9:</h4>
                                <br>
                                How is the layout of widgets on panel specified?
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="radio">
                                    <label><input type="radio" name="ans9" id="ans9-1" value="option1"> By calling the method setLayout</label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="ans9" id="ans9-2" value="option2"> By inheriting from main container such as a JFrame or JApplet</label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="ans9" id="ans9-3" value="option3"> By calling the method setContentPane</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Question 10:</h4>
                                <br>
                                Which of the following is a valid taglib directive?
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="radio">
                                    <label><input type="radio" name="ans10" id="ans10-1" value="option1"> <% taglib uri="/stats" prefix="stats" %></label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="ans10" id="ans10-2" value="option2"> <%@ taglib uri="/stats" prefix="stats" %></label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="ans10" id="ans10-3" value="option3"> <%@ taglib name="/stats" prefix="stats" %></label>
                                </div>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                <input type="submit" class="btn btn-primary btn-lg" name="submit" id="submit">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
            </div>
        </div>
        <div class="col-md-2"></div>
    </body>
</html>
