$(document).ready(function () {
    $('form').on('submit', function (e) {
        var val = $('#text_newContribution').val();
        if (val.length > 140) {
            e.preventDefault();
            alert('To many characters');
        }
    });
});
