Ext.define(MyIndo.getNameSpace('controller.Transaction.Trainings'), {
	extend: MyIndo.getNameSpace('controller.Transaction'),

	requires: [
	MyIndo.getNameSpace('view.Transaction.Trainings.Add'),
	MyIndo.getNameSpace('view.Transaction.Trainings.ManageParticipants')
	],

	init: function() {
		this.control({
			'trtrainingsview button': {
				click: this.onButtonClicked
			},
			'trtrainingsview button[action=manage]': {
				click: this.manageParticipants
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
	},

	manageParticipants: function(record) {
		var manageParticipantsWindow = Ext.create(MyIndo.getNameSpace('view.Transaction.Trainings.ManageParticipants'));
		manageParticipantsWindow.show();
	}
});