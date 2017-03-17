$(document).ready( function()
{
    $(window).scroll( function()
    {
        if ($(window).scrollTop() > 150)
        {
            $('#header').addClass('fixed');
        }
        else
        {
            $('#header').removeClass('fixed');
        }
    });
});
