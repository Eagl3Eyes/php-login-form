<?php
session_start();

if (!isset($_SESSION['user']) || (time() - $_SESSION['last_activity']) > 600) {
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
    <title>About <?php echo htmlspecialchars($user['first_name']); ?></title>
    <link rel="shortcut icon" href="./images/favicon.svg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <?php
    include 'navbar.php';
    ?>

    <!-- Profile Navigation -->
    <div class="bg-white shadow-md mt-4 rounded-lg">
        <div class="container mx-auto px-4 py-2 flex justify-center space-x-8">
            <a href="profile.php" class="text-gray-600 font-semibold hover:text-gray-800">Posts</a>
            <a href="about.php" class="text-blue-600 font-semibold hover:text-blue-700">About</a>
            <a href="#" class="text-gray-600 font-semibold hover:text-gray-800">Friends</a>
            <a href="#" class="text-gray-600 font-semibold hover:text-gray-800">Photos</a>
            <a href="#" class="text-gray-600 font-semibold hover:text-gray-800">More</a>
        </div>
    </div>



    <!-- About Section -->
    <div class="container mx-auto mt-6">
        <div class="bg-white p-4 shadow-md rounded-lg">
            <h3 class="text-xl font-semibold mb-4">About <?php echo htmlspecialchars($user['first_name']); ?></h3>
            <p class="text-gray-600 mb-2">Full Name:
                <?php echo htmlspecialchars($user['first_name']) . ' ' . htmlspecialchars($user['last_name']); ?>
            </p>
            <p class="text-gray-600 mb-2">Username:
                <?php echo htmlspecialchars($user['username']); ?>
            </p>
            <p class="text-gray-600 mb-2">Email:
                <?php echo htmlspecialchars($user['email']); ?>
            </p>
            <p class="text-gray-600 mb-2">Date of Birth:
                <?php echo empty($user['dob']) ? 'Not set' : htmlspecialchars($user['dob']); ?>
            </p>
            <p class="text-gray-600 mb-2">Location:
                <?php echo empty($user['location']) ? 'Not set' : htmlspecialchars($user['location']); ?>
            </p>
            <p class="text-gray-600 mb-2">Work:
                <?php echo empty($user['work']) ? 'Not set' : htmlspecialchars($user['work']); ?>
            </p>
            <p class="text-gray-600 mb-2">Education:
                <?php echo empty($user['education']) ? 'Not set' : htmlspecialchars($user['education']); ?>
            </p>
            <p class="text-gray-600 mb-2">Joined:
                <?php echo empty($user['joined']) ? 'Today' : htmlspecialchars($user['joined']); ?>
            </p>
        </div>
    </div>


    <?php
    include 'footer.php';
    ?>
</body>

</html>