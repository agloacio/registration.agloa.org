/**
 * Tabs Compnent.
 *
 * This file defines the Component class for the Tabbed Content component.
 *
 * There are three main parts to this component:
 * 1. The Control class, which is responsible for rendering the UI for the control,
 *    as well as binding the change events for the control.
 * 2. The Tabs Component, which is responsible for handling interaction with the component inside
 *    the editor, and handles binding all of tinyMce.editor events for the component.
 * 3. The Tabs Plugin, which is the top level class that handles the overall initialization of
 *    the the Tabs within the application. The Plugin serves as an interface between the Control
 *    and the Component, as well as the front-end interraction.
 *
 * @link   https://www.boldgrid.com
 * @file   This files defines the Plugin class.
 * @author jamesros161
 * @since  1.1.0
 */
import './style.scss';
import sampleTabs from './sample-tabs.html';
import { Plugin as TabsPlugin } from './plugin';
import { Control } from './control';

let $ = jQuery,
	BG = BOLDGRID.EDITOR;

export class Component {
	constructor() {
		this.tabsConfig = {
			name: 'tabs',
			title: 'Tabs',
			type: 'structure',
			icon: '<span class="dashicons dashicons-block-default"></span>',
			insertType: 'insert',
			getDragElement: () => this.getSampleTabs( sampleTabs ),
			onClick: component => this.prepend( component ),
			priority: 90
		};

		this.tabsPlugin = new TabsPlugin();
		this.control    = new Control( this.tabsPlugin );
	}

	/**
	 * Get a sample tabs.
	 *
	 * @since 1.1.0
	 *
	 * @param  {string} html HTMl.
	 * @return {jQuery}      Tabs.
	 */
	getSampleTabs( html ) {
		let $tabs    = $( html ),
			defaults = new TabsPlugin().defaults;

		$tabs.attr( 'data-config', JSON.stringify( defaults ) );

		return $tabs;
	}

	/**
	 * Insert a Tab to the content.
	 *
	 * @since 1.1.0
	 *
	 * @param  {Object} component Component.
	 */
	prepend( component ) {
		let $inserted,
			$html = component.getDragElement();

		BG.Service.component.prependContent( $html );

		BG.Service.component.scrollToElement( $html, 200 );
		this.openCustomization( $html );
		this.tabsPlugin.initTabs( $html );
		setTimeout( () => $( window ).trigger( 'resize' ) );
	}

	/**
	 * Open the customizer for a Tabs component.
	 *
	 * @since 1.1.0
	 *
	 * @param  {jQuery} $inserted Inserted component.
	 */
	openCustomization( $inserted ) {
		let control = BG.Controls.get( 'tabs' );
		BG.Controls.$menu.targetData.tabs = $inserted;
		$inserted.click();
		control.onMenuClick();
	}

	/**
	 * Init the class, binding events.
	 *
	 * This method is called by the editor to load
	 * the component.
	 *
	 * @since 1.1.0
	 */
	init() {
		this._setupCustomization();

		BG.$window.on( 'boldgrid_editor_loaded', () => {
			this.initTabs();

			// On Undo and redo make sure tabs are reintialized.
			BG.mce.on( 'undo redo', () => {
				IMHWPB['tinymce_undo_disabled'] = true;
				this.updateAllTabs();
				setTimeout( () => {
					IMHWPB['tinymce_undo_disabled'] = false;
				} );
			} );

			// User goes from text to visual.
			BG.mce.on( 'show', () => this.updateAllTabs() );
			BG.mce.on( 'SetContent', this.updateAllTabs() );
			BG.mce.on( 'Change', _.throttle( () => this.updateAllTabs(), 100 ) );

			// Remove temp classes on save.
			BG.mce.on( 'saveContent', e => this.onSave( e ) );

			// Handes deletion / node changes.
			BG.mce.on( 'KeyDown', e => this.tabsPlugin.onKeyDown( e ) );
			BG.mce.on( 'NodeChange', e => this.tabsPlugin.onNodeChange( e ) );
		} );

		// Bind Service events.
		BG.Service.event
			.on( 'cloneSection', $markup => this.onClone( $markup ) )
			.on( 'cloneContent', $markup => this.onClone( $markup ) )
			.on( 'modifyContent', () => this.updateAllTabs() )
			.on( 'endTyping', () => this.updateAllTabs() )
			.on( 'mceResize', () => this.updateAllTabs() )
			.on( 'rowResize', _.throttle( () => this.updateAllTabs(), 100 ) )
			.on( 'dragDrop', $markup => this.onClone( $markup ) );

		// Updates iframe and fourpan.
		this.tabsPlugin.event.on( 'tabsChange', () => $( window ).trigger( 'resize' ) );
	}

	/**
	 * Setup the Controls and the Component.
	 *
	 * @since 1.1.0
	 */
	_setupCustomization() {
		if ( ! BoldgridEditor.plugin_configs.premium.is_premium ) {
			return;
		}

		// Setup the ability for a user to customizer a component.
		this.control.init();

		BG.$window.on( 'boldgrid_editor_loaded', () => {
			BG.Service.component.register( this.tabsConfig );
		} );
	}

	/**
	 * Initialize editor tabs.
	 *
	 * @since 1.1.0
	 */
	initTabs() {
		this.tabsPlugin.initTabs( BG.Controls.$container.find( '.boldgrid-tabs.boldgrid-section-wrap' ) );
	}

	/**
	 * Find all tabs in the container and update their tablists.
	 *
	 * @since 1.1.0
	 */
	updateAllTabs() {
		this.tabsPlugin.initPageTabs( BG.Controls.$container );
	}

	/**
	 * When a tab is cloned, init the new tab.
	 *
	 * @since 1.1.0
	 *
	 * @param  {jQuery} $markup Tab HTMl.
	 */
	onClone( $markup ) {
		if ( $markup.hasClass( 'boldgrid-tabs' ) ) {
			this.tabsPlugin.updateAllTabs( $markup );
		}
	}

	/**
	 * On Save.
	 *
	 * On Save, remove active classes, and set first tab to active.
	 *
	 * @since 1.1.0
	 *
	 * @param  {Object} e Event.
	 */
	onSave( e ) {
		var $savedContent = $( '<div>' + e.content + '</div>' ),
			$tabs         = $savedContent.find(
				'.boldgrid-tabs.boldgrid-section-wrap'
			);

		$tabs.each( ( index, el ) => {
			var $tab         = $( el ),
				$tabLi       = $tab.find( 'ul.nav.nav-tabs li' ),
				activePaneId = $tabLi
					.first()
					.children( 'button' )
					.attr( 'data-bgtab-target' );

			$tabLi.children( 'button' ).removeClass( 'active' );
			$tab.find( 'ul.nav.nav-tabs' ).removeClass( 'contenteditable' );
			$tabLi.children( 'button' ).removeAttr( 'contenteditable' );
			$tabLi
				.first()
				.children( 'button' )
				.addClass( 'active' );

			$tab.find( '.boldgrid-section.boldgrid-tabs-pane' ).removeClass( 'active' );
			$tab.find( '#' + activePaneId ).addClass( 'active' );
		} );

		e.content = $savedContent.html();
	}
}
