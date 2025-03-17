<?php
session_start();
include 'includes/db.php';

$ingredient_id = $_POST['IngredientID'] ?? null;
$user_id = $_POST['userID'] ?? null;

$insert_sql = "INSERT INTO cart (IngredientID, UserID) VALUES ('$ingredient_id','$user_id')";
$conn->query($insert_sql);

?>