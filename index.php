<?php
session_start();



$users = [
    [
        "first_name" => "John",
        "last_name" => "Doe",
        "username" => "user1",
        "email" => "user1@gmail.com",
        "password" => "password1",
        "profile_img" => "https://images.pexels.com/photos/771742/pexels-photo-771742.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
        "cover_img" => "https://www.trendycovers.com/covers/Colorful_Hearts_facebook_cover_1346950504.jpg",
        'location' => 'New York, USA',
        'work' => 'Deft Group',
        'education' => 'University X',
        'joined' => 'March 2022'
    ],
    [
        "first_name" => "Jane",
        "last_name" => "Smith",
        "username" => "user2",
        "email" => "user2@gmail.com",
        "password" => "password2",
        "profile_img" => "https://wallpapers.com/images/featured-full/cool-profile-picture-87h46gcobjl5e4xu.jpg",
        "cover_img" => "https://www.trendycovers.com/covers/abstract_3d_facebook_cover_1370594397.jpg",
        'location' => 'New Jersy, USA',
        'work' => 'Deft Decor',
        'education' => 'University Y',
        'joined' => 'March 2014'
    ],
    [
        "first_name" => "Alice",
        "last_name" => "Johnson",
        "username" => "user3",
        "email" => "user3@gmail.com",
        "password" => "password3",
        "profile_img" => "https://images.pexels.com/photos/1043471/pexels-photo-1043471.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
        "cover_img" => "https://149369349.v2.pressablecdn.com/wp-content/uploads/2012/10/twitter-cover.jpg",
        'location' => 'New York, USA',
        'work' => 'Deft Digital',
        'education' => 'University Z',
        'joined' => 'March 2020'
    ]

];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $username = $_POST['email'];
    $password = $_POST['password'];


    foreach ($users as $user) {
        if (($user['email'] === $email || $user['username'] === $username) && $user['password'] === $password) {

            $_SESSION['user'] = $user;

            $_SESSION['last_activity'] = time();

            header("Location: profile.php");
            exit();
        }
    }

    echo "<div class='text-red-500 text-center mt-4'>Invalid email or password.</div>";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="flex flex-col items-center justify-center min-h-screen">
        <!-- Logo Section -->
        <div class="mb-10">
            <h1 class="text-blue-600 text-5xl font-bold">facebook</h1>
        </div>

        <!-- Login Form -->
        <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
            <form method="post">
                <div class="mb-4">
                    <input
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        id="email" name="email" type="text" placeholder="Email address or phone number" required>
                </div>
                <div class="mb-6">
                    <input
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        id="password" name="password" type="password" placeholder="Password" required>
                </div>
                <div class="mb-6">
                    <button
                        class="w-full bg-blue-600 text-white text-lg font-semibold py-3 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        type="submit">
                        Log In
                    </button>
                </div>
                <div class="text-center mb-4">
                    <a href="#" class="text-blue-600 hover:underline text-sm">Forgotten password?</a>
                </div>
                <hr class="my-4">
                <div class="text-center">
                    <a href="signup.php"
                        class="inline-block bg-green-600 text-white font-semibold py-3 px-6 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                        Create New Account
                    </a>
                </div>
            </form>
        </div>

        <!-- Footer Section -->
        <div class="mt-8 text-center text-sm text-gray-600">
            <p>Facebook © 2024</p>
        </div>
    </div>




</body>

</html>