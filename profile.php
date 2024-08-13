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
    <title>Profile of <?php echo htmlspecialchars($user['first_name']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .dropdown {
            z-index: 50;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a class="text-blue-600 text-3xl font-bold" href="profile.php">facebook</a>
            <div class="flex items-center space-x-4">
                <input type="text" placeholder="Search Facebook"
                    class="px-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button class="text-blue-600 font-semibold hover:underline">Home</button>
                <a href="profile.php" class="text-blue-600 font-semibold hover:underline">Profile</a>
                <a href="logout.php" class="text-blue-600 font-semibold hover:underline" id="logout">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Cover Photo and Profile Picture Section -->
    <div class="bg-white shadow-md">
        <div class="relative">
            <img src="<?php echo empty($user['cover_img']) ? 'https://via.placeholder.com/1200' : htmlspecialchars($user['cover_img']); ?>"
                alt="Cover Photo" class="w-full h-48 object-cover rounded-t-lg">
            <div class="absolute -bottom-16 left-4">
                <img src="<?php echo empty($user['profile_img']) ? 'https://via.placeholder.com/150' : htmlspecialchars($user['profile_img']); ?>"
                    alt="Profile Picture" class="w-32 h-32 rounded-full border-4 border-white shadow-lg">
            </div>
        </div>
        <div class="pt-20 pb-4 text-center">
            <h2 class="text-3xl font-bold text-gray-800">
                <?php echo htmlspecialchars($user['first_name']); ?>
                <?php echo ' '; ?>
                <?php echo htmlspecialchars($user['last_name']); ?>
            </h2>
            <p class="text-gray-600">@<?php echo htmlspecialchars($user['username']); ?></p>
        </div>
    </div>

    <!-- Profile Navigation -->
    <div class="bg-white shadow-md mt-4 rounded-lg">
        <div class="container mx-auto px-4 py-2 flex justify-center space-x-8">
            <a href="#" class="text-blue-600 font-semibold hover:text-blue-700">Posts</a>
            <a href="about.php" class="text-gray-600 font-semibold hover:text-gray-800">About</a>
            <a href="#" class="text-gray-600 font-semibold hover:text-gray-800">Friends</a>
            <a href="#" class="text-gray-600 font-semibold hover:text-gray-800">Photos</a>
            <a href="#" class="text-gray-600 font-semibold hover:text-gray-800">More</a>
        </div>
    </div>

    <!-- Profile Content -->
    <div class="container mx-auto mt-6 flex flex-col lg:flex-row space-y-6 lg:space-y-0 lg:space-x-6">
        <!-- Left Sidebar -->
        <div class="lg:w-1/3">
            <div class="bg-white p-6 shadow-md rounded-lg">
                <h3 class="text-xl font-semibold mb-4">Intro</h3>
                <p class="text-gray-600 mb-3"><strong>Location:</strong>
                    <?php echo empty($user['location']) ? 'Not set' : htmlspecialchars($user['location']); ?>
                </p>
                <p class="text-gray-600 mb-3"><strong>Works at:</strong>
                    <?php echo empty($user['work']) ? 'Not set' : htmlspecialchars($user['work']); ?>
                </p>
                <p class="text-gray-600 mb-3"><strong>Studied at:</strong>
                    <?php echo empty($user['education']) ? 'Not set' : htmlspecialchars($user['education']); ?>
                </p>
                <p class="text-gray-600 mb-3"><strong>Joined:</strong>
                    <?php echo empty($user['joined']) ? 'Today' : htmlspecialchars($user['joined']); ?>
                </p>
            </div>

            <div class="bg-white p-6 shadow-md rounded-lg mt-6">
                <h3 class="text-xl font-semibold mb-4">Photos</h3>
                <div class="grid grid-cols-3 gap-2">
                    <img src="https://via.placeholder.com/100" alt="Photo 1" class="rounded-lg">
                    <img src="https://via.placeholder.com/100" alt="Photo 2" class="rounded-lg">
                    <img src="https://via.placeholder.com/100" alt="Photo 3" class="rounded-lg">
                    <img src="https://via.placeholder.com/100" alt="Photo 4" class="rounded-lg">
                    <img src="https://via.placeholder.com/100" alt="Photo 5" class="rounded-lg">
                    <img src="https://via.placeholder.com/100" alt="Photo 6" class="rounded-lg">
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:w-2/3">
            <div class="bg-white p-6 shadow-md rounded-lg">
                <h3 class="text-xl font-semibold mb-4">Posts</h3>
                <div class="mb-6">
                    <textarea id="postContent"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        rows="3"
                        placeholder="What's on your mind, <?php echo htmlspecialchars($user['first_name']); ?>?"></textarea>
                    <button onclick="savePost()"
                        class="mt-3 bg-blue-600 text-white font-semibold px-4 py-2 rounded-lg hover:bg-blue-700">Post</button>
                </div>
                <div id="posts" class="border-t border-gray-300 pt-4">
                    <!-- Posts will be injected here from JavaScript -->
                </div>


                <div class="">
                    <div class="mb-4 flex">
                        <img src="<?php echo empty($user['profile_img']) ? 'https://via.placeholder.com/150' : htmlspecialchars($user['profile_img']); ?>"
                            alt="Profile Picture" class="w-10 h-10 rounded-full mr-4">
                        <div class="flex flex-col">
                            <h4 class="font-semibold text-gray-800">
                                <?php echo htmlspecialchars($user['first_name']); ?>
                                <?php echo ' '; ?>
                                <?php echo htmlspecialchars($user['last_name']); ?>
                            </h4>
                            <p class="text-gray-600">Just completed a new project!</p>
                        </div>
                    </div>
                    <div class="mb-4 flex">
                        <img src="<?php echo empty($user['profile_img']) ? 'https://via.placeholder.com/150' : htmlspecialchars($user['profile_img']); ?>"
                            alt="Profile Picture" class="w-10 h-10 rounded-full mr-4">
                        <div class="flex flex-col">
                            <h4 class="font-semibold text-gray-800">
                                <?php echo htmlspecialchars($user['first_name']); ?>
                                <?php echo ' '; ?>
                                <?php echo htmlspecialchars($user['last_name']); ?>
                            </h4>
                            <p class="text-gray-600">Loving the new design trends in 2024.</p>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- Footer Section -->
    <footer class="mt-8 bg-white py-4 text-center text-sm text-gray-600 shadow-md rounded-lg">
        <p>Facebook © 2024</p>
    </footer>

    <script>
        let openDropdownIndex = -1;

        // Save the post to local storage
        function savePost() {
            const postContent = document.getElementById('postContent').value;
            if (postContent.trim()) {
                const posts = JSON.parse(localStorage.getItem('posts')) || [];
                posts.unshift({ content: postContent });
                localStorage.setItem('posts', JSON.stringify(posts));
                document.getElementById('postContent').value = '';
                displayPosts();
            }
        }

        // Display the posts from local storage
        function displayPosts() {
            const postsContainer = document.getElementById('posts');
            postsContainer.innerHTML = '';
            const posts = JSON.parse(localStorage.getItem('posts')) || [];
            posts.forEach((post, index) => {
                const postElement = document.createElement('div');
                postElement.className = 'mb-4 flex items-start relative';
                postElement.innerHTML = `
                    <img src="<?php echo empty($user['profile_img']) ? 'https://via.placeholder.com/150' : htmlspecialchars($user['profile_img']); ?>"
                        alt="Profile Picture" class="w-10 h-10 rounded-full mr-4">
                    <div class="flex flex-col w-full">
                        <div class="flex justify-between items-center">
                            <h4 class="font-semibold text-gray-800">
                                <?php echo htmlspecialchars($user['first_name']); ?>
                                <?php echo ' '; ?>
                                <?php echo htmlspecialchars($user['last_name']); ?>
                            </h4>
                            <div class="relative">
                                <button onclick="toggleDropdown(${index})"
                                    class="text-gray-600 hover:text-gray-800 focus:outline-none">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div id="dropdown-${index}" class="dropdown hidden absolute right-0 mt-2 w-48 bg-white border border-gray-300 rounded-lg shadow-lg">
                                    <button onclick="editPost(${index})"
                                        class="block w-full px-4 py-2 text-gray-800 hover:bg-gray-100 text-left">
                                        Edit
                                    </button>
                                    <button onclick="deletePost(${index})"
                                        class="block w-full px-4 py-2 text-red-600 hover:bg-red-100 text-left">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-600">${post.content}</p>
                    </div>
                `;
                postsContainer.appendChild(postElement);
            });
        }

        // Toggle dropdown visibility
        function toggleDropdown(index) {
            if (openDropdownIndex !== -1 && openDropdownIndex !== index) {
                document.getElementById(`dropdown-${openDropdownIndex}`).classList.add('hidden');
            }
            const dropdown = document.getElementById(`dropdown-${index}`);
            dropdown.classList.toggle('hidden');
            openDropdownIndex = dropdown.classList.contains('hidden') ? -1 : index;
        }

        // Edit post content
        function editPost(index) {
            const posts = JSON.parse(localStorage.getItem('posts')) || [];
            const newContent = prompt('Edit your post:', posts[index].content);
            if (newContent !== null) {
                posts[index].content = newContent;
                localStorage.setItem('posts', JSON.stringify(posts));
                displayPosts();
            }
        }

        // Delete post
        function deletePost(index) {
            const posts = JSON.parse(localStorage.getItem('posts')) || [];
            posts.splice(index, 1);
            localStorage.setItem('posts', JSON.stringify(posts));
            displayPosts();
        }

        // Display posts on page load
        displayPosts();
    </script>
</body>

</html>