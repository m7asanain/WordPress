<?php 

    get_header(); 
    include(get_template_directory() . '/includes/breadcrumb.php');

?>

<!-- <div class="emptyTopArea"></div> -->

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

        
        // get id                => global $post;   $post->ID . '<br>';
        // get post id           => get_queried_object_id()
        // get categorise id     => wp_get_post_categories( get_queried_object_id() )

        // error: comments complex in random posts

    ?>

        <h4 class="rendom-categorie-posts">Random posts from same categorie</h4>

    <?php


        $random_posts_arguments = array(
            'posts_per_page'        => 3,  // 5
            'orderby'               => 'rand',
            'category__in'          => wp_get_post_categories(get_queried_object_id()),
            'post__not_in'          => array(get_queried_object_id())
        );

        $random_posts = new WP_Query($random_posts_arguments);

        if ($random_posts->have_posts()) {
            while ($random_posts-> have_posts()) {
                $random_posts-> the_post(); ?>
                <div class="random-posts">
                    <h3 class="random-posts-title">
                        <a class="title" href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h3>
                    <hr>
                </div>
                <?php
            }
            wp_reset_postdata();
        } else {
            echo 'there is no related post in this categories';
        }

    ?>

    <hr>

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