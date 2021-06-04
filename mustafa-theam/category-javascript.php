<?php get_header(); ?>

<div class="emptyTopArea"></div>

<div class="container home-page">
    <div class="row">
        <div class="text-center category-information">
            <h1 class="catergory-title"><?php single_cat_title() ?></h1>
            <div class="category-description"><?php echo category_description() ?></div>
            <div class="category-stats">
                <span>This is a spicial page</span>
            </div>
        </div>
        <?php
            if (have_posts()) {
                while (have_posts()) {
                    the_post(); ?>
                    <div class="col-sm-6">
                        <div class="main-post single-post">
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
                            <?php the_post_thumbnail('', ['class' => 'img-responsive img-thumbnail', 'title' => 'Post Image']); ?>
                            <div class="post-content">
                                <!-- <?php the_content('Continue Reading...'); ?> -->
                                <?php the_excerpt(); ?>
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
                    </div>
                    <?php
                } // end while loop
            } // end if conditional

            echo '<div class="clearfix"></div>'; // fix float clear

            /*

            echo '<div class="post-pagination ">';

                if (get_previous_posts_link()) {
                    previous_posts_link('<i class="fas fa-chevron-left"></i> New Articles');
                } else {
                    echo '<span class="previous-span">New Articles</span>';
                }

                if (get_next_posts_link()) {
                    next_posts_link('Old Articles <i class="fas fa-chevron-right"></i> '); 
                } else {
                    echo '<span class="next-span">Old Articles</span>';
                }
                
            echo '</div>';

            */
        ?>

        <div class="numbering-pagination">
            <div class="pagination">
                <?php  echo numbering_pagination(); ?>
            </div>
        </div>

    </div>
</div>

<?php get_footer(); ?>