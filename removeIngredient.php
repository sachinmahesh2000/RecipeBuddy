<?php
session_start();
include 'includes/db.php';

$ingredient_id = $_POST['IngredientID'] ?? null;
$user_id = $_POST['userID'] ?? null;

$delete_sql = "DELETE FROM `cart` WHERE IngredientID = $ingredient_id";
$conn->query($delete_sql);

?>