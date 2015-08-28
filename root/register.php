<?php # Script 9.5 - register.php #2
// This script performs an INSERT query to add a record to the users table.

$page_title = 'Register';
include ('header.html');

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {



	$errors = array(); // Initialize an error array.

	// Check for a first name:
	if (empty($_POST['name'])) {
		$errors[] = 'You forgot to enter your name.';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['name']));
	}



	// Check for an email address:
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	}

	// Check for a password and match against the confirmed password:
	if (!empty($_POST['pass1'])) {
		if ($_POST['pass1'] != $_POST['pass2']) {
			$errors[] = 'Your password did not match the confirmed password.';
		} else {
			$p = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
		}
	} else {
		$errors[] = 'You forgot to enter your password.';
	}

$ro = mysqli_real_escape_string($dbc, trim($_POST['role']));
	if (empty($errors)) { // If everything's OK.

		// Register the user in the database...

		// Make the query:
		$q = "INSERT INTO users (name, email, pass, registration_date,role,balance) VALUES ('$fn', '$e', SHA1('$p'), NOW(),'$ro',200 )";
		$r = @mysqli_query ($dbc, $q); // Run the query.
		if ($r) { // If it ran OK.

			// Print a message:
			echo '<h1>Thank you!</h1>
		<p>You are now registered.</p><p><br /></p>';

		} else { // If it did not run OK.

			// Public message:
			echo '<h1>System Error</h1>
			<p class="error">You could not be registered due to email has been used. We apologize for any inconvenience.</p>';

			// Debugging message:
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';

		} // End of if ($r) IF.

		mysqli_close($dbc); // Close the database connection.

		// Include the footer and quit the script:
		include ('includes/footer.html');
		exit();

	} else { // Report the errors.

		echo '<h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p><p><br /></p>';

	} // End of if (empty($errors)) IF.

	mysqli_close($dbc); // Close the database connection.

} // End of the main Submit conditional.
?>

<div class="media">
	<div>
		<a href="#">
			<img class="media-object" src="uploads/umr.png" alt="umaru">
		</a>
	</div>
	<div class="media-body">
<h1>Register</h1>
<form action="register.php" method="post">
	<p>Name: <input type="text" name="name" size="15" maxlength="20" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>" /></p>
	<p>Email Address: <input type="text" name="email" size="20" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"  /> </p>
	<p>Password: <input type="password" name="pass1" size="10" maxlength="20" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>"  /></p>
	<p>Confirm Password: <input type="password" name="pass2" size="10" maxlength="20" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>"  /></p>
	<p><input type="hidden" name="role" value="user"/></p>
	<p><input type="hidden" name="balance" value="200"/></p>
	<p><input type="submit" name="submit" value="Register" /></p>
</form>
<?php include ('includes/footer.html'); ?>
