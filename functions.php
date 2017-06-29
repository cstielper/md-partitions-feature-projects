<?php
function md_partitions_project_listing() {
	if(function_exists('get_field')) {
		if( have_rows('project_listing') ):
			// You will probably want to change this path to a minified version of the script
			wp_enqueue_script( 'md-partitions-lightbox', get_template_directory_uri() . '/js/lightbox.js', array( 'jquery'), NULL, TRUE );
			$i = 0; ?>
			<section class="featured-projects">
				<h2><span>Featured Projects</span></h2>
				<ul>
					<?php 
					while( have_rows('project_listing') ): the_row();
					$i++;
					$name = get_sub_field('project_name');
					$thumb = get_sub_field('project_main_image');
					$gallery_imgs = get_sub_field('project_gallery'); ?>
					<li class="trigger-gallery-<?php echo $i; ?>">
						<?php // $thumb['sizes']['thumbnail'] or any custom size you have defined ?>
						<img src="<?php echo esc_url( $thumb['sizes']['thumbnail'] ); ?>" alt="<?php echo esc_attr( $thumb['alt'] ); ?>">
						<?php echo esc_html( $name ); ?>
						<?php // You might want to remove the inline CSS and add to your SASS files ?>
						<div class="gallery-images" style="display:none">
							<ul>
								<?php foreach( $gallery_imgs as $img ): ?>
									<li><a href="<?php echo esc_url( $img['url'] ); ?>" data-imagelightbox="gallery-<?php echo $i; ?>"><?php echo esc_html( $img['filename'] ); ?></a></li>
								<?php endforeach; ?>
							</ul>
						</div>
					</li>
					<?php endwhile; ?>
				</ul>
			</section>
		<?php endif;
	}
}

add_action( 'wp_footer', 'md_partitions_build_project_script', 100, 1 );
function md_partitions_build_project_script() {
	if(function_exists('get_field')) { 
		if( have_rows('project_listing') ):
			$i = 0; ?>
			<script>
			<?php while( have_rows('project_listing') ): the_row();
				$i++;
				// Feel free to change the options below. You can find them here: https://github.com/rejas/imagelightbox ?>
				var gallery<?php echo $i; ?> = jQuery('a[data-imagelightbox="gallery-<?php echo $i; ?>"]').imageLightbox({
					activity: true,
					arrows: true,
					button:true,
					lockbody:true,
					overlay:true,
					preloadNext: true
				});

				jQuery('.trigger-gallery-<?php echo $i; ?>').on('click', function () {
					gallery<?php echo $i; ?>.startImageLightbox();
				});
			<?php endwhile; ?>
			</script>
		<?php endif; 
	}
}