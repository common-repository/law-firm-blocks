(function (blocks, blockEditor, components, i18n, element) {
  const el = element.createElement;

  const { registerBlockType } = blocks;

  const { RichText, InspectorControls, MediaUpload } = blockEditor;
  const { Fragment } = element;
  const {
    TextControl,
    CheckboxControl,
    RadioControl,
    SelectControl,
    TextareaControl,
    ToggleControl,
    RangeControl,
    Panel,
    PanelBody,
    PanelRow
  } = components;

  const catExists = !!(wp.blocks.getCategories().find(cat => cat.slug === 'wp_law_firm_custom_blocks'));

  if (catExists) {
    registerBlockType('wplawfirm/banner-block', {

      title: 'Banner',
      description: 'For displaying banner',
      icon: 'format-image',
      category: 'wp_law_firm_custom_blocks',
      supports: {
        align: true,
        alignWide: true,
        multiple: true
      },
      example: {
        attributes: {
          'preview': true,
        },
      },
      attributes: {
        imageID: {
          type: 'number'
        },
        image: {
          type: 'string',
        },
        form_title: {
          type: 'string',
          default: "Get your free legal consultation with a friendly lawyer!"
        },
        cf7_form_id: {
          type: 'string',
        },
      },
      edit: (props) => {

        var onSelectImage = function (media) {
          return props.setAttributes({
            image: media.url,
            imageID: media.id
          })
        }

        return [

          el("div", { className: props.className },
            el("h3", { className: 'block-title' }, 'Banner Section'),
            el(MediaUpload, {
              onSelect: onSelectImage,
              type: 'image',
              value: props.attributes.imageID,
              render: function (obj) {
                return el(components.Button, {
                  className: props.attributes.imageID ? 'image-button' : 'button button-large',
                  onClick: obj.open
                },
                  !props.attributes.image ? 'Upload Image' : el('img', { src: props.attributes.image })
                )
              }
            }),
            el(TextControl, {
              label: 'Form Title',
              value: props.attributes.form_title,
              onChange: (value) => {
                props.setAttributes({ form_title: value });
              }
            }),
            el(TextControl, {
              label: 'CF7 Form ID (This form will only work if the Contact Form 7 plugin is activated!)',
              value: props.attributes.cf7_form_id,
              placeholder: 'Add CF7 form ID here.',
              onChange: (value) => {
                props.setAttributes({ cf7_form_id: value });
              }
            }),
          )
        ]
      },

      save: () => {
        /** this is resolved server side */
        return null
      }
    });
  }
})(
  window.wp.blocks,
  window.wp.blockEditor,
  window.wp.components,
  window.wp.i18n,
  window.wp.element
)