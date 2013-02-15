$(function () {
    $('#container').twzipcode({
        css: ["input-small", "input-small", "input-small"],
    });
    $( "#submit_date" ).datepicker({
        dateFormat: "yy-mm-dd"
    });
});