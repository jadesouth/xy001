/**
 * Created by xuying on 17/3/15.
 */
$('.navbar-toggle').on('click',function(){
    $(this).toggleClass('active').toggleClass('');
    if($(this).hasClass('active')){
        $('#navbar-collapse').addClass('active');
    } else{
        $('#navbar-collapse').removeClass('active');
    }
});
$('#header-pick-a-crate-link').on('click',function(){
    $(this).toggleClass('collapsed').toggleClass('');
    if($(this).hasClass('collapsed')){
        $(this).attr('aria-expanded',false);
        $('#dropdown-pick-crate').addClass('in');
    }else{
        $(this).attr('aria-expanded',true);
        $('#dropdown-pick-crate').removeClass('in');
    }
});