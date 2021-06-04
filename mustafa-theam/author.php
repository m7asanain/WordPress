<?php get_header(); ?>

    <div class="container author-page">
        <h1 class="profile-header ">
            <?php echo the_author_posts_link(); ?> Page
        </h1>
        <div class="aurhor-main-info">
            <div class="row">
                <div class="col-md-3">
                    <?php
                        $avatar_arguments = array(
                            'class' => 'img-responsive img-thumbnail center-block'
                        );
                        // img margin might not work.
                        echo get_avatar(get_the_author_meta('ID'), 196, '', 'User Avatar', $avatar_arguments);
                    ?>
                    <!-- </div> -->
                </div>
                <div class="col-md-9">
                    <ul class="list-unstyled">
                        <li>First Name: <?php the_author_meta('first_name'); ?></li>
                        <li>Last Name: <?php the_author_meta('last_name'); ?></li>
                        <li>Nickname: <?php echo the_author_posts_link(); ?></li>
                    </ul>
                    <hr>
                    <?php
                        if (the_author_meta('description')) { ?>
                            <p class="author-description"><?php get_the_author_meta('description'); ?></p> 
                        <?php } else { 
                            echo 'There is no Biographical Info!';
                        }
                    ?> 
                </div> 
            </div>
        </div>
        <div class="row author-stats">
            <div class="col-md-3">
                <div class="stats">
                    Post Count
                    <span><?php echo count_user_posts(get_the_author_meta('ID')) ?></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats">
                    Comments Count
                    <span>
                        <?php
                            $commentscount_arguments = array(
                                'user_id' => get_the_author_meta('ID'),
                                'count' => true,
                            );
                            echo get_comments($commentscount_arguments);
                        ?>
                    </span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats">
                    Total Post View
                    <span>0</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats">
                    Anything
                    <span>0</span>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="clearfix"></div>

            <?php

                $latest_author_post = 4;

                $author_posts_arguments = array(
                    'author' => get_the_author_meta('ID'),
                    'posts_per_page' => $latest_author_post
                );

                $author_posts = new WP_Query($author_posts_arguments);

                // $author_posts_number = ($author_posts > 4)  ?  $latest_author_post : echo "fer";

                if ($author_posts->have_posts()) { ?>
                    <h4 class="last-posts">
                        <?php if (count_user_posts(get_the_author_meta('ID')) >= $latest_author_post) { ?>
                            Latest <?php echo $latest_author_post ?> Posts <?php the_author_meta('nickname')?> has posted
                        <?php } else { ?>
                            Latest <?php the_author_meta('nickname') ?> Posts
                        <?php } ?>
                    </h4>
                    <?php
                    while ($author_posts-> have_posts()) {
                        $author_posts-> the_post(); ?>
                        <div class="author-posts">
                            <div class="row">
                                <div class="col-sm-2 author-img">
                                    <?php the_post_thumbnail('', ['class' => 'img-responsive img-thumbnail', 'title' => 'Post Image']); ?>
                                </div>
                                <div class="col-sm-10 author-details">
                                    <h3 class="post-title">
                                        <a class="title" href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
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
                        </div>
                        <div class="clearfix"></div>
                        <?php
                    }
                }
                wp_reset_postdata();

                // comments

                $latest_author_comments = 4;

                $author_comments_arguments = array(
                    'user_id'       => get_the_author_meta('ID'),
                    'status'        => 'approve',
                    'number'        => $latest_author_comments,
                    'post_status'   => 'publish',
                    'post_type'     => 'post'
                );

                $comments = get_comments($author_comments_arguments);

                if (get_comments($commentscount_arguments) >= $latest_author_comments) { ?>
                    <h4 class="last-comments">Latest <?php echo $latest_author_comments?> comments <?php echo the_author_posts_link() ?> has commented</h4>
                    <!-- echo ' ' . $latest_author_comments . ' '; -->
                <?php } else { ?>
                    <h4 class="last-comments">Latest comments <?php echo the_author_posts_link() ?> has commented</h4>
                <?php }

                if ($comments) {

                    foreach ($comments as $comment) { ?>

                        <div class="last-author-comments">
                            <a class="comments-links" href="<?php echo get_permalink($comment->comment_post_ID) ?>">
                                <?php echo get_the_title($comment->comment_post_ID); ?>
                            </a>
                            <br>
                            <div class="latest-author-comment-date">
                                <i class="fa fa-calendar fa-fw icone"></i>
                                <span>Commented on:</span>
                                <?php  echo '<span class=comment-date>' . get_comment_date( 'l jS \of F Y' ) . '</span>'; ?>
                            </div>
                            <p class="comment-simple"><?php echo $comment->comment_content; ?></p>
                        </div>
    
                    <?php }

                } else { ?>
                    <h4 class="last-comments"><?php echo the_author_posts_link(); ?> has comment on any post!</h4>
                <?php } 
            ?>
        </div> 
    </div>

<?php get_footer(); ?>
