<?php

//#########################################################
//
//
//			    note
//
//You must add your password to the local password variable
//
//	Also remove the password before commiting
//
//#########################################################

//======================================================================
// DATABASE CONFIGURATIONS
//======================================================================

// Local Database Connection Details (in this example, the developer is using a
// ClearDB mysql database that is different than the deployment DB.  You can
// simply use your own MySql DB on your computer.
$local_host = "localhost";
$local_username = "postgres";
$local_password = "";
$local_databaseName = "postgres";

$conn_string = "host=" . $local_host . " dbname=" . $local_databaseName . " user=" . $local_username . " password=" . $local_password;

// Production Database Connection Details:
//$databaseConnectURL = "mysql://bec9224a3c2850:feb6f6a3@us-cdbr-iron-east-04.cleardb.net/heroku_81f997698bd0911?reconnect=true";
// CLEARDB_DATABASE_URL needs to be set in Heroku.  


//======================================================================
// DATABASE CONNECTION
//======================================================================

$possibleLocalhosts = array('127.0.0.1', "::1");

if(in_array($_SERVER['REMOTE_ADDR'], $possibleLocalhosts)) // If our REMOTE_ADDR is a localhost, do this:
{
	// Open a connection with our local database
	$conn = pg_connect($conn_string);
} 
else // If our REMOTE_ADDR wasn't a localhost, we must be working remotely.
{ 
	// Parse our $databaseConnectURL so that we can pull out the key's we neeed
	$conn = pg_connect(getenv("DATABASE_URL"));
	// Open a connection with our remote database
}


//====================================================================o=
// FRESH DEPLOY DATABASE SETUP WIZARD
//======================================================================

if (isset($_GET['setup-db'])) // Only enter this if our URL contains a "setup-db" parameter
{
	echo '<h1>Database Configurations</h1>';
	echo '<form method="GET" action="?setup-db">';
	echo '<p>Are you sure you want to erase your current remote database and reconfigure it with a fresh schema?</br></p>';
	echo '<input name="execute-db-setup" type="submit" value="Yes">' . '</form>';
}

if (isset($_GET['execute-db-setup'])) // Only enter this if our URL contains a "setup-db" parameter
{	
	echo '<h1>Database Configurations</h1>';
	// STEP A - CREATE TASKS TABLE IN DATABASE
	$sqlCreateTableStatement = "
		CREATE TABLE `tasks` (
			`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
			`taskName` varchar(200) NOT NULL DEFAULT '',
			`completed` tinyint(1) DEFAULT '0',
			`lastUpdated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
			PRIMARY KEY (`id`)
		)";
	if (pg_query($conn, $sqlCreateTableStatement))
	{
		echo '</br>StepA: Successfully configured database.</br>';
	} 
	else 
	{
		echo '</br>StepA: Looks like there was an error :(</br>';
		echo '</br>' . pg_error($conn);
	}

	// STEP B - ADD SAMPLE TASKS TO TABLE (that was created by step a)
	$sqlPopulateTableStatement = "
		INSERT INTO `tasks` (`id`, `taskName`, `completed`, `lastUpdated`) VALUES
		(1, 'Give yourself a high five, your PRODUCTION table is working!', 0, '2016-09-20 11:35:05'),
		(2, 'Complete the next part of the lab, since PRODUCTION is working.', 0, '2016-09-20 11:35:05');
		";

	if (pg_query($conn, $sqlPopulateTableStatement))
	{
		echo '</br>Step B: Successfully added sample tasks to task table in database.</br>';
	} 
	else 
	{
		echo '</br>Step B: Looks like there was an error :(</br>';
		echo '</br>' . pg_error($conn);
	}
}
?>
