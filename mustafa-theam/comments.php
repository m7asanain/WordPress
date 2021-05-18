<?php

    if (comments_open()) { ?>

        <h4 class="comments-count"><?php comments_number('There is no comments!', '1 Comment', '% Comments') ?></h4>

        <?php

        echo '<ul class="list-unstyled comments-list">';

            $comments_arguments = array(
                'max_depth'     => 3,
                'style'         => 'comment',
                'per_page'      => 20,  //4
                'avatar_size'   => 64   // not working
            );
            
            wp_list_comments($comments_arguments);

        echo '</ul>';

        echo '<hr class="comments-separator">';

        // $comment_author = 'Name';
        // $comment_email = 'E-Mail';
        // $comment_url = 'Website';
        // $comment_body = 'Comment';

        // $comments_args = array(
        //     'fields' => array(
        //         'author' => '<div class="form-group"><lable>Your Name * </lable><input class="form-control" id="author" name="author" aria-required="true"></input></div><br />',
        //         'email' => '<div class="form-group"><lable>Your Email * <span class="not-be-published">(Your email address will not be published.)</span></lable><input class="form-control" id="email" name="email"></input></div><br />',
        //         'url' => '<div class="form-group"><lable>Your Url <span class="not-be-published">(Your url address will not be published.)</span></lable><input class="form-control" id="url" name="url"></input></div><br />'
        //     ),
        //     'title_reply' => 'Add your comment',
        //     'comment_field' => '<div class="form-group"><label for="comment"> Comment:</label><textarea class="form-control" rows="5"></textarea></div>',
        //     'label_submit' => 'Post comment',
        //     'class_submit' => 'btn btn-secondary',
        //     'comment_notes_before' => '',
        //     'title_reply_to' => 'Reply to [%s]'

        // );  

        // comment_form($comments_args);

        comment_form();

    } else {
        echo 'Sorry comments are disabled!';
    }