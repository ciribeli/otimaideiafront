<?php get_header(); ?>
<section class="topo-pagina-padrao topo-single-blog">
  <div class="container">
    <div class="row">
        <h1><?php the_title(); ?></h1>
    </div>
  </div>
</section>
<section class="conteudo-single-blog">
  <div class="container">
    <div class="row">
      <?php
          wp_reset_query(); // necessary to reset query
          while ( have_posts() ) : the_post();
              the_content();
          endwhile; // End of the loop.
      ?>
    </div>
  </div>
</section>






<?php get_footer(); ?>
