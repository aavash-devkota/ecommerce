<?php include 'header.php'?>

<?php
// Add to cart
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_SESSION['user_id'] != '') {
        // Here the user is authenticated.
        $product_id = $_POST['id'];
        $cart_res = $pdo->query('SELECT COUNT(*) FROM cart WHERE user_id = '.$_SESSION['user_id'].' AND product_id = '.$product_id);
        $is_already_added_to_cart = false;
        foreach ($cart_res as $res) {
            $is_already_added_to_cart = $res[0] > 0;
        }

        if (! $is_already_added_to_cart) {
            $pdo->query('INSERT INTO cart VALUES (NULL, '.$_SESSION['user_id'].', '.$product_id.')');
        }
        header('location: cart.php');
    } else {
        // Here the user is NOT authenticated.
        header('location: register.php');
    }

}
?>

<?php
$products = $pdo->query('SELECT * FROM products');
?>

<main style="padding: 20px;">
	<h1>Products list</h1>
	<div style="display: flex; gap: 60px; margin-top: 16px; align-items: center;">
<?php
        foreach ($products as $product) {
            echo '<div>
			<img src="'.$product['image'].'" alt="'.$product['name'].'" style="width: 200px; height: 200px; object-fit: contain;" />
			<div>
				<p>'.$product['name'].'</p>
				<form method="post">
					<input type="hidden" name="id" value="'.$product['id'].'" />
					<button style="margin-top: 6px; padding: 2px 8px;">Add to cart</button>
				</form>
			</div>
		</div>';
        }
?>
	</div>
</main>

<script>
<?php if ($_GET['checkout'] == true) {
    echo 'alert("Your products has been checked out successfully!");';
} ?>
</script>

<?php include 'footer.php'?>
