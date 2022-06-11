<?php
$number = isset($_GET['shortcodepreview']) ? intval($_GET['shortcodepreview']) : 0;

if($number === 0){
    return '';
}

require($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
?>
<?php
get_header(); ?>
    <style>
        #wpadminbar {
            display: none !important;
        }
        #header {
            display: none !important;
        }
        #footer {
            display: none !important;
        }
        #page hr {
            display: none !important;
        }
        body {
            padding:0 30px;
        }

        .ct-preview-wrapper {
            max-width: 95%;
            margin: 20px auto;
        }

        .ct-preview-wrapper__title {
            text-align: center;
        }
        .form-control-textarea {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            min-height: 150px;
            text-align: left;
        }

        .gallery-columns-2 {
            display: flex;
            flex-direction: row;
        }
    </style>
<?php



$shortcodes_list = ct_preview_shortcodes_list();

$shortcode_to_render = $shortcodes_list[$number];


?>
    <div class="ct-preview-wrapper">
        <?php
        if ($shortcode_to_render) {
            echo do_shortcode($shortcode_to_render);

            if($number === 3){
                // embed
                global $wp_embed;
                echo $wp_embed->run_shortcode($shortcode_to_render);
            }

            echo '<br><label>Shortcode:</label>';
            echo '<br><textarea class="ct-preview-wrapper__title form-control-textarea">' . $shortcode_to_render . '</textarea></p><br>';
        }
        ?>
    </div>

<?php
get_footer();