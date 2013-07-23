Ext.define(MyIndo.getNameSpace('controller.Master.AreaLevels'), {
	extend: MyIndo.getNameSpace('controller.Master.Main'),

	requires: [
	MyIndo.getNameSpace('view.Master.AreaLevels.Add'),
	MyIndo.getNameSpace('view.Master.AreaLevels.Update'),
	MyIndo.getNameSpace('view.Master.AreaLevels.Filter')
	],

	init: function() {
		this.control({
			'arealevelsview button': {
				click: this.onButtonClicked
			},
			'arealevelsaddwindow button': {
				click: this.onButtonClicked
			},
			'arealevelsupdatewindow button': {
				click: this.onButtonClicked
			},
			'arealevelsfilterwindow button': {
				click: this.onButtonClicked
			}
		});
	}
});