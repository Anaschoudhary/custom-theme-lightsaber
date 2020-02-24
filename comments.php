<?php

/**
 * @package LightSaberTheme
 * =======================
 * comments.php
 * =======================
 * 
 */

if (post_password_required()) {
    return;
}

?>

<div id="comments" class="comments-area">

    <?php if (have_comments()) :
        //we have comment
    ?>

        <h2 class="comment-title">
            <?php
            printf(
                esc_html(_nx(
                    'One comment on &ldquo;%2$s&rdquo;',
                    '%1$s comments on &ldquo;%2$s&rdquo;',
                    get_comments_number(),
                    'comments title',
                    'LightSaberTheme'
                )),
                number_format_i18n(get_comments_number()),
                '<span>' . get_the_title() . '</span>'
            );
            ?>
        </h2>

        <?php ls_comment_navigation(); ?>

        <ol class="comment-list">
            <?php

            $args = array(
                'walker'        => null,
                'max_depth'    => '',
                'style'        => 'ol',
                'callback'     => null,
                'end-callback' => null,
                'type'         => 'all',
                'reply_text'   => 'Reply',
                'page'         => '',
                'per_page'     => '',
                'avatar_size'  => 32,
                'reverse_top_level' => null,
                'reverse_children' => '',
                'format'            => 'html5',
                'short_ping'   => false,
                'echo'         => true
            );

            wp_list_comments($args); ?>

        </ol>

        <?php ls_comment_navigation(); ?>

        <?php if (!comments_open() && get_comments_number()) : ?>

            <p class="no-comments"><?php esc_html_e('Comments are Closed', 'lightsabertheme'); ?></p>

        <?php endif; ?>

    <?php endif; ?>

    <?php
    $fields = array(
        'author' =>
        '<div class="form-group"><label for="author">' . __('Name', 'domainreference') . '</label><span class="required">*</span>
      <input id="author" name="author" class="form-control" type="text" value="' . esc_attr($commenter['comment_author']) . '" 
      required="required" /></div>',
        'email' =>
        '<div class="form-group"><label for="email">' . __('Email', 'domainreference') . '<span class="required">*</span></label> 
      <input id="email" name="email" class="form-control" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" aria-describedby="email-notes" required="required"/></div>',

        'url' =>
        '<div class="form-group last-field"><label for="url">' . __('Website', 'domainreference') . '</label>
            <input id="url" name="url" class="form-control" type="url" value="' . esc_attr($commenter['comment_author_url']) . '" /></div>'
    );

    $args = array(
        'class_submit' => 'btn btn-block btn-lg btn-warning',
        'label_submit' => __('Submit Comment'),
        'comment_field' =>
        '<div class="form-group"><label for="comment">' . __('Comment', 'domainreference') . '<span class="required">*</span>    </label>
        <textarea id="comment" name="comment" class="form-control" type="text" required="required">' . esc_attr($commenter['comment_author_url']) . '</textarea></div>',
        'fields' => apply_filters('comment_form_default_fields', $fields)
    );

    comment_form($args); ?>

</div>
<!--.comments-area -->