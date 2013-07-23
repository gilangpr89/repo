Ext.define(MyIndo.getNameSpace('controller.Master.FundingSources'), {
	extend: MyIndo.getNameSpace('controller.Master.Main'),

	requires: [
	MyIndo.getNameSpace('view.Master.FundingSources.Add'),
	MyIndo.getNameSpace('view.Master.FundingSources.Update'),
	MyIndo.getNameSpace('view.Master.FundingSources.Filter')
	],

	init: function() {
		this.control({
			'fundingsourcesview button': {
				click: this.onButtonClicked
			},
			'fundingsourcesaddwindow button': {
				click: this.onButtonClicked
			},
			'fundingsourcesupdatewindow button': {
				click: this.onButtonClicked
			},
			'fundingsourcesfilterwindow button': {
				click: this.onButtonClicked
			}
		});
	}
});