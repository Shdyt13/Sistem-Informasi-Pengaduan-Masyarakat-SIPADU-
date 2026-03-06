<?php
// Password yang kita inginkan: 123456
$password_baru = "123456";

// Buat Hash
$hash = password_hash($password_baru, PASSWORD_DEFAULT);

echo "<h1>Copy kode di bawah ini:</h1>";
echo "<h3 style='background: yellow; padding: 10px; display: inline-block;'>" . $hash . "</h3>";
echo "<br><br>Panjang karakter: " . strlen($hash) . " (Harus 60)";
?>