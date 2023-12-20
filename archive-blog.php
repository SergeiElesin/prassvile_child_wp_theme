<?php
/*
 Template name: Все посты блога
 Template Post Type: page
  */
?>

<?php get_header(); ?>

<?php // Breadcrumbs
get_template_part( 'template-parts/breadcrumbs' ); ?>

<!-- COLUMNS : begin -->
<div id="columns">
    <div class="columns__inner">
        <div class="lsvr-container">
            <div class="lsvr-grid">
                <div class="columns__main lsvr-grid__col lsvr-grid__col--span-8">

<!--                    <div class="lsvr-grid">-->
<!--                        <div class="lsvr-grid__col lsvr-grid__col--xlg-span-8 lsvr-grid__col--xlg-push-2">-->

                            <!-- MAIN : begin -->
                            <main id="main">
                                <div class="main__inner">
                                    <!-- POST ARCHIVE : begin -->
                                    <div class="post-archive blog-post-archive blog-post-archive--default">
										<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                                            <!-- MAIN HEADER : begin -->
                                            <header class="main__header">

                                                <h1 class="main__title">
													<?php the_title() ?>
                                                </h1>


                                            </header>

										<?php endwhile; endif; ?>

                                        <!-- MAIN HEADER : end -->


										<?php
										$args = array(
											'paged'            => ( get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1 ),
											'post_type'        => 'blog',
											'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
										);
										query_posts( $args );
										while ( have_posts() ) {
										the_post();
										?>

                                        <!-- POST : begin -->
                                        <article
                                                class="post-45 post type-post status-publish format-standard has-post-thumbnail hentry category-bez-rubriki">
                                            <div class="post__inner">

                                                <!-- POST THUMBNAIL : begin -->
                                                <p class="post__thumbnail">
                                                    <a href="<?php the_permalink() ?>" class="post__thumbnail-link">
														<?php the_post_thumbnail(); ?>        </a>
                                                </p>
                                                <!-- POST THUMBNAIL : end -->

                                                <!-- POST HEADER : begin -->
                                                <header class="post__header">

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

                                                    </p>
                                                    <!-- POST META : end -->

                                                    <!-- POST TITLE : begin -->
                                                    <h2 class="post__title">
                                                        <a href="<?php the_permalink() ?>" class="post__title-link"
                                                           rel="bookmark"><?php the_title() ?></a>
                                                    </h2>
                                                    <!-- POST TITLE : end -->

                                                </header>
                                                <!-- POST HEADER : end -->

                                                <!-- POST CONTENT : begin -->
                                                <div class="post__content">

                                                    <p><?php the_excerpt(); ?> </p>

                                                </div>
                                                <!-- POST CONTENT : end -->

                                            </div>
                                        </article>
                                        <!-- POST : end -->

											<?php
										}
										?>

	                                    <?php the_posts_pagination(); ?>

                                    </div>
                                    <!-- POST ARCHIVE : end -->


									<?php wp_reset_query(); ?>

                                </div>
                            </main>
                            <!-- MAIN : end -->


                        </div>

                <!--                            боковая панель-->
                <div class="columns__sidebar columns__sidebar--right lsvr-grid__col lsvr-grid__col--span-4">

		            <?php // Sidebar
		            get_sidebar(); ?>

                </div>
                <!-- конец боковой панели -->

                    </div>
                </div>


    </div>
</div>
<!-- COLUMNS : end -->


<?php get_footer(); ?>
