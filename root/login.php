<?php # Script 12.12 - login.php #4
// This page processes the login form submission.
// The script now stores the HTTP_USER_AGENT value for added security.

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Need two helper files:
	require ('includes/login_function.php');
	require ('../mysqli_connect.php');

	// Check the login:
	list ($check, $data) = check_login($dbc, $_POST['email'], $_POST['pass']);

	if ($check) { // OK!


		// Set the cookies:
		//setcookie ('user_id', $data['user_id']);
		//setcookie ('name', $data['name']);
		//setcookie ('role',$data['role']);

		// Set the session data:
		session_start();
		$_SESSION['user_id'] = $data['user_id'];
		$_SESSION['name'] = $data['name'];
		$_SESSION['role'] = $data['role'];
		$_SESSION['balance']= $data['balance'];
		// Store the HTTP_USER_AGENT:
		$_SESSION['agent'] = md5($_SERVER['HTTP_USER_AGENT']);

		// Redirect:
		redirect_user('loggedin.php');

	} else { // Unsuccessful!

		// Assign $data to $errors for login_page.inc.php:
		$errors = $data;

	}

	mysqli_close($dbc); // Close the database connection.

} // End of the main submit conditional.

// Create the page:
include ('login_page.php');
?>
