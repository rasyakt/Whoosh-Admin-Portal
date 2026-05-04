<?php
$serverName = "HYPE\SQLEXPRESS";
$database   = "whoossh_db";
$username   = "sa";
$password   = "12345";

try {
    $conn = new PDO("sqlsrv:Server=$serverName;Database=$database;TrustServerCertificate=yes", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $conn->query("SELECT * FROM migrations");
    print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "\n";
}
