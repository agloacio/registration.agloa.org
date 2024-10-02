/**
 * BoldGrid AI Control.
 *
 * This file defines the Control class for the BoldGrid AI component.
 *
 * There are three main parts to this component:
 * 1. The Control class, which is responsible for rendering the UI for the control,
 *    as well as binding the change events for the control.
 * 2. The Component class, which is responsible for handling interaction with the component inside
 *    the editor, and handles binding all of tinyMce.editor events for the component.
 * 3. The Plugin class, which is the top level class that handles the overall initialization 
 *    within the application. The Plugin serves as an interface between the Control
 *    and the Component.
 *
 * @link   https://www.boldgrid.com
 * @file   This files defines the Control class.
 * @author jamesros161
 * @since  1.2.0
 */

import './style.scss';
import { createRoot } from '@wordpress/element';
import { BoldgridPanel } from 'boldgrid-panel';
import apiFetch from '@wordpress/api-fetch';

let $  = jQuery,
	BG = BOLDGRID.EDITOR;

export class Control {

	/**
	 * Constructor.
	 *
	 * @since 1.2.0
	 * 
	 * @param {BoldgridAiPlugin} plugin BoldgridAiPlugin object.
	 */
	constructor( plugin ) {
		this.name             = 'boldgrid-ai';
		this.priority         = 90;
		this.tooltip          = 'BoldGrid AI';
		this.iconClasses      = '';
		this.supportUrl       = 'https://www.boldgrid.com/support/page-builder/boldgrid-ai/';
		this.allowNested      = true;
		this.plugin           = plugin;
		this.apiEndpoints     = this.plugin.configs.api_endpoints;

		this.actions = {
			'' : {
				'label': 'BoldGrid AI',
				'click': '',
				'endpoint': '',
				'context': 'content column row section new edit'
			},
			'generate': {
				'label': 'Generate New Content',
				'click': 'onNewTextAction',
				'endpoint': 'generate',
				'context': 'content column row section new'
			},
			'edit': {
				'label': 'Edit Content',
				'click': 'onNewTextAction',
				'endpoint': 'generate',
				'context': 'content column row section edit'
			},
			'review': {
				'label': 'Review Content',
				'click': 'onReviewAction',
				'endpoint': 'review',
				'context': 'content column row section edit'
			},
			'shorten': {
				'label': 'Make It Shorter',
				'click' : 'onEditAction',
				'endpoint': 'shorten',
				'context': 'content edit',
			},
			'lengthen': {
				'label': 'Add More Details',
				'click': 'onMenuAction',
				'class': 'side-menu-parent',
				'context': 'content edit',
				'endpoint': 'lengthen',
				'items': {
					'expand': {
						'label': 'Expand with Examples',
						'click': 'onEditAction',
						'context': 'content edit',
						'endpoint': 'lengthen',
					},
					'stats': {
						'label': 'Include Stats / Data',
						'click': 'onEditAction',
						'context': 'content edit',
						'endpoint': 'lengthen',
					},
					'anecdotes': {
						'label': 'Add Anecdontes or Stories',
						'click': 'onEditAction',
						'endpoint': 'lengthen',
						'context': 'content edit',
					},
					'context': {
						'label': 'Add Context or Background',
						'click': 'onEditAction',
						'endpoint': 'lengthen',
						'context': 'content edit',
					},
					'quotes': {
						'label': 'Include Quotes or Opinions',
						'click': 'onEditAction',
						'endpoint': 'lengthen',
						'context': 'content edit',
					}
				}
			},
			'structure': {
				'label': 'Improve Structure',
				'click': 'onMenuAction',
				'context': 'content column edit',
				'class': 'side-menu-parent',
				'items': {
					'colHeadings': {
						'label': 'Add Subheadings',
						'click': 'onEditAction',
						'context': 'column edit',
						'endpoint': 'col_add_headings',
					},
					'colList': {
						'label': 'Create a List',
						'click': 'onEditAction',
						'context': 'column edit',
						'endpoint': 'col_list',
					},
					'colBullets': {
						'label': 'Create Bullet Points',
						'click': 'onEditAction',
						'context': 'column edit',
						'endpoint': 'col_bullet_points',
					},
					'pList': {
						'label': 'Convert to a List',
						'click': 'onEditAction',
						'context': 'content edit',
						'endpoint': 'p_list',
					},
					'pBullets': {
						'label': 'Convert to Bullet Points',
						'click': 'onEditAction',
						'context': 'content edit',
						'endpoint': 'p_bullet_points',
					},
					'colParagraphs': {
						'label': 'Add Paragraphs',
						'click': 'onEditAction',
						'context': 'column edit',
						'endpoint': 'add_paragraphs_col',
					},
					'contentParagraphs': {
						'label': 'Split into Paragraphs',
						'click': 'onEditAction',
						'context': 'content edit',
						'endpoint': 'split_paragraphs',
					},
					'sectionSplit': {
						'label': 'Split into Multiple Sections',
						'click': 'onEditAction',
						'context': '',
						'endpoint': 'split_sections',
					}
				}
			},
			'rephrase': {
				'label': 'Rephrase',
				'click': 'onEditAction',
				'context': 'content edit',
				'endpoint': 'rephrase',
			},
			'changeTone': {
				'label': 'Change Tone',
				'click': 'onMenuAction',
				'class': 'side-menu-parent',
				'context': 'content edit',
				'endpoint': 'change-tone',
				'items': {}
			},
		};

		if ( this.plugin.configs.custom_prompts && this.plugin.configs.custom_prompts.quick_action	) {
			this.actions.customActions = {
				'label': 'Custom Actions',
				'click': 'onMenuAction',
				'class': 'side-menu-parent',
				'context': 'content column row section new edit',
				'items': {}
			}
			this.plugin.configs.custom_prompts.quick_action.forEach( ( action ) => {
				this.actions.customActions.items[ action.id ] = {
					'label': action.label,
					'click': 'onCustomAction',
					'context': 'content column row section new edit',
					'endpoint': action.prompt,
				};
			} );
		}

		/**
		 * Tracking of clicked elements.
		 * @type {Object}
		 */
		this.layerEvent = { latestTime: 0, targets: [] };

		this.plugin.configs.tone_options.forEach( ( option ) => {
			this.actions.changeTone.items[ option ] = {
				'label': option,
				'click': 'onEditAction',
				'context': 'content edit',
				'endpoint': 'change_tone',
			};
		} );

		this.panel = {
			title: 'BoldGrid AI',
			height: '625px',
			width: '450px',
			noSlimScroll: true,
			scrollTarget: '.panel-body',
			sizeOffset: 0
		};

		this.selectors = [];

		this.disabledSelectors = [
			'img',
			'div.boldgrid-shortcode',
			'.post-type-crio_page_header .boldgrid-section',
			'p.boldgrid-google-maps'
		];
	}

	/**
	 * Initialize the control.
	 *
	 * Controls are initialized when the editor is loaded,
	 * But are not rendered until the panel is opened.
	 *
	 * @since 1.2.0
	 */
	init() {
		if ( BoldgridEditor.plugin_configs.boldgrid_ai['bgai_enabled'] ) {
			BG.$window.on( 'boldgrid_editor_preload', () => {
				BG.Controls.registerControl( this );
			} );

			BG.$window.on( 'boldgrid_editor_loaded', () => {
				var $editingBlocker = $( '.editing-blocker' ),
					$container      = BOLDGRID.EDITOR.Controls.$container,
					$bgAiDropdown   = $( '.boldgrid-ai-tools-dropdown' );

				$editingBlocker.find( '.actions' ).append(
					'<a class="button button-primary" id="bgai-start-with-ai"><span class="bgai-icon"></span>Start With AI</a>'
				);

				// Open the dropdown if the user clicks on it.
				$bgAiDropdown.find( 'button' ).on( 'click', ( event ) => {
					var $target      = $( BG.mce.selection.getNode() ),
						$actionItems = $bgAiDropdown.find( 'li' ),
						isPostEmpty  = $target.closest( '.boldgrid-section' ).parent().text().trim().length === 0;
					if ( $editingBlocker.is( ':visible' ) ) {
						$target = $target.closest( '.boldgrid-section' );
					}

					event.preventDefault();

					$actionItems.each( ( index, item ) => {
						var $item   = $( item ),
							context = $item.data( 'context' ).split( ' ' );

						if ( context.includes( 'new' ) && ! isPostEmpty ) {
							$item.hide();
						}

						if ( context.includes( 'edit' ) && isPostEmpty ) {
							$item.hide();
						}

						$item.on( 'click', ( event ) => {
							var action = $item.data( 'action' );

							event.preventDefault();
							$bgAiDropdown.removeClass( 'expanded' );

							$editingBlocker.hide();
							BG.VALIDATION.Section.updateContainers( $container );

							this.awaitOpenPanel( $target, action );
						} );
					} );
					
					$bgAiDropdown.toggleClass( 'expanded' );
				} );

				// Close the dropdown if the user clicks outside of it.
				$( document ).on('click', function( event ) {
					if ( ! $( event.target ).closest( $bgAiDropdown ).length ) {
						$bgAiDropdown.removeClass( 'expanded' );
					}
				});

				// Handle clicking on the start with AI button.
				$( '#bgai-start-with-ai' ).on( 'click', ( event ) => {
					var $target = $( BG.mce.selection.getNode() );
					if ( $editingBlocker.is( ':visible' ) ) {
						$target = $target.closest( '.boldgrid-section' );
					}
					event.preventDefault();
					$editingBlocker.hide();
					BG.VALIDATION.Section.updateContainers( $container );

					this.awaitOpenPanel( $target );
				} );
			} );
		}
	}

	/**
	 * Await Open Panel
	 * 
	 * This opens the panel, but waits first to get the userdefaults.
	 *
	 * @param {JQuery} $target Target Element.
	 * @param {string} selectedComponent Name of selected component
	 */
	awaitOpenPanel( $target, selectedComponent = 'BoldgridAiText' ) {
		apiFetch.use( apiFetch.createNonceMiddleware( wpApiSettings.nonce ) );
		apiFetch.use( apiFetch.createRootURLMiddleware( wpApiSettings.root ) );

		apiFetch( {
			path: 'wp/v2/users/' +  userSettings.uid,
			method: 'GET',
		} ).then( ( res ) => {
			if ( res.meta[ 'boldgrid_ai_user_defaults'] ) {
				this.plugin.configs.userDefaults = res.meta[ 'boldgrid_ai_user_defaults']
			}
			this.openPanel( $target, selectedComponent );
		} );
	}

	/**
	 * Open the controls Panel.
	 *
	 * The control is rendered when the panel is opened.
	 *
	 * @since 1.2.0
	 * 
	 * @param {jQuery} $target The target element.
	 * @param {string} selectedComponent Name of selected component
	 */
	openPanel( $target, selectedComponent ) {
		var panel             = BG.Panel;

			this.$target = $target;

			// Remove all content from the panel.
			panel.clear();

			panel.$element.find( '.panel-body' ).html();

			this.setElementType();

			panel.$element.find( '.ui-sortable' ).sortable( {
				handle: '.dashicons-move'
			} );

			// Open Panel.
			panel.open( this );

			panel.$element.find( '.panel-body' ).append( '<div class="bg-ai-react-container"></div>' );

			// This will be the element that the React App attaches to.
			const bgRoot = createRoot( panel.$element.find( '.bg-ai-react-container' ).get( 0 ) );

			const connectKey = BoldgridEditor.boldgrid_settings.api_key;

			const boldgridAiConfigs = this.plugin.configs;

			boldgridAiConfigs.wpApiSettings = {
				root: wpApiSettings.root,
				nonce: wpApiSettings.nonce,
				userId: userSettings.uid
			};

			console.log( { boldgridAiConfigs } );

			const usedComponents = [
				{
					name: 'BoldgridAiText',
					props: {
						target: $target,
						assetServer: this.plugin.asset_server,
						boldgridAiConfigs: boldgridAiConfigs,
						connectKey: connectKey,
					},
					navClass: 'dashicons dashicons-editor-textcolor',
					title: 'Background Color',
					Component: null
				},
				{
					name: 'BoldgridAiSettings',
					props: { boldgridAiConfigs: boldgridAiConfigs },
					navClass: 'dashicons dashicons-admin-generic',
					title: 'Settings',
					Component: null
				},
				{
					name: 'BoldgridAiReview',
					props: {
						target: $target,
						assetServer: this.plugin.asset_server,
						boldgridAiConfigs: boldgridAiConfigs,
						connectKey: connectKey,
					},
					navClass: 'dashicons dashicons-format-chat',
					title: 'Settings',
					Component: null
				},
			];

			panel.$element.on( 'boldgrid-ai-close-panel', () => {
				if ( panel.isOpenControl( this ) ) {
					panel.closePanel();
				}
			} );

			return bgRoot.render(
				<BoldgridPanel type="BoldgridAi" selectedComponent={selectedComponent} usedComponents={usedComponents} target={this.$target} />
			);
	}

	/**
	* Find out what type of element we're working with.
	*
	* @since 1.2.0
	*/
	setElementType() {
		this.elementType = this.checkElementType( this.$target );
		BG.Panel.$element.find( '.customize-navigation' ).attr( 'data-element-type', this.elementType );
		this.panel.targetType = this.elementType;
	}

	/**
	 * Determine the element type supported by this control.
	 *
	 * @since 1.2.0
	 * 
	 * @param {jQuery} $element The element to check.
	 */
	checkElementType( $element ) {
		let elementType = '';
		if ( $element.hasClass( 'boldgrid-section' ) ) {
			elementType = 'section';
		} else if ( $element.hasClass( 'row' ) ) {
			elementType = 'row';
		} else if ( $element.hasClass( 'bg-box' ) ) {
			elementType = 'bg-box';
		} else {
			elementType = 'column';
		}

		return elementType;
	}

	/**
	 * Update Popover Menu to hide or show AI menu.
	 * on certain elements.
	 * 
	 * @since 1.2.0
	 *
	 * @param {Popover} Popover Popover object.
	 */
	updatePopoverMenu( Popover ) {
		var $target        = Popover.$target,
			$aiMenu        = Popover.$element.find( '.context-menu-imhwpb.bgai' ),
			aiMenuDisabled = false;

		this.disabledSelectors.forEach( ( selector ) => {
			if ( $target.is( selector ) ) {
				aiMenuDisabled = true;
				return false;
			}
		} );

		// PPB wraps images in a 'p' tag, so we don't wanna use AI on those.
		if ( $target.is("p") &&
		$target.children().length === 1 &&
		$target.children().first().is("img") ) {
			aiMenuDisabled = true;
		}

		// If the target is a row, and has a nested row, disable AI.
		if ( $target.is( '.row' ) && 0 !== $target.find( '.row:not(.bg-editor-hr-wrap)' ).length ) {
			aiMenuDisabled = true;
		}

		// If the target is a nested row, disable AI.
		if ( $target.is( '.row' ) && 0 !== $target.parents( '.row' ).length ) {
			aiMenuDisabled = true;
		}

		if ( aiMenuDisabled ) {
			$aiMenu.hide();
		} else {
			$aiMenu.show();
		}

		this.maybeHideQuickActions( Popover );
	}

	/**
	 * Maybe hide quick actions.
	 * 
	 * If the target has no text in it, hide quick actions
	 * and only show the generate new text action.
	 * 
	 * @since 1.2.0
	 *
	 * @param {Popover} Popover Popover object.
	 */
	maybeHideQuickActions( Popover ) {
		var $target          = Popover.$target,
			$quickActions    = Popover.$element
				.find( '.popover-menu-imhwpb.bgai .action-list' )
				.not(':first'),
			editOrNew = 'edit',
			popoverType = Popover.name;
			
		if ( 0 === $target.text().trim().length ) {
			editOrNew = 'new';
		}

		$quickActions.each( ( index, item ) => {
			var $item   = $( item ),
				context = $item.data( 'context' ).split( ' ' );

			if ( context.includes( popoverType ) && context.includes( editOrNew ) ) {
				$item.show();
			} else {
				$item.hide();
			}
		} );
	}

	/**
	 * Bind Popover Actions.
	 * 
	 * @since 1.2.0
	 * 
	 * @param {jQuery} $popover Popover element.
	 * @param {Popover} Popover Popover object.
	 */
	bindPopoverActions( $popover, Popover ) {
		var $actionItems = $popover.find( '.popover-menu-imhwpb.bgai .action-list' ),
			Plugin = this.plugin;

		$actionItems.each( ( index, item ) => {
			var $item          = $( item ),
				action         = $item.data( 'action' ),
				actionFunction = $item.data( 'actionFunction' ),
				actionEndpoint = $item.data( 'endpoint' );

			if ( ! action ) {
				return;
			}

			$item.on( 'click', ( event ) => {
				event.preventDefault();
				if ( 'function' === typeof Plugin[ actionFunction ] ) {
					Plugin[ actionFunction ]( action, actionEndpoint, Popover );
				}
			} );
		} );

		/**
		 * This runs just before saving the content to the WP_POST.
		 * This ensures that any un-confirmed AI actions are reverted.
		 * 
		 * @since 1.2.0
		 * 
		 * @param {Object} e Event object.
		 */
		BOLDGRID.EDITOR.mce.on( 'saveContent', ( e ) => {
			var $savedContent         = $( '<div>' + e.content + '</div>' ),
				$pendingConfirmations = $savedContent.find( '.pending-ai-confirmation' ),
				$aiOverlays           = $savedContent.find( '.boldgrid-ai-overlay' );

			$pendingConfirmations.each( ( index, item ) => {
				var $item        = $( item ),
					originalText = $item.data( 'originalText' );

				$item.text( originalText );
				$item.removeClass( 'pending-ai-confirmation' );
			} );

			$aiOverlays.remove();

			e.content = $savedContent.html();
		} );

		/**
		 * This runs when doing an undo / redo action
		 * and ensures that the panel is closed, since
		 * it's target no longer exists.
		 * 
		 * @since 1.2.0
		 */
		BOLDGRID.EDITOR.mce.on( 'undo redo', () => {
			if ( BG.Panel.isOpenControl( this ) ) {
				BG.Panel.closePanel();
			}
		} );
	}

	/**
	 * When the user clicks on an element within the mce editor record the element clicked.
	 *
	 * @since 1.2.0
	 *
	 * @param  {MouseEvent} event DOM Event
	 */
	elementClick( event ) {
		var $target     = $( event.target ),
			isMenuItem  = $target.is( '.action-list' ),
			panelIsOpen = BOLDGRID.EDITOR.Panel.isOpenControl( this );

		if ( ! isMenuItem && panelIsOpen ) {
			let targetIsDisabled = false;
			console.log( {
				newTarget: $target,
			} );

			this.disabledSelectors.forEach( ( selector ) => {
				if ( $target.is( selector ) ) {
					targetIsDisabled = true;
					return false;
				}
			} );

			if ( ! targetIsDisabled ) {
				this.openPanel( $target );
			} else {
				BG.Panel.closePanel();
			}
		}

		if ( isMenuItem && panelIsOpen && 'generate' !== $target.data( 'action' ) ) {
			BG.Panel.closePanel();
		}
	}
}
