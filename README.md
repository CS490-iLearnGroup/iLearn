# iLearn Installation Instructions
1-Install MAMP https://www.mamp.info/en/downloads/
<br>
2-Pull the files from github and put it in htdocs folder in MAMP, name the folder
ilearn
<br>
3-download phpmyadmin https://www.phpmyadmin.net and move it to htdocs
folder and name it “phpmyadmin”
<br>
4-go to phpmyadmin in your localhost url probably http://localhost/phpmyadmin
or http://localhost:8888/phpmyadmin/ depending on your MAMP preferences
<br>
5-in phpmyadmin, create a new database named ilearn , or any other name but
you have to update it in config.php file
<br>
6-in MAMP/htdocs/ilearn go to Database folder and drag ilearn.xml and drop it
into phpmyadmin but you have to be in the database you just created, that
should create all the tables we need
<br>
7-in MAMP/htdocs/ilearn you will find moodledata.zip move it to MAMP/ and
unzip it, so the current moodledata folder will have the following path:
/Applications/MAMP/moodledata
<br>
8-rename MAMP/htdocs/ilearn/moodle/config-example.php to config.php
<br>
9-open MAMP/htdocs/ilearn/moodle/config.php in any text editor and make sure
it has the correct values, make sure it has the correct database values and the
correct url to your moodle in localhost in line 21 and the correct path to
moodledata folder (step 7), you probably won’t have to change anything if you
followed my steps
By now you should have everything ready, to test it go to your moodle site url
probably http://localhost/ilearn/moodle or http://localhost:8888/ilearn/moodle and
login
<br>
Admin info:
<br>
Username:admin
<br>
Password: Admin@admin1
