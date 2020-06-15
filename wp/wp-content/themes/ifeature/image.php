<?php
/**
 * Title: Image template.
 *
 * Description: Defines template for single image page.
 *
 * Please do not edit this file. This file is part of the CyberChimps Framework and all modifications
 * should be made in a child theme.
 *
 * @category CyberChimps Framework
 * @package  Framework
 * @since    1.0
 * @author   CyberChimps
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v3.0 (or later)
 * @link     https://www.cyberchimps.com/
 */

get_header(); ?>

	<div id="image_page" class="container-full-width">

		<div class="container">

			<div class="container-fluid">

				<?php do_action( 'ifeature_cc_before_container' ); ?>

				<div id="container" <?php Ifeature_Helper::ifeature_cc_filter_container_class(); ?>>

					<?php do_action( 'ifeature_cc_before_content_container' ); ?>

					<div id="content" <?php Ifeature_Helper::ifeature_cc_filter_content_class(); ?>>

						<?php do_action( 'ifeature_cc_before_content' ); ?>

						<?php
						while ( have_posts() ) :
							the_post();
							?>

							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<header class="entry-header">
									<h1 class="entry-title"><?php the_title(); ?></h1>

									<div class="entry-meta">
										<?php
										$metadata = wp_get_attachment_metadata();
										printf(
											esc_html( 'Published', 'ifeature' ) . ' <span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span> - ' . esc_html( 'size', 'ifeature' ) . ': <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> ' . esc_html( 'in', 'ifeature' ) . ' <a href="%6$s" title="Return to %7$s" rel="gallery">%7$s</a>',
											esc_attr( get_the_date( 'c' ) ),
											esc_html( get_the_date() ),
											wp_get_attachment_url(),
											$metadata['width'],
											$metadata['height'],
											get_permalink( $post->post_parent ),
											get_the_title( $post->post_parent )
										);
										?>
										<?php edit_post_link( __( 'Edit', 'ifeature' ), '<span class="sep"> | </span> <span class="edit-link">', '</span>' ); ?>
									</div>
									<!-- .entry-meta -->

									<nav id="image-navigation" class="row-fluid">
										<div class="span6">
											<div class="previous-image"><?php previous_image_link( false, '&larr; ' . __( 'Previous', 'ifeature' ) ); ?></div>
										</div>
										<div class="span6">
											<div class="next-image alignright"><?php next_image_link( false, __( 'Next', 'ifeature' ) . ' &rarr;' ); ?></div>
										</div>
									</nav>
									<!-- #image-navigation -->
								</header>
								<!-- .entry-header -->

								<div class="entry-content">

									<div class="entry-attachment">
										<div class="attachment">

											<a href="<?php wp_get_attachment_link( $post->ID, 'fullsize' ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment">
																				   <?php
																					$attachment_size = apply_filters( 'ifeature_cc_attachment_size', array( 1200, 1200 ) ); // Filterable image size.
																					echo wp_get_attachment_image( $post->ID, $attachment_size );
																					?>
												</a>
										</div>
										<!-- .attachment -->

										<?php if ( ! empty( $post->post_excerpt ) ) : ?>
											<div class="entry-caption">
												<?php the_excerpt(); ?>
											</div>
										<?php endif; ?>
									</div>
									<!-- .entry-attachment -->

									<?php the_content(); ?>
									<?php
									wp_link_pages(
										array(
											'before' => '<div class="page-links">' . __( 'Pages:', 'ifeature' ),
											'after'  => '</div>',
										)
									);
									?>

								</div>
								<!-- .entry-content -->

								<?php
								// HS Thumbnail next and previous image
								$attachments = array_values(
									get_children(
										array(
											'post_parent' => $post->post_parent,
											'post_status' => 'inherit',
											'post_type'   => 'attachment',
											'post_mime_type' => 'image',
											'order'       => 'DESC',
											'orderby'     => 'menu_order ID',
										)
									)
								);

								foreach ( $attachments as $k => $attachment ) {
									if ( $attachment->ID == $post->ID ) {

										$previous_image = isset( $attachments[ $k - 1 ] ) ? $attachments[ $k - 1 ]->ID : false;
										$next_image     = isset( $attachments[ $k + 1 ] ) ? $attachments[ $k + 1 ]->ID : false;

										$first_image = isset( $attachments[0] ) ? $attachments[0]->ID : false;
										$last_image  = isset( $attachments[ $k + 1 ] ) ? end( $attachments )->ID : false;

										$previous_url = isset( $attachments[ $k - 1 ] ) ? get_permalink( $attachments[ $k - 1 ]->ID ) : get_permalink( $attachments[0]->ID );
										$next_url     = isset( $attachments[ $k + 1 ] ) ? get_permalink( $attachments[ $k + 1 ]->ID ) : get_permalink( $attachments[0]->ID );

										$first_url = isset( $attachments[0] ) ? get_permalink( $attachments[0] ) : false;
										$last_url  = isset( $attachments[ $k + 1 ] ) ? get_permalink( end( $attachments )->ID ) : get_permalink( $attachments[0]->ID );
									}
								}
								?>
								<div class="row-fluid gallery-pagination">
									<div class="span6 previous-image">
										<?php if ( $previous_image == false && count( $attachments ) > 1 ) : ?>
											<a href="<?php echo $last_url; ?>"><?php echo wp_get_attachment_image( $last_image, 'thumbnail' ); ?></a>
										<?php elseif ( $previous_image != $post->ID ) : ?>
											<a href="<?php echo $previous_url; ?>"><?php echo wp_get_attachment_image( $previous_image, 'thumbnail' ); ?></a>
										<?php endif; ?>
									</div>
									<!-- span6 -->

									<div class="span6 next-image">
										<?php if ( $next_image == false && count( $attachments > 1 ) ) : ?>
											<a href="<?php echo $first_url; ?>"><?php echo wp_get_attachment_image( $first_image, 'thumbnail' ); ?></a>
										<?php elseif ( $next_image != $post->ID ) : ?>
											<a href="<?php echo $next_url; ?>"><?php echo wp_get_attachment_image( $next_image, 'thumbnail' ); ?></a>
										<?php endif; ?>
									</div>
									<!-- span6 -->
								</div>
								<!-- row fluid -->
								<?php // HS END Thumbnail next and previous image ?>


								<footer class="entry-meta">
									<?php if ( comments_open() && pings_open() ) : // Comments and trackbacks open ?>
										<?php printf( '<a class="comment-link" href="#respond" title="Post a comment">' . esc_html( 'Post a comment', 'ifeature' ) . '</a> ' . esc_html( 'or leave a trackback', 'ifeature' ) . ': <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">' . esc_html( 'Trackback URL', 'ifeature' ) . '</a>.', get_trackback_url() ); ?>
									<?php elseif ( ! comments_open() && pings_open() ) : // Only trackbacks open ?>
										<?php printf( esc_html( 'Comments are closed, but you can leave a trackback:', 'ifeature' ) . ' <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">' . esc_html( 'Trackback URL', 'ifeature' ) . '</a>.', get_trackback_url() ); ?>
										<?php
									elseif ( comments_open() && ! pings_open() ) : // Only comments open
										?>
										<?php esc_html_e( 'Trackbacks are closed, but you can', 'ifeature' ) . ' <a class="comment-link" href="#respond" title="Post a comment">' . __( 'post a comment', 'ifeature' ) . '</a>.'; ?>
										<?php
									elseif ( ! comments_open() && ! pings_open() ) : // Comments and trackbacks closed
										?>
										<?php esc_html_e( 'Both comments and trackbacks are currently closed.', 'ifeature' ); ?>
									<?php endif; ?>
									<?php edit_post_link( __( 'Edit', 'ifeature' ), ' <span class="edit-link">', '</span>' ); ?>
								</footer>
								<!-- .entry-meta -->
							</article><!-- #post-<?php the_ID(); ?> -->

							<?php comments_template(); ?>

						<?php endwhile; // end of the loop. ?>

						<?php do_action( 'ifeature_cc_after_content' ); ?>

					</div>
					<!-- #content -->

					<?php do_action( 'ifeature_cc_after_content_container' ); ?>

				</div>
				<!-- #container .row-fluid-->

				<?php do_action( 'ifeature_cc_after_container' ); ?>

			</div>
			<!--container fluid -->

		</div>
		<!-- container -->

	</div><!-- container full width -->

<?php get_footer(); ?>
