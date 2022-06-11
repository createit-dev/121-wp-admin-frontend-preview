<?php
// ct-wp-admin-frontend-preview/views/view1.php
/** @var string $iframe_url */
/** @var string $shortcode_index */
/** @var array $shortcodes */
?>

<div class="row justify-content-md-center" style="min-height:700px;">
    <div class="col-md-auto col-md-12 postbox-wrapper">
        <div class="postbox">
            <div class="inside">
                <div class="main">
                    <h5>Ultimate shortcode previewer!</h5>
                    <p>Check how shortcode is rendering on frontend without leaving your admin area</p>
                    <label for="select1">Shortcodes</label>
                    <select class="form-control form-control--w100 mt-2 js-select-preview" id="select1">
                        <?php foreach ($shortcodes as $key => $item): ?>
                            <option value="<?php echo $key; ?>"><?php echo ($key !== 0) ? ($key .'. ') : ''; ?><?php echo $item; ?></option>
                        <?php endforeach; ?>
                    </select>

                </div>
            </div>
        </div>

        <h5>Preview inside frontend iframe:</h5>
        <div id="iframe-url" class="mt-2 mb-2"><pre></pre></div>

        <?php if($iframe_url): ?>
            <div class="ct-loader is-disabled">
                <iframe src="<?php echo $iframe_url; ?>" style="background-image: url('<?php echo ct_admin_url('images/loader-1.gif') ?>')" frameBorder="0" id="iframe-preview"></iframe>
            </div>
        <?php endif; ?>


    </div>
</div>
<!-- / row -->