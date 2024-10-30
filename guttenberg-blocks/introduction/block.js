(function (blocks, blockEditor, components, i18n, element) {
    var __ = i18n.__
    var el = element.createElement
    const { registerBlockType } = blocks;
    var RichText = blockEditor.RichText
    var BlockControls = blockEditor.BlockControls
    var MediaUpload = blockEditor.MediaUpload

    const catExists = !!(wp.blocks.getCategories().find(cat => cat.slug === 'wp_law_firm_custom_blocks'));

    if (catExists) {
        registerBlockType('wplawfirm/introduction-block', { // The name of our block. Must be a string with prefix. Example: my-plugin/my-custom-block.
            title: __('Introduction'), // The title of our block.
            description: __('A custom block for displaying introduction content.'), // The description of our block.
            icon: 'businessman', // Dashicon icon for our block. Custom icons can be added using inline SVGs.
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
                title: {
                    type: 'string',
                    default: 'Write the title here'
                },
                content: {
                    type: 'string',
                    default: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec in magna et felis laoreet tincidunt vel bibendum metus. Praesent eget laoreet purus. Curabitur rhoncus mattis lacus id sollicitudin. Aliquam efficitur vel orci et auctor. Praesent posuere sem odio, quis ultricies augue hendrerit in. Mauris venenatis laoreet pretium. Mauris magna libero, fringilla id tortor at, rhoncus venenatis velit. Fusce efficitur massa nec urna suscipit molestie. Sed eget nisi quam.'
                },
                
                url:{
                    type: 'string',
                   default: '<a href="#">Page link </a>'
                },
                
                mediaID: {
                    type: 'number'
                },
                mediaURL: {
                    type: 'string'
                },             
            },     
            edit: function (props) {       
                var attributes = props.attributes 
                var onSelectImage = function (media) {
                    return props.setAttributes({
                        mediaURL: media.url,
                        mediaID: media.id
                    })
                }    
                return [
                    el(BlockControls, { key: 'controls' }, // Display controls when the block is clicked on.
                        el('div', { className: 'components-toolbar' },
                            el(MediaUpload, {
                                onSelect: onSelectImage,
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
                        el("h3", { className: 'block-title' }, 'Introduction Section'),
                        el('div', {},
                            el('div', { className: 'wp-law-firm-introduction-content', style: {} },
                                el(RichText, {
                                    key: 'editable',
                                    tagName: 'h2',
                                    placeholder: __('Write a title...'),
                                    keepPlaceholderOnFocus: true,
                                    value: attributes.title,
                                    onChange: function (newTitle) {
                                        props.setAttributes({ title: newTitle })
                                    }
                                }),      
                                el(RichText, {
                                    className: 'introduction-content',
                                    // key: 'editable',
                                    tagName: 'p',
                                    placeholder: __('Write a content...'),
                                    keepPlaceholderOnFocus: true,
                                    value: attributes.content,
                                    onChange: function (newContent) {
                                        props.setAttributes({ content: newContent })
                                    }
                                }), 
                                
                                el(RichText, {
                                   className: 'introduction-conte',
                                    // key: 'editable',
                                    tagName: 'a',
                                    // // type:'url',
                                    // placeholder: __('Write a link ...'),
                                    keepPlaceholderOnFocus: true,
                                    value: attributes.url,
                                    onChange: function (newUrl) {
                                        console.log(newUrl);
                                        props.setAttributes({ url: newUrl })
                                    } 
                                }) 
                            ),   
                            el('div', {
                                className: attributes.mediaID ? 'wp-law-firm-introduction-image image-active' : 'wp-law-firm-introduction-image image-inactive',
                                // style: attributes.mediaID ? { backgroundImage: 'url(' + attributes.mediaURL + ')' } : {}
                            },
                                el(MediaUpload, {
                                    onSelect: onSelectImage,
                                    type: 'image',
                                    value: attributes.mediaID,
                                    render: function (obj) {
                                        return el(components.Button, {
                                            className: attributes.mediaID ? 'image-button' : 'button button-large',
                                            onClick: obj.open
                                        },
                                            !attributes.mediaURL ? __('Upload Image') : el('img', { src: attributes.mediaURL })
                                        )
                                    }
                                })
                            ),
                        )
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