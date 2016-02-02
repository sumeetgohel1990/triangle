<?php
/**
 * The Template for displaying all single posts
 *
 *
 * @package  WordPress
 * @subpackage  Timber
 */
?>
<div class="col-md-3 col-sm-5">
    <div class="sidebar blog-sidebar">
        <?php if (comments_open()): ?>
            <div class="sidebar-item  recent">
                <h3>Comments</h3>
                <?php
                $args = array(
                    'number' => '5',
                    'offset' => '',
                    'orderby' => '',
                    'order' => 'DESC',
                    'parent' => '',
                    'post_author__in' => '',
                    'post_author__not_in' => '',
                    'post_ID' => '', // ignored (use post_id instead)
                    'post_id' => 0,
                    'post__in' => '',
                    'post__not_in' => '',
                    'post_author' => '',
                    'post_name' => '',
                    'post_parent' => '',
                    'post_status' => '',
                    'post_type' => '',
                    'status' => 'approve',
                    'type' => '',
                    'type__in' => '',
                    'type__not_in' => '',
                    'user_id' => '',
                    'search' => '',
                    'count' => false,
                    'meta_key' => '',
                    'meta_value' => '',
                    'meta_query' => '',
                    'date_query' => null, // See WP_Date_Query
                );
                $comments = get_comments($args);
                foreach ($comments as $comment) :
                    $get_img_src = get_template_directory_uri() . '/images/no_image.png';
                    if (has_post_thumbnail($comment->comment_post_ID)):
                        $get_img_src = wp_get_attachment_url(get_post_thumbnail_id($comment->comment_post_ID));
                    endif;
                    $d = "l, F jS, Y";
                    $comment_date = get_comment_date($d, $comment->comment_ID);
                    ?>
                    <div class="media">
                        <div class="pull-left">
                            <a href="<?php echo get_permalink($comment->comment_post_ID); ?>"><img src="<?php echo $get_img_src; ?>" alt="<?php echo get_the_title($comment->comment_post_ID); ?>"></a>
                        </div>
                        <div class="media-body">
                            <h4><a href="<?php echo get_permalink($comment->comment_post_ID); ?>"><?php $comment->comment_content; ?></a></h4>
                            <p>posted on  <?php echo $comment_date; ?> by <?php echo $comment->comment_author; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <?php
        $get_all_cat = get_categories();
        if (count($get_all_cat) > 0) {
            ?>
            <div class="sidebar-item categories">
                <h3>Categories</h3>
                <ul class="nav navbar-stacked">
                    <?php
                    foreach (get_categories() as $category) {
                        $category_link = get_category_link($category->term_id);
                        ?>
                        <li><a href="<?php echo esc_url($category_link); ?>"><?php echo $category->cat_name; ?><span class="pull-right">(<?php echo $category->count; ?>)</span></a></li>
                    <?php } ?>
                </ul>
            </div>
        <?php }
        ?>
        <!-- tag cloud -->
        <?php
        $get_all_tag = get_tags();
        if (count($get_all_tag) > 0) {
            ?>
            <div class="sidebar-item tag-cloud">
                <h3>Tag Cloud</h3>
                <ul class="nav nav-pills">
                    <?php
                    foreach (get_tags() as $tag) {
                        $tag_link = get_term_link($tag->term_id);
                        ?>
                        <li><a href="<?php echo esc_url($tag_link); ?>"><?php echo $tag->name; ?><span class="pull-right">(<?php echo $tag->count; ?>)</span></a></li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>
    </div>
</div>