<?php
/*
 Template name: Мой блог
 Template Post Type: page
  */
?>
<?php get_header(); ?>

<?php // Breadcrumbs
get_template_part( 'template-parts/breadcrumbs' ); ?>

<!-- COLUMNS : begin -->
<div id="columns">
    <div class="columns__inner">


        <!-- MAIN : begin -->
        <main id="main" class="main--fullwidth">
            <div class="main__inner">

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                    <!--     ////////////////////////////////////////////////////////////////////-->
                    <!-- MAIN HEADER : begin -->
                    <header class="page__header">
                        <!--                            <h1 class="page__title is-main-headline">-->
                        <!--								-->
                        <!--                            </h1>-->
                    </header>
                    <!-- MAIN HEADER : end -->

                    <div class="page__content">

                        <section
                                class="lsvr-pressville-post-grid lsvr-pressville-post-grid--posts lsvr-pressville-post-grid--layout-title-top lsvr-pressville-post-grid--has-slider lsvr-pressville-post-grid--dark-bg"
                        >
                            <div class="lsvr-pressville-post-grid__inner">
                                <div class="lsvr-container">
                                    <div class="lsvr-pressville-post-grid__content">
                                        <header class="lsvr-pressville-post-grid__header">
                                            <h2 class="lsvr-pressville-post-grid__title"><?php the_title(); ?></h2>
                                            <p class="lsvr-pressville-post-grid__subtitle">Читайте последние
                                                записи</p>
                                            <p class="lsvr-pressville-post-grid__more lsvr-pressville-post-grid__more--top">
                                                <a href="https://narva-online.ee/"
                                                   class="c-button lsvr-pressville-post-grid__more-link">Другие
                                                    записи</a>
                                            </p>
                                            <i class="icon-post lsvr-pressville-post-grid__icon"
                                               aria-hidden="true"></i>
                                        </header>

                                        <div class="lsvr-pressville-post-grid__list-wrapper">
                                            <div class="lsvr-grid lsvr-grid--3-cols lsvr-grid--md-2-cols lsvr-grid--sm-2-cols lsvr-pressville-post-grid__list lsvr-pressville-post-grid__list--5-items lsvr-pressville-post-grid--slider lsvr-pressville-post-grid__list--loading"
                                                 data-columns-count="3">

												<?php
												$posts = get_posts( array(
													'numberposts'      => 10,
													'post_type'        => 'blog',
													'suppress_filters' => true
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
                                                                            <span class="lsvr-pressville-post-grid__post-meta-date"
                                                                                  role="group"><?php echo get_the_date() ?></span>
                                                                            <span class="lsvr-pressville-post-grid__post-meta-categories"
                                                                                  role="group">
<!--			<span class="post__categories">-->
<!--				в <a href="https://narva-online.ee/category/bez-rubriki/"-->
<!--                     class="post__category-link">--><?php //the_terms( get_the_ID(), 'themes', ' ', '&nbsp;,&nbsp;', ' ' ); ?><!--</a>			</span>-->

                 <span class="post__categories">
				в <?php the_terms( get_the_ID(), 'themes', ' ', '&nbsp;,&nbsp;', ' ' ); ?>		</span>

		</span>
                                                                        </p>
                                                                    </div>
                                                                    <a href="<?php the_permalink() ?>"
                                                                       class="lsvr-pressville-post-grid__post-overlay-link">
                                                                        <span class="screen-reader-text">Читать все
                                    записи</span>
                                                                    </a>
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
                                <a href="https://narva-online.ee/my-blog/allposts/"
                                   class="c-button lsvr-pressville-post-grid__more-link">Читать все
                                    записи</a>
                            </div>

                        </section>

                    </div>


				<?php endwhile; endif; ?>


            </div>


        </main>
        <!-- MAIN : end -->

        <!--кнопка со ссылкой на все посты-->


    </div>
</div>
<!-- COLUMNS : end -->

<?php get_footer(); ?>

