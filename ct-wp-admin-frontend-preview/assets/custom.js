(function($) {

    $(".js-select-preview").change(function(){
        const $select = $(this);
        const val = $select.val();

        $("#iframe-preview").each(function(){
            const $this = $(this);
            const _src = $this.attr("src");
            const iframe_src = _src.replace(/(shortcodepreview=)[^\&]+/, '$1' + val);
            $this.attr("src", iframe_src);
            $("#iframe-url pre").text(iframe_src);
        });
    });

})( jQuery );