<?php get_header(); ?>
<div class="heading-checkout">
  <div class="container">
    <h1><?php the_title(); ?></h1>
  </div>
</div>
  <div class="container">


    <?php
        wp_reset_query(); // necessary to reset query
        while ( have_posts() ) : the_post();
            the_content();
        endwhile; // End of the loop.
    ?>
      </div>


<?php get_footer(); ?>
