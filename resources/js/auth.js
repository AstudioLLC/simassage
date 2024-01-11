$(".typeChange").on('click',function (){
    $(this).toggleClass('passChange');
  if($(this).hasClass('passChange')) {
      $(this).children('.fa-eye').addClass('hidden');
      $(this).children('.fa-eye-slash').removeClass('hidden');
      $(this).siblings().attr('type', 'text');
  }else{
      $(this).children('.fa-eye').removeClass('hidden');
      $(this).children('.fa-eye-slash').addClass('hidden');
      $(this).siblings().attr('type', 'password');
  }
})
