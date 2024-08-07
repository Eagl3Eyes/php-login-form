<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-sm">
        <form method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="email" placeholder="Email">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" name="password" type="password" placeholder="***********">
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Sign In
                </button>
            </div>
            <div class="mt-4">
                <a class="text-blue-500 hover:text-blue-700" href="signup.php">Don't have an account? Sign up</a>
            </div>
        </form>
    </div>

    <?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $users = [
            [
                "email" => "user1@gmail.com",
                "password" => "password1",
                "username" => "user1",
                "first_name" => "John",
                "last_name" => "Doe"
            ],
            [
                "email" => "user2@gmail.com",
                "password" => "password2",
                "username" => "user2",
                "first_name" => "Jane",
                "last_name" => "Smith"
            ],
            [
                "email" => "user3@gmail.com",
                "password" => "password3",
                "username" => "user3",
                "first_name" => "Alice",
                "last_name" => "Johnson"
            ]
        ];


        $email = $_POST['email'];
        $password = $_POST['password'];


        $user_found = false;
        $user_details = null;


        foreach ($users as $user) {
            if ($user['email'] === $email && $user['password'] === $password) {
                $user_found = true;
                $user_details = $user;
                break;
            }
        }

        if ($user_found) {

            $_SESSION['user'] = $user_details;
            $_SESSION['last_activity'] = time();

            header("Location: profile.php");
            exit();
        } else {
            echo "<div class='text-red-500 text-center mt-4'>Invalid email or password.</div>";
        }
    }
    ?>
</body>

</html>