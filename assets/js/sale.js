$(function() {
    $.extend({
        getUrlVars: function() {
            var vars = [],
                hash, hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
            for(var i = 0; i < hashes.length; i++) {
                hash = hashes[i].split('=');
                vars.push(hash[0]);
                vars[hash[0]] = decodeURIComponent(hash[1]);
            }
            return vars;
        },
        getUrlVar: function(name) {
            return $.getUrlVars()[name];
        }
    });
    $("#submit_date").datepicker({
        dateFormat: "yy-mm-dd"
    });

    $(document).on('click', '.manage_house', function(e){
        var source   = $("#manage-template").html();
        var template = Handlebars.compile(source);
        var uid = $(this).data('uid');
        $.ajax({
            url: '/sale/item/' + uid,
            dataType: 'json',
            type: 'GET',
            success: function(response) {
                if (response.success_text) {
                    response.item.is_submit = +response.item.is_submit;
                    response.item.is_owner = +response.item.is_owner;
                    var html = template(response.item);
                    $('#manage_house').html(html);
                }
            }
        });
    })
});