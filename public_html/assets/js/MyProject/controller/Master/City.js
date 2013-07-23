Ext.define(MyIndo.getNameSpace('controller.Master.City'), {
	extend: MyIndo.getNameSpace('controller.Master.Main'),

	requires: [
	MyIndo.getNameSpace('view.Master.City.Add'),
	MyIndo.getNameSpace('view.Master.City.Update'),
	MyIndo.getNameSpace('view.Master.City.Filter')
	],

	init: function() {
		this.control({
			'cityview button': {
				click: this.onButtonClicked
			},
			'cityaddwindow button': {
				click: this.onButtonClicked
			},
			'cityupdatewindow button': {
				click: this.onButtonClicked
			},
			'cityfilterwindow button': {
				click: this.onButtonClicked
			}
		});
	}
});