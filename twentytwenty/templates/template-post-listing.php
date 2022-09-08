<?php
/**
 * Template Name: Post Listing Template
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
$post_list = new WP_Query(
      [
            'post_type'      => 'post',
            'post_status'    => 'publish', 
            'posts_per_page' => 9,
      ]
); 

if ( $post_list->have_posts() ) : ?>
  <div id="list-post-panel">
    <ul>
      <?php while ( $post_list->have_posts() ) : 
            $post_list->the_post();
            $image = get_the_post_thumbnail_url( get_the_ID()); 
      ?>
      <li>
            <div class="post-list-featured-image">
                  <img src="<?php echo $image; ?>" />
            </div>
            <div class="post-list-title">
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </div>
      </li>
     <?php endwhile; ?>
    </ul>
    <ul id="list_post"></ul>
    <button class="load_more">Load More</button>
    <?php wp_reset_postdata(); ?>
<?php else : ?>
  <p><?php _e( 'There no posts to display.' ); ?></p>
<?php endif; ?>
</div>
<?php get_footer(); ?>
<script>
      jQuery(".load_more").on('click', function(e) {
            e.preventDefault();
            $.ajax({
                  type: "GET",
                  url: 'wp-json/wp/v2/posts/?per_page=10',
                  success: function(data) {
                        console.log(data);
                        data.forEach(post => {
                              jQuery("#list_post").append(`
                              <li><a href="${post.link}" target="_blank">${post.title.rendered}</a></li>
                              `)
                        });
                  },
                  error: function(result) {
                        alert('error');
                  }
            });
      });
      
</script>
