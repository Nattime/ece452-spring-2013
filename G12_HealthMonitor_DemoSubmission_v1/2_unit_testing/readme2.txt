Health Monitor - Fitness Friends
Group 12
readme2.txt


README

  Since our code is in php, all unit testings were done internally by pre-setting variables or test cases
  in order to test if the class/use cases work properly. This was the same for the database.

WEBSITE
  Visit us at http://se1.engr.rutgers.edu/~13group12/ for any questions or problems.

UNIT TESTING
  Classes
	Account
	  -username: first name of group members
	  -password: password
	  -in order for the account to be made, we had to make sure the data/account settings was saved into the database
	Account Setting
	  -change password: change user password from password to password2, echo the previous password and new password
	Analyzer
	  -create graph: uploaded a .csv file and used the graph creator to read and create a graph from given data
	  -anaylze data: upload a .csv file with workout data and/or manually input data and take the wanted information
		and output onto screen, echo out data in a table on screen
	Database
	  -creating account: username: jie password: (md5)password age: 20 weight: 140
	  -store graph: tested april.csv by uploading the file to server, then checked if server moved file into folder called
		user_data/files, echo out location of file
	dataDisplay
	  -displayGraph: uploaded april.csv to server, the server then analyzes the file and read off the wanted items then prints to screen
	Home Screen
	  -account settings: change user's data, eg. first name, last name, email address
	  -view data: read off username.csv file and echo onto screen
	Login screen
	  -verify login: echo typed username and echo user session id, inputs: username-jie pass-password

  Use Cases
	Visitor registration
	  -firstname:jie  lastname:huang  password:password  passwordagain:password  emailaddress:jie@gmail.com  age:20  weight:140  gender:male
	User Login
	  -username:jie  password:password
	View data
	  -uploaded april.csv to view table
	  -to test out the leadership board, premade 4 different accounts with random cardio points
	Upload from device
	  -tested by uploading april.csv and checked the database where the location of the file was moved
	Manual input
	  -date: 4/21 lengthofworkout: 2 heartrate: 110
	Data compare
	  -compared jie with users cody, kyle, sam, jack
	Sharing to social network
	  -passed user calories and workout to send to facebook as post

AUTHORS
  Jie Huang
  Cody Goodman
  Florian Pranata Hidayat

COPY/LICENSE
