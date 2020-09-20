const { registerBlockStyle } = wp.blocks;

wp.domReady( () => {

	// HEADINGS
	registerBlockStyle( 'core/heading', [ 
		{
			name: 'sunset-heading',
			label: 'Sunset Heading',
			isDefault: true,
		}
	]);
	// -END HEADINGS

	// GROUPS
	registerBlockStyle('core/group', [
		{
			name: 'sunset-about-us-section',
			label: 'Sunset About Us Section',
		},
		{
			name: 'sunset-wrapper',
			label: 'Sunset Wrapper',
		},
		{
			name: 'sunset-quote-group',
			label: 'Sunset Quote',
		}
	]);
	// -END GROUPS

	// COLUMNS
	registerBlockStyle('core/column', [
		{
			name: 'sunset-quote-group',
			label: 'Sunset Quote',
		}
	]);

	// -END COLUMNS


	// IMAGES
	registerBlockStyle('core/image', [
		{
			name: 'sunset-left-figcaption',
			label: 'Sunset Left Caption',
			isDefault: true,
		},
	]);
	// -END IMAGES

} );