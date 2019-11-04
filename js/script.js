// on attend que le document soit complètement construit
$(document).ready(function() {

    $('#toggleMenu').on('click', function() {
        $('header').slideToggle(500);
    });

    $('#fadeImg').on('click', function() {
        $('img').fadeOut();
    });

    $('#hideAside').on('click', function() {
        $('aside').hide(2000);
    });

    $('section > dl > dd').css('display', 'none');

    $('body').on('click', 'section > dl > dt', function(event) {

        $(this).next('dd').slideToggle();

        if($(this).next('section > dl > dd').is(':visible')) {
            $('section > dl > dd').slideUp();
            var nbClics = parseInt($(this).find('.nbClics').text());
            $(this).find('.nbClics').html(nbClics + 1);

            trier();

        }

        console.log($(this));
    });

    function trier() {
        var clics = $('section > dl > dt');

        clics.sort(function (a, b) {
            return $(b).find('.nbClics').text() - $(a).find('.nbClics').text();
        });

        var section = '';
        clics.each(function (element) {
            section += '<dt>'+ $(this).html() +'</dt>';

            var displayNone = '';
            if(!$(this).next('dd').is(':visible')) {
                displayNone = ' style="display:none;"';
            }

            section += '<dd'+ displayNone +'>'+ $(this).next('dd').html() +'</dd>';
        });

        $('section > dl').html(section);
    }


    $('#sectionAdmin div').hide();
    $('#sectionAdmin h1').on('click', function () {
        $(this).next('div').slideToggle();
    });


});