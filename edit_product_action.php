<?php
// Update produk melalui API
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $price = $_POST['price'];
    $availabilityStatus = $_POST['availabilityStatus'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    // Data yang akan dikirim ke API
    $data = [
        'id' => $id,
        'title' => $title,
        'price' => $price,
        'availabilityStatus' => $availabilityStatus,
        'category' => $category,
        'description' => $description
    ];

    // URL endpoint API
    $apiUrl = 'https://dummyjson.com/products/update'; // Ganti dengan URL API Anda

    // Inisialisasi cURL
    $ch = curl_init($apiUrl);

    // Konfigurasi opsi cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); // Gunakan metode PUT jika sesuai dengan API Anda
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer YOUR_API_KEY' // Tambahkan header otorisasi jika diperlukan
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // Kirim data dalam format JSON

    // Eksekusi cURL dan tangkap respons
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // Periksa apakah terjadi error
    if (curl_errno($ch)) {
        $error = curl_error($ch);
        echo "cURL Error: $error";
    }

    curl_close($ch);

    // Tangani respons dari API
    if ($httpCode == 200) {
        // Redirect kembali ke halaman produk jika berhasil
        header("Location: product.php");
        exit;
    } else {
        echo "Gagal memperbarui produk. HTTP Code: $httpCode. Response: $response";
    }
}
?>
