<?php

$pdo = new PDO('mysql:host=127.0.0.1;dbname=ecommerce-simple', 'root', '');
$pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true); // Fetch the query in the same line as the query method call.
