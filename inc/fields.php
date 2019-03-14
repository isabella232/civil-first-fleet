<?php
/**
 * Fieldmanager fields
 *
 * @package Civil_First_Fleet
 */

/* begin fm:post-landing-page-settings */
/**
 * `post-landing-page-settings` Fieldmanager fields.
 */
function civil_first_fleet_fm_post_landing_page_settings() {
	$fm = new Fieldmanager_Group(
		[
			'name' => 'post-landing-page-settings',
			'serialize_data' => false,
			'add_to_prefix' => false,
			'children' => [
				'landing_page_type' => new Fieldmanager_Select(
					[
						'first_empty' => true,
						'options' => \Civil_First_Fleet\get_landing_page_types(),
					]
				),
				'homepage' => new Fieldmanager_Group(
					[
						'label' => __( 'Homepage', 'civil-first-fleet' ),
						'tabbed' => 'vertical',
						'display_if' => [
							'src' => 'landing_page_type',
							'value' => 'homepage',
						],
						'children' => \Civil_First_Fleet\get_homepage_fields(),
					]
				),
			],
		]
	);
	$fm->add_meta_box( __( 'Landing Page Settings', 'civil-first-fleet' ), [ 'landing-page' ], 'normal', 'high' );
}
add_action( 'fm_post_landing-page', 'civil_first_fleet_fm_post_landing_page_settings' );
/* end fm:post-landing-page-settings */

/* begin fm:post-guest-author-info */
/**
 * `post-guest-author-info` Fieldmanager fields.
 */
function civil_first_fleet_fm_post_guest_author_info() {
	$fm = new Fieldmanager_Group(
		[
			'name' => 'post-guest-author-info',
			'serialize_data' => false,
			'add_to_prefix' => false,
			'children' => [
				'email' => new Fieldmanager_TextField( __( 'Email', 'civil-first-fleet' ) ),
				'twitter' => new Fieldmanager_TextField(
					[
						'label' => __( 'Twitter', 'civil-first-fleet' ),
						'sanitize' => function( $value ) { return str_replace( '@', '', $value ); },
					]
				),
				'biography' => new Fieldmanager_RichTextArea(
					[
						'label' => __( 'Biography', 'civil-first-fleet' ),
						'buttons_1' => [ 'bold', 'italic', 'link' ],
						'buttons_2' => [],
						'sanitize' => 'wp_filter_post_kses',
						'editor_settings' => [
							'media_buttons' => false,
						],
						'attributes' => [
							'style' => 'width: 100%',
							'rows' => 4,
						],
					]
				),
			],
		]
	);
	$fm->add_meta_box( __( 'Info', 'civil-first-fleet' ), [ 'guest-author' ], 'normal' );
}
add_action( 'fm_post_guest-author', 'civil_first_fleet_fm_post_guest_author_info' );
/* end fm:post-guest-author-info */

/* begin fm:submenu-newsroom-settings */
/**
 * `newsroom-settings` Fieldmanager fields.
 */
function civil_first_fleet_fm_submenu_newsroom_settings() {
	$fm = new Fieldmanager_Group(
		[
			'name' => 'newsroom-settings',
			'tabbed' => 'vertical',
			'serialize_data' => false,
			'add_to_prefix' => false,
			'children' => [
				'branding' => new Fieldmanager_Group(
					[
						'label' => __( 'Branding', 'civil-first-fleet' ),
						'children' => [
							'logo' => new Fieldmanager_Group(
								[
									'label' => __( 'Logo', 'civil-first-fleet' ),
									'children' => [
										'image_id' => new Fieldmanager_Media( __( 'Upload a logo image', 'civil-first-fleet' ) ),
										'svg' => new Fieldmanager_TextArea( __( 'Logo SVG', 'civil-first-fleet' ) ),
									],
								]
							),
							'footer_logo' => new Fieldmanager_Group(
								[
									'label' => __( 'Footer Logo', 'civil-first-fleet' ),
									'children' => [
										'image_id' => new Fieldmanager_Media( __( 'Upload a logo image', 'civil-first-fleet' ) ),
										'svg' => new Fieldmanager_TextArea( __( 'Logo SVG', 'civil-first-fleet' ) ),
									],
								]
							),
						],
					]
				),
				'analytics' => new Fieldmanager_Group(
					[
						'label' => __( 'Analytics', 'civil-first-fleet' ),
						'children' => [
							'ga_property_code' => new Fieldmanager_TextField(
								[
									'label' => __( 'Google Analytics Property ID', 'civil-first-fleet' ),
									'description' => __( "This is the Google Analytics Property ID that will be used to track all data on this site. (i.e. 'UA-XXXXX-Y')", 'civil-first-fleet' ),
								]
							),
						],
					]
				),
				'seo' => new Fieldmanager_Group(
					[
						'label' => __( 'SEO', 'civil-first-fleet' ),
						'children' => [
							'social' => new Fieldmanager_Group(
								[
									'label' => __( 'Social', 'civil-first-fleet' ),
									'children' => [
										'facebook_app_id' => new Fieldmanager_TextField(
											[
												'label' => __( 'Facebook App ID', 'civil-first-fleet' ),
												'description' => __( 'Newsroom Facebook App ID', 'civil-first-fleet' ),
											]
										),
										'twitter_handle' => new Fieldmanager_TextField(
											[
												'label' => __( 'Twitter Handle', 'civil-first-fleet' ),
												'description' => __( 'Newsroom Twitter Handle', 'civil-first-fleet' ),
												'sanitize' => function( $value ) { return str_replace( '@', '', $value ); },
											]
										),
									],
								]
							),
						],
					]
				),
				'newsletter' => new Fieldmanager_Group(
					[
						'label' => __( 'Newsletter', 'civil-first-fleet' ),
						'children' => [
							'mailchimp_api_key' => new Fieldmanager_TextField( __( 'MailChimp API Key', 'civil-first-fleet' ) ),
							'mailchimp_list_id' => new Fieldmanager_TextField(
								[
									'label' => __( 'MailChimp List ID', 'civil-first-fleet' ),
									'attributes' => [
										'disabled' => true,
									],
									'description' => __( 'This field has been deprecated. Please add a new list below to use Mailchimp.', 'civil-first-fleet' ),
								]
							),
							'success_message' => new Fieldmanager_TextField(
								[
									'label' => __( 'Success Message', 'civil-first-fleet' ),
									'description' => __( 'The message shown to the user after a successful signup.', 'civil-first-fleet' ),
									'default_value' => __( 'Thank you for subscribing!', 'civil-first-fleet' ),
								]
							),
							'mailchimp_lists' => new Fieldmanager_Group(
								[
									'label' => __( 'Mailchimp Lists', 'civil-first-fleet' ),
									'children' => [
										'lists' => new Fieldmanager_Group(
											[
												'label' => __( 'New List', 'civil-first-fleet' ),
												'label_macro' => [ '%s', 'name' ],
												'limit' => 0,
												'collapsed' => true,
												'add_more_label' => __( 'Add List', 'civil-first-fleet' ),
												'children' => [
													'name' => new Fieldmanager_TextField( __( 'List Name', 'civil-first-fleet' ) ),
													'id' => new Fieldmanager_TextField( __( 'List ID', 'civil-first-fleet' ) ),
												],
											]
										),
									],
								]
							),
							'sticky_call_to_action' => new Fieldmanager_Group(
								[
									'label' => __( 'Sticky CTA', 'civil-first-fleet' ),
									'collapsed' => true,
									'children' => \Civil_First_Fleet\Component\call_to_action()->set_fm_fields( \Civil_First_Fleet\Component\call_to_action()->sticky_cta_fm_fields() )->get_fm_fields(),
								]
							),
						],
					]
				),
				'component_defaults' => new Fieldmanager_Group(
					[
						'label' => __( 'Component Defaults', 'civil-first-fleet' ),
						'children' => [
							'paywall_call_to_action' => new Fieldmanager_Group(
								[
									'label' => __( 'Paywall Call to Action', 'civil-first-fleet' ),
									'collapsed' => true,
									'children' => [
										'button_text' => new Fieldmanager_TextField(
											[
												'label' => __( 'Button Text', 'civil-first-fleet' ),
												'description' => __( 'E.g. the "Subscribe" buttons in header and footer navs', 'civil-first-fleet' ),
												'default_value' => __( 'Subscribe', 'civil-first-fleet' ),
											]
										),
									],
								]
							),
							'credibility_indicators' => new Fieldmanager_Group(
								[
									'label' => __( 'Credibility Indicators', 'civil-first-fleet' ),
									'collapsed' => true,
									'children' => \Civil_First_Fleet\Component\credibility_indicators()->get_fm_fields(),
								]
							),
							'newsletter_call_to_action' => new Fieldmanager_Group(
								[
									'label' => __( 'Newsletter CTA', 'civil-first-fleet' ),
									'collapsed' => true,
									'children' => \Civil_First_Fleet\Component\call_to_action()->set_setting( 'type', 'newsletter' )->remove_fm_field( 'enable' )->remove_fm_field( 'settings' )->get_fm_fields(),
								]
							),
							'subscribe_call_to_action' => new Fieldmanager_Group(
								[
									'label' => __( 'Subscribe CTA', 'civil-first-fleet' ),
									'collapsed' => true,
									'children' => \Civil_First_Fleet\Component\call_to_action()->set_setting( 'type', 'subscribe' )->remove_fm_field( 'enable' )->remove_fm_field( 'settings' )->get_fm_fields(),
								]
							),
						],
					]
				),
				'contact' => new Fieldmanager_Group(
					[
						'label' => __( 'Contact Info', 'civil-first-fleet' ),
						'children' => [
							'email' => new Fieldmanager_TextField(
								[
									'label' => __( 'Email Address', 'civil-first-fleet' ),
									'default_value' => 'support@civil.co',
								]
							),
						],
					]
				),
				'search' => new Fieldmanager_Group(
					[
						'label' => __( 'Search', 'civil-first-fleet' ),
						'children' => [
							'search_display' => new Fieldmanager_Group(
								[
									'label' => __( 'Search Form Display', 'civil-first-fleet' ),
									'children' => [
										'show_search_in_header_nav' => new Fieldmanager_Checkbox( __( 'Show search form in header navigation.', 'civil-first-fleet' ) ),
										'search_form_style' => new Fieldmanager_Select(
											[
												'label' => __( 'Display style:', 'civil-first-fleet' ),
												'options' => [
													'trigger' => __( 'Toggle: Hide search form until user clicks icon to display it', 'civil-first-fleet' ),
													'inline' => __( 'Inline: Show a search form in the header navigation', 'civil-first-fleet' ),
												],
											]
										),
									],
								]
							),
						],
					]
				),
				'article_taxonomies' => new Fieldmanager_Group(
					[
						'label' => __( 'Article Taxonomies', 'civil-first-fleet' ),
						'children' => \Civil_First_Fleet\Component\article_taxonomies()->get_fm_fields(),
					]
				),
			],
		]
	);
	$fm->activate_submenu_page();
}
add_action( 'fm_submenu_newsroom-settings', 'civil_first_fleet_fm_submenu_newsroom_settings' );
if ( function_exists( 'fm_register_submenu_page' ) ) {
	fm_register_submenu_page( 'newsroom-settings', 'options-general.php', __( 'Newsroom Settings', 'civil-first-fleet' ), __( 'Newsroom Settings', 'civil-first-fleet' ), 'manage_options' );
}
/* end fm:submenu-newsroom-settings */

/* begin fm:post-post-article-settings */
/**
 * `post-post-article-settings` Fieldmanager fields.
 */
function civil_first_fleet_fm_post_post_article_settings() {
	$fm = new Fieldmanager_Group(
		[
			'name' => 'post-post-article-settings',
			'tabbed' => 'vertical',
			'serialize_data' => false,
			'add_to_prefix' => false,
			'children' => [
				'settings_group' => new Fieldmanager_Group(
					[
						'label' => __( 'Settings', 'civil-first-fleet' ),
						'serialize_data' => false,
						'add_to_prefix' => false,
						'children' => [
							'dek' => new Fieldmanager_TextArea(
								[
									'label' => __( 'Deck', 'civil-first-fleet' ),
									'attributes' => [
										'style' => 'width: 100%;',
										'rows' => '5',
									],
								]
							),
							'primary_category_id' => new Fieldmanager_Autocomplete(
								[
									'label' => __( 'Primary Category', 'civil-first-fleet' ),
									'description' => __( 'Begin typing to select a primary category.', 'civil-first-fleet' ),
									'datasource' => new Fieldmanager_Datasource_Term(
										[
											'taxonomy' => 'category',
											'taxonomy_save_to_terms' => false,
											'only_save_to_taxonomy' => false,
										]
									),
								]
							),
							'label' => new Fieldmanager_Checkboxes(
								[
									'label' => __( 'Enable Label', 'civil-first-fleet' ),
									'options' => \Civil_First_Fleet\Component\Content_Item()->get_label_options(),
								]
							),
						],
					]
				),
				'featured_media' => new Fieldmanager_Group(
					[
						'label' => __( 'Featured Media', 'civil-first-fleet' ),
						'serialize_data' => false,
						'add_to_prefix' => false,
						'children' => [
							'disable_featured_image' => new Fieldmanager_Checkbox(
								[
									'label' => __( 'Hide image on article header', 'civil-first-fleet' ),
									'description' => __( 'This will still display as the thumbnail on archives.', 'civil-first-fleet' ),
								]
							),
							'featured_video_url' => new Fieldmanager_Link( __( 'Video URL for the featured homepage slot and article header.', 'civil-first-fleet' ) ),
						],
					]
				),
				'credibility_indicators_group' => new Fieldmanager_Group(
					[
						'label' => __( 'Credibility Indicators', 'civil-first-fleet' ),
						'serialize_data' => false,
						'add_to_prefix' => false,
						'children' => [
							'credibility_indicators' => new Fieldmanager_Group(
								[
									'children' => \Civil_First_Fleet\Component\credibility_indicators()->article_fields(),
								]
							),
						],
					]
				),
				'call_to_action_group' => new Fieldmanager_Group(
					[
						'label' => __( 'Call to Action', 'civil-first-fleet' ),
						'serialize_data' => false,
						'add_to_prefix' => false,
						'children' => [
							'call_to_action' => new Fieldmanager_Group(
								[
									'children' => \Civil_First_Fleet\Component\call_to_action()->get_fm_fields(),
								]
							),
						],
					]
				),
				'secondary_bylines_group' => new Fieldmanager_Group(
					[
						'label' => __( 'Secondary Bylines', 'civil-first-fleet' ),
						'serialize_data' => false,
						'add_to_prefix' => false,
						'children' => [
							'secondary_bylines' => new Fieldmanager_Group(
								[
									'limit' => 0,
									'add_more_label' => __( 'Add Byline', 'civil-first-fleet' ),
									'label' => __( 'New Byline', 'civil-first-fleet' ),
									'label_macro' => [ 'Byline: %s', 'type' ],
									'minimum_count' => 0,
									'extra_elements' => 0,
									'collapsed' => true,
									'sortable' => true,
									'children' => [
										'role' => new Fieldmanager_TextField(
											[
												'label' => __( 'Role', 'civil-first-fleet' ),
												'description' => __( 'e.g., "Edited by", "Fact-checked by"', 'civil-first-fleet' ),
											]
										),
										'id' => new Fieldmanager_Autocomplete(
											[
												'label' => __( 'Name', 'civil-first-fleet' ),
												'description' => __( 'Begin typing to select a user.', 'civil-first-fleet' ),
												'datasource' => new Fieldmanager_Datasource_Post(
													[
														'query_args' => [
															'post_type' => [ 'guest-author' ],
														],
													]
												),
												'display_if' => [
													'src' => 'name_toggle',
													'value' => false,
												],
											]
										),
										'custom_name' => new Fieldmanager_TextField(
											[
												'label' => __( 'Name', 'civil-first-fleet' ),
												'description' => __( 'Enter a custom name.', 'civil-first-fleet' ),
												'display_if' => [
													'src' => 'name_toggle',
													'value' => true,
												],
											]
										),
										'name_toggle' => new Fieldmanager_Checkbox( __( 'Manually enter name.', 'civil-first-fleet' ) ),
									],
								]
							),
						],
					]
				),
			],
		]
	);
	$fm->add_meta_box( __( 'Article Settings', 'civil-first-fleet' ), [ 'post' ] );
}
add_action( 'fm_post_post', 'civil_first_fleet_fm_post_post_article_settings' );
/* end fm:post-post-article-settings */