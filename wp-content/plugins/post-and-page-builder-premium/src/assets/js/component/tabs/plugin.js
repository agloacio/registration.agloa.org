/**
 * Tabs Plugin.
 *
 * This file defines the Plugin class for the Tabbed Content component.
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
import { EventEmitter } from 'eventemitter3';
import sampleTab from './sample-tab.html';
import sampleTabContent from './sample-tab-content.html';

let $ = jQuery;

export class Plugin {

	/**
	 * Constructor.
	 *
	 * @since 1.1.0
	 */
	constructor() {
		let defaultId1 = Math.floor( Math.random() * 1000 + 1 );
		let defaultId2 = Math.floor( Math.random() * 1000 + 1 );
		let defaultId3 = Math.floor( Math.random() * 1000 + 1 );

		this.defaults = {
			tabsList: [
				{
					title: 'Tab 1',
					tabId: 'tab-' + defaultId1,
					target: 'tab-' + defaultId1 + '-content'
				},
				{
					title: 'Tab 2',
					tabId: 'tab-' + defaultId2,
					target: 'tab-' + defaultId2 + '-content'
				},
				{
					title: 'Tab 3',
					tabId: 'tab-' + defaultId3,
					target: 'tab-' + defaultId3 + '-content'
				}
			],
			bgOptions: {}
		};

		this.settings = [];

		this.event = new EventEmitter();
	}

	/**
	 * Instantiate all tabs on the page.
	 *
	 * This method serves as the entry point for the tabs component.
	 * This method is fired on the front-end and in the editor,
	 * and is responsible for ensuring the tabs properly respond to
	 * being clicked on.
	 *
	 * @since 1.1.0
	 *
	 * @param {$} $html The html to search for tabs.
	 */
	initPageTabs( $html ) {
		let $tabSections = $( '.boldgrid-tabs.boldgrid-section-wrap' );

		// This method runs on page load in the front end AND editor.
		if ( 'undefined' === typeof $html && 'undefined' !== typeof BG ) {
			$html = $( BG.mce.dom.doc );
		} else if ( 'undefined' === typeof $html ) {
			$html = $( document );
		}

		if ( $html && $html.hasClass( 'boldgrid-section-wrap' ) ) {
			$tabSections = $html;
		}

		if ( 0 === $tabSections.length ) {
			$tabSections = $html.find( '.boldgrid-tabs.boldgrid-section-wrap' );
		}

		$tabSections.each( ( index, tabSection ) => {
			let $tabSection = $( tabSection );
			let $tabs       = $tabSection.find( 'ul.nav-tabs li.nav-item .nav-link' );

			$tabs.off( 'click' );
			$tabs.on( 'click', event => {
				$tabs.removeClass( 'active' );
				event.preventDefault();
				let $tab        = $( event.currentTarget );
				let $tabContent = $tabSection.find( '#' + $tab.attr( 'data-bgtab-target' ) );

				$tab.addClass( 'active' );
				$tabContent.addClass( 'active' );

				$tabSection.find( '.boldgrid-tabs-pane' ).removeClass( 'active' );
				$tabContent.addClass( 'active' );
			} );
		} );
	}

	/**
	 * Instantiate the tabs for a specific Tab Section.
	 *
	 * This method is responsible for initializing a specific component,
	 * rather than page-wide initialization. This ensures that the markup
	 * is clean, and that any removed tabs have had their content tab removed,
	 * and new tabs have had a new content tab added.
	 *
	 * @since 1.1.0
	 *
	 * @listens $tabs.#afterChange.ppbp
	 * @fires   CLASS.event.#tabsChange
	 * @fires   CLASS.event.#initialized
	 *
	 * @param  {jQuery} $html HTML.
	 */
	initTabs( $html ) {
		$html.each( ( index, tabs ) => {
			let $tabs = $( tabs ),
				config;

			// Only run on tabs.
			if ( ! $tabs.hasClass( 'boldgrid-tabs' ) ) {
				return;
			}

			config = this.parseConfig( $tabs );

			config = { ...this.defaults, ...config };

			// Remove tab items, so updated / correct ones can be added.
			$tabs
				.find( 'ul.nav-tabs' )
				.children()
				.remove();

			if ( config.tabsList ) {
				config.tabsList.forEach( tab => {
					let $tab = this.getSampleTab( sampleTab );
					let $tabButton = $tab.find( 'button' );
					let $tabContent = this.getSampleTabContent( sampleTabContent );

					let $existingTabContent = $tabs.find( '#' + tab.target );

					$tabButton.text( tab.title );
					$tabButton.attr( 'id', tab.tabId );
					$tabButton.attr( 'data-bgtab-target', tab.target );
					$tabButton.attr( 'contenteditable', 'false' );
					$tabs.find( 'ul.nav-tabs' ).attr( 'contenteditable', 'false' );
					$tabs.find( 'ul.nav-tabs' ).append( $tab );

					// If the tab added doesn't have a corresponding tab pane, add it.
					if ( 0 === $existingTabContent.length ) {
						$tabContent.find( 'div[class*=col-] p' ).text( tab.title );
						$tabContent.attr( 'id', tab.target );
						$tabContent.attr( 'aria-labelledby', tab.tabId );
						$tabs.append( $tabContent );
					}
				} );
			}

			// Set the first tab to active on load.
			$tabs
				.find( 'ul.nav-tabs' )
				.children()
				.first()
				.find( 'button' )
				.addClass( 'active' );

			// Set all tab panes to inactive.
			$tabs.find( '.boldgrid-tabs-pane' ).removeClass( 'active' );

			// Set the tab pane cooresponding to first tab to active.
			$tabs
				.find( '#' + $tabs.find( 'ul.nav-tabs li .active' ).attr( 'data-bgtab-target' ) )
				.addClass( 'active' );

			// When a tab is inserted a resize and insert event happen back to back, prevent double binding.
			$tabs.off( 'afterChange.ppbp' );
			$tabs.on( 'afterChange.ppbp', () => this.event.emit( 'tabsChange', $tabs ) );

			// Apply color classes and dynamic padding.
			this._applyColors( $tabs, config );
			this._calcPadding( $tabs, config );

			// Emit an event to let the rest of the app know that this tab section has been initialized.
			this.event.emit( 'initialized', $tabs );
		} );

		// Initialize Page tabs to ensure all click binding is correct.
		this.initPageTabs( $html );
	}

	/**
	 * Get a sample tabs.
	 *
	 * This wrapper is used by the tab Component
	 * to get a sample tab for new tabs.
	 *
	 * @since 1.1.0
	 *
	 * @param  {string} html HTMl.
	 * @return {jQuery}      Tab.
	 */
	getSampleTab( html ) {
		let $tabs = $( html );

		return $tabs;
	}

	/**
	 * Get a sample tabs.
	 *
	 * This wrapper is used by the tab Component
	 * to get a sample tab content for new tab panes.
	 *
	 * @since 1.1.0
	 *
	 * @param  {string} html HTMl.
	 * @return {jQuery}      Tab.
	 */
	getSampleTabContent( html ) {
		let $tabContent = $( html );

		return $tabContent;
	}

	/**
	 * Get Alignment.
	 *
	 * This method is used by the tab Control
	 * to get the alignment of the tabs.
	 *
	 * @since 1.1.0
	 *
	 * @param  {jQuery} $target Target.
	 * @return {string} Alignment.
	 */
	getAlignment( $target ) {
		var $tabs = $target.find( 'ul.nav-tabs' );

		if ( $tabs.hasClass( 'left-aligned' ) ) {
			return 'left-aligned';
		}

		if ( $tabs.hasClass( 'right-aligned' ) ) {
			return 'right-aligned';
		}

		return 'center';
	}

	/**
	 * Set Alignment.
	 *
	 * This method is used by the tab Control
	 * to set the alignment of the tabs.
	 * @since 1.1.0
	 *
	 * @param {jQuery} $target Target.
	 * @param {string} alignment Alignment.
	 */
	setAlignment( $target, alignment ) {
		var $tabs = $target.find( 'ul.nav-tabs' );

		$tabs.removeClass( 'left-aligned right-aligned' );
		if ( 'center' !== alignment ) {
			$tabs.addClass( alignment );
		}
	}

	/**
	 * Add New Tab to Tabs.
	 *
	 * This method is used by the tab Control
	 * to add a new tab to a tabs set.
	 *
	 * Once tabs are added, the tabs are re-initialized.
	 *
	 * @since 1.1.0
	 *
	 * @param {jQuery} $html Tabs HTML.
	 * @param {Object} tabConfig Tab Config.
	 */
	addNewTab( $html, tabConfig ) {
		var configs = this.parseConfig( $html );

		configs.tabsList.push( tabConfig );

		$html.attr( 'data-config', JSON.stringify( configs ) );

		this.initTabs( $html );
	}

	/**
	 * Remove Tab from a Tabs Set.
	 *
	 * This method is used by the tab Control
	 * to remove a tab from a tabs set.
	 *
	 * Once tabs are removed, the tabs are re-initialized.
	 *
	 * @since 1.1.0
	 *
	 * @param {jQuery} $target Target.
	 * @param {string} tabId Tab ID.
	 */
	removeTab( $target, tabId ) {
		var configs     = this.parseConfig( $target ),
			$tabContent = $target.find( '#' + tabId );

		$tabContent.remove();

		configs.tabsList = configs.tabsList.filter( tab => {
			return tab.tabId === tabId ? false : true;
		} );

		$target.attr( 'data-config', JSON.stringify( configs ) );

		this.initTabs( $target );
	}

	/**
	 * On Node Change.
	 *
	 * This is used to correct node positioning when all content
	 * is deleted from a tab pane.
	 *
	 * @since 1.1.0
	 *
	 * @listens tinymce.Editor#NodeChange
	 *
	 * @param {event} e Event.
	 */
	onNodeChange( e ) {
		var $selection      = $( BG.mce.selection.getNode() ),
			$tabSectionWrap = $selection.parents( '.boldgrid-tabs.boldgrid-section-wrap' ),
			$currentTabPane = $selection.closest( '.boldgrid-tabs-pane' ),
			$tabNavSection  = $selection.parents( '.boldgrid-tabs-section' ),
			$activeTabPane  = $tabSectionWrap.find( '.boldgrid-tabs-pane.active' );

		// We are not in a tab section, so do nothing.
		if ( 0 === $tabSectionWrap.length ) {
			return;
		}

		// User has clicked on something in the nav tabs, so move selection to wrapper.
		if ( 0 !== $tabNavSection.length ) {
			BG.mce.selection.setCursorLocation( $tabNavSection.get( 0 ), 0 );
		}

		// We are not in a tab content pane, so do nothing.
		if ( 0 === $currentTabPane.length ) {
			return;
		}

		// The current selection has been moved to an inactive pane. Move it to the active pane.
		if ( $currentTabPane.get( 0 ) !== $activeTabPane.get( 0 ) ) {
			let $activePaneRow = $activeTabPane.find( 'div[class*=row]' ).first(),
				$activePaneCol = $activePaneRow.find( 'div[class*=col-]' ).first();

			// If the Active pane has no rows, we have to make one.
			if ( 0 === $activePaneRow.length ) {
				$activeTabPane.html(
					`<div class="container">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<p></p>
							</div>
						</div>
					</div>`
				);
				BG.mce.selection.setCursorLocation( $activeTabPane.find( 'p' ).get( 0 ), 0 );

				// If the active pane's first row has no columns, we have to make one.
			} else if ( 0 === $activePaneCol.length ) {
				$activeTabPane.html(
					`<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<p></p>
					</div>`
				);
				BG.mce.selection.setCursorLocation( $activeTabPane.find( 'p' ).get( 0 ), 0 );

				// If the active pane's first column is empty, we have to make a paragraph.
			} else if ( BG.mce.dom.isEmpty( $activePaneCol.get( 0 ) ) ) {
				$activePaneCol.append( '<p></p>' );
				BG.mce.selection.setCursorLocation( $activePaneCol.find( 'div[class*=col-]' ).get( 0 ), 0 );

				// Otherwise, we just move the curstor to the first child of the first col.
			} else {
				BG.mce.selection.setCursorLocation( $activePaneCol.children().get( 0 ), 0 );
			}
		}
	}

	/**
	 * On KeyDown.
	 *
	 * This is used to prevent users from deleting empty tabs.
	 *
	 * @since 1.1.0
	 *
	 * @listens tinymce.Editor#KeyDown
	 *
	 * @param {event} e Event.
	 */
	onKeyDown( e ) {
		var $selection   = $( BG.mce.selection.getNode() ),
			isTabContent =
				0 === $selection.parents( '.boldgrid-tabs.boldgrid-section-wrap' ).length ?
				false :
				true;

		// If the user is pressing the delete key or backspace key.
		if ( isTabContent && ( '8' == e.which || '46' == e.which ) ) {
			if ( BG.mce.dom.isEmpty( $selection[0] ) ) {
				let $newParagraph = $( '<p><br data-mce-bogus="1"></p>' );
				$selection.after( $newParagraph );
				BG.mce.selection.setCursorLocation( $newParagraph[0], 0 );
				return false;
			}
		}
	}

	/**
	 * Get configurations from a tabs.
	 *
	 * This is used by the Plugin and the Control
	 * to retrieve the tab configurations encoded into
	 * the tab section wrapper.
	 *
	 * @since 1.1.0
	 *
	 * @param  {jQuery} $tabs tabs Object.
	 * @return {object}       tabs Values.
	 */
	parseConfig( $tabs ) {
		return JSON.parse( $tabs.attr( 'data-config' ) || '{}' ) || this.defaults;
	}

	/**
	 * Set the color from configs on all.
	 *
	 * @since 1.1.0
	 *
	 * @param  {jQuery} $tabs  tabs element.
	 * @param  {object} config Configs for tabs.
	 */
	_applyColors( $tabs, config ) {
		if ( ! config.colors ) {
			return;
		}

		for ( let control of this.settings ) {
			if ( config.colors[control.name] ) {
				let $element = $tabs.find( control.selector );

				if ( 'background-color' === control.type ) {
					this._applyBGColor( config.colors[control.name], $element );
				} else {
					this._applyColor( config.colors[control.name], control.type, $element );
				}
			}
		}
	}

	/**
	 * Apply the background color.
	 *
	 * @since 1.1.0
	 *
	 * @param {jQuery} $element
	 */
	_applyBGColor( colors, $element ) {
		if ( 'class' === colors.type ) {
			$element.addClass(
				`color${colors.value}-background-color color-${colors.value}-text-contrast`
			);
		} else {
			$element.css( {
				'background-color': colors.value,
				color: colors.text
			} );
		}
	}

	/**
	 * Add the color.
	 *
	 * @since 1.1.0
	 *
	 * @param  {object} colors  Color Configs.
	 * @param  {string} cssProp Property.
	 */
	_applyColor( colors, cssProp, $element ) {
		if ( 'class' === colors.type ) {
			$element.addClass( `color${colors.value}-${cssProp}` );
		} else {
			$element.css( cssProp, colors.value );
		}
	}

	/**
	 * Add padding to the containers within the tabs to prevent the container
	 * from coliding with the content.
	 *
	 * @since 1.1.0
	 *
	 * @param  {$} $tabs     tabs Object.
	 * @param  {object} config tabs Configuration.
	 */
	_calcPadding( $tabs, config ) {
		let $containers = $tabs.find( '.container, .container-fluid' ),
			css         = { paddingLeft: '', paddingRight: '' };

		$containers.css( css );
	}
}
