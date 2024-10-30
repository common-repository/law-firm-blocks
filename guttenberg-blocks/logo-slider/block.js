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
    registerBlockType('wplawfirm/logo-slider-block', {

      title: 'Logo Slider',
      description: 'For displaying logo slider',
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
        items: [
          {
            index: {
              type: 'number',
              source: 'attribute',
              attribute: 'data-index'
            },
            mediaID: {
              type: 'number'
            },
            mediaURL: {
              type: 'string',
            },
            link: {
              type: 'string',
            },
          }
        ]
      },

      edit: function (props) {

        var attributes = props.attributes;
        var items = attributes.items || [];

        var itemList = items.sort(function (a, b) {
          return a.index - b.index;
        }).map(function (item) {
          var onSelectImage = function (media) {
            var newObject = Object.assign({}, item, {
              mediaURL: media.url,
              mediaID: media.id
            });
            return props.setAttributes({
              items: [].concat(_cloneArray(props.attributes.items.filter(function (itemFilter) {
                return itemFilter.index != item.index;
              })), [newObject])
            });
          }
          return el('div', { className: 'item', id: item.index },
            el(MediaUpload, {
              onSelect: onSelectImage,
              type: 'image',
              value: item.mediaID,
              autoFocus: true,
              render: function (obj) {
                return el(components.Button, {
                  className: item.mediaID ? 'image-button' : 'button button-large',
                  onClick: obj.open
                },
                  !item.mediaID ? ('Upload Image') : el('img', { src: item.mediaURL })
                )
              }
            }),
            el(TextControl, {
              className: '',
              // key: 'editable',
              tagName: 'p',
              placeholder: 'Insert a link...',
              keepPlaceholderOnFocus: true,
              value: item.link,
              onChange: function (newLink) {
                var newObject = Object.assign({}, item, {
                  link: newLink,
                });
                return props.setAttributes({
                  items: [].concat(_cloneArray(props.attributes.items.filter(function (itemFilter) {
                    return itemFilter.index != item.index;
                  })), [newObject])
                });
              }
            }),
            el(components.Button, {
              className: 'button remove-row',
              onClick: function () {
                var newItems = items.filter(_item => item.index != _item.index).map((_item, index) => ({ ..._item, index: index }));
                return props.setAttributes({
                  items: newItems
                });
              }
            },
              'X'
            )
          )
        });
        function _cloneArray(arr) {
          if (Array.isArray(arr)) {
            for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) {
              arr2[i] = arr[i];
            }
            return arr2;
          } else {
            return Array.from(arr);
          }
        }
        return el('div', { className: props.className },
          el("h3", { className: 'block-title' }, 'Logo Slider Section'),
          el('div', { className: 'item-list' },
            itemList,
          ),
          el(components.Button, {
            className: 'button add-row',
            onClick: function () {
              return props.setAttributes({

                items: [].concat(_cloneArray(props.attributes.items || []), [{
                  index: props.attributes.items ? props.attributes.items.length : 0,
                  mediaURL: '',
                  mediaID: '',
                  link: '',
                }])

              });

            }
          },
            'Add Row'
          )
        );
      },

      save: function (props) {
        // var attributes = props.attributes;
        // if (attributes.items && attributes.items.length > 0) {

        //   var itemList = attributes.items.map(function (item) {
        //     return el('div', { className: 'item', 'data-index': item.index },
        //       el('a', { href: item.link, target: '_blank', rel: 'noopener noreferrer' },
        //         el('img', { src: item.mediaURL, alt: 'Logo Image' })
        //       )
        //     );
        //   });

        //   return el('section', { className: 'partner-slider' },
        //     el('div', { className: 'llf-container' },
        //       el('div', { className: 'carousel-wrap' },
        //         el('div', { className: 'owl-carousel logo-slider' },
        //           itemList
        //         )
        //       )
        //     )
        //   );

        // } else {
        //   return null;
        // }

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

 

  $('.logo-slider').owlCarousel({
    autoplay: true,
    loop: true,
    smartSpeed: 1500,
    items: 4,
    lazyLoad: true,
    dots: false,
    nav: false,
    margin: 20,
    responsive: {
      1024: {
        items: 4
      },
      992: {
        items: 3
      },
      576: {
        items: 2
      },
      0: {
        items: 1
      }
    }
  });

 

});    