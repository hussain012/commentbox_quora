SETUP INSTRUCTIONS FOR MOODLE WONDERWALL FOR MOODLE 2.X

Note: this is a free version of the Moodle Wonderwall. It is not as full-featured as the latest version. The latest version has a dual editor feature plus more options.



SETUP INSTRUCTIONS
------------------

1. Extract the contents of wall.zip into a folder wall on your local PC.

2. Change the MySQL username, password and database name found inside the file includes/db.php

    define('DB_USERNAME', 'frankie_username'); <-- change to your MySQL admin user account name
    define('DB_PASSWORD', 'myPassword');       <-- change to your MySQL user account password
    define('DB_DATABASE', 'myDatabase');       <-- change to your MySQL database name



3. Import the SQL instructions found inside the file wall.sql

    If you have phpMyAdmin installed, then this process is quite simple. Otherwise, you might want to use a tool like
    MYSQL Wizard provided by your CPanel.


4. Edit the file includes/functions.php

    Change the identifier: mdl_m22_user to the name of your actual Moodle 2.2/2.3/2.4 user table.
    For example, if your user table is named m232_user, then change all occurrences of mdl_m22_user to m232_user.


5. Unzip wall.zip so that there is a folder named wall. Ftp the folder wall to public_html/moodle. For example, the Wall folder is
    the child of the moodle folder. I.e., 

    public_html/moodle/wall


6. Rename the user table name that I used in my code (mdl_m22_user) to your MySQL user table name.
If your user table name is already mdl_m22_user, then there is nothing for you to change. Otherwise, if your user table name is mdl_m2_user, then change all occurrences to mdl_m22_user t0 mdl_m2_user.

Note: Line numbers may differ. What is important are the contents of the code. Use Control-F to find for the code in each PHP file.

6.1   comment_ajax.php (1 hit)
	Line 321:  $ustring = "select * from mdl_m22_user where id = ".$uid;

6.2   load_comments.php (1 hit)
	Line 291:  $ustring = "select * from mdl_m22_user where id = ".$uid;

6.3   load_messages.php (3 hits)
	Line 411:  $ustring = "select * from mdl_m22_user where id = ".$uid;
	Line 645:  //$ustring = "select * from mdl_m22_user where id = ".$uid;
	Line 646:  $ustring = "select * from mdl_m22_user where id = ".$USER->id;

6.4   message_ajax.php (3 hits)
	Line 379:  $ustring = "select * from mdl_m22_user where id = ".$uid;
	Line 666:  //$ustring = "select * from mdl_m22_user where id = ".$uid;
	Line 667:  $ustring = "select * from mdl_m22_user where id = ".$USER->id;


6.5  functions.php (7 hits)

	Line 30:            $query = mysql_query("SELECT M.course_id, M.activity_id, M.msg_id, M.uid_fk, M.message, M.created, U.username, U.firstname, U.lastname FROM messages_activity M, mdl_m22_user U  WHERE M.uid_fk=U.id and M.course_id='$wcid' and M.activity_id='$id' order by M.msg_id desc ") or die(mysql_error());

	Line 33: 		   $query = mysql_query("SELECT M.course_id, M.activity_id, M.msg_id, M.uid_fk, M.message, M.created, U.username, U.firstname, U.lastname FROM messages_activity M, mdl_m22_user U  WHERE M.uid_fk=U.id and M.course_id='$wcid' and M.activity_id='$id' order by M.msg_id") or die(mysql_error());

	Line 47: 		$query = mysql_query("SELECT C.course_id, C.com_id, C.uid_fk, C.comment, C.created, U.username, U.firstname, U.lastname FROM comments_activity C, mdl_m22_user U WHERE C.uid_fk=U.id and C.msg_id_fk='$msg_id' and C.course_id='$wcid' order by C.com_id asc ") or die(mysql_error());

	Line 63: 	   $query = mysql_query("SELECT email FROM `mdl_m22_user` WHERE id = '$uid'") or die(mysql_error());

	Line 74: 		$ustring = "select * from mdl_m22_user where id = '2'";

	Line 102:             $newquery = mysql_query("SELECT M.msg_id, M.uid_fk, M.message, M.created, M.activity_id, U.username FROM messages_activity M, mdl_m22_user U where M.uid_fk=U.id and M.uid_fk='$uid' order by M.msg_id desc limit 1 ");

	Line 138:             $newquery = mysql_query("SELECT C.course_id, C.activity_id, C.com_id, C.uid_fk, C.comment, C.msg_id_fk, C.created, U.username FROM comments_activity C, mdl_m22_user U where C.uid_fk=U.id and C.uid_fk='$uid' and C.msg_id_fk='$msg_id' and C.course_id='$w' and C.activity_id='$id' order by C.com_id desc limit 1 ");
Search "mdl_m22_user" (8 hits in 4 files)



7. Create a webpage, block, resource where you can go to HTML Mode. In HTML Mode, paste in this code:

<h1>Dissertation Wall</h1>
<p></p>
<center><iframe width="100%" scrolling="auto" height="700px" frameborder="0" align="middle" name="Embedded Frame" src="http://www.yourwebsite.com/moodle/wall/index.php?Order=0&amp;CourseId=3&amp;Id=59&amp;Desc=What's the progress of your Dissertation so far?" marginheight="5px" marginwidth="5px"></iframe></center>

After you have saved the webpage resource, you may just see a blank page. If that happens, just do a browser refresh (F5) and the wall should appear after a couple of seconds.

If nothing happened, 
1. check that the wall subfolder is inside your moodle folder.
2. check that your user table name is mdl_m22_user.
3. check your debugging information by setting your moodle site's debugging mode to "show all errors".
4. Still can't solve it? Email Frankie Kam at: boonsengkam@gmail.com


iFRAME PARAMETERS EXPLANATION AND GUIDE
---------------------------------------

&Order=0  --> Display wall posts as normal social wall format. I.e., default FIFO mode. Most recent post at top of the wall.

&Order=1  --> Display wall posts as reverse social wall format. I.e., as LIFO mode. Last post at top of the wall.

&CourseId=28  --> supposed to be the same value as your Moodle course id. In actual fact, any number will do! You can change 28 to 1020 for example. 

&Id=1  --> any number will do. LOL! This MUST be set in tandem with &CourseId=28 for example.

&Desc=Announcements  --> Whatever is typed after &Desc will appear on the Wall page top.


ADDITIONAL NOTES
----------------

Your copy of the Wall code is exactly the same as this one:

http://www.moodurian.com/m2/mod/page/view.php?id=59
Username: student
Password: student

For more stuff that the Wall can do, refer to this blogpost.
http://moodurian.blogspot.com/2012/10/wallify-your-moodle-19-and-2x-coursepage.html


You can E-mail me if there are any problems.


Regards
Frankie Kam
boonsengkam@gmail.com


ADDITIONAL ADVANCED INFO
========================

You can even have a separate individual Wall for EVERY course!
All you need to do is to edit your 
/public_html/course/format/<courseformatname>/format.php

For example, on my system I have
/public_html/course/format/weekcoll/format.php

What I did was to add the below iframe code in between the 
print_container_start();
and
echo skip_main_destination(); 
lines.


For example below:-

...
    print_container_start();
 
    echo '<center><iframe style="border: 1px" width="100%" scrolling="auto" height="520px" frameborder="1" align="left" marginwidth="5px" marginheight="5px" src="http://www.yourwebsite.com/moodle/wall/index.php?CourseId='.$COURSE->id.'&Id=1&Order=0&Desc=Social Wall"></iframe></center>';	


    echo skip_main_destination(); 
...




End of setup instructions for the free version. 
Frankie Kam (c) 2012

