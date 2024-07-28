"use strict"

var postUrl = "../vendor/php/view.php";

// Initialize Toastr
toastr.options = {
  closeButton: true,
  debug: false,
  newestOnTop: true,
  progressBar: true,
  positionClass: 'toast-top-right',
  preventDuplicates: false,
  onclick: null,
  showDuration: '300',
  hideDuration: '1000',
  timeOut: '5000',
  extendedTimeOut: '1000',
  showEasing: 'swing',
  hideEasing: 'linear',
  showMethod: 'fadeIn',
  hideMethod: 'fadeOut'
};

$(window).on("load", function() {
    $('.btn-forget').on('click',function(e){
        e.preventDefault();
        var inputField = $(this).closest('form').find('input');
        if(inputField.attr('required') && inputField.val()){
            $('.error-message').remove();
            $('.form-items','.form-content').addClass('hide-it');
            $('.form-sent','.form-content').addClass('show-it');
        }else{
            $('.error-message').remove();
            $('<small class="error-message">Please fill the field.</small>').insertAfter(inputField);
        }

    });
    
    $('.btn-tab-next').on('click',function(e){
        e.preventDefault();
        $('.nav-tabs .nav-item > .active').parent().next('li').find('a').trigger('click');
    });
    $('.custom-file input[type="file"]').on('change', function(){
        var filename = $(this).val().split('\\').pop();
        $(this).next().text(filename);
    });
});

var password = document.getElementById('password1')
var password2 = document.getElementById('password2')
var pass1_visible = document.getElementById('pass1-visible')
var pass1_hidden = document.getElementById('pass1-hidden')
var pass2_visible = document.getElementById('pass2-visible')
var pass2_hidden = document.getElementById('pass2-hidden')

pass1_hidden.onclick = function(){
    pass1_visible.style.display = 'block'
    pass1_hidden.style.display = 'none'
    password.type = 'text'
}
pass1_visible.onclick = function(){
    pass1_visible.style.display = 'none'
    pass1_hidden.style.display = 'block'
    password.type = 'password'

}
pass2_hidden.onclick = function(){
    pass2_visible.style.display = 'block'
    pass2_hidden.style.display = 'none'
    password2.type = 'text'
}
pass2_visible.onclick = function(){
    pass2_visible.style.display = 'none'
    pass2_hidden.style.display = 'block'
    password2.type = 'password'

}



