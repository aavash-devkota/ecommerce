<?php include 'header.php'?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    // Check password and confirm password
    if ($password == $confirm_password) {
        // Check if a user with the same username exists or not
        $users_count_res = $pdo->query("SELECT COUNT(*) FROM users WHERE username = '$username'");
        foreach ($users_count_res as $count) {
            $users_count = $count[0];
        }

        if ($users_count == 0) {
            // Actual user creation
            $pdo->query("INSERT INTO users VALUES (NULL, '$username', '$password')");

            // Login the user as well
            $user_res = $pdo->query("SELECT id FROM users WHERE username = '$username'");
            foreach ($user_res as $user) {
                $_SESSION['user_id'] = $user['id'];
            }
            $_SESSION['user'] = $username;
            header('location: index.php');
        } else {
            $error = 'Username already exists.';
        }
    } else {
        $error = 'Passwords do not match.';
    }
}
?>

<main style="height: 100vh; width: 100vw; display: flex; justify-content: center; align-items: center;">
	<form method="post" style="border: 2px solid #E6E6E6; border-radius: 10px; padding: 14px 24px; display: flex; flex-direction: column;">
		<p style="font-size: 2rem; font-weight: bold; text-align: center;">Register</p>
		<div style="display: grid; grid-template-columns: auto 1fr; margin-top: 20px; gap: 7px 10px;">
			<label for="username">Username: </label>
			<input name="username" id="username" />
			<label for="password">Password: </label>
			<input type="password" name="password" id="password" />
			<label for="confirm-password">Confirm Password: </label>
			<input type="password" name="confirm-password" id="confirm-password" />
		</div>
		<?php if (isset($error)) {
		    echo '<p style="color: red; align-self: center; margin-top: 14px;">'.$error.'</p>';
		} ?>
		<button style="margin-top: 20px; padding: 5px 14px; align-self: center;">Submit</button>
	</form>
</main>

<?php include 'footer.php'?>
