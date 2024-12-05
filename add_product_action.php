<?php
// Simulasi menambahkan produk
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Simulasi menambah produk
    // Biasanya, di sini kita akan mengirim data ke API untuk menyimpan produk baru
    $newProduct = [
        'id' => rand(1000, 9999),  // ID acak untuk simulasi
        'title' => $title,
        'price' => $price,
        'description' => $description
    ];

    // Redirect kembali ke halaman produk setelah menambah produk
    header("Location: product.php");
    exit;
}
?>
