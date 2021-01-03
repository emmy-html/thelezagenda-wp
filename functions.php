<?php
add_action( 'after_setup_theme', 'dykeagenda_setup' );
function dykeagenda_setup() {
load_theme_textdomain( 'dykeagenda', get_template_directory() . '/languages' );
add_theme_support( 'title-tag' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'html5', array( 'search-form' ) );
global $content_width;
if ( ! isset( $content_width ) ) { $content_width = 1920; }
register_nav_menus( array( 'main-menu' => esc_html__( 'Main Menu', 'dykeagenda' ) ) );
}
add_action( 'wp_enqueue_scripts', 'dykeagenda_load_scripts' );
function dykeagenda_load_scripts() {
wp_enqueue_style( 'dykeagenda-style', get_stylesheet_uri() );
wp_enqueue_script( 'jquery' );
}
add_action( 'wp_footer', 'dykeagenda_footer_scripts' );
function dykeagenda_footer_scripts() {
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
add_filter( 'document_title_separator', 'dykeagenda_document_title_separator' );
function dykeagenda_document_title_separator( $sep ) {
$sep = '|';
return $sep;
}
add_filter( 'the_title', 'dykeagenda_title' );
function dykeagenda_title( $title ) {
if ( $title == '' ) {
return '...';
} else {
return $title;
}
}
add_filter( 'the_content_more_link', 'dykeagenda_read_more_link' );
function dykeagenda_read_more_link() {
if ( ! is_admin() ) {
return ' <a href="' . esc_url( get_permalink() ) . '" class="more-link">...</a>';
}
}
add_filter( 'excerpt_more', 'dykeagenda_excerpt_read_more_link' );
function dykeagenda_excerpt_read_more_link( $more ) {
if ( ! is_admin() ) {
global $post;
return ' <a href="' . esc_url( get_permalink( $post->ID ) ) . '" class="more-link">...</a>';
}
}
add_filter( 'intermediate_image_sizes_advanced', 'dykeagenda_image_insert_override' );
function dykeagenda_image_insert_override( $sizes ) {
unset( $sizes['medium_large'] );
return $sizes;
}
add_action( 'widgets_init', 'dykeagenda_widgets_init' );
function dykeagenda_widgets_init() {
register_sidebar( array(
'name' => esc_html__( 'Sidebar Widget Area', 'dykeagenda' ),
'id' => 'primary-widget-area',
'before_widget' => '<div class="sidebar-section">',
'after_widget' => '</div>',
'before_title' => '<h2>',
'after_title' => '</h2>',
) );
}
add_action( 'wp_head', 'dykeagenda_pingback_header' );
function dykeagenda_pingback_header() {
if ( is_singular() && pings_open() ) {
printf( '<link rel="pingback" href="%s" />' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
}
}
add_action( 'comment_form_before', 'dykeagenda_enqueue_comment_reply_script' );
function dykeagenda_enqueue_comment_reply_script() {
if ( get_option( 'thread_comments' ) ) {
wp_enqueue_script( 'comment-reply' );
}
}
function dykeagenda_custom_pings( $comment ) {
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php
}
add_filter( 'get_comments_number', 'dykeagenda_comment_count', 0 );
function dykeagenda_comment_count( $count ) {
if ( ! is_admin() ) {
global $id;
$get_comments = get_comments( 'status=approve&post_id=' . $id );
$comments_by_type = separate_comments( $get_comments );
return count( $comments_by_type['comment'] );
} else {
return $count;
}
}