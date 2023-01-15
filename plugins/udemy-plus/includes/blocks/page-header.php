<?php

function up_search_page_header_render_cb($attributes)
{
    //esc_html is a function that strips html characters
    $heading = esc_html($attributes['content']);



    if ($attributes['showCategory']) {
        $heading = get_the_archive_title();
    }
    //ob means output buffer
    ob_start();
?>
<div class="wp-block-udemy-plus-page-header">
    <div class="inner-page-header">
        <h1><?php echo $heading; ?></h1>
    </div>
</div>

<?php

    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}