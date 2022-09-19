<?php

/**
 * Popular Posts Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 */

$popularpostbyview = array(
      'meta_key'       => 'wp_post_views_count', // set custom meta key
      'orderby'        => 'meta_value_num',
      'order'          => 'DESC',
      'posts_per_page' => 4
);
   
// Invoke the query
$popularpost = new WP_Query( $popularpostbyview );
   
if ( $popularpost->have_posts() ) :?>
      <ul>
      <?php while ( $popularpost->have_posts() ) : $popularpost->the_post(); ?>
            <li>
                  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                       <?php the_title(); ?>
                      </a>
                  </li>
              <?php
            endwhile;
              wp_reset_postdata();
          ?>
      </ul>
  <?php 
endif;