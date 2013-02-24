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
    }).on('click', '.setting', function(e) {
        e.preventDefault();
        var mode = $(this).data('mode') || '';
        var form_info = $("#setting_form").serializeObject();
        var uid = $(this).data('uid') || '';
        var data = {}, message = '';
        switch (mode) {
            case 'reservation':
            case 'deal':
                $("#reservation, #deal").hide();
                $("#" + mode).show();
                break;
            case 'update_reservation':
            case 'update_deal':
                if (mode == 'update_reservation') {
                    message = '已預約/續約成功';
                } else if (mode == 'update_deal') {
                    message = '設定已成交';
                }
                $.ajax({
                    url: '/sale/setting/' + uid,
                    dataType: 'json',
                    data: $.extend(form_info, {mode: mode}),
                    type: 'POST',
                    success: function(response) {
                        if (response.success_text) {
                            alert(message);
                        }
                    }
                });
                break;
            case 'open':
            case 'close':
                var key = $(this).data('key') || '';
                var value = $(this).data('value') || '';
                $.ajax({
                    url: '/sale/setting/' + uid,
                    dataType: 'json',
                    data: {
                        'key': key,
                        'value': value,
                        'mode': mode
                    },
                    type: 'POST',
                    success: function(response) {
                        if (response.success_text) {
                            alert('設定完成，重新整理網頁');
                            window.location.reload();
                        }
                    }
                });
                break;
            case 'delete':
                if (!confirm("確定要刪除此銷售物件?")) {
                    return true;
                }
                $.ajax({
                    url: '/sale/delete/' + uid,
                    dataType: 'json',
                    type: 'GET',
                    success: function(response) {
                        if (response.success_text) {
                            alert('刪除完成，重新整理網頁');
                            window.location.reload();
                        }
                    }
                });
                break;
        }
    }).on('shown', '#manage_house', function () {
        $("#submit_date").datepicker({
            dateFormat: "yy-mm-dd"
        });
    });
});
