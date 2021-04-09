<?php
add_action( 'after_setup_theme', 'lezagenda_setup' );
function lezagenda_setup() {
load_theme_textdomain( 'lezagenda', get_template_directory() . '/languages' );
add_theme_support( 'title-tag' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'html5', array( 'search-form' ) );
global $content_width;
if ( ! isset( $content_width ) ) { $content_width = 1920; }
register_nav_menus( array( 'main-menu' => esc_html__( 'Main Menu', 'lezagenda' ) ) );
}
add_action( 'wp_enqueue_scripts', 'lezagenda_load_scripts' );
function lezagenda_load_scripts() {
wp_enqueue_style( 'lezagenda-style', get_stylesheet_uri() );
wp_enqueue_script( 'jquery' );
wp_enqueue_script( 'script', get_template_directory_uri() . '/js/main.js');
}
add_action( 'wp_footer', 'lezagenda_footer_scripts' );
function lezagenda_footer_scripts() {
?>
<script>
jQuery(document).ready(function ($) {
var deviceAgent = navigator.userAgent.toLowerCase();
if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
$("html").addClass("ios");
$("html").addClass("mobile");
}
if (navigator.userAgent.search("MSIE") >= 0) {
$("html").addClass("ie");
}
else if (navigator.userAgent.search("Chrome") >= 0) {
$("html").addClass("chrome");
}
else if (navigator.userAgent.search("Firefox") >= 0) {
$("html").addClass("firefox");
}
else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
$("html").addClass("safari");
}
else if (navigator.userAgent.search("Opera") >= 0) {
$("html").addClass("opera");
}
});
</script>
<?php
}
add_filter( 'document_title_separator', 'lezagenda_document_title_separator' );
function lezagenda_document_title_separator( $sep ) {
$sep = '|';
return $sep;
}
add_filter( 'the_title', 'lezagenda_title' );
function lezagenda_title( $title ) {
if ( $title == '' ) {
return '...';
} else {
return $title;
}
}
add_filter( 'the_content_more_link', 'lezagenda_read_more_link' );
function lezagenda_read_more_link() {
if ( ! is_admin() ) {
return ' <a href="' . esc_url( get_permalink() ) . '" class="more-link">Read More &#8250;</a>';
}
}
add_filter( 'excerpt_more', 'lezagenda_excerpt_read_more_link' );
function lezagenda_excerpt_read_more_link( $more ) {
if ( ! is_admin() ) {
global $post;
return ' <a href="' . esc_url( get_permalink( $post->ID ) ) . '" class="more-link">...</a>';
}
}
add_filter( 'intermediate_image_sizes_advanced', 'lezagenda_image_insert_override' );
function lezagenda_image_insert_override( $sizes ) {
unset( $sizes['medium_large'] );
return $sizes;
}
add_action( 'widgets_init', 'lezagenda_widgets_init' );
function lezagenda_widgets_init() {
register_sidebar( array(
'name' => esc_html__( 'Sidebar Widget Area', 'lezagenda' ),
'id' => 'primary-widget-area',
'before_widget' => '<div class="sidebar-section">',
'after_widget' => '</div>',
'before_title' => '<h2>',
'after_title' => '</h2>',
) );
}
add_action( 'wp_head', 'lezagenda_pingback_header' );
function lezagenda_pingback_header() {
if ( is_singular() && pings_open() ) {
printf( '<link rel="pingback" href="%s" />' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
}
}
add_action( 'comment_form_before', 'lezagenda_enqueue_comment_reply_script' );
function lezagenda_enqueue_comment_reply_script() {
if ( get_option( 'thread_comments' ) ) {
wp_enqueue_script( 'comment-reply' );
}
}
function lezagenda_custom_pings( $comment ) {
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php
}
add_filter( 'get_comments_number', 'lezagenda_comment_count', 0 );
function lezagenda_comment_count( $count ) {
if ( ! is_admin() ) {
global $id;
$get_comments = get_comments( 'status=approve&post_id=' . $id );
$comments_by_type = separate_comments( $get_comments );
return count( $comments_by_type['comment'] );
} else {
return $count;
}
}
function wpb_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
    }
    add_filter( 'comment_form_fields', 'wpb_move_comment_field_to_bottom'); 