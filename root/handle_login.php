<?php # Script 12.3 - login.php
// This page processes the login form submission.
// Upon successful login, the user is redirected.
// Two included files are necessary.
// Send NOTHING to the Web browser prior to the setcookie() lines!

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// For processing the login:
	require ('includes/login_function.php');

	// Need the database connection:
	require ('../mysqlcont.php');

	// Check the login:
	list ($check, $data) = check_login($dbc, $_POST['email'], $_POST['pass']);

	if ($check) { // OK!

		// Set the cookies:
		setcookie ('user_id', $data['user_id']);
		setcookie ('user_name', $data['user_name']);

		// Set the session data:
		session_start();
		$_SESSION['user_id'] = $data['user_id'];
		$_SESSION['user_name'] = $data['user_name'];

		// Redirect:
		redirect_user('logedin.php');

	} else { // Unsuccessful!

		// Assign $data to $errors for error reporting
		// in the login_page.inc.php file.
		$errors = $data;

	}

	mysqli_close($dbc); // Close the database connection.
	// Redirect:
	redirect_user('login.html');

} // End of the main submit conditional.


?>
