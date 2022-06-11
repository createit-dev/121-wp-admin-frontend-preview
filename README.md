# How to: Preview Shortcodes in WP Admin?
### Preview how shortcode is rendering on frontend without leaving your admin area
Wordpress plugin, that will add option to preview rendering of shortcodes, while being in wp-admin. Plugin is using template_include hook and iframe is displayed in custom admin page.

Plugin is simple but has awesome name: “Ultimate shortcode previewer”! 

Currently our list contains 5 shortcodes that are built-in inside Wordpress Core. It's worth to mention that also shortcodes defined in plugins or themes will work. You can extend this list and add any shortcode you like. Here is current list:
* audio player
* image with caption
* embed from youtube
* gallery list from media library
* video player for mp4 file

Most important part of the plugin is action “template_include”, which is intercepting server request for page "/ctpreview", returning status header 200 (success response) and loading our custom PHP template, example url: /ctpreview?shortcodepreview=2

![](https://github.com/createit-dev/121-wp-admin-frontend-preview/blob/master/ct-wp-admin-frontend-preview/images/shortcode-preview-in-admin-area.gif)



