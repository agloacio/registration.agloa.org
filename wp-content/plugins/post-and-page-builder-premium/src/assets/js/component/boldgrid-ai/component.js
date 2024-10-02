/**
 * BoldGrid AI Component.
 *
 * This file defines the Component class for the BoldGrid AI component.
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
 * @file   This files defines the Component class.
 * @author jamesros161
 * @since  1.2.0
 */

import { Control } from './control';
import { Plugin as BoldgridAiPlugin } from './plugin';

export class Component {
	/**
	 * Constructor
	 * 
	 * @since 1.2.0
	 */
	constructor() {
		this.boldgridAiPlugin = new BoldgridAiPlugin();
		this.control    = new Control( this.boldgridAiPlugin );

		this.control.init();
	}
}
