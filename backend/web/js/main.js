$(document).ready(function() {
    $('.comment-row').on('click', '.comment-status-allow', function(e) {
        e.preventDefault();

        var id = $(this).data('id');

        $.ajax({
            url: '/admin/blog-comment/allow',
            data: { id: id },
            type: 'GET',
            success: function(result) {
                $('#' + id).html(result);
            }
        });
    });

    $('.comment-row').on('click', '.comment-status-disallow', function(e) {
        e.preventDefault();

        var id = $(this).data('id');

        $.ajax({
            url: '/admin/blog-comment/disallow',
            data: { id: id },
            type: 'GET',
            success: function(result) {
                $('#' + id).html(result);
            }
        });
    });
});