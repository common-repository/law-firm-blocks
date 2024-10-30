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

  const catExists = !!(wp.blocks.getCategories().find(cat => cat.slug === 'wp_law_firm_custom_blocks'));

  if (catExists) {
    registerBlockType('wplawfirm/blog-block', {

      title: 'Blog',
      description: 'For displaying blog',
      icon: 'welcome-write-blog',
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
          default: "Our New Blog"
        },
        'url': {
          type: 'string',
          default: "#"
        },
      },
      edit: (props) => {

           
        return [

          el("div", { className: props.className },
            el("h3", { className: 'block-title' }, 'Blog Section'),
            el(TextControl, {
              label: 'Section Title',
              value: props.attributes.title,
              onChange: (value) => {
                props.setAttributes({ title: value });
              }
            }),
            el(TextControl, {
              label: 'Url',
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

