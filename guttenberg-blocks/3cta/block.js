(function (blocks, blockEditor, components, i18n, element) {
    var __ = i18n.__
    var el = element.createElement
    var registerBlockType = blocks.registerBlockType
    var RichText = blockEditor.RichText
    var BlockControls = blockEditor.BlockControls
    var MediaUpload = blockEditor.MediaUpload

    const catExists = !!(wp.blocks.getCategories().find(cat => cat.slug === 'wp_law_firm_custom_blocks'));

    if (catExists) {
        registerBlockType('wplawfirm/three-cta-block', { // The name of our block. Must be a string with prefix. Example: my-plugin/my-custom-block.
            title: __('3 CTA'), // The title of our block.
            description: __('A custom block for displaying three-cta content.'), // The description of our block.
            icon: 'chart-bar', // Dashicon icon for our block. Custom icons can be added using inline SVGs.
            category: 'wp_law_firm_custom_blocks', // The category of the block.
            supports: {
                // align: true,
                // alignWide: true
            },
            example: {
                attributes: {
                    preview: true
                }
            },
            attributes: { // Necessary for saving block content.
                mediaID1: {
                    type: 'number'
                },
                mediaID2: {
                    type: 'number'
                },
                mediaID3: {
                    type: 'number'
                },
                mediaURL1: {
                    type: 'string'
                },
                mediaURL2: {
                    type: 'string'
                },
                mediaURL3: {
                    type: 'string'
                },
                title1: {
                    type: 'string',
                    default: 'Title 1 here'
                },
                title2: {
                    type: 'string',
                    default: 'Title 2 here'
                },
                title3: {
                    type: 'string',
                    default: 'Title 3 here'
                },
                content1: {
                    type: 'string',
                    default: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the'
                },
                content2: {
                    type: 'string',
                    default: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the'
                },
                content3: {
                    type: 'string',
                    default: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the'
                },
                link1: {
                    type: 'string',
                    default: '#'
                },
                link2: {
                    type: 'string',
                    default: '#'
                },
                link3: {
                    type: 'string',
                    default: '#'
                }
            },

            edit: function (props) {
                var attributes = props.attributes

                var onSelectImage1 = function (media) {
                    return props.setAttributes({
                        mediaURL1: media.url,
                        mediaID1: media.id
                    })
                }
                var onSelectImage2 = function (media) {
                    return props.setAttributes({
                        mediaURL2: media.url,
                        mediaID2: media.id
                    })
                }
                var onSelectImage3 = function (media) {
                    return props.setAttributes({
                        mediaURL3: media.url,
                        mediaID3: media.id
                    })
                }

                return [
                    el(BlockControls, { key: 'controls' }, // Display controls when the block is clicked on.
                        el('div', { className: 'components-toolbar' },
                            el(MediaUpload, {
                                onSelect: onSelectImage1,
                                type: 'image',
                                render: function (obj) {
                                    return el(components.Button, {
                                        className: 'components-icon-button components-toolbar__control',
                                        onClick: obj.open
                                    },
                                        // Add Dashicon for media upload button.
                                        el('svg', { className: 'dashicon dashicons-edit', width: '20', height: '20' },
                                            el('path', { d: 'M2.25 1h15.5c.69 0 1.25.56 1.25 1.25v15.5c0 .69-.56 1.25-1.25 1.25H2.25C1.56 19 1 18.44 1 17.75V2.25C1 1.56 1.56 1 2.25 1zM17 17V3H3v14h14zM10 6c0-1.1-.9-2-2-2s-2 .9-2 2 .9 2 2 2 2-.9 2-2zm3 5s0-6 3-6v10c0 .55-.45 1-1 1H5c-.55 0-1-.45-1-1V8c2 0 3 4 3 4s1-3 3-3 3 2 3 2z' })
                                        ))
                                }
                            }),
                            el(MediaUpload, {
                                onSelect: onSelectImage2,
                                type: 'image',
                                render: function (obj) {
                                    return el(components.Button, {
                                        className: 'components-icon-button components-toolbar__control',
                                        onClick: obj.open
                                    },
                                        // Add Dashicon for media upload button.
                                        el('svg', { className: 'dashicon dashicons-edit', width: '20', height: '20' },
                                            el('path', { d: 'M2.25 1h15.5c.69 0 1.25.56 1.25 1.25v15.5c0 .69-.56 1.25-1.25 1.25H2.25C1.56 19 1 18.44 1 17.75V2.25C1 1.56 1.56 1 2.25 1zM17 17V3H3v14h14zM10 6c0-1.1-.9-2-2-2s-2 .9-2 2 .9 2 2 2 2-.9 2-2zm3 5s0-6 3-6v10c0 .55-.45 1-1 1H5c-.55 0-1-.45-1-1V8c2 0 3 4 3 4s1-3 3-3 3 2 3 2z' })
                                        ))
                                }
                            }),
                            el(MediaUpload, {
                                onSelect: onSelectImage3,
                                type: 'image',
                                render: function (obj) {
                                    return el(components.Button, {
                                        className: 'components-icon-button components-toolbar__control',
                                        onClick: obj.open
                                    },
                                        // Add Dashicon for media upload button.
                                        el('svg', { className: 'dashicon dashicons-edit', width: '20', height: '20' },
                                            el('path', { d: 'M2.25 1h15.5c.69 0 1.25.56 1.25 1.25v15.5c0 .69-.56 1.25-1.25 1.25H2.25C1.56 19 1 18.44 1 17.75V2.25C1 1.56 1.56 1 2.25 1zM17 17V3H3v14h14zM10 6c0-1.1-.9-2-2-2s-2 .9-2 2 .9 2 2 2 2-.9 2-2zm3 5s0-6 3-6v10c0 .55-.45 1-1 1H5c-.55 0-1-.45-1-1V8c2 0 3 4 3 4s1-3 3-3 3 2 3 2z' })
                                        ))
                                }
                            })
                        )
                    ),
                    el('div', { className: props.className },
                        el("h3", { className: 'block-title' }, '3 CTA Section'),
                        el('div', {},
                            el('div', { className: 'wp-law-firm-three-cta-content', style: {} },
                                el(MediaUpload, {
                                    onSelect: onSelectImage1,
                                    type: 'image',
                                    value: attributes.mediaID1,
                                    render: function (obj) {
                                        return el(components.Button, {
                                            className: attributes.mediaID1 ? 'image-button' : 'button button-large',
                                            onClick: obj.open
                                        },
                                            !attributes.mediaURL1 ? __('Upload Image') : el('img', { src: attributes.mediaURL1 })
                                        )
                                    }
                                }),
                                el(RichText, {
                                    key: 'editable',
                                    tagName: 'h3',
                                    placeholder: 'Write a title...',
                                    keepPlaceholderOnFocus: true,
                                    value: attributes.title1,
                                    onChange: function (newTitle1) {
                                        props.setAttributes({ title1: newTitle1 })
                                    }
                                }),
                                el(RichText, {
                                    className: 'three-cta-content',
                                    // key: 'editable',
                                    tagName: 'p',
                                    placeholder: __('Write a content...'),
                                    keepPlaceholderOnFocus: true,
                                    value: attributes.content1,
                                    onChange: function (newContent1) {
                                        props.setAttributes({ content1: newContent1 })
                                    }
                                }),
                                el(RichText, {
                                    className: 'three-cta-link',
                                    // key: 'editable',
                                    tagName: 'p',
                                    placeholder: __('Insert a link...'),
                                    keepPlaceholderOnFocus: true,
                                    value: attributes.link1,
                                    onChange: function (newLink1) {
                                        props.setAttributes({ link1: newLink1 })
                                    }
                                })
                            ),
                            el('div', { className: 'wp-law-firm-three-cta-content', style: {} },
                                el(MediaUpload, {
                                    onSelect: onSelectImage2,
                                    type: 'image',
                                    value: attributes.mediaID2,
                                    render: function (obj) {
                                        return el(components.Button, {
                                            className: attributes.mediaID2 ? 'image-button' : 'button button-large',
                                            onClick: obj.open
                                        },
                                            !attributes.mediaURL2 ? __('Upload Image') : el('img', { src: attributes.mediaURL2 })
                                        )
                                    }
                                }),
                                el(RichText, {
                                    key: 'editable',
                                    tagName: 'h3',
                                    placeholder: 'Write a title...',
                                    keepPlaceholderOnFocus: true,
                                    value: attributes.title2,
                                    onChange: function (newTitle2) {
                                        props.setAttributes({ title2: newTitle2 })
                                    }
                                }),
                                el(RichText, {
                                    className: 'three-cta-content',
                                    // key: 'editable',
                                    tagName: 'p',
                                    placeholder: __('Write a content...'),
                                    keepPlaceholderOnFocus: true,
                                    value: attributes.content2,
                                    onChange: function (newContent2) {
                                        props.setAttributes({ content2: newContent2 })
                                    }
                                }),
                                el(RichText, {
                                    className: 'three-cta-link',
                                    // key: 'editable',
                                    tagName: 'p',
                                    placeholder: __('Insert a link...'),
                                    keepPlaceholderOnFocus: true,
                                    value: attributes.link2,
                                    onChange: function (newLink2) {
                                        props.setAttributes({ link2: newLink2 })
                                    }
                                })
                            ),
                            el('div', { className: 'wp-law-firm-three-cta-content', style: {} },
                                el(MediaUpload, {
                                    onSelect: onSelectImage3,
                                    type: 'image',
                                    value: attributes.mediaID3,
                                    render: function (obj) {
                                        return el(components.Button, {
                                            className: attributes.mediaID3 ? 'image-button' : 'button button-large',
                                            onClick: obj.open
                                        },
                                            !attributes.mediaURL3 ? __('Upload Image') : el('img', { src: attributes.mediaURL3 })
                                        )
                                    }
                                }),
                                el(RichText, {
                                    key: 'editable',
                                    tagName: 'h3',
                                    placeholder: 'Write a title...',
                                    keepPlaceholderOnFocus: true,
                                    value: attributes.title3,
                                    onChange: function (newTitle3) {
                                        props.setAttributes({ title3: newTitle3 })
                                    }
                                }),
                                el(RichText, {
                                    className: 'three-cta-content',
                                    // key: 'editable',
                                    tagName: 'p',
                                    placeholder: __('Write a content...'),
                                    keepPlaceholderOnFocus: true,
                                    value: attributes.content3,
                                    onChange: function (newContent3) {
                                        props.setAttributes({ content3: newContent3 })
                                    }
                                }),
                                el(RichText, {
                                    className: 'three-cta-link',
                                    // key: 'editable',
                                    tagName: 'p',
                                    placeholder: __('Insert a link...'),
                                    keepPlaceholderOnFocus: true,
                                    value: attributes.link3,
                                    onChange: function (newLink3) {
                                        props.setAttributes({ link3: newLink3 })
                                    }
                                })
                            ),
                        ),
                    )
                ]
            },

            save: function () {
                /** this is resolved server side */
                return null
            }
        })
    }
})(
    window.wp.blocks,
    window.wp.blockEditor,
    window.wp.components,
    window.wp.i18n,
    window.wp.element
)