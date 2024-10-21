<?php
$flag = "FLAG{sEb3L@5_eRpe3L_5@tu}";
$hint = "Lihat  sumber halaman ini untuk menemukan petunjuk!";
$message = "";
$is_success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_flag = $_POST["flag"];
    if ($user_flag === $flag) {
        $message = "Selamat! Anda berhasil menemukan flag yang benar!";
        $is_success = true;
    } else {
        $message = "Maaf, flag yang Anda masukkan salah. Coba lagi!";
    }
    header("Location: " . $_SERVER['PHP_SELF'] . "?message=" . urlencode($message) . "&success=" . ($is_success ? "1" : "0"));
    exit();
}

if (isset($_GET['message'])) {
    $message = $_GET['message'];
    $is_success = isset($_GET['success']) && $_GET['success'] === "1";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CTF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .notification {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
        <!-- Flag: <?php echo $flag; ?> -->
    </style>
</head>
<body>
    <div class="container">
        <h1>Capture The Flag - XI RPL 1</h1>
        <?php
        if ($message) {
            $notificationClass = $is_success ? "success" : "error";
            echo "<div class='notification {$notificationClass}'>{$message}</div>";
        }
        ?>
        <?php if ($is_success): ?>
            <p>Anda telah berhasil menyelesaikan tantangan!</p>
        <?php else: ?>
            <p>Temukan flag yang tersembunyi dan masukkan di bawah ini:</p>
            <form method="POST">
                <input type="text" name="flag" placeholder="Masukkan flag di sini">
                <input type="submit" value="Submit">
            </form>
            <p><strong>Petunjuk:</strong> <?php echo $hint; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>