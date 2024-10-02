/**
 * BoldGrid AI Plugin.
 *
 * This file defines the Plugin class for the BoldGrid AI component.
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
 * @file   This files defines the Plugin class.
 * @author jamesros161
 * @since  1.2.0
 */
import { EventEmitter } from 'eventemitter3';
import { escapeHTML, escapeAttribute } from '@wordpress/escape-html';
import { decodeEntities } from '@wordpress/html-entities';
import { Spinner } from '@wordpress/components';
import { createRoot } from '@wordpress/element';

let $ = jQuery;

export class Plugin {
	/**
	 * Constructor.
	 *
	 * @since 1.2.0
	 */
	constructor() {
		this.configs      = BoldgridEditor.plugin_configs.boldgrid_ai;
		this.asset_server = BoldgridEditor.plugin_configs.asset_server;
		// For now, we want to force this to run on the dev server.
		this.asset_server = 'https://api-dev-jamesros.boldgrid.com';
		this.api_key      = BoldgridEditor.plugin_configs.api_key;
		this.aiProvider   = this.getProviderFromQueryString();

		this.event = new EventEmitter();
	}

	/**
	 * Get Provider from Query String.
	 * 
	 * Determines the the ai provider is set using the query string.
	 * 
	 * @since 1.2.0
	 * 
	 * @return {string} aiProvider
	 */
	getProviderFromQueryString() {
		var queryString = window.location.search;

		if ( queryString.toLowerCase().includes( 'ai=bgai' ) ) {
			this.configs.ai_provider = 'boldgridAi';
			return 'boldgridAi';
		} else if ( queryString.toLowerCase().includes( 'ai=openai' ) ) {
			this.configs.ai_provider = 'openai';
			return 'openai';
		} else if ( queryString.toLowerCase().includes( 'ai=jrosai' ) ) {
			return 'jrosai';
		} else {
			return this.configs.ai_provider;
		}
	}

	/**
	 * Encode data as a FormData object.
	 * 
	 * @param {object} data
	 * 
	 * @since 1.2.0
	 * 
	 * @return {FormData} formData
	 */
	formDataEncode( data ) {
		const formData = new FormData();

		for ( const key in data ) {		
			formData.append( key, data[ key ] );
		}

		return formData;
	}

	/**
	 * Create an overlay element and 
	 * append it to the text node's parent.
	 *
	 * @param {DOMNode} textNode 
	 * 
	 * @since 1.2.0
	 * 
	 * @return {DOMElement} overlay element.
	 */
	addOverlay( textNode ) {
		let overlay     = document.createElement( 'div' );
		let spinnerRoot = document.createElement( 'div' );
		let overlayTarget = 3 === textNode.nodeType ? textNode.parentElement : textNode;
		let isCol = textNode.className.includes( 'col-' );
		let top = overlayTarget.offsetTop;
		let left = overlayTarget.offsetLeft;

		if ( isCol ) {
			top = 0;
			left = 0;
		}

		overlay.classList     = 'boldgrid-ai-overlay bgai';
		spinnerRoot.classList = 'boldgrid-ai-spinner bgai';

		overlay.style.cssText = `
			position: absolute;
			top: ${ top }px;
			left: ${ left }px;
			width: ${ overlayTarget.offsetWidth }px;
			height: ${ overlayTarget.offsetHeight }px;
			z-index: 1000;`;

		overlay.appendChild( spinnerRoot );

		createRoot( spinnerRoot ).render( <Spinner /> );

		overlayTarget.appendChild( overlay );
				
		return overlay;
	}

	/**
	 * Remove spinner from overlay
	 *
	 * @param {DOMNode} textNode
	 * 
	 * @since 1.2.0
	 */
	removeSpinner( overlay ) {
		let spinner = overlay.querySelector( '.boldgrid-ai-spinner' );

		if ( spinner ) {
			spinner.remove();
		}
	}

	/**
	 * Maybe Add Undo if all
	 * overlays are removed.
	 * 
	 * @since 1.2.0
	 */
	maybeAddUndo() {
		let overlays = BOLDGRID.EDITOR.mce.dom.doc.querySelectorAll( '.boldgrid-ai-overlay' );

		if ( 0 === overlays.length ) {
			BOLDGRID.EDITOR.mce.undoManager.add();
			BOLDGRID.EDITOR.mce.execCommand( 'mceCleanup' );
		}
	}

	/**
	 * Handle AI Request
	 * 
	 * @since 1.2.0
	 *
	 * @param {string} endpoint Endpoint URL
	 * @param {object} options fetch request options
	 * @param {DOMNode} textNode the text node to update
	 * @param {string} originalText the original text
	 */
	handleRequest( endpoint, options, textNode, originalText ) {
		var overlay          = this.addOverlay( textNode );
		this.lastRequestMade = [ endpoint, options, textNode, originalText ];

		fetch( endpoint, options )
			.then( response => response.json() )
			.then( data => {
				this.removeSpinner( overlay );
				this.updateTextNode( data.result.data, textNode, originalText, overlay );
				this.updateOverlayNode( data.result.data, textNode, overlay, options );
			} )
			.catch( error => {
				console.warn( error );
				this.removeSpinner( overlay );
				overlay.remove();
			} );
	}

	/**
	 * Handles Feedback Requests.
	 *
	 * @since 1.2.0
	 *
	 * @param {string} originalText The original text string.
	 * @param {string} newText The new text string.
	 * @param {string} action The name of the action performed.
	 * @param {string} endpoint The endpoint of the action performed.
	 */
	handleFeedbackRequest( originalText, newText, action, endpoint ) {
		var url     = this.asset_server + '/ai/text/feedback',
			options = {
				method: 'POST',
				body: this.formDataEncode(
					{
						key: this.api_key,
						originalText,
						newText,
						action,
						messageType: endpoint
					}
				),
			};

		fetch( url, options )
			.then( response => response.json() )
			.catch( error => {
				console.warn( error );
			} );
	
	}

	/**
	 * On Edit Action
	 *
	 * @since 1.2.0
	 *
	 * @param {string} action action to perform
	 * @param {string} endpoint the endpoint key
	 * @param {Popover} Popover the popover instance
	 */
	onEditAction( action, endpoint, Popover ) {
		var url      = this.asset_server + '/ai/text/quick-edit',
			element  = Popover.$target[ 0 ];

		let originalText = 3 === element.nodeType ? element.nodeValue : element.innerHTML;

		if ( ! originalText ) {
			return;
		}

		const options = {
			method: 'POST',
			body: this.formDataEncode(
				{
					key: this.api_key,
					originalText,
					action,
					messageType: endpoint,
					aiProvider: this.aiProvider
				}
			),
		};

		this.handleRequest( url, options, element, originalText, action );
	}

	/**
	 * On Edit Action
	 *
	 * @since 1.2.3
	 *
	 * @param {string} action action to perform
	 * @param {string} endpoint the endpoint key
	 * @param {Popover} Popover the popover instance
	 */
	onCustomAction( action, endpoint, Popover ) {
		var url      = this.asset_server + '/ai/text/custom',
			element  = Popover.$target[ 0 ];

		let originalText = 3 === element.nodeType ? element.nodeValue : element.innerHTML;

		if ( ! originalText ) {
			return;
		}

		const options = {
			method: 'POST',
			body: this.formDataEncode(
				{
					key: this.api_key,
					originalText,
					prompt: endpoint,
					aiProvider: this.aiProvider
				}
			),
		};

		this.handleRequest( url, options, element, originalText, action );
	}

	/**
	 * On New Text Action
	 * 
	 * The only parameter used in this function
	 * is the Popover instance, but this method
	 * is called dynamically in a click event,
	 * and all three parameters are passed.
	 *
	 * @param {string} action action to perform
	 * @param {$JQuery} endpointKey endpoint key
	 * @param {Popover} Popover the popover instance
	 * 
	 * @since 1.2.0
	 */
	onNewTextAction( action, endpointKey, Popover ) {
		var $target = Popover.$target,
			bgAiControl = BG.Controls.get( 'boldgrid-ai' );
	
		bgAiControl.awaitOpenPanel( $target );
	}

	/**
	 * On Review Content Action
	 * 
	 * The only parameter used in this function
	 * is the Popover instance, but this method
	 * is called dynamically in a click event,
	 * and all three parameters are passed.
	 *
	 * @param {string} action action to perform
	 * @param {$JQuery} endpointKey endpoint key
	 * @param {Popover} Popover the popover instance
	 * 
	 * @since 1.2.0
	 */
	onReviewAction( action, endpoint, Popover ) {
		var $target = Popover.$target,
			bgAiControl = BG.Controls.get( 'boldgrid-ai' );

		bgAiControl.awaitOpenPanel( $target, 'BoldgridAiReview' );
	}

	/**
	 * Get Action Container
	 *
	 * @param {string} newText New text string
	 * @param {DOMNode} textNode Text Node
	 * @param {DOMNode} overlay Overlay Node
	 * @param {object} options fetch request options
	 *
	 * @since 1.2.0
	 *
	 * @returns {DOMElement} actionContainer
	 */
	getActionContainer( newText, textNode, overlay, options ) {
		let actionContainer = document.createElement( 'div' ),
			confirmAction   = document.createElement( 'span' ),
			cancelAction    = document.createElement( 'span' ),
			retryAction     = document.createElement( 'span' );

		actionContainer.classList = 'boldgrid-ai-action-container bgai';
		confirmAction.classList   = 'dashicons dashicons-yes boldgrid-ai-action-confirm bgai';
		cancelAction.classList    = 'dashicons dashicons-no boldgrid-ai-action-cancel bgai';
		retryAction.classList     = 'dashicons dashicons-image-rotate boldgrid-ai-action-retry bgai';

		actionContainer.appendChild( confirmAction );
		actionContainer.appendChild( cancelAction );
		actionContainer.appendChild( retryAction );

		confirmAction.addEventListener( 'click', () => {
			this.doConfirmAction( newText, textNode, overlay, options );
		} );

		cancelAction.addEventListener( 'click', () => {
			this.doCancelAction( textNode, overlay );
		} );

		retryAction.addEventListener( 'click', () => {
			overlay.remove();
			this.doRetryAction( textNode, overlay );
		} );

		return actionContainer;
	}

	/**
	 * Do Confirm Action
	 * 
	 * @param {DOMNode} textNode Text Node
	 * @param {DOMElement} overlay Overlay Node
	 * 
	 * @since 1.2.0
	 */
	doConfirmAction( newText, textNode, overlay, options ) {
		var targetElement = 3 === textNode.nodeType ? textNode.parentElement : textNode,
			originalText  = targetElement.getAttribute( 'data-original-text' ),
			action        = options.body.get( 'action' ),
			endpoint      = options.body.get( 'messageType' );

		this.handleFeedbackRequest( originalText, newText, action, endpoint );

		overlay.remove();
		targetElement.classList.remove( 'pending-ai-confirmation' );
		targetElement.removeAttribute( 'data-original-text' );
		
		this.maybeAddUndo();
	};

	/**
	 * Do Cancel Action
	 * 
	 * @param {DOMNode} textNode Text Node
	 * @param {DOMElement} overlay Overlay Node
	 * 
	 * @since 1.2.0
	 */
	doCancelAction( textNode, overlay ) {
		var isTextNode = 3 === textNode.nodeType;
		overlay.remove();
				
		if ( isTextNode ) {
			textNode.nodeValue = textNode.parentElement.getAttribute( 'data-original-text' );
			textNode.parentElement.removeAttribute( 'data-original-text' );
			textNode.parentElement.classList.remove( 'pending-ai-confirmation' );
		} else {
			textNode.innerHTML = decodeEntities( textNode.getAttribute( 'data-original-text' ) );
			textNode.removeAttribute( 'data-original-text' );
			textNode.classList.remove( 'pending-ai-confirmation' );
		}		

		this.maybeAddUndo();
	}

	/**
	 * Do Retry Action
	 * 
	 * @since 1.2.0
	 */
	doRetryAction() {
		this.handleRequest( ...this.lastRequestMade );
	}

	/**
	 * Update the Overlay Node.
	 * 
	 * @param {string} newText New text string
	 * @param {DOMNode} textNode Text Node
	 * @param {DOMNode} overlay Overlay Node
	 * @param {object} options fetch request options
	 * 
	 * @since 1.2.0
	 */
	updateOverlayNode( newText, textNode, overlay, options ) {
		var targetElement = 3 === textNode.nodeType ? textNode.parentElement : textNode,
			top,
			left;

		overlay.appendChild( this.getActionContainer( newText, textNode, overlay, options ) );

		if ( targetElement.className.includes( 'col-' ) ||
			targetElement.className.includes( 'row' ) ||
			targetElement.className.includes( 'boldgrid-section' ) ) {
			top = 0;
			left = 0;
		} else {
			top = targetElement.offsetTop;
			left = targetElement.offsetLeft;
		}

		overlay.style.top      = top + 'px';
		overlay.style.left     = left + 'px';
		overlay.style.width    = targetElement.offsetWidth + 'px';
		overlay.style.height   = targetElement.offsetHeight + 'px';

		overlay.classList.add( 'pending-confirmation' );
		targetElement.classList.add( 'pending-ai-confirmation' );
	}

	/**
	 * Update Text Node
	 *
	 * @param {string} text New text string
	 * @param {DOMNode} textNode Text Node
	 * @param {string} originalText Original text string
	 * @param {DOMNode} overlay Overlay
	 * 
	 * @since 1.2.0
	 */
	updateTextNode( text, textNode, originalText, overlay ) {
		var nodeIsText = 3 === textNode.nodeType;
	
		if ( nodeIsText ) {
			textNode.nodeValue = escapeHTML( text );
			textNode.parentElement.setAttribute( 'data-original-text', originalText );
		} else {
			textNode.innerHTML = text;
			textNode.appendChild( overlay );
			textNode.setAttribute( 'data-original-text', escapeAttribute( originalText ) );
		}
	}
}
