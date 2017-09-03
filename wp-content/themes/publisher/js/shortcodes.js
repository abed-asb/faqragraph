jQuery(document).ready(function ($) {

    var media = wp.media, shortcode_string = 'bsShortcodes';
    wp.mce    = wp.mce || {};

    wp.mce.bsShortcodes = {

        shortcode_data: {},
        template: media.template('editor-boutique-banner'),

        getContent: function () {
            var options          = this.shortcode.attrs.named;
            options.innercontent = this.shortcode.content;

            return this.template(options);
        },

        View: { // before WP 4.2:
            template: media.template('editor-boutique-banner'),
            postID: $('#post_ID').val(),
            initialize: function (options) {
                this.shortcode                     = options.shortcode;
                wp.mce.bsShortcodes.shortcode_data = this.shortcode;
            },
            getHtml: function () {
                var options          = this.shortcode.attrs.named;
                options.innercontent = this.shortcode.content;
                return this.template(options);
            }
        },

        edit: function (data) {
            var shortcode_data  = wp.shortcode.next(shortcode_string, data);
            var values          = shortcode_data.shortcode.attrs.named;
            values.innercontent = shortcode_data.shortcode.content;
            wp.mce.bsShortcodes.popupwindow(tinyMCE.activeEditor, values);
        },

        // this is called from our tinymce plugin, also can call from our "edit" function above
        // wp.mce.bsShortcodes.popupwindow(tinyMCE.activeEditor, "bird");
        popupwindow: function (editor, values, onsubmit_callback) {
            values = values || [];
            if (typeof onsubmit_callback !== 'function') {
                onsubmit_callback = function (e) {

                    // Insert content when the window form is submitted (this also replaces during edit, handy!)
                    var args = {
                        tag: shortcode_string,
                        type: 'closed',//e.data.innercontent.length ? 'closed' : 'single',
                        content: '--SHORTCODE-CONTAINER--',//e.data.innercontent,
                        attrs: {
                            title: 'x',//e.data.title,
                            link: 'y',//e.data.link,
                            linkhref: 'z',//e.data.linkhref
                        }
                    };

                    //                      //replace('--SHORTCODE-CONTAINER--', wp.shortcode.string(args))

                    console.group('debug');
                    console.log(wp.shortcode.string(args));
                    console.groupEnd();

                    editor.insertContent(wp.shortcode.string(args).toString());


                };
            }

            editor.windowManager.open({
                title: 'Banner',
                body: [
                    {
                        type: 'textbox',
                        name: 'title',
                        label: 'Title',
                        value: values.title
                    },
                    {
                        type: 'textbox',
                        name: 'link',
                        label: 'Button Text',
                        value: values.link
                    },
                    {
                        type: 'textbox',
                        subtype: 'url',
                        name: 'linkhref',
                        label: 'Button URL',
                        value: values.linkhref
                    },
                    {
                        type: 'textbox',
                        name: 'innercontent',
                        label: 'Content',
                        value: values.innercontent
                    }
                ],
                onsubmit: onsubmit_callback
            });
        }
    };

    //wp.mce.views.register( shortcode_string, _.extend( {}, wp.mce.bsShortcodes, {
    //    state: [ 'playlist-edit', 'video-playlist-edit' ]
    //} )  );

    wp.mce.views.register(shortcode_string, wp.mce.bsShortcodes);
});
