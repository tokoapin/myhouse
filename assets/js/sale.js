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
});