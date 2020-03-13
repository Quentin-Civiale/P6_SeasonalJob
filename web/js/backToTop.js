$(document).ready(function() {

    var btn = $('#btn-to-top');
    var btnToTop = $('#top');

    /* Apparition et disparition du bouton */
    $(window).scroll(function() {
        if ($(window).scrollTop() > 300) {
            btn.addClass('show');
        } else {
            btn.removeClass('show');
        }
    });

    /* Défilement vers le haut */
    btnToTop.on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({scrollTop:0}, '300');
    });
});