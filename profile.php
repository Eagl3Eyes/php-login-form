<?php
session_start();


if (!isset($_SESSION['user']) || (time() - $_SESSION['last_activity']) > 60) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}


$_SESSION['last_activity'] = time();

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-sm">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 text-center">
            <h1 class="text-2xl font-bold mb-4">Welcome to Your Profile!</h1>

            <p class="font-bold">
                <?php echo htmlspecialchars($user['first_name']);
                echo ' ';
                echo htmlspecialchars($user['last_name']);
                ?>
            </p>

            <p class="font-bold">Username: <?php echo htmlspecialchars($user['username']); ?></p>
            <p class="font-bold">Email: <?php echo htmlspecialchars($user['email']); ?></p>

            <a href="logout.php" class="text-blue-500 hover:text-blue-700">Logout</a>
        </div>
    </div>
</body>

</html>