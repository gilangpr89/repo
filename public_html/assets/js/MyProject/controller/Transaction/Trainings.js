Ext.define(MyIndo.getNameSpace('controller.Transaction.Trainings'), {
	extend: MyIndo.getNameSpace('controller.Transaction'),

	requires: [
	MyIndo.getNameSpace('view.Transaction.Trainings.Add'),
	MyIndo.getNameSpace('view.Transaction.Trainings.Update'),
	MyIndo.getNameSpace('view.Transaction.Trainings.ManageParticipants'),
	MyIndo.getNameSpace('view.Transaction.Trainings.AddParticipants'),
	MyIndo.getNameSpace('view.Transaction.Trainings.UpdateParticipants')
	],

	init: function() {
		this.control({
			'trtrainingsview button': {
				click: this.onButtonClicked
			},
			'trtrainingsview button[action=manage]': {
				click: this.manageParticipants
			},
			'managetrtrainingsparticipantswindow button[action=add]': {
				click: this.onManageAddParticipant
			},
			'managetrtrainingsparticipantswindow button[action=update]': {
				click: this.onManageUpdateParticipant
			},
			'managetrtrainingsparticipantswindow button[action=delete]': {
				click: this.onManageDeleteParticipant
			},
			'manageparticipantsupdatewindow button[action=update-save]': {
				click: this.onManageSaveUpdateParticipant
			},
			'manageparticipantsaddwindow button[action=add-save]': {
				click: this.onAddSaveParticipant
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
		var parent = record.up().up();
		var selected = parent.getSelectionModel().getSelection();
		if(selected.length > 0) {
			var store = Ext.create(MyIndo.getNameSpace('store.Transaction.TrainingParticipants'));
			var manageParticipantsWindow = Ext.create(MyIndo.getNameSpace('view.Transaction.Trainings.ManageParticipants'), {
				store: store,
				trTrainingId: selected[0].data.ID
			});
			store.load();
			manageParticipantsWindow.show();
		} else {
			Ext.Msg.alert('Application Error', 'You did not select any Training.');
		}
	},

	onManageAddParticipant: function(record) {
		var parent = record.up().up();
		var trTrainingId = parent.trTrainingId;
		var addWindow = Ext.create(MyIndo.getNameSpace('view.Transaction.Trainings.AddParticipants'));
		var form = addWindow.items.items[0].getForm();
		form.setValues({
			TRAINING_ID: trTrainingId
		});
		addWindow.show();
	},

	onAddSaveParticipant: function(record) {
		var parent = record.up().up();
		var form = parent.items.items[0].getForm();
		var me = this;
		if(form.isValid()) {
			me.showLoadingWindow();
			form.submit({
				success: function(act, res) {
					var json = Ext.decode(res.response.responseText);
					me.closeLoadingWindow();
					if(me.isLogin(json)) {
						Ext.Msg.alert('Message', 'Data successfully saved.');
						var mainContent = Ext.getCmp('manage-participant-grid');
						var store = mainContent.getStore();
						store.proxy.extraParams = {};
						store.load();
						form.reset();
					}
				},
				failure: function(act, res) {
					var json = Ext.decode(res.response.responseText);
					me.closeLoadingWindow();
					if(me.isLogin(json)) {
						Ext.Msg.alert('Application Error', '<strong>Error Code</strong>: ' + json.error_code + '<br/><strong>Message</strong>: ' + json.error_message);
					}
				}
			});
		} else {
			Ext.Msg.alert('Application Error', 'Please complete form first.');
		}
	},

	onManageUpdateParticipant: function(record) {
		var parent = record.up().up();
		var grid = parent.items.items[0];
		var selected = grid.getSelectionModel().getSelection();
		var me = this;
		if(selected.length > 0) {
			var data = selected[0].data;
			var updateWindow = Ext.create(MyIndo.getNameSpace('view.Transaction.Trainings.UpdateParticipants'));
			var form = updateWindow.items.items[0].getForm();
			form.setValues(data);
			updateWindow.show();
		} else {
			Ext.Msg.alert('Application Error', 'You did not select any participant.');
		}
	},

	onManageSaveUpdateParticipant: function(record) {
		var parent = record.up().up();
		var form = parent.items.items[0].getForm();
		var me = this;
		if(form.isValid()) {
			Ext.Msg.confirm('Update Participant', 'Are you sure want to update this participant ?', function(btn) {
				if(btn == 'yes') {
					me.showLoadingWindow();
					form.submit({
						success: function(act, res) {
							var json = Ext.decode(res.response.responseText);
							me.closeLoadingWindow();
							if(me.isLogin(json)) {
								Ext.Msg.alert('Message', 'Data successfully saved.');
								var mainContent = Ext.getCmp('manage-participant-grid');
								var store = mainContent.getStore();
								store.proxy.extraParams = {};
								store.load();
								parent.close();
							}
						},
						failure: function(act, res) {
							var json = Ext.decode(res.response.responseText);
							me.closeLoadingWindow();
							if(me.isLogin(json)) {
								Ext.Msg.alert('Application Error', '<strong>Error Code</strong>: ' + json.error_code + '<br/><strong>Message</strong>: ' + json.error_message);
							}
						}
					});
				}
			});
		} else {
			Ext.Msg.alert('Application Error', 'Please complete form first.');
		}
	},

	onManageDeleteParticipant: function(record) {
		var parent = record.up().up();
		var grid = parent.items.items[0];
		var selected = grid.getSelectionModel().getSelection();
		var me = this;
		if(selected.length > 0) {
			Ext.Msg.confirm('Remove Participant', 'Are you sure want to remove this participant ?', function(btn) {
				if(btn == 'yes') {
					me.showLoadingWindow();
					Ext.Ajax.request({
						url: MyIndo.siteUrl('trainingparticipants/request/destroy'),
						params: selected[0].data,
						success: function(r) {
							var json = Ext.decode(r.responseText);
							me.closeLoadingWindow();
							if(me.isLogin(json)) {
								if(me.isSuccess(json)) {
									var mainContent = Ext.getCmp('manage-participant-grid');
									var store = mainContent.getStore();
									store.load();
									Ext.Msg.alert('Delete', 'User successfully deleted.');
								}
							}
						}
					})
				}
			});
		} else {
			Ext.Msg.alert('Application Error', 'You did not select any participant.');
		}
	}
});