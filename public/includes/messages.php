<?php
if (isset($_SESSION['delete_message']) && !empty($_SESSION['delete_message'])) {
?>
    <div class="fixed z-50 flex justify-center w-full top-[50%]" id="deletePost">
        <div class="flex gap-5 px-10 py-5 bg-red-600 rounded-full ring-red-600 ring-8 ring-opacity-60">
            <p class="text-xl text-white"><?= $_SESSION['delete_message']; ?></p>
            <button class="px-2 py-1 rounded-full hover:ring-2 ring-opacity-80 ring-white" onclick="closedeletePost()">
                <i class="text-lg font-bold text-white fas fa-x"></i>
            </button>
        </div>
    </div>
<?php
    $_SESSION['delete_message'] = '';
}
?>
