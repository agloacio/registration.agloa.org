/**
 * Tabs Control.
 *
 * This file defines the Control class for the Tabbed Content component.
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
 * @file   This files defines the Control class.
 * @author jamesros161
 * @since  1.1.0
 */

import './style.scss';
import colorTemplate from './color-controls.html';
import alignmentTemplate from './alignment-controls.html';

let $ = jQuery,
	BG = BOLDGRID.EDITOR;

export class Control {

	/**
	 * Constructor.
	 *
	 * @since 1.1.0
	 *
	 * @param {Object} tabsPlugin The tabs plugin.
	 */
	constructor( tabsPlugin ) {
		this.name        = 'tabs';
		this.priority    = 90;
		this.tooltip     = 'Tabs';
		this.iconClasses = 'dashicons dashicons-block-default';
		this.supportUrl  = 'https://www.boldgrid.com/support/page-builder/tabs/';
		this.selectors   = [ '.boldgrid-tabs.boldgrid-section-wrap' ];
		this.allowNested = true;
		this.tabsPlugin  = tabsPlugin;

		this.panel = {
			title: 'Tabs',
			height: '575px',
			width: '450px'
		};
	}

	/**
	 * Initialize the control.
	 *
	 * Controls are initialized when the editor is loaded,
	 * But are not rendered until the panel is opened.
	 *
	 * @since 1.1.0
	 */
	init() {
		BG.$window.on( 'boldgrid_editor_preload', () => BG.Controls.registerControl( this ) );
	}

	/**
	 * Open menu event, fires when the user clicks on the option from the drop tab.
	 *
	 * @since 1.1.0
	 */
	onMenuClick() {
		this.openPanel();
	}

	/**
	 * Open the controls Panel.
	 *
	 * The control is renedered when the panel is opened.
	 *
	 * @since 1.1.0
	 */
	openPanel() {
		BG.Panel.clear();
		BG.Panel.open( this );

		this._createUI();
		BG.Panel.$element.find( '.panel-body' ).html( this.$control );

		this.$target = BG.Menu.getCurrentTarget();

		this._initColorControls();
		this._initAlignmentControl();
	}

	/**
	 * Initialize the color controls.
	 *
	 * Runs on panel open.
	 *
	 * @since 1.1.0
	 */
	_initColorControls() {
		var $colorInputs = this.$control.find( 'input.color-control' );

		$colorInputs.each( ( index, input ) => {
			var $input  = $( input ),
				prop    = $input.attr( 'data-property' ),
				$target = this.$target.find( '.nav-tabs' ),
				value   = $target.css( prop );

			$input.val( value );
			$input.siblings( 'label' ).css( 'background-color', value );
		} );
	}

	/**
	 * Initialize the Alignment Controls.
	 *
	 * Runs on panel open.
	 *
	 * @since 1.1.0
	 */
	_initAlignmentControl() {
		var $alignmentInputs = this.$control.find( 'input.alignment-control' ),
			alignment        = this.tabsPlugin.getAlignment( this.$target );

		$alignmentInputs.each( ( index, input ) => {
			var $input = $( input );

			if ( $input.val() === alignment ) {
				$input.prop( 'checked', true );
			}
		} );
	}

	/**
	 * Create a UI for the form.
	 *
	 * This is run on panel open, and is responsible
	 * for rendering the UI for the control, as well
	 * as populating default / previously saved values.
	 * This is also where the control change events are
	 * initially bound.
	 *
	 * @since 1.1.0
	 */
	_createUI() {
		var $control = $( '<div class="boldgrid-control tabs-control"></div>' );

		$control.append( this._renderTabList() );

		$control.append( alignmentTemplate );

		$control.append( colorTemplate );

		this.$control = $control;

		this.$control.find( '.ui-sortable' ).sortable( {
			handle: '.dashicons-move',
			update: ( event, ui ) => {
				this._updateTabList();
			}
		} );

		this._bindChanges();
	}

	/**
	 * Update the tab list.
	 *
	 * @since 1.1.0
	 */
	_updateTabList() {
		let $tabs          = BG.Menu.getCurrentTarget(),
			attr           = $tabs.attr( 'data-config' ),
			configs        = attr ? JSON.parse( attr ) : {},
			controlTabList = this.$control.find( 'li' ),
			newTabList     = [];

		controlTabList.each( ( index, tab ) => {
			let $tab   = $( tab ),
				title  = $tab.find( 'input[name=title]' ).val(),
				tabId  = $tab.find( 'input[name=id]' ).val(),
				target = $tab.find( 'input[name=target]' ).val();

			newTabList.push( {
				title: title,
				tabId: tabId,
				target: target
			} );
		} );

		configs.tabsList = newTabList;

		$tabs.attr( 'data-config', JSON.stringify( configs ) );

		this.tabsPlugin.initTabs( $tabs );
	}

	/**
	 * Render the Tab List.
	 *
	 * @since 1.1.0
	 *
	 * @returns {$} The tab list jQuery object.
	 */
	_renderTabList() {
		var $tabs       = BG.Menu.getCurrentTarget(),
			attr        = $tabs.attr( 'data-config' ),
			configs     = attr ? JSON.parse( attr ) : {},
			$tabControl = $( '<div class="tab-control"></div>' );

		$tabControl.append(
			`<div class="heading">
				<h3>Tab Labels and Ordering</h3>
				<a href="${this.supportUrl}" target="_blank">
					<span class="dashicons dashicons-editor-help"></span>
				</a>
			</div>`
		);
		$tabControl.append( '<ul class="ui-sortable"></ul>' );

		configs.tabsList.forEach( tab => {
			$tabControl.find( 'ul' ).append( this._renderTabControl( tab ) );
		} );

		$tabControl.append(
			'<button class="button button-primary add-tab"><span class="dashicons dashicons-plus"></span>Add Tab</button>'
		);

		return $tabControl;
	}

	/**
	 * Render Tab Control.
	 *
	 * This method renders a single draggable LI for a given
	 * tab nav item. It is used to render the tab list.
	 *
	 * @param {object} tab Object containing tab data.
	 * @returns {string} HTML for the tab control.
	 */
	_renderTabControl( tab ) {
		return `<li>
			<span class="dashicons dashicons-move"></span>
			<input name="title" type="text" value="${tab.title}"></input>
			<input name="id" type="hidden" value="${tab.tabId}"></input>
			<input name="target" type="hidden" value="${tab.target}"></input>
			<span data-tabId="${tab.tabId}" class="dashicons dashicons-trash"></span>
		</li>`;
	}

	/**
	 * Setup control change events.
	 *
	 * @since 1.1.0
	 *
	 * @param {boolean} bindAddNew Whether or not to bind the add new tab event.
	 */
	_bindChanges( bindAddNew = true ) {
		this._bindAlignmentChange();
		this._bindColorChange();
		this._bindTitleChange();
		this._bindRemoveTab();

		/*
		 * _bindChanges is fired inside of the _bindAddNewTab method,
		 * so we don't want to recursion here, so the option to not
		 * bind the add new tab event is available.
		 */
		if ( bindAddNew ) {
			this._bindAddNewTab();
		}
	}

	/**
	 * Bind the change event for the alignment.
	 *
	 * @since 1.1.0
	 */
	_bindAlignmentChange() {
		var $alignmentInputs = this.$control.find( 'input.alignment-control' );

		$alignmentInputs.off( 'change' );
		$alignmentInputs.on( 'change', event => {
			var $this = $( event.target ),
				value = $this.val();

			this.tabsPlugin.setAlignment( this.$target, value );
		} );
	}

	/**
	 * Bind color changes.
	 *
	 * @since 1.1.0
	 */
	_bindColorChange() {
		var $colorInputs = this.$control.find( 'input.color-control' );

		$colorInputs.off( 'change' );
		$colorInputs.on( 'change', event => {
			var $this   = $( event.target ),
				value   = $this.val(),
				type    = $this.attr( 'data-type' ),
				prop    = $this.attr( 'data-property' ),
				$target = this.$target.find( '.nav-tabs' );

			value = 'class' === type ? 'var( --color-' + value + ')' : value;

			// Set CSS property.
			$target.css( prop, value );

			// Set data attribute to ensure changes are saved.
			$target.attr( 'data-mce-style', $target.attr( 'style' ) );
		} );
	}

	/**
	 * Bind the change event for the title.
	 *
	 * @since 1.1.0
	 */
	_bindTitleChange() {
		var $titleInputs = this.$control.find( 'input[name="title"]' );

		$titleInputs.off( 'change' );
		$titleInputs.on( 'change', event => {
			this._updateTabList();
		} );
	}

	/**
	 * Bind the event for removing tabs.
	 *
	 * @since 1.1.0
	 */
	_bindRemoveTab() {
		var $removeButton = this.$control.find( '.dashicons-trash' );

		$removeButton.off( 'click' );
		$removeButton.on( 'click', event => {
			var $this       = $( event.target ),
				tabId       = $this.attr( 'data-tabId' ),
				$tabControl = $this.parents( 'li' );

			$tabControl.remove();

			this.tabsPlugin.removeTab( this.$target, tabId );
		} );
	}

	/**
	 * Bind the event for adding new tabs.
	 *
	 * @since 1.1.0
	 */
	_bindAddNewTab() {
		var $addNewTab = this.$control.find( 'button.add-tab' );

		$addNewTab.off( 'click' );
		$addNewTab.on( 'click', event => {
			var newTabIdNum  = Math.floor( Math.random() * 1000 + 1 ),
				newTabId     = 'tab-' + newTabIdNum,
				newTabTitle  = 'New Tab',
				newTabTarget = 'tab-' + newTabIdNum + '-content',
				tabConfig    = {
					tabId: newTabId,
					title: newTabTitle,
					target: newTabTarget
				};

			this.addNewTabControl( tabConfig, this );
			this.tabsPlugin.addNewTab( this.$target, tabConfig );

			this._bindChanges( false );
		} );
	}

	/**
	 * Add New Tab Control.
	 *
	 * @param {object} tabConfig Tab Config object.
	 */
	addNewTabControl( tabConfig ) {
		this.$control.find( 'ul' ).append( this._renderTabControl( tabConfig ) );
	}
}
