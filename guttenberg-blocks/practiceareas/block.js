(function (blocks, blockEditor, components, i18n, element) {
  const el = element.createElement;

  const { registerBlockType } = blocks;

  const { RichText, InspectorControls } = blockEditor;
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

  const { ServerSideRender } = wp.components;

  const catExists = !!(wp.blocks.getCategories().find(cat => cat.slug === 'wp_law_firm_custom_blocks'));

  if (catExists) {
    /** Register the block */
    registerBlockType('wplawfirm/practice-areas-block', {
      title: 'Practice Areas',
      icon: 'book-alt',
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

        'title': {
          type: 'string',
          default: "Practice Areas"
        },

        'url': {
          type: 'string',
          default: "#"
        },
        'content': {
          type: 'string',
          default: '10'
        }
      },
      edit: (props) => {

        if (props.isSelected) {
          // do something...
          //console.debug(props.attributes);
        };
        var preview = props.attributes.preview
        if (preview) {
          return (
            el('img', { src: wppic.wppic_preview })
          );
        }
        return [
          /**
           * Server side render
           */
          el("div", { className: props.className },
            el("h3", { className: 'block-title' }, 'Practice Areas Section'),
            el(TextControl, {
              label: 'Section Title',
              value: props.attributes.title,
              onChange: (value) => {
                props.setAttributes({ title: value });
              }
            }),
            el(TextControl, {
              label: 'Number of post',
              value: props.attributes.content,
              placeholder: 'Number Of Post',
              onChange: (value) => {
                props.setAttributes({ content: value });
              }
            }),
            el(TextControl, {
              label: 'View all link',
              value: props.attributes.url,
              placeholder: 'Plase put the url here.',
              onChange: (value) => {
                props.setAttributes({ url: value });
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