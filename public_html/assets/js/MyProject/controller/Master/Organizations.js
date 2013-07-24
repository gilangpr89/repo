Ext.define(MyIndo.getNameSpace('controller.Master.Organizations'), {
	extend: MyIndo.getNameSpace('controller.Master.Main'),

	requires: [
	MyIndo.getNameSpace('view.Master.Organizations.Add'),
	MyIndo.getNameSpace('view.Master.Organizations.Update'),
	MyIndo.getNameSpace('view.Master.Organizations.Filter')
	],

	init: function() {
		this.control({
			'organizationsview button': {
				click: this.onButtonClicked
			},
			'organizationsaddwindow button': {
				click: this.onButtonClicked
			},
			'organizationsupdatewindow button': {
				click: this.onButtonClicked
			},
			'organizationsfilterwindow button': {
				click: this.onButtonClicked
			}
		});
	}
});