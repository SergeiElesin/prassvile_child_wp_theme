<?php get_header(); ?>


<?php // Breadcrumbs
get_template_part( 'template-parts/breadcrumbs' ); ?>

    <!-- COLUMNS : begin -->
    <div id="columns">
    <div class="columns__inner">
        <div class="lsvr-container">

            <!-- MAIN : begin -->
            <main id="main">
                <div class="main__inner">

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

                </div>
            </main>
            <!-- MAIN : end -->

        </div>
    </div>
    </div>
    <!-- COLUMNS : end -->

<?php get_footer(); ?>