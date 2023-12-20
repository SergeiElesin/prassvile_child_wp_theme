<?php
/*
 Template Name: Отдельный пост блога
 Template Post Type: blog
  */
?>

<?php get_header(); ?>

    <!--    <main id="main">-->
    <!--        <div class="main__inner">-->


<?php do_action( 'lsvr_pressville_breadcrumbs_before' ); ?>

<?php // Breadcrumbs
get_template_part( 'template-parts/breadcrumbs' ); ?>

<?php do_action( 'lsvr_pressville_breadcrumbs_after' ); ?>


    <div id="columns">
        <div class="columns__inner">
            <div class="lsvr-container">
                <div class="lsvr-grid">
                    <div class="columns__main lsvr-grid__col lsvr-grid__col--span-8">

                        <main id="main">
                            <div class="main__inner">
                                <!--                                <div class="lsvr-grid">-->
                                <!--                                    <div class="lsvr-grid__col lsvr-grid__col--xlg-span-8 lsvr-grid__col--xlg-push-2">-->

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


                                                    <!-- POST META : begin -->
                                                    <p class="post__meta">

                                                        <!-- POST DATE : begin -->
                                                        <span class="post__meta-item post__meta-item--date"
                                                              role="group">
				<?php echo get_the_date() ?>			</span>
                                                        <!-- POST DATE : end -->


                                                        <!-- POST CATEGORIES : begin -->
                                                        <span class="post__meta-item post__meta-item--category"
                                                              title="Категория">

					<span class="post__terms post__terms--category">
						в <a class="post__term-link"><?php the_terms( get_the_ID(), 'themes', ' ', '&nbsp;,&nbsp;', ' ' ); ?></a>					</span>

                                                        </span>
                                                        <!-- POST CATEGORIES : end -->


                                                        <!-- POST AUTHOR : begin -->
                                                        <span class="post__meta-item post__meta-item--author">
				<?php echo sprintf( esc_html__( 'by %s', 'pressville' ), '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" class="post__meta-item-link" rel="author">' . get_the_author() . '</a>' ); ?>
			</span>
                                                        <!-- POST AUTHOR : end -->

                                                    </p>
                                                    <!-- POST META : end -->


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

                                        <!-- POST NAVIGATION : begin -->
                                        <div class="post-navigation">

                                            <ul class="post-navigation__list">

												<?php if ( lsvr_pressville_has_previous_post() ) : ?>

                                                    <!-- PREVIOUS POST : begin -->
                                                    <li class="post-navigation__prev">
                                                        <div class="post-navigation__prev-inner">

                                                            <h2 class="post-navigation__title">
                                                                <a href="<?php echo esc_url( lsvr_pressville_get_previous_post_url() ); ?>"
                                                                   class="post-navigation__title-link">
																	<?php esc_html_e( 'Previous', 'pressville' ); ?>
                                                                </a>
                                                            </h2>

                                                            <a href="<?php echo esc_url( lsvr_pressville_get_previous_post_url() ); ?>"
                                                               class="post-navigation__link">
																<?php echo esc_html( lsvr_pressville_get_previous_post_title() ); ?>
                                                            </a>

                                                        </div>
                                                    </li>
                                                    <!-- PREVIOUS POST : end -->

												<?php endif; ?>

												<?php if ( lsvr_pressville_has_next_post() ) : ?>

                                                    <!-- NEXT POST : begin -->
                                                    <li class="post-navigation__next">
                                                        <div class="post-navigation__next-inner">

                                                            <h2 class="post-navigation__title">
                                                                <a href="<?php echo esc_url( lsvr_pressville_get_next_post_url() ); ?>"
                                                                   class="post-navigation__title-link">
																	<?php esc_html_e( 'Next', 'pressville' ); ?>
                                                                </a>
                                                            </h2>

                                                            <a href="<?php echo esc_url( lsvr_pressville_get_next_post_url() ); ?>"
                                                               class="post-navigation__link">
																<?php echo esc_html( lsvr_pressville_get_next_post_title() ); ?>
                                                            </a>

                                                        </div>
                                                    </li>
                                                    <!-- NEXT POST : end -->

												<?php endif; ?>

                                            </ul>

                                        </div>
                                        <!-- POST NAVIGATION : end -->

										<?php // Post comments
										comments_template(); ?>

									<?php endwhile; endif; ?>

                                </div>
                                <!-- POST SINGLE : end -->

                            </div>
                        </main>
                    </div>

                    <!--                            "Боковая панель - блог"-->
                    <div class="columns__sidebar columns__sidebar--right lsvr-grid__col lsvr-grid__col--span-4 pl">

						<?php // Sidebar
						dynamic_sidebar( 'lsvr-pressville-custom-sidebar-7' ); ?>

                    </div>
                    <!--                Конец  "Боковая панель - блог"-->

                </div>

            </div>


        </div>
    </div>


<?php get_footer(); ?>