<?php

add_filter('the_content', 'fyc_the_content');

function fyc_the_content( $content ) {

    if (is_singular( 'clients' ) && in_the_loop()) {
       	ob_start(); ?>
        
       	<div class="fyc-top">
	        <div class="fyc-client-featured">
	        	<img src="<?php echo the_field('client_featured_image'); ?>" class="fyc-image"  alt="<?php echo $image['alt']; ?>" />
			</div> <!-- Close .fyc-client-featured -->

			<div class="fyc-client-sidebar">
				<div class="fyc-client-recent-thumbs">

						<?php
								// The query variable
								$queried_term = get_query_var( 'Clients' );
								 
								// Return the terms for current post based off the query variable. Make you sanitize your queries!!
								$terms = wp_get_post_terms( absint( get_the_ID() ), 'Clients', array( 'fields' => 'all' ) );
								 
								// Start the arguments for WP_Query(). We'll define an empty tax_query
								// so we hav something to dump our terms into programatically.
								$args = array(
									'post_type' => 'post',
									'posts_per_page' => 2,
									'tax_query' => array()
								);
								 
								// Loop through all the terms returned for the post and add them to
								// the tax_query in the proper format
								foreach ( $terms as $term ) {
									$args['tax_query'][] = array(
										'taxonomy' => 'Clients',
										'field' => 'slug',
										'terms' => sanitize_title( $term->slug )
									);
								}
								 
								// Fetch the posts we need
								$client_posts = new WP_Query( $args );
								 
								// Start the loop
								if ( $client_posts->have_posts() ) : while ( $client_posts->have_posts() ) : $client_posts->the_post();
									echo ' <div class="fys-recent-client-item"> ';

									echo ' <a href=" ';
									echo the_permalink();
									echo ' " class="fyc-thumbnail" > ';
									echo the_post_thumbnail('medium');
									echo ' </a> ';

									echo ' <h3 class="fyc-thumbnail-title"> ';
									echo ' <a href=" ';
									echo the_permalink();
									echo ' "> ';
									echo get_the_title();
									echo ' </a> ';
									echo ' </h3> ';


									echo ' </div> ';

								endwhile;
								else :
								  // Handle the loop when no posts exist
								endif;
								 
								// FIN

							wp_reset_postdata();
						?>

				</div>

				<?php
				if( get_field('client_proofing_url') ):
				 echo '<a href=" ';
				 echo the_field('client_proofing_url'); 
				 echo ' " class="fyc-order-button">Order Prints Here</a>'; 
				endif;
				?>

			</div> <!-- Close .fyc-client-sidebar -->
		</div> <!--	Close .fyc-top -->

		<div class="fyc-midriff"> 
			 <div class="fyc-client-story">
				<h3>Love Story</h3>
				<p><?php the_field('client_story'); ?></p>
			</div>

				<div class="fyc-client-review">
					<h3>Reviews</h3>
					<p><?php the_field('client_review'); ?></p>	
				</div>  

		</div> <!-- Close .fyc-midriff -->	        
        	
        <?php
        echo ob_get_clean();	
    }
        return $content;
}