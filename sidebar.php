<aside class="sidebar">
    <div class="content-wrapper">
        <div class="sidebar-section">
            <?php if ( is_active_sidebar( 'primary-widget-area' ) ) : ?>
            <?php dynamic_sidebar( 'primary-widget-area' ); ?>
        </div>
    </div>
    <?php endif; ?>
</aside>