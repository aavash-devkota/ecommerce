<?php include 'header.php'?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $users_res = $pdo->query("SELECT * FROM users WHERE username = '$username'");
    foreach ($users_res as $user) {
	// Check if the username and password matches
        if ($user['username'] == $username && $user['password'] == $password) {
	    // Authorize the user
	    $_SESSION['user_id'] = $user['id'];
            $_SESSION['user'] = $username;
            header('location: index.php');
        }
    }

    // If we reach this point in the code, it means that the user gave invalid credentials.
    if ($_SESSION['user'] == '') {
        $error = 'Invalid credentials.';
    }
}
?>

<main style="height: 100vh; width: 100vw; display: flex; justify-content: center; align-items: center;">
	<form method="post" style="border: 2px solid #E6E6E6; border-radius: 10px; padding: 14px 24px; display: flex; flex-direction: column;">
		<p style="font-size: 2rem; font-weight: bold; text-align: center;">Login</p>
		<div style="display: grid; grid-template-columns: auto 1fr; margin-top: 20px; gap: 7px 10px;">
			<label for="username">Username: </label>
			<input name="username" id="username" />
			<label for="password">Password: </label>
			<input type="password" name="password" id="password" />
		</div>
		<?php if (isset($error)) {
		    echo '<p style="color: red; align-self: center; margin-top: 14px;">'.$error.'</p>';
		} ?>
		<button style="margin-top: 20px; padding: 5px 14px; align-self: center;">Login</button>
	</form>
</main>

<?php include 'footer.php'?>
