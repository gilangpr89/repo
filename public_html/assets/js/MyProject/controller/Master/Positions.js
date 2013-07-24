Ext.define(MyIndo.getNameSpace('controller.Master.Positions'), {
	extend: MyIndo.getNameSpace('controller.Master.Main'),

	requires: [
	MyIndo.getNameSpace('view.Master.Positions.Add'),
	MyIndo.getNameSpace('view.Master.Positions.Update'),
	MyIndo.getNameSpace('view.Master.Positions.Filter')
	],

	init: function() {
		this.control({
			'positionsview button': {
				click: this.onButtonClicked
			},
			'positionsaddwindow button': {
				click: this.onButtonClicked
			},
			'positionsupdatewindow button': {
				click: this.onButtonClicked
			},
			'positionsfilterwindow button': {
				click: this.onButtonClicked
			}
		});
	}
});