<?php
$active = $_GET['category_id'] ?? 0;
?>

<!-- Left Frame -->
<div class="hidden md:flex flex-col min-w-[200px] w-[25%] pr-[20px]">
    <!-- Items -->
    <a href="home.php">
        <div id="all" class="category-tab <?= $active == 0 ? 'category-active' : ''; ?>">
            <i class="fa-solid fa-circle-arrow-up fa-rotate-by text-xl" style="--fa-rotate-angle: 45deg;"></i>
            <p class=" category-text">All Recipes</p>
        </div>
    </a>
    <div class="flex flex-row w-full gap-[10px] px-[20px] py-[20px] items-center">
        <p class="text-[24px]/[120%] font-semibold text-heading">Categories:</p>
    </div>
    <?php
    $category_left_query = "SELECT * FROM categories ORDER BY id";
    $category_left_result = mysqli_query($conn, $category_left_query);
    while ($categories_left = mysqli_fetch_assoc($category_left_result)) {
    ?>
        <a href="home.php?category_id=<?= $categories_left['id']; ?>">
            <div id="<?= $categories_left['id'] ?>" class="category-tab <?= $active == $categories_left['id'] ? 'category-active' : ''; ?>">
                <p class="category-text"><?= $categories_left['name']; ?></p>
            </div>
        </a>
    <?php
    }
    ?>
</div>