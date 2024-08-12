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
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a class="text-blue-600 text-3xl font-bold" href="">facebook</a>
            <div class="flex items-center">
                <input type="text" placeholder="Search Facebook"
                    class="px-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button class="ml-4 text-blue-600 font-semibold">Home</button>
                <button class="ml-4 text-blue-600 font-semibold">Profile</button>
                <a href="logout.php" class="ml-4 text-blue-600 font-semibold" id="logout">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Cover Photo and Profile Picture Section -->
    <div class="bg-white shadow-md">
        <div class="relative">
            <img src="<?php echo empty($user['cover_img']) ? 'https://via.placeholder.com/1200' : htmlspecialchars($user['cover_img']); ?>"
                alt="Cover Photo" class="w-full h-48 object-cover">
            <div class="absolute -bottom-16 left-4">
                <img src="<?php echo empty($user['profile_img']) ? 'https://via.placeholder.com/150' : htmlspecialchars($user['profile_img']); ?>"
                    alt="Profile Picture" class="w-32 h-32 rounded-full border-4 border-white shadow-md">
            </div>
        </div>
        <div class="pt-20 pb-4 text-center">
            <h2 class="text-3xl font-bold">
                <?php echo htmlspecialchars($user['first_name']); ?>
                <?php echo ' '; ?>
                <?php echo htmlspecialchars($user['last_name']); ?>
            </h2>
            <p class="text-gray-600">@<?php echo htmlspecialchars($user['username']); ?></p>
        </div>
    </div>

    <!-- Profile Navigation -->
    <div class="bg-white shadow-md mt-4">
        <div class="container mx-auto px-4 py-2 flex justify-center space-x-8">
            <a href="#" class="text-blue-600 font-semibold hover:text-blue-700">Posts</a>
            <a href="#" class="text-gray-600 font-semibold hover:text-gray-800">About</a>
            <a href="#" class="text-gray-600 font-semibold hover:text-gray-800">Friends</a>
            <a href="#" class="text-gray-600 font-semibold hover:text-gray-800">Photos</a>
            <a href="#" class="text-gray-600 font-semibold hover:text-gray-800">More</a>
        </div>
    </div>

    <!-- Profile Content -->
    <div class="container mx-auto mt-6 flex space-x-6">
        <!-- Left Sidebar -->
        <div class="w-1/3">
            <div class="bg-white p-4 shadow-md rounded-lg">
                <h3 class="text-xl font-semibold mb-2">Intro</h3>
                <p class="text-gray-600 mb-2">
                    <?php echo empty($user['location']) ? '' : htmlspecialchars($user['location']); ?>
                </p>
                <p class="text-gray-600 mb-2">Works at
                    <?php echo empty($user['work']) ? '' : htmlspecialchars($user['work']); ?>
                </p>
                <p class="text-gray-600 mb-2">Studied at
                    <?php echo empty($user['education']) ? '' : htmlspecialchars($user['education']); ?>
                </p>
                <p class="text-gray-600 mb-2">Joined
                    <?php echo empty($user['joined']) ? 'Today' : htmlspecialchars($user['joined']); ?>
                </p>
            </div>

            <div class="bg-white p-4 shadow-md rounded-lg mt-4">
                <h3 class="text-xl font-semibold mb-2">Photos</h3>
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
        <div class="w-2/3">
            <div class="bg-white p-4 shadow-md rounded-lg">
                <h3 class="text-xl font-semibold mb-4">Posts</h3>
                <div class="mb-4">
                    <textarea id="postContent" class="w-full p-2 border border-gray-300 rounded-lg" rows="3"
                        placeholder="What's on your mind, <?php echo htmlspecialchars($user['first_name']); ?>?"></textarea>
                    <button onclick="savePost()"
                        class="mt-2 bg-blue-600 text-white font-semibold px-4 py-2 rounded-lg hover:bg-blue-700">Post</button>



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
    <footer class="mt-8 bg-white py-4 text-center text-sm text-gray-600 shadow-md">
        <p>Facebook © 2024</p>
    </footer>






    <script>
        // ave the post to local storage
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

        // display the posts from local storage
        function displayPosts() {
            const posts = JSON.parse(localStorage.getItem('posts')) || [];
            const postsContainer = document.getElementById('posts');
            postsContainer.innerHTML = '';

            const profileImgUrl = '<?php echo empty($user['profile_img']) ? 'https://via.placeholder.com/150' : htmlspecialchars($user['profile_img']); ?>';

            posts.forEach((post, index) => {
                const postElement = document.createElement('div');
                postElement.className = 'mb-4 flex items-start relative';
                postElement.innerHTML = `
            <img src="${profileImgUrl}" alt="Profile Picture" class="w-10 h-10 rounded-full mr-4">
            <div class="flex-1">
                <h4 class="font-semibold text-gray-800"><?php echo htmlspecialchars($user['first_name']) . ' ' . htmlspecialchars($user['last_name']); ?></h4>
                <p class="text-gray-600">${post.content}</p>
            </div>
            <div class="ml-4 relative">
                <button onclick="toggleDropdown(event, ${index})" class="text-gray-600 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9l6 6 6-6"></path>
                    </svg>
                </button>
                <div id="dropdown-${index}" class="dropdown-menu absolute right-0 mt-2 w-32 bg-white shadow-lg rounded-md hidden">
                    <button onclick="editPost(${index})" class="block px-4 py-2 text-blue-600 hover:bg-gray-100 w-full text-left">Edit</button>
                    <button onclick="deletePost(${index})" class="block px-4 py-2 text-red-600 hover:bg-gray-100 w-full text-left">Delete</button>
                </div>
            </div>
        `;
                postsContainer.appendChild(postElement);
            });
        }

        // toggle the visibility of the dropdown menu
        function toggleDropdown(event, index) {
            event.stopPropagation();
            const dropdown = document.getElementById(`dropdown-${index}`);
            const isVisible = !dropdown.classList.contains('hidden');
            closeAllDropdowns();
            dropdown.classList.toggle('hidden', isVisible);
        }

        // Function to close all dropdowns
        function closeAllDropdowns() {
            const dropdowns = document.querySelectorAll('.dropdown-menu');
            dropdowns.forEach(dropdown => dropdown.classList.add('hidden'));
        }

        // edit a post
        function editPost(index) {
            const posts = JSON.parse(localStorage.getItem('posts')) || [];
            const newContent = prompt("Edit your post:", posts[index].content);
            if (newContent !== null) {
                posts[index].content = newContent;
                localStorage.setItem('posts', JSON.stringify(posts));
                displayPosts();
            }
        }

        // delete a post
        function deletePost(index) {
            const posts = JSON.parse(localStorage.getItem('posts')) || [];
            posts.splice(index, 1);
            localStorage.setItem('posts', JSON.stringify(posts));
            displayPosts();
        }

        document.addEventListener('click', closeAllDropdowns);
        document.addEventListener('DOMContentLoaded', displayPosts);
    </script>






</body>

</html>