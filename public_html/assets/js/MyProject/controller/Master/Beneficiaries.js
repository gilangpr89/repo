Ext.define(MyIndo.getNameSpace('controller.Master.Beneficiaries'), {
	extend: MyIndo.getNameSpace('controller.Master.Main'),

	requires: [
	MyIndo.getNameSpace('view.Master.Beneficiaries.Add'),
	MyIndo.getNameSpace('view.Master.Beneficiaries.Update'),
	MyIndo.getNameSpace('view.Master.Beneficiaries.Filter')
	],

	init: function() {
		this.control({
			'beneficiariesview button': {
				click: this.onButtonClicked
			},
			'beneficiariesaddwindow button': {
				click: this.onButtonClicked
			},
			'beneficiariesupdatewindow button': {
				click: this.onButtonClicked
			},
			'beneficiariesfilterwindow button': {
				click: this.onButtonClicked
			}
		});
	}
});