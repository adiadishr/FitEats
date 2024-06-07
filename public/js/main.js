// Admin Menu Functionality
document.addEventListener("DOMContentLoaded", function() {
    // Select all dropdown buttons and menus
    const dropdownBtns = document.querySelectorAll('.admin-menu-btn');
    const dropdownMenus = document.querySelectorAll('.admin-dropdown-menu');

    // Add event listener for each dropdown button
    dropdownBtns.forEach(function(dropdownBtn, index) {
        dropdownBtn.addEventListener('click', function() {
            // Toggle the visibility of the corresponding dropdown menu
            dropdownMenus[index].classList.toggle('hidden');
        });
    });

    // Hide dropdown menus when clicking outside of them
    document.addEventListener('click', function(event) {
        dropdownBtns.forEach(function(dropdownBtn, index) {
            if (!dropdownMenus[index].contains(event.target) && !dropdownBtn.contains(event.target)) {
                dropdownMenus[index].classList.add('hidden');
            }
        });
    });
});

// Close Delete Message
function closedeletePost() {
    var deletePostElement = document.getElementById("deletePost");
    if (deletePostElement) {
        deletePostElement.classList.add("hidden");
    }
}

// Close Review Success Message
function closeReviewSuccess() {
    var reviewSuccessElement = document.getElementById("reviewSuccess");
    if (reviewSuccessElement) {
        reviewSuccessElement.classList.add("hidden");
    }
}

// Close Review Same Message
function closeReviewSame() {
    var reviewSameElement = document.getElementById("reviewSame");
    if (reviewSameElement) {
        reviewSameElement.classList.add("hidden");
    }
}