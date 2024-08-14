<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $dob = $_POST['dob'];
    $location = $_POST['location'];
    $phone = $_POST['phone'];
    $bio = $_POST['bio'];

    // Handle cover image upload
    $coverImage = '';
    if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] == 0) {
        $coverImageData = file_get_contents($_FILES['cover_image']['tmp_name']);
        $coverImage = 'data:image/' . pathinfo($_FILES['cover_image']['name'], PATHINFO_EXTENSION) . ';base64,' . base64_encode($coverImageData);
    }

    // Handle profile image upload
    $profileImage = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $profileImageData = file_get_contents($_FILES['image']['tmp_name']);
        $profileImage = 'data:image/' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION) . ';base64,' . base64_encode($profileImageData);
    }

    $_SESSION['user'] = [
        'first_name' => $first_name,
        'last_name' => $last_name,
        'username' => $username,
        'email' => $email,
        'password' => $password,
        'dob' => $dob,
        'location' => $location,
        'phone' => $phone,
        'bio' => $bio,
        'cover_img' => $coverImage,
        'profile_img' => $profileImage
    ];

    $_SESSION['last_activity'] = time();

    header("Location: profile.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Facebooke</title>
    <link rel="shortcut icon" href="./images/favicon.svg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-sm">
        <div class="mb-10">
            <h1 class="text-blue-600 text-5xl text-center font-bold">facebook</h1>
        </div>
        <form id="signupForm" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="post"
            enctype="multipart/form-data">
            <h3 class="text-center m-4 font-bold">Signup</h3>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="first_name">
                    First Name <span class="text-red-500">*</span>
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="first_name" name="first_name" type="text" placeholder="First Name" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="last_name">
                    Last Name <span class="text-red-500">*</span>
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="last_name" name="last_name" type="text" placeholder="Last Name" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Username <span class="text-red-500">*</span>
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="username" name="username" type="text" placeholder="Username" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email <span class="text-red-500">*</span>
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="email" name="email" type="email" placeholder="Email" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="dob">
                    Date of Birth <span class="text-red-500">*</span>
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="dob" name="dob" type="date" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="location">
                    Location <span class="text-red-500">*</span>
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="location" name="location" type="text" placeholder="Location" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">
                    Phone Number <span class="text-red-500">*</span>
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="phone" name="phone" type="tel" placeholder="Phone Number" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="bio">
                    Bio <span class="text-red-500">*</span>
                </label>
                <textarea
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="bio" name="bio" placeholder="Tell us something about yourself" required></textarea>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password <span class="text-red-500">*</span>
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                    id="password" name="password" type="password" placeholder="***********" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                    Upload Profile Image
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                    id="image" name="image" type="file" accept="image/*">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="cover_image">
                    Upload Cover Image
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                    id="cover_image" name="cover_image" type="file" accept="image/*">
            </div>
            <div class="flex items-center justify-between">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                    Sign Up
                </button>
            </div>
            <div class="mt-4">
                <a class="text-blue-500 hover:text-blue-700" href="index.php">Already have an account? Log in</a>
            </div>
        </form>
    </div>
</body>

</html>