Ext.define(MyIndo.getNameSpace('controller.Transaction.Trainings'), {
	extend: MyIndo.getNameSpace('controller.Transaction'),

	requires: [
	MyIndo.getNameSpace('view.Transaction.Trainings.Add')
	],

	init: function() {
		this.control({
			'trtrainingsview button': {
				click: this.onButtonClicked
			},
			'trtrainingsaddwindow button': {
				click: this.onButtonClicked
			},
			'trtrainingsupdatewindow button': {
				click: this.onButtonClicked
			},
			'trtrainingsfilterwindow button': {
				click: this.onButtonClicked
			}
		});
	}
});