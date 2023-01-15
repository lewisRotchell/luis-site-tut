<?php

function up_cuisine_add_form_fields()
{
?>

<div class="form-field">
    <label><?php _e('More Info URL', 'udemy-plus') ?></label>
    <input type="text" id="cuisine-image-id" name="up_more_info_url">
    <p><?php _e('The URL for more info about this cuisine', 'udemy-plus') ?></p>
</div>

<?php
}