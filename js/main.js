
/****************INIT*******************/
function init() {

    //toggleSyllabus();
    //$('.syllabusData').toggle();

    // -- Animations --
    $('.angular-img').css('visibility', 'visible');
    $('.angular-img').addClass('animated bounceInRight'); //animate the angular logo
    setTimeout(function () {
        $('.heading-content').find('h1').css('visibility', 'visible');
        $('.heading-content').find('h1').addClass('animated zoomIn'); //animate the angular heading    
    }, 1000);
    $('#nav-contact-us').click(function(){
        $("html, body").animate({ scrollTop: $('#contactForm').offset().top }, 1000);
    });
    $('#header-contact-us').click(function(){
        $("html, body").animate({ scrollTop: $('#contactForm').offset().top }, 1000);
    });
}

  

/****************TOGGLE SYLLABUS BUTTON*******************/

function toggleSyllabus() {
    $('#syllabus-text').toggle();
}


function toggleSyllabusItem(el) {
    $(el).find('.syllabusData').toggle();
}

/****************CONTACT MESSAGE SUBMITTED*******************/

$('#contactForm').submit(function (e) {
    $('#contactSubmit').addClass('disabled');
    $('.sent-massage-modal').addClass('show-modal');

    e.preventDefault();
    var data = {
        name: $('#name').val(),
        email: $('#email').val(),
        phone: $('#phone').val(),
        msg: $('#message').val()
    };
    console.log('data', data)

    $.ajax({
        type: "POST",
        url: 'contact/contact.php',
        data: data,
        success: function (response) {
            doWhenFinish();
        },
        error: function (error) {
            console.log('Error:', error);
            doWhenFinish();
        }
    });
});

function doWhenFinish() {
    $('#contactSubmit').removeClass('disabled');
    $('#myModal').modal('show')

    $('#contactForm').addClass('hide-only');
    // $('#thank-you').fadeIn();
    $('#name').val('');
    $('#email').val('');
    $('#phone').val('');
    $('#message').val('');
    setTimeout(function () {
        $('#myModal').modal('hide')

        // $('#thank-you').hide();
    }, 7000);
}



function showRedirecting() {
    $('.RedirectingToPayPal').css('display', 'block');
}