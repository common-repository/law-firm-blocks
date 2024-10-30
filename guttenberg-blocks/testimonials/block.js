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
    registerBlockType('wplawfirm/testimonials-block', {

      title: 'Testimonials Slider',
      description: 'Display testimonials in slider',
      icon: 'testimonial',
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
          default: "Testimonials"
        },
        'number': {
          type: 'number',
          default: '10'
        },
      },
      edit: (props) => {


        return [

          el("div", { className: props.className },
            el("h3", { className: 'block-title' }, 'Tesimonials Slider Section'),
            el(TextControl, {
              label: 'Section Title',
              value: props.attributes.title,
              onChange: (value) => {
                props.setAttributes({ title: value });
              }
            }),
            el(TextControl, {
              label: 'Number of post',
              value: props.attributes.number,
              placeholder: 'Number Of Post',
              onChange: (value) => {
                props.setAttributes({ number: value });
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

jQuery(document).ready(function ($) {
  //Owl Carousel

  $('.testimonials-slider').owlCarousel({
    autoplay: true,
    loop: true,
    smartSpeed: 1500,
    items: 1,
    lazyLoad: true,
    dots: false,
    nav: true,
    margin: 20
    
  });

});    