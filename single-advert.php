<?php get_header(); ?>

    <div id="columns">
        <div class="columns__inner">
            <div class="lsvr-container">
                <div class="lsvr-grid">
                    <div class="columns__main lsvr-grid__col lsvr-grid__col--span-8">

                        <main id="main">
                            <div class="main__inner">

                                <!-- POST SINGLE : begin -->
                                <div class="post-single blog-post-single">

									<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                                        <!-- POST : begin -->
                                        <article <?php post_class(); ?>>
                                            <div class="post__inner">

                                                <!-- POST HEADER : begin -->
                                                <header class="post__header">

                                                    <!-- POST TITLE : begin -->
                                                    <h1 class="post__title is-main-headline"><?php the_title(); ?></h1>
                                                    <!-- POST TITLE : end -->

                                                    <!-- Кнопки социальных сетей -->
	                                                <?php echo do_shortcode('[mashshare]'); ?>

                                                    <!-- POST : end -->

													<?php // Post meta
													get_template_part( 'template-parts/single-post-meta' ); ?>

                                                </header>
                                                <!-- POST HEADER : end -->

												<?php // Add custom code before thumbnail
												do_action( 'lsvr_pressville_blog_single_thumbnail_before' ); ?>

												<?php // Thumbnail
												if ( has_post_thumbnail() && true === apply_filters( 'lsvr_pressville_post_single_thumbnail_enable', true ) ) : ?>

                                                    <p class="post__thumbnail">
														<?php the_post_thumbnail( apply_filters( 'lsvr_pressville_post_single_thumbnail_size', 'full' ) ); ?>
                                                    </p>

												<?php endif; ?>

												<?php // Add custom code before content
												do_action( 'lsvr_pressville_blog_single_content_before' ); ?>

												<?php // Post content
												get_template_part( 'template-parts/single-post-content' ); ?>

												<?php // Add custom code before footer
												do_action( 'lsvr_pressville_blog_single_footer_before' ); ?>

												<?php // Post footer
												get_template_part( 'template-parts/single-post-footer' ); ?>

												<?php // Add custom code at post bottom
												do_action( 'lsvr_pressville_blog_single_bottom' ); ?>

                                            </div>

                                        </article>
                                        <!-- POST : end -->

									<?php endwhile; endif; ?>

                                </div>
                                <!-- POST SINGLE : end -->

                            </div>
                        </main>
                    </div>

                    <!--                            "Боковая панель - объявления"-->
                    <div class="columns__sidebar columns__sidebar--right lsvr-grid__col lsvr-grid__col--span-4 pl">

						<?php // Sidebar
						dynamic_sidebar( 'lsvr-pressville-custom-sidebar-5' ); ?>

                    </div>
                    <!--                Конец  "Боковая панель - объявления"-->

                </div>

            </div>


        </div>
    </div>


<?php get_footer(); ?>