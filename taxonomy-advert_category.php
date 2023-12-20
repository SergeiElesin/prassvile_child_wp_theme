<?php get_header(); ?>

<?php //// Directory map
//get_template_part( 'template-parts/lsvr_listing/archive-map' ); ?>

<?php // Breadcrumbs
get_template_part( 'template-parts/breadcrumbs' ); ?>

<?php // Main begin
get_template_part( 'template-parts/main-begin' ); ?>

<?php //// Archive
//get_template_part( 'template-parts/lsvr_listing/archive-layout', apply_filters( 'lsvr_pressville_listing_archive_layout', 'default' ) ); ?>


<div class="post-archive blog-post-archive blog-post-archive--grid">

	<?php // Main header
	get_template_part( 'template-parts/main-header' ); ?>

	<?php // Archive categories
	get_template_part( 'template-parts/archive-categories' ); ?>

	<?php // Archive category description
	get_template_part( 'template-parts/archive-category-description' ); ?>

	<?php if ( have_posts() ) : ?>

        <!-- POST ARCHIVE GRID : begin -->
        <div class="post-archive__grid">
            <div class="<?php lsvr_pressville_the_blog_post_archive_grid_class(); ?>">

				<?php
				global $wp_query;
				remove_filter( "the_content", "adverts_the_content" );
				echo shortcode_adverts_list( array(
					"category" => $wp_query->get_queried_object_id()
				) );
				?>

            </div>
        </div>
        <!-- POST ARCHIVE GRID : end -->

		<?php // Pagination
		the_posts_pagination(); ?>


	<?php else : ?>
		<?php lsvr_pressville_the_alert_message( esc_html__( 'No listings matched your criteria', 'pressville' ) ); ?>


	<?php endif; ?>

</div>

<!--начало файла main-end-->
</div>
</main>
<!-- MAIN : end -->

<?php if ( true === apply_filters( 'lsvr_pressville_narrow_content_enable', false ) ) : ?>

    </div>
    </div>

<?php endif; ?>

<?php if ( 'disable' !== apply_filters( 'lsvr_pressville_sidebar_position', 'right' ) ) : ?>

    </div>

	<?php if ( 'left' === apply_filters( 'lsvr_pressville_sidebar_position', 'right' ) ) : ?>

        <div class="columns__sidebar columns__sidebar--left lsvr-grid__col lsvr-grid__col--span-4 lsvr-grid__col--pull-8">

	<?php else : ?>

        <div class="columns__sidebar columns__sidebar--right lsvr-grid__col lsvr-grid__col--span-4 pl">

	<?php endif; ?>

    <!-- сайдбар по умолчанию	--><?php //// Sidebar
//	get_sidebar(); ?>


    <!--                            "Боковая панель - рубрика объявления"-->
	<?php // Sidebar
	dynamic_sidebar( 'lsvr-pressville-custom-sidebar-5' ); ?>
    <!--                Конец  "Боковая панель - рубрика объявления"-->


    </div>
    </div>

<?php endif; ?>

</div>
</div>
</div>

<?php get_footer(); ?>
