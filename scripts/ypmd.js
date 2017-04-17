//script that operates the sticky header
$(document).ready( function()
{
    $(window).scroll( function()
    {
        if ($(window).scrollTop() > 100)
        {
            $('#header').addClass('fixed');
        }
        else
        {
            $('#header').removeClass('fixed');
        }
    });
});
