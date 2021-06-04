<?php
    // Get category comments count

    $comments_args = array(
        'status'    => 'approve',   // only approved comments
    );

    $comments_count = 0;    // starts count from 0
    $all_comments = get_comments($comments_args);   // get all comments

    foreach ($all_comments as $comment) { // loop throw all comments
        $post_id = $comment->comment_post_ID;   // get post id fo comment

        if (! in_category('linux', $post_id)) {     // check if post is not in linux category
            continue;   // continue loop 
        }

        $comments_count++;  // counter
    }

    // Get category post count

    $cat = get_queried_object();    // get full object properties

    $posts_count = $cat->count;     // ger post count
    
?>

<div class="sidebar-linux">
    <!-- first widget -->
    <div class="widget">
        <div class="title-color-lable"></div>
        <h3 class="widget-title"><?php single_cat_title(); ?> Statistics</h3>
        <div class="widget-content">
            <ul>
                <!-- bug - there is unexpected number -->
                <li><span>Comments Count:</span> <?php echo $comments_count; ?></li>
                <li><span>Post Count:</span> <?php echo $posts_count; ?></li>
            </ul>
        </div>
    </div>
    <!-- secound widget -->
    <div class="widget">
        <h3 class="widget-title">Latest PHP Posts</h3>
        <div class="widget-content">
            <ul>
                <?php
                    $post_args = array(
                        'posts_per_page'    => 5,
                        'cat'               => 4,
                    );

                    $query = new WP_Query($post_args);

                    if ($query->have_posts()) {
                        while ($query->have_posts()) {
                           $query->the_post();

                           ?>

                            <li class="latest_posts_sidebar">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </li>

                           <?php
                        }
                        wp_reset_postdata();
                    }
                ?>
            </ul>
        </div>
    </div>
    <!-- third widget -->
    <div class="widget">
        <h3 class="widget-title">Trending topics</h3>
        <div class="widget-content">
            <?php
                $trending_post_args = array(
                    'posts_per_page'    => 1,
                    'orderby '          => 'comment_count',
                );

                $trending_query = new WP_Query($trending_post_args);

                if ($trending_query->have_posts()) {
                    while ($trending_query->have_posts()) {
                        $trending_query->the_post();

                        ?>

                        <div class="latest_posts_sidebar third-widget">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            <hr>
                        </div>

                        <?php
                    }
                    wp_reset_postdata();
                }
            ?>
        </div>
    </div>
</div>