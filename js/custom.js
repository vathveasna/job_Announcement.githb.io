$(document).ready(function() {
    // 1. Initialize Bootstrap Tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // 2. Form Validation Placeholder
    // You can add logic here to check if search inputs are empty
    $('.btn-block').on('click', function(e) {
        let keyword = $('#search').val();
        if(keyword === "") {
            console.log("Please enter a keyword to search.");
        }
    });

    // 3. Image Lazy Loading
    // This works with the "lazy" class in your HTML
    if ($(".lazy").length > 0) {
        $(".lazy").lazyload();
    }
});