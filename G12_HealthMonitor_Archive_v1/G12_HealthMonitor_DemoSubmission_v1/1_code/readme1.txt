Health Monitor - Fitness Friends
Group 12
readme.txt


README

  Fitness Friends is a health improving program that will help improve or better the lives
  of the individual user. With Fitness Friends, the user can compare, share, and compete
  with friends on their daily exercise or routine. Users can view their "fitness points"
  vs. their friends and see who has a better score.

WEBSITE
  Visit us at http://se1.engr.rutgers.edu/~13group12/ for any questions or problems.

INSTALL
  For database
  1. create a database with any name
  2. create a table with 11 rows with these items: name, type, default
	a.user_id, int(11), none, auto_increment
	b.username, varchar(32), none
	c.password, varchar(32), none
	d.first_name, varchar(32), none
	e.last_name, varchar(32), none
	f.email, varchar(255), none
	g.age, int(2), none
	h.weight, int(3), none
	i.cardio_points, int(11), 0
	j.user_file, varchar(55), none
	k.gender, varchar(55), none


  FOR PHP FILES
  1. Open health_monitor folder
  2. Open core folder, open database folder
  3. Open connect.php
  4. Change "mysql_connect("localhost", "root", "")" to whatever login your uploading the
     php is being uploaded to, e.g. "root" to "username" and "" to "password"
  5. Upload php to server
  6. Create/Register Login
  7. Login and go to upload .csv or .cgi file
  8. View and compare data with friends


  FOR ANDROID DEVICE
  1. Put the source code into eclipse workspace
  2. Run eclipse
  3. Create a new run configuration and choose 'Launch Default Activity'
  4. Run the new configuration
  5. There are two ways to run the app, by creating a device emulator or using an android device
  6. If using an android device, make sure you enable 'USB Debugging' in the developer options
  7. After opening the app, register an account before login, which takes you to the main menu

BUGS

  Website
  -currently no files can be uploaded to server
  -login error when password is not inputed correctly manually
  -errors comparing data with friends


  Android App
  -currently account registration is local and not synchronized with server
  -there is still no way to input any data nor connect to the monitoring device
  -selecting a date will prompt a force close

CHANGELOG
  -adding the point system for calories burned
  -correcting user upload data to store in server
  -adding manual input of data

  update 5/09
  -updated comparing data, now fixed
  -fixed login
  -added sharing to social media on android app
  -fixed upload to server problem
  -fixed force close on android app
  -fixed synchronizing problem between server and android app


AUTHORS
  Jie Huang
  Cody Goodman
  Florian Pranata Hidayat

COPY/LICENSE
