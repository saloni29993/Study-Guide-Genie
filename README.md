# Study-Guide-Genie

An adaptive recommender system is a kind of system which adapts based on user interaction with the system. It deals with representing and organizing the information that is most relevant to user. Java Study Guide Genie is such an adaptive recommender system. The goal of the system is to encourage programming learning, to push students organize domain knowledge and facilitate exam preparation. The quiz determines the knowledge level of the student which is taken into consideration while providing hybrid recommendations. The system facilitates learning by allowing students to take notes. The dynamic nature of the system provides recommendation for similar topic from the reference book and their peer’s notes. The social aspect of the system shows a visualization of how two user profiles are similar. This system a user-friendly adaptive system which is to-go tool for cheat sheet preparation.

I recommend you run this project on windows machine due to the Elastic Search version support.

To run the project, please follow the steps given below. Please note that you might be familier with some of the steps. I still request you to follow all stepa very carefully/

1. Download and install XAMPP for windows. You can download from here  https://www.apachefriends.org/download.html

2. Go to XAMPP directory. Inside the XAMPP folder, find a folder called ‘htdocs’. Place the submitted folder named “genie” in this directory. The final path will look something like: “C:/Xampp/htdocs/genie “

3. Now go to XAMPP folder again. Inside that find a file called “xampp-control.exe” . Run this file . A window will open . Click start   for Apache and MySQL module . And make sure this runs all the time while running the project.

![alt tag](https://github.com/saloni29993/Study-Guide-Genie/blob/master/screenshots/xamp.png)

4. 4. Go to your browser (Google chrome most prefered). Type the following link: “localhost/phpmyadmin” 
On the left menu you will find a new button. When you click that button you will create a database with name “ javagenie” and press create.
Once you have created the new database, from the top menu c lick import. Click Choose file button a nd s elect the file “javagenie.sql” f rom d atabase folder i n our submission folder. And p r e s s G  o .
Please allow some time for the database tables to load. You will see a message saying “ Import has been successfully finished”.

5. Copy the “elasticsearch-2.3.1” folder  from this repository on desktop.

6. Now right click “This PC (My computer)”. Go to properties. Click on “Advanced System Settings” from the left menu. Click on “Environment Variables”. In the System variables tab, CLick on New. A new window will open. In the variable name text box a dd “JAVA_HOME”. And in the Variable value field add the path to your Java jdk folder. The path should look something like this: “C:\Program Files\Java\jdk1.8.0_77”. Once you have done this, Click on OK.

7. Now open the elasticsearch folder on your desktop and then go to bin. Inside the folder you will find “elasticsearch” file. The file type is “Windows Batch File” . Run this file... You should see the console open.

8. Allow some time for the it to load... When nothing more is printed in the console everything has been loaded.  Make sure this window is open all the time.

![alt tag](https://github.com/saloni29993/Study-Guide-Genie/blob/master/screenshots/bash.png)

9. Now, go to your browser and go to url -> “localhost:9200” You should see something like this...

![alt tag](https://github.com/saloni29993/Study-Guide-Genie/blob/master/screenshots/code.png) 

This means Elasticsearch is running. 

10. Now in your browser go to URL “localhost/genie/”
You should see the home page. You are now free to use the system.

11. You can login with few of these credentials or look at the database for the set of users for their login information.
      1) Username: KashBhansali 
      2) Username: JohnSmith
      3) Username: NikitShah
      4) Username: MattTodd  
      The Password for all of the above users is: qwer. 

12. The app.R file consists of the code for social graph. The file just needs to be run on RStudio while xampp is running and press “Run App” button to see the social graph for a user.



