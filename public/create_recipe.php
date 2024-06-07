<?php
require './includes/config.php';
require './includes/login_check.php';
require './includes/head.php';
?>

<body class="bg-background font-universal">

    <?php require './includes/top.php' ?>

    <div class="w-1/2">
        <form action="./actions/create_recipe_action.php" method="POST" enctype="multipart/form-data" class="w-full max-w-lg mx-auto">
            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input id="title" name="title" type="text" class="block w-full p-2 mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" />
            </div>
            <div class="mb-6">
                <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                <select id="category" name="category_id" class="block w-full p-2 mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    <option value="">Select a Category</option>
                    <?php
                    $query = "SELECT * FROM categories";
                    $result = mysqli_query($conn, $query);
                    while ($category = mysqli_fetch_assoc($result)) {
                    ?>
                        <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="mb-6">
                <label for="calories" class="block text-sm font-medium text-gray-700">Calories</label>
                <input id="calories" name="calories" type="number" class="block w-full p-2 mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" />
            </div>
            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" rows="4" class="block w-full p-2 mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"></textarea>
            </div>
            <div class="mb-6">
                <label for="ingredients" class="block text-sm font-medium text-gray-700">Ingredients</label>
                <textarea id="ingredients" name="ingredients" rows="4" class="block w-full p-2 mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"></textarea>
            </div>
            <div class="mb-6">
                <label for="instructions" class="block text-sm font-medium text-gray-700">Instructions</label>
                <textarea id="instructions" name="instructions" rows="4" class="block w-full p-2 mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"></textarea>
            </div>
            <div class="mb-6">
                <label for="recipe_picture" class="block text-sm font-medium text-gray-700">Photo</label>
                <input id="recipe_picture" name="recipe_picture" type="file" class="block w-full p-2 mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" />
            </div>
            <div class="mb-6">
                <button type="submit" class="px-4 py-2 text-white rounded-md bg-primary hover:bg-opacity-85">Submit</button>
            </div>
        </form>
    </div>

</body>