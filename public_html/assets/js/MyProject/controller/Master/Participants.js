Ext.define(MyIndo.getNameSpace('controller.Master.Participants'), {
	extend: MyIndo.getNameSpace('controller.Master.Main'),

	requires: [
	MyIndo.getNameSpace('view.Master.Participants.Add'),
	MyIndo.getNameSpace('view.Master.Participants.Update'),
	MyIndo.getNameSpace('view.Master.Participants.Filter'),
	//MyIndo.getNameSpace('view.Report.Participants')
	],

	init: function() {
		this.control({
			'participantsview button': {
				click: this.onButtonClicked
			},
//			'participantsview button[action=report-participants]': {
//				click: this.reportParticipants
//			},
//			'reportparticipantswindow button[action=add]': {
//				click: this.onManageReportParticipant
//			},
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
	},
});