import './component/slider/library';
import '../scss/slider.scss';
import '../scss/tabs.scss';
import '../scss/single.scss';
import '../scss/post-list.scss';

import { Plugin as SliderPlugin } from './component/slider/plugin';
import { Plugin as TabsPlugin } from './component/tabs/plugin';

let $ = jQuery;

class Application {

	/**
	 * Instantiate the Application.
	 *
	 * @since 1.0.0
	 */
	init() {
		$( () => this.onLoad() );

		return this;
	}

	/**
	 * Run this on page load.
	 *
	 * @since 1.0.0
	 */
	onLoad() {
		this.slider = new SliderPlugin();
		this.slider.initPageSliders();

		this.tabs = new TabsPlugin();
		this.tabs.initPageTabs();
	}
}

window.BOLDGRID = window.BOLDGRID || {};
window.BOLDGRID.PPBP = new Application().init();
