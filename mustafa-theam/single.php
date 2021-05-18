<?php get_header(); ?>

<div class="emptyTopArea"></div>

<div class="container post-page">
    <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post(); ?>
                    <!-- <?php edit_post_link('Edit') ?> -->
                    <div class="main-post single-post">
                        <h3 class="post-title">
                            <a class="title" href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h3>
                        <span class="post-date">
                            <i class="fa fa-calendar fa-fw icone"></i>
                             <?php the_time('F j, Y'); ?> <!-- <span class="pipe">|</span> -->
                        </span> 
                        <!-- <span class="post-comments">
                            <i class="fa fa-comments-o fa-fw icone"></i> 
                            <?php comments_popup_link( 'No Comments »', '1 Comment »', '% Comments »', 'comment-url', 'Comment Disabled' ); ?>
                        </span> -->
                        <?php the_post_thumbnail('', ['class' => 'img-responsive img-thumbnail', 'title' => 'Post Image']); ?>
                        <div class="post-content">
                            <?php the_content('Continue Reading...'); ?>
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

        // <p>
        // <?php ; 
        // </p>

        echo '<div class="clearfix"></div>'; // fix float clear

        $avatar_arguments = array(
            'class' => 'img-responsive img-thumbnail center-block'
        );

    ?>
    <div class="row">
        <div class="col-md-2">
            <?php
                echo get_avatar(get_the_author_meta('ID'), 128, '', 'User Avatar', $avatar_arguments);
            ?>
        </div>
        <div class="col-md-10 author-info">
            <h4>
                <?php the_author_meta('first_name'); ?>
                <?php the_author_meta('last_name'); ?>
                <span>(<?php echo the_author_posts_link(); ?>)</span>
            </h4>
            <?php
                if (the_author_meta('description')) { ?>
                    <p class="author-description"><?php get_the_author_meta('description'); ?></p> 
                <?php } else { 
                    echo 'There is no Biographical Info!';
                }
            ?> 
        </div>
        <hr>
        <p class="author-stats">
            <i class="fas fa-user-tag"></i> Number Of Posts Created By User: <span class="posts-count"><?php echo count_user_posts(get_the_author_meta('ID')) ?></span> <br>
            <i class="fas fa-home"></i> Visit User Profile Page  <span class="author-link"><?php echo the_author_posts_link(); ?></span>
        </p>
    </div>
    <?php
        echo '<div class="post-pagination ">';

            if (get_next_post_link()) {
                next_post_link('%link', '<i class="fas fa-chevron-left"></i>Next Article: %title'); 
            } else {
                echo '<span class="next-span">Next Article: None</span>';
            }

            if (get_previous_post_link()) {
                previous_post_link('%link', 'Previous Article: %title<i class="fas fa-chevron-right"></i>');
            } else {
                echo '<span class="previous-span">Previous Article: None</span>';
            }
        
        echo '</div>';

        echo '<hr class="comments-separator">';

        comments_template();

    ?>
</div>

<div class="emptyBottomArea"></div>

<?php get_footer(); ?>