<?php
include("Taskforce.inc.php");

#Add your Taskforce username and API key here, which is then put into the object below. You can get your API key at http://www.taskforceapp.com/account
$username = "";
$apiKey = "";


#Making a Taskforce object using the username and password from above, get the user's details then dump them out to the browser
$object = new Taskforce($username, $apiKey);
$user = $object->getUser();
var_dump($user);


$list = $object->createList("A list I'm going to create");
if ($list != false) {
/* The list was created fine - $user will contain the JSON returned */
} else {
/* Something went wrong, who knows what though. */
}

/*
		So yeah. You pretty much follow the pattern from createList() above with every method. Just make sure you read README.md for any of the weird exceptions, 
		Check Taskforce.inc.php or the API documentation at http://www.taskforceapp.com/api to find out all the parameters and how everything works.
*/

#The createUser() method is static, and is not called from within a Taskforce object
$new = Taskforce::createUser("an_email_address@email.com", "afasrasljrlay8q3y78");
if ($new == true) {
	# The user was created okay - this method is an exception to the usual behaviour, in that it returns true if successful, rather than the JSON response
} else {
	# Couldn't make the user. The result was false.
}
?>