<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package whitelist
 */

if( !is_user_logged_in() ) {
    wp_redirect(home_url());
    exit;
}

get_header();

$post_type = 'brand';
$paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
$orderby = ( get_query_var('orderby') ) ? get_query_var('orderby') : 'date';
$order = ( get_query_var('order') ) ? get_query_var('order') : 'desc';
$args = array(
	'post_type'			=> $post_type,
	'post_status'		=> 'publish',
	'orderby'			=> $orderby,
	'order'				=> $order,
	'paged'				=> $paged,
);
$query = new WP_Query($args);
$count = $query->found_posts;
$post_classes = '';
if( $count == 0 ) {
	$post_classes = ' post-grid-empty';
}
?>
	<main id="primary" class="site-main">
    	<div class="wp-page-inner px-4 py-5 min-vh-100">
			<div class="post-grid<?php echo $post_classes;?>">
				<table class="w-100">
					<thead>
						<tr>
							<th>Title</th>
							<th>Created on</th>
							<th>Last Update Date</th>
							<th>Last Update By</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
					<?php 
					if ( $query->have_posts() ) : ?>
						<?php
						$i = 1;
						/* Start the Loop */
						while ( $query->have_posts() ) :
							$query->the_post();
							get_template_part( 'template-parts/template-archive-listing', 'brand', array('index'=>$i,'type'=>'table') );
							$i++;
						endwhile;
						echo '<div class="post-pagination">';
							echo paginate_links([
								'base' => get_pagenum_link(1) . '%_%',
								'current' => $paged,
								'format' => 'page/%#%/',
								'total'   => $query->max_num_pages,
								'prev_text' => '<i class="fa fa-chevron-left"></i><span class="d-none d-md-block">Prev</span>',
								'next_text' => '<span class="d-none d-md-block">Next</span><i class="fa fa-chevron-right"></i>',
							]);
						echo '</div>';
						wp_reset_postdata();
					else :

						get_template_part( 'template-parts/template-archive-listing', 'empty', array('type'=>'table') );

					endif;
					?>
					</tbody>
				</table>
			</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();
