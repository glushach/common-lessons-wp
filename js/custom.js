jQuery(document).ready(function($) {
  $('.sp_prev').on('click', function() {
    $(this).children('.plus').toggle(100);
    $(this).children('.minus').toggle(100);

    const par = $(this).parent('.spoller');
    par.children('.sp_content').stop().toggle(100);
  });
});
