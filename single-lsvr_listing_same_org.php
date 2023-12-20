<?php
/**
 * Template Name: Организация, похожие организации
 * Template Post Type: lsvr_listing
 */
?>
<?php get_header(); ?>

<?php // Post gallery
get_template_part( 'template-parts/lsvr_listing/single-gallery' ); ?>

<?php // Breadcrumbs
get_template_part( 'template-parts/breadcrumbs' ); ?>

<?php // Main begin
get_template_part( 'template-parts/main-begin' ); ?>

<!-- POST SINGLE : begin -->
<div class="lsvr_listing-post-page post-single lsvr_listing-post-single">

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<!-- POST : begin -->
		<article <?php post_class( 'post' ); ?>>
			<div class="post__inner">

				<!-- POST HEADER : begin -->
				<header class="post__header">

					<!-- POST TITLE : begin -->
					<h1 class="post__title is-main-headline"><?php the_title(); ?></h1>
					<!-- POST TITLE : end -->

					<?php // Post meta
					get_template_part( 'template-parts/single-post-meta' ); ?>

					<?php // Social links
					get_template_part( 'template-parts/lsvr_listing/single-social-links' ); ?>

				</header>
				<!-- POST HEADER : end -->

				<?php // Add custom code before thumbnail
				do_action( 'lsvr_pressville_listing_single_thumbnail_before' ); ?>

				<?php // Thumbnail
				get_template_part( 'template-parts/single-post-thumbnail' ); ?>

				<?php // Add custom code before content
				do_action( 'lsvr_pressville_listing_single_content_before' ); ?>

				<?php // Post content
				get_template_part( 'template-parts/single-post-content' ); ?>

				<?php // Add custom code before contact info
				do_action( 'lsvr_pressville_listing_single_contact_info_before' ); ?>

				<?php // Contact info
				get_template_part( 'template-parts/lsvr_listing/single-contact-info' ); ?>

				<?php // Map and address
				if ( true === get_theme_mod( 'lsvr_listing_single_map_enable', true ) &&
					lsvr_pressville_has_listing_map_location( get_the_ID() ) && lsvr_pressville_has_listing_address( get_the_ID() ) ) : ?>

					<?php // Add custom code before map
					do_action( 'lsvr_pressville_listing_single_addressmap_before' ); ?>

					<?php // Address and map
					get_template_part( 'template-parts/lsvr_listing/single-addressmap' ); ?>

				<?php // Map only
				elseif ( true === get_theme_mod( 'lsvr_listing_single_map_enable', true ) && lsvr_pressville_has_listing_map_location( get_the_ID() ) ) : ?>

					<?php // Add custom code before map
					do_action( 'lsvr_pressville_listing_single_map_before' ); ?>

					<?php // Map
					get_template_part( 'template-parts/lsvr_listing/single-map' ); ?>

				<?php // Address only
				elseif ( lsvr_pressville_has_listing_address( get_the_ID() ) ) : ?>

					<?php // Add custom code before map
					do_action( 'lsvr_pressville_listing_single_address_before' ); ?>

					<!-- POST ADDRESS : begin -->
					<p class="post__address">
						<?php lsvr_pressville_the_listing_address( get_the_ID(), false ); ?>
					</p>
					<!-- POST ADDRESS : end -->

				<?php endif; ?>

				<?php // Add custom code before opening hours
				do_action( 'lsvr_pressville_listing_single_opening_hours_before' ); ?>

				<?php // Opening hours
				get_template_part( 'template-parts/lsvr_listing/single-opening-hours' ); ?>


				<?php // Add custom code before footer
				do_action( 'lsvr_pressville_listing_single_footer_before' ); ?>

				<?php // Post footer
				get_template_part( 'template-parts/single-post-footer' ); ?>

				<?php // Add custom code at post bottom
				do_action( 'lsvr_pressville_listing_single_bottom' ); ?>


			</div>
		</article>
		<!-- POST : end -->

		<?php comments_template(); ?>


        <!--Виджет похожих организаций-->
        <section
                class="lsvr-pressville-post-grid lsvr-pressville-post-grid--posts lsvr-pressville-post-grid--layout-title-top lsvr-pressville-post-grid--has-slider lsvr-pressville-post-grid--dark-bg"
        >
            <div class="lsvr-pressville-post-grid__inner">
                <div class="lsvr-container">

                    <div class="lsvr-pressville-post-grid__content">
                        <header class="lsvr-pressville-post-grid__header">

                            <h2 class="lsvr-pressville-post-grid__title" style="text-align: center">Похожие организации</h2>

                            <!--                                                        <i class="icon-location-map lsvr-pressville-post-grid__icon"-->
                            <!--                                                           aria-hidden="true"></i>-->
                        </header>

                        <div class="lsvr-pressville-post-grid__list-wrapper">
                            <div class="lsvr-grid lsvr-grid--3-cols lsvr-grid--md-2-cols lsvr-grid--sm-2-cols lsvr-pressville-post-grid__list lsvr-pressville-post-grid__list--5-items lsvr-pressville-post-grid--slider lsvr-pressville-post-grid__list--loading"
                                 data-columns-count="3">

								<?php
								$terms  = get_the_terms( $post->ID, 'lsvr_listing_cat' );
								$cat_add_id = $terms[0]->slug;
								$cat_add_name = $terms[0]->name;

								$posts = get_posts( array(
									'numberposts'      => 10,
									'post_type'        => 'lsvr_listing',
									'lsvr_listing_cat' => $cat_add_id,
									'orderby' => 'rand',
									'suppress_filters' => true,
									'exclude'          => $GLOBALS['post']->ID,
								) );


								foreach ( $posts as $post ) {
									setup_postdata( $post ); ?>

                                    <div class="lsvr-grid__col lsvr-grid__col--span-4 lsvr-grid__col--md-span-6 lsvr-grid__col--sm-span-6 lsvr-pressville-post-grid__item">
                                        <article
                                                class="lsvr-pressville-post-grid__post post-45 post type-post status-publish format-standard has-post-thumbnail hentry category-bez-rubriki"
                                                style="background-image: url('<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>');">
                                            <div class="lsvr-pressville-post-grid__post-inner">
                                                <div class="lsvr-pressville-post-grid__post-bg">
                                                    <div class="lsvr-pressville-post-grid__post-content">


                                                        <h3 class="lsvr-pressville-post-grid__post-title">
                                                            <a href="<?php the_permalink() ?>"
                                                               class="lsvr-pressville-post-grid__post-title-link"
                                                               rel="bookmark"><?php the_title() ?></a>
                                                        </h3>
                                                        <p class="lsvr-pressville-post-grid__post-meta">

                                                            <span class="lsvr-pressville-post-grid__post-meta-categories"
                                                                  role="group">
                                                        <p class="lsvr-pressville-post-grid__post-address"><?php lsvr_pressville_the_listing_address(get_the_ID());?></p>

                                                        </span>
                                                        </p>
                                                    </div>

                                                    <!--категория в голубом цвете-->
                                                    <p class="lsvr-pressville-post-grid__post-badge"
                                                       title="Категория">
<span class="lsvr-pressville-post-grid__post-badge-categories">

<!--    <span class="post__categories">-->
    <!--в <a href="--><?php //echo home_url('directory-category/'.$cat_add_id) ?><!--" class="post__category-link"-->
    <!--     tabindex="0">--><?php //echo $cat_add_name ?><!--</a> </span>-->


    <span class="post__categories">
в <a href="<?php echo get_term_link($cat_add_id, 'lsvr_listing_cat'); ?>" class="post__category-link"
     tabindex="0"><?php echo $cat_add_name ?></a> </span>


</span>
                                                    </p>

                                                </div>
                                            </div>
                                        </article>
                                    </div>

								<?php }

								wp_reset_postdata() ?>

                            </div>

                            <button type="button"
                                    class="c-arrow-button lsvr-pressville-post-grid__list-button lsvr-pressville-post-grid__list-button--prev"
                                    aria-hidden="true" title="Previous">
                                                <span class="c-arrow-button__icon c-arrow-button__icon--left"
                                                      aria-hidden="true"></span>
                            </button>

                            <button type="button"
                                    class="c-arrow-button lsvr-pressville-post-grid__list-button lsvr-pressville-post-grid__list-button--next"
                                    aria-hidden="true" title="Next">
                                                <span class="c-arrow-button__icon c-arrow-button__icon--right"
                                                      aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!--кнопка внизу страницы блога-->
            <div class="lsvr-pressville-post-grid__more lsvr-pressville-post-grid__more-left btn-blog-link">
                <a href="/directory/"
                   class="c-button lsvr-pressville-post-grid__more-link">Все организации</a>
            </div>

        </section>
        <!--Конец виджета похожих организаций-->


	<?php endwhile; endif; ?>



</div>

<!-- POST SINGLE : end -->

<?php // Main end
get_template_part( 'template-parts/main-end' ); ?>



<?php get_footer(); ?>