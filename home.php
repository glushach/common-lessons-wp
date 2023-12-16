<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <?php wp_head(); ?>
</head>

<body>
  <!-- 
    Скачать исходники можно здесь
    https://github.com/jquery-backstretch/jquery-backstretch
  -->

  <?php
  wp_nav_menu(
    array(
      'theme_location' => 'primary',
      'menu_class'     => 'nav-menu',
    )
  );

  $url = '';
  query_posts($query_string . '&category_name=home&posts_per_page=-1&order=ASC');

  if (have_posts()) : while (have_posts()) : the_post();
      $id = get_post_thumbnail_id();
      $url .= '"' . wp_get_attachment_url($id) . '",';
    endwhile;
  else :

  endif;
  ?>

<!--   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script src="<?php bloginfo('template_url'); ?>/js/jquery.backstretch.min.js"></script> -->
  <script>
    jQuery.backstretch([
      /* "pot-holder.jpg",
      "coffee.jpg",
      "dome.jpg" */
      <?php echo $url; ?>
    ], {
      fade: 750,
      duration: 4000
    });
  </script>
  <?php wp_footer(); ?>
</body>

</html>
