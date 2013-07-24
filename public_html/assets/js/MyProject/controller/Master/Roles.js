Ext.define(MyIndo.getNameSpace('controller.Master.Roles'), {
	extend: MyIndo.getNameSpace('controller.Master.Main'),

	requires: [
	MyIndo.getNameSpace('view.Master.Roles.Add'),
	MyIndo.getNameSpace('view.Master.Roles.Update'),
	MyIndo.getNameSpace('view.Master.Roles.Filter')
	],

	init: function() {
		this.control({
			'rolesview button': {
				click: this.onButtonClicked
			},
			'rolesaddwindow button': {
				click: this.onButtonClicked
			},
			'rolesupdatewindow button': {
				click: this.onButtonClicked
			},
			'rolesfilterwindow button': {
				click: this.onButtonClicked
			}
		});
	}
});