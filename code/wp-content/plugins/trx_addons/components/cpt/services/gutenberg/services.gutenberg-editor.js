(function(blocks, editor, i18n, element) {
	// Set up variables
	var el = element.createElement;

	// Register Block - Services
	blocks.registerBlockType(
		'trx-addons/services',
		trx_addons_apply_filters( 'trx_addons_gb_map', {
			title: i18n.__( 'Services' ),
			icon: 'hammer',
			category: 'trx-addons-cpt',
			attributes: trx_addons_apply_filters( 'trx_addons_gb_map_get_params', trx_addons_object_merge(
				{
					type: {
						type: 'string',
						default: 'default'
					},
					tabs_effect: {
						type: 'string',
						default: 'fade'
					},
					featured: {
						type: 'string',
						default: 'image'
					},
					featured_position: {
						type: 'string',
						default: 'top'
					},
					thumb_size: {
						type: 'string',
						default: ''
					},
					no_links: {
						type: 'boolean',
						default: false
					},
					more_text: {
						type: 'string',
						default: i18n.__( 'Read more' ),
					},
					pagination: {
						type: 'string',
						default: 'none'
					},
					hide_excerpt: {
						type: 'boolean',
						default: false
					},
					no_margin: {
						type: 'boolean',
						default: false
					},
					icons_animation: {
						type: 'boolean',
						default: false
					},
					hide_bg_image: {
						type: 'boolean',
						default: false
					},
					popup: {
						type: 'boolean',
						default: false
					},
					post_type: {
						type: 'string',
						default: TRX_ADDONS_STORAGE['gutenberg_sc_params']['CPT_SERVICES_PT']
					},
					taxonomy: {
						type: 'string',
						default: TRX_ADDONS_STORAGE['gutenberg_sc_params']['CPT_SERVICES_TAXONOMY']
					},
					cat: {
						type: 'string',
						default: '0'
					}
				},
				trx_addons_gutenberg_get_param_query(),
				trx_addons_gutenberg_get_param_slider(),
				trx_addons_gutenberg_get_param_title(),
				trx_addons_gutenberg_get_param_button(),
				trx_addons_gutenberg_get_param_id()
			), 'trx-addons/services' ),
			edit: function(props) {
				if ( ! TRX_ADDONS_STORAGE['gutenberg_sc_params']['taxonomies'][props.attributes.post_type].hasOwnProperty( props.attributes.taxonomy ) ) {
					props.attributes.taxonomy = trx_addons_array_first_key( TRX_ADDONS_STORAGE['gutenberg_sc_params']['taxonomies'][props.attributes.post_type] );
				}
				return trx_addons_gutenberg_block_params(
					{
						'render': true,
						'general_params': el(
							'div', {}, trx_addons_gutenberg_add_params( trx_addons_apply_filters( 'trx_addons_gb_map_add_params', [
								// Layout
								{
									'name': 'type',
									'title': i18n.__( 'Layout' ),
									'descr': i18n.__( "Select shortcodes's layout" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['sc_layouts']['trx_sc_services'] )
								},
								// Tabs change effect
								{
									'name': 'tabs_effect',
									'title': i18n.__( 'Tabs change effect' ),
									'descr': i18n.__( "Select the tabs change effect" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['sc_services_tabs_effects'] ),
									'dependency': {
										'type': ['tabs']
									}
								},
								// Featured
								{
									'name': 'featured',
									'title': i18n.__( 'Featured' ),
									'descr': i18n.__( "What to use as featured element?" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['sc_services_featured'] ),
									'dependency': {
										'type': ['default', 'callouts', 'hover', 'light', 'list', 'iconed', 'tabs', 'tabs_simple', 'timeline']
									}
								},
								// Featured position
								{
									'name': 'featured_position',
									'title': i18n.__( 'Featured position' ),
									'descr': i18n.__( "Select the position of the featured element. Attention! Use 'Bottom' only with 'Callouts' or 'Timeline'" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['sc_services_featured_positions'] ),
									'dependency': {
										'featured': ['image', 'icon', 'number', 'pictogram']
									}
								},
								// Thumb size
								{
									'name': 'thumb_size',
									'title': i18n.__( 'Image size' ),
									'descr': i18n.__( "Leave 'Default' to use default size defined in the shortcode template or any registered size to override thumbnail size with the selected value." ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['sc_services_thumb_sizes'] ),
									'dependency': {
										'type': [ '^news' ]
									}
								},
								// Disable links
								{
									'name': 'no_links',
									'title': i18n.__( 'Disable links' ),
									'descr': i18n.__( "Check if you want disable links to the single posts" ),
									'type': 'boolean'
								},
								// 'More' text
								{
									'name': 'more_text',
									'title': i18n.__( "'More' text" ),
									'descr': i18n.__( "Specify caption of the 'Read more' button. If empty - hide button" ),
									'type': 'text',
								},
								// Pagination
								{
									'name': 'pagination',
									'title': i18n.__( 'Pagination' ),
									'descr': i18n.__( "Add pagination links after posts. Attention! Pagination is not allowed if the slider layout is used." ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['sc_paginations'] )
								},
								// Excerpt
								{
									'name': 'hide_excerpt',
									'title': i18n.__( "Hide excerpt" ),
									'descr': i18n.__( "Toggle this option to hide the excerpt." ),
									'type': 'boolean',
								},
								// Remove margin
								{
									'name': 'no_margin',
									'title': i18n.__( "Remove margin" ),
									'descr': i18n.__( "Check if you want remove spaces between columns" ),
									'type': 'boolean',
								},
								// Animation
								{
									'name': 'icons_animation',
									'title': i18n.__( "Icons animation" ),
									'descr': i18n.__( "Attention! Animation is enabled only if there is an .SVG  icon in your theme with the same name as the selected icon." ),
									'type': 'boolean',
								},
								// Hide bg image
								{
									'name': 'hide_bg_image',
									'title': i18n.__( "Hide bg image" ),
									'descr': i18n.__( "Toggle to hide the background image on the front item." ),
									'type': 'boolean',
									'dependency': {
										'type': ['hover']
									}
								},
								// Open in the popup
								{
									'name': 'popup',
									'title': i18n.__( "Open in the popup" ),
									'descr': i18n.__( "Open details in the popup or navigate to the single post (default)" ),
									'type': 'boolean',
								},
								// Post type
								{
									'name': 'post_type',
									'title': i18n.__( "Post type" ),
									'descr': i18n.__( "Select post type to show posts" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['posts_types'] )
								},
								// Taxonomy
								{
									'name': 'taxonomy',
									'title': i18n.__( "Taxonomy" ),
									'descr': i18n.__( "Select taxonomy to show posts" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['taxonomies'][props.attributes.post_type] )
								},
								// Category
								{
									'name': 'cat',
									'title': i18n.__( 'Category' ),
									'descr': i18n.__( "Services group" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['categories'][props.attributes.taxonomy] )
								}
							], 'trx-addons/services', props ), props )
						),
						'additional_params': el(
							'div', {},
							// Query params
							trx_addons_gutenberg_add_param_query( props ),
							// Title params
							trx_addons_gutenberg_add_param_title( props, true ),
							// Slider params
							trx_addons_gutenberg_add_param_slider( props ),
							// ID, Class, CSS params
							trx_addons_gutenberg_add_param_id( props )
						)
					}, props
				);
			},
			save: function(props) {
				return el( '', null );
			}
		},
		'trx-addons/services'
	) );
})( window.wp.blocks, window.wp.editor, window.wp.i18n, window.wp.element );
