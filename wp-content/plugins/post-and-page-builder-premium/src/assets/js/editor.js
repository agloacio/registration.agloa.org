import { SliderComponent } from './component/slider';
import { TabsComponent } from './component/tabs';
import { BoldgridAiComponent } from './component/boldgrid-ai';

export class Editor {
	init() {
		this.slider = new SliderComponent().init();
		this.tabs = new TabsComponent().init();
		this.boldgridAi = new BoldgridAiComponent();
	}
}

new Editor().init();
