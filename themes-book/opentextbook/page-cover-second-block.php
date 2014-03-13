			<section class="second-block-wrap"> 
				<div class="second-block clearfix">
						<div class="description-book-info">
							<?php $metadata = pb_get_book_information();?>
							<h2> Book Description</h2>
								<?php if ( ! empty( $metadata['pb_about_unlimited'] ) ): ?>
									<p><?php
										$about_unlimited = pb_decode( $metadata['pb_about_unlimited'] );
										$about_unlimited = preg_replace( '/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', $about_unlimited ); // Make valid HTML by removing first <p> and last </p>
										echo $about_unlimited; ?></p>
								<?php endif; ?>	
								
							  <div id="share">
								  <div id="twitter" data-url="<?php the_permalink(); ?>" data-text="Check out this great book on PressBooks." data-title="Tweet"></div>
								  <div id="facebook" data-url="<?php the_permalink(); ?>" data-text="Check out this great book on PressBooks." data-title="Like"></div>
								  <div id="googleplus" data-url="<?php the_permalink(); ?>" data-text="Check out this great book on PressBooks." data-title="+1"></div>
</div>	
						</div>
							
								<?php	$args = $args = array(
										    'post_type' => 'back-matter',
										    'tax_query' => array(
										        array(
										            'taxonomy' => 'back-matter-type',
										            'field' => 'slug',
										            'terms' => 'about-the-author'
										        )
										    )
										); ?>
			
		      				
								<div class="author-book-info">
		      				
		      						<?php $loop = new WP_Query( $args );
											while ( $loop->have_posts() ) : $loop->the_post(); ?>
										    <h4><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>
											<?php  echo '<div class="entry-content">';
										    the_excerpt();
										    echo '</div>';
											endwhile; ?>
								</div>	
					<!-- display links to files -->
					<?php
//					$download_url_prefix = get_bloginfo( 'url' ) . '/wp-admin/admin.php?page=pb_export&download_export_file=';
					$files = \PBT\Utility\latest_exports();
					if ( is_array( $files ) ) {
						echo '<h2>Alternate Formats</h2><p>This books is also available for free, download in the following formats:</p>';
						
						$dir = \PressBooks\Export\Export::getExportFolder();
						foreach ( $files as $ext => $filename ) {
							$file_extension = substr( strrchr( $ext, '.' ), 1 );
							$pre_suffix = strstr( $ext, '._3.epub' );

							if ( 'html' == $file_extension ) $file_class = 'xhtml';
							elseif ( 'xml' == $file_extension ) $file_class = 'wxr';
							elseif ( 'epub' == $file_extension && '._3.epub' == $pre_suffix )
									$file_class = 'epub3';
							else $file_class = $file_extension;
							
							echo '<a href="'.$dir . $filename.'"><span class="export-file-icon small '.$file_class.'" title="'.esc_attr($filename).'"></span></a>';
						}
					}
					?>
					</div><!-- end .secondary-block -->
				</section> <!-- end .secondary-block --> 
