Ext.define(MyIndo.getNameSpace('controller.Master.Participants'), {
	extend: MyIndo.getNameSpace('controller.Master.Main'),

	requires: [
	MyIndo.getNameSpace('view.Master.Participants.Add'),
	MyIndo.getNameSpace('view.Master.Participants.Update'),
	MyIndo.getNameSpace('view.Master.Participants.Filter')
	],

	init: function() {
		this.control({
			'participantsview button': {
				click: this.onButtonClicked
			},
			'participantsaddwindow button': {
				click: this.onButtonClicked
			},
			'participantsupdatewindow button': {
				click: this.onButtonClicked
			},
			'participantsfilterwindow button': {
				click: this.onButtonClicked
			}
		});
	}
});