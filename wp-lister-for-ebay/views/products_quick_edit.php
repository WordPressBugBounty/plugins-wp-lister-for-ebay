<fieldset class="inline-edit-col-left">
    <h4>WP-Lister for eBay</h4>
	<div id="wplister-fields" class="inline-edit-col" style="">

        <label class="">
            <input type="checkbox" value="yes" name="revise_listing" />
            <?php _e( 'Revise on update', 'wp-lister-for-ebay' ); ?>
        </label>
    </div>
    <?php if ( ! isset( $is_bulk_edit ) || ! $is_bulk_edit ) : ?>
    <div class="inline-edit-col" style="">
        <label>
            <span class="title"><?php _e( 'eBay Price', 'wp-lister-for-ebay' ); ?></span>
            <span class="input-text-wrap">
                <input type="text" name="_ebay_start_price" id="ebay_start_price" class="text ebay_start_price wc_input_price" value="">
            </span>
        </label>
    </div>
    <?php endif; ?>

</fieldset>