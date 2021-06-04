<?php get_header(); ?>

<div class="emptyTopArea"></div>

<div class="container home-page linux-category">
    <div class="row">
        <div class="text-center category-information">
            <h1 class="catergory-title"><?php single_cat_title() ?></h1>
            <div class="category-description"><?php echo category_description() ?></div>
            <div class="category-stats">
                <span>Post Counts: 20</span> |
                <span>Comments Count: 100</span>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-9">
            <?php
                if (have_posts()) {
                    while (have_posts()) {
                        the_post(); ?>
                        <div class="main-post single-post">
                            <div class="row">
                                <div class="col-md-6">
                                    <?php the_post_thumbnail('', ['class' => 'img-responsive img-thumbnail', 'title' => 'Post Image']); ?>
                                </div>
                                <div class="col-md-6 category-post-content">
                                    <h3 class="post-title">
                                        <a class="title" href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                    <span class="post-auther">
                                        <i class="fas fa-user fa-fw icone"></i>
                                        <?php the_author_posts_link(); ?> <span class="pipe">|</span>
                                    </span>
                                    <span class="post-date">
                                        <i class="fa fa-calendar fa-fw icone"></i>
                                        <?php the_time('F j, Y'); ?> <span class="pipe">|</span>
                                    </span> 
                                    <span class="post-comments">
                                        <i class="fa fa-comments-o fa-fw icone"></i> 
                                        <?php comments_popup_link( 'No Comments »', '1 Comment »', '% Comments »', 'comment-url', 'Comment Disabled' ); ?>
                                    </span>
                                    <div class="post-content">
                                        <!-- <?php the_content('Continue Reading...'); ?> -->
                                        <?php the_excerpt(); ?>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <p class="post-categories">
                                <i class="fa fa-tags fa-fw"></i>
                                <?php the_category( ', ' ); ?>
                            </p>
                            <p class="post-tags">
                                <?php
                                    if (has_tag()) {
                                        the_tags();
                                    } else {
                                        echo 'Tags: There is no tags in this post';
                                    }
                                ?>
                            </p>
                        </div>
                        <?php
                    } // end while loop
                } // end if conditional

            ?>

        </div>   <!-- end the col div -->

        <!-- sidebar -->
        <div class="col-md-3">
            <div class="linux-sidebar">
                <?php
                    get_sidebar('linux');
                    // if (is_active_sidebar('main-sidebar')) {
                    //     dynamic_sidebar('main-sidebar');
                    // }
                ?>
            </div>
        </div>

        <div class="numbering-pagination">
            <div class="pagination">
                <?php  echo numbering_pagination(); ?>
            </div>
        </div>

    </div>
</div>

<?php get_footer(); ?>