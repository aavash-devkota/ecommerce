<?php include 'header.php'?>

<?php
// Check if the user is authenticated or not.
if ($_SESSION['user_id'] == '') {
    header('location: register.php');
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cart_res = $pdo->query('SELECT * FROM cart WHERE user_id = '.$_SESSION['user_id']);
    foreach ($cart_res as $res) {
	// Copy the data from cart table to checkout table
        $pdo->query('INSERT INTO checkout VALUES (NULL, '.$res['user_id'].', '.$res['product_id'].')');
    }

    $pdo->query('DELETE FROM cart WHERE user_id = '.$res['user_id']);

    header('location: index.php?checkout=true');
}
?>

<?php
$products = $pdo->query('SELECT * FROM cart LEFT JOIN products ON cart.product_id = products.id WHERE user_id = '.$_SESSION['user_id']);
?>

<main style="padding: 20px;">
	<h1>Your cart</h1>
	<div style="display: flex; gap: 60px; margin-top: 16px; align-items: center;">
<?php
        foreach ($products as $product) {
            echo '<div>
			<img src="'.$product['image'].'" alt="'.$product['name'].'" style="width: 200px; height: 200px; object-fit: contain;" />
			<div>
				<p>'.$product['name'].'</p>
			</div>
		</div>';
        }
?>
	</div>

    <form method="post" style="margin-top: 8px;">
	<button style="margin-top: 6px; padding: 2px 8px;">Checkout</button>
    </form>
</main>

<?php include 'footer.php'?>
