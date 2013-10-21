Ext.define(MyIndo.getNameSpace('controller.Report.Participant'), {
	extend: MyIndo.getNameSpace('controller.Report'),

	requires: [
	MyIndo.getNameSpace('view.Report.Participants.Detail'),
	MyIndo.getNameSpace('view.Report.Participants.Filter'),
	MyIndo.getNameSpace('view.Report.Participants.View')
	],

	init: function() {
		this.control({
			'reportparticipantsview button': {
				click: this.onButtonClicked
			},
			'reportparticipantsdetail button': {
				click: this.onButtonClicked
			},
			'reportparticipantsfilterwindow button':{ 
				click:this.onButtonClicked
			}
		});
	},
	
	printParticipant: function(record) {
		var parent = record.up().up();
		var grid = parent.items.get(0);
		var selected = parent.getSelectionModel().getSelection();
		var store = Ext.create(MyIndo.getNameSpace('store.Report.ParticipantTrainings'));
		if(selected.length > 0) {
			store.proxy.extraParams = {
					PARTICIPANTS_ID: selected[0].data.ID
			};
			Ext.create(MyIndo.getNameSpace('view.Report.Participants.Detail'), {
				participantsData: selected[0].data,
				store: store
			}).show();
			store.load();
		} else {
			Ext.Msg.alert('Application Error', 'You did not select any participant.');
		}
	},
	
	doPrintParticipant: function(record) {
		var parent = record.up().up();
		var me = this;
		Ext.Msg.confirm('Print Participant Report', 'Are you sure want to print this data ?', function(btn) {
			if(btn == 'yes') {
				if(typeof(parent.participantsData.ID) !== 'undefined') {
					me.showLoadingWindow();
					Ext.Ajax.request({
						url: MyIndo.siteUrl('participants/request/print'),
						params: parent.participantsData,
						success: function(r) {
							var json = Ext.decode(r.responseText);
							me.closeLoadingWindow();
							if(me.isLogin(json)) {
								if(me.isSuccess(json)) {
									window.open(MyIndo.siteUrl(json.data.path + json.data.fileName));
								}
							}
						}
					});
				} else {
					Ext.Msg.alert('Application Error', 'Invalid participant.');
				}
			}
		});
	}
});