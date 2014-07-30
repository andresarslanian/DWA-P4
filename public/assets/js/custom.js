$(document).ready(function () {

    var url = window.location.href;
    url = '/'+url.replace(/^(?:\/\/|[^\/]+)*\//, "");
    $('.nav a[href="'+url+'"]').parent().addClass('active');
    
});