<!-- Navbar -->
<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <a class="text-blue-600 text-3xl font-bold" href="profile.php">facebook</a>
        <div class="flex items-center space-x-4">
            <!-- Search Bar for larger screens -->
            <input type="text" placeholder="Search Facebook"
                class="hidden md:block px-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <!-- Navigation Links -->
            <button class="text-blue-600 font-semibold hover:underline">Home</button>
            <a href="profile.php" class="text-blue-600 font-semibold hover:underline">Profile</a>
            <a href="logout.php" class="text-blue-600 font-semibold hover:underline" id="logout">Logout</a>
        </div>
    </div>
    <!-- Mobile Search Bar and Menu -->
    <div class="container mx-auto px-4 py-4 md:hidden flex flex-col space-y-4">
        <input type="text" placeholder="Search Facebook"
            class="px-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
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