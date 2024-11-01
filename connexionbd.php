<?php 
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Path to the JSON file
$jsonFilePath = './security/id.json';

// Check if the JSON file exists
if (!file_exists($jsonFilePath)) {
    die("JSON file not found at $jsonFilePath !");
}

// Parse the JSON file
$id = json_decode(file_get_contents($jsonFilePath), true);

// Check if the JSON decoding was successful and if the necessary keys exist
if ($id === null) {
    die('Failed to decode JSON. Error: ' . json_last_error_msg());
}

if (!isset($id['servername'], $id['username'], $id['password'], $id['dbname'])) {
    die('Missing required keys in id.json. Check that "servername", "username", "password", and "dbname" are present.');
}

// Construct the DSN (Data Source Name)
$dsn = "mysql:host={$id['servername']};dbname={$id['dbname']};charset=utf8";

try {
    // Create the PDO connexion using the constructed DSN
    $pdo = new PDO($dsn, $id['username'], $id['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connexion failed: " . $e->getMessage());
}
?>