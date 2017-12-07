parallax();
$(window).bind('DOMMouseScroll', function(e) {
    //Firefox
    $('html, body').stop();
}).bind('mousewheel', function(e) {
    //IE, Opera, Safari
    $('html, body').stop();
});
$(window).on('scroll', function() {
    parallax();
}).resize(function(event) {
    parallax();
});
function parallax() {
    var wScroll = $(window).scrollTop();
    $('.parallax-intro').css('background-position', 'center '+(wScroll*0.7)+'px');
    if (wScroll > 150) {
        $('.navbar').removeClass('navbar-dark bg-transparent py-nav').addClass('navbar-light bg-light navbar-shadow');
        $('.navbar-brand').removeClass('sr-only');
        $('#LoginBtn .btn').removeClass('btn-outline-light').addClass('btn-outline-dark');
    } else {
        $('#mynav').on('show.bs.collapse', showLessNavbarCollapse );
        $('#mynav').on('hide.bs.collapse', hideLessNavbarCollapse );
        if ($('#mynav').hasClass('show') == false) {
            $('.navbar').removeClass('navbar-light bg-light navbar-shadow').addClass('navbar-dark bg-transparent py-nav');
            $('#LoginBtn .btn').removeClass('btn-outline-dark').addClass('btn-outline-light');
            $('.navbar-brand').addClass('sr-only');
        } else {
            $('.navbar-brand').removeClass('sr-only');
            var wWidth = $(window).width();
            if (wWidth > 560)
                hideLessNavbarCollapse();
            else
                showLessNavbarCollapse();
        }
        $('.navbar').removeClass('py-2').addClass('py-nav');
    }
}
function showLessNavbarCollapse() {
    if ($(window).scrollTop() < 150) {
        $('.navbar').removeClass('navbar-dark bg-transparent').addClass('navbar-light bg-light navbar-shadow');
        $('#LoginBtn .btn').removeClass('btn-outline-light').addClass('btn-outline-dark');
        $('.navbar-brand').removeClass('sr-only');
    }
}
function hideLessNavbarCollapse() {
    if ($(window).scrollTop() < 150) {
        $('.navbar').removeClass('navbar-light bg-light navbar-shadow').addClass('navbar-dark bg-transparent');
        $('#LoginBtn .btn').removeClass('btn-outline-dark').addClass('btn-outline-light');
        $('.navbar-brand').addClass('sr-only');
    }
}