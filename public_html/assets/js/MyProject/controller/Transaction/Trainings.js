Ext.define(MyIndo.getNameSpace('controller.Transaction.Trainings'), {
	extend: MyIndo.getNameSpace('controller.Transaction'),

	requires: [
	MyIndo.getNameSpace('view.Transaction.Trainings.Add'),
	MyIndo.getNameSpace('view.Transaction.Trainings.Update'),
	MyIndo.getNameSpace('view.Transaction.Trainings.ManageParticipants'),
	MyIndo.getNameSpace('view.Transaction.Trainings.AddParticipants'),
	MyIndo.getNameSpace('view.Transaction.Trainings.UpdateParticipants'),

	MyIndo.getNameSpace('view.Transaction.Trainings.ManageTrainers'),
	MyIndo.getNameSpace('view.Transaction.Trainings.AddTrainers'),
	MyIndo.getNameSpace('view.Transaction.Trainings.UpdateTrainers'),
	MyIndo.getNameSpace('view.Transaction.Trainings.Modules'),
	MyIndo.getNameSpace('view.Transaction.Trainings.UploadModule')
	],

	init: function() {
		this.control({
			'trtrainingsview button': {
				click: this.onButtonClicked
			},
			'trtrainingsview button[action=manage-participants]': {
				click: this.manageParticipants
			},
			'trtrainingsview button[action=manage-trainers]': {
				click: this.manageTrainers
			},
			'trtrainingsview button[action=training-modules]': {
				click: this.trainingModules
			},

			/* Participants */
			'managetrtrainingparticipantswindow button[action=add]': {
				click: this.onManageAddParticipant
			},
			'managetrtrainingparticipantswindow button[action=update]': {
				click: this.onManageUpdateParticipant
			},
			'managetrtrainingparticipantswindow button[action=delete]': {
				click: this.onManageDeleteParticipant
			},
			'manageparticipantsupdatewindow button[action=update-save]': {
				click: this.onManageSaveUpdateParticipant
			},
			'manageparticipantsaddwindow button[action=add-save]': {
				click: this.onAddSaveParticipant
			},
			/* End of : Participants */

			'managetrtrainingtrainerswindow button[action=add]': {
				click: this.onManageAddTrainer
			},
			'managetrtrainingtrainerswindow button[action=update]': {
				click: this.onManageUpdateTrainer
			},
			'managetrtrainingtrainerswindow button[action=delete]': {
				click: this.onManageDeleteTrainer
			},
			'managetrainersaddwindow button[action=add-save]': {
				click: this.onAddSaveTrainer
			},
			'managetrainerupdatewindow button[action=update-save]': {
				click: this.onManageSaveUpdateTrainer
			},

			'trtrainingsaddwindow button': {
				click: this.onButtonClicked
			},
			'trtrainingsupdatewindow button': {
				click: this.onButtonClicked
			},
			'trtrainingsfilterwindow button': {
				click: this.onButtonClicked
			},

			/* Training Modules */
			'trainingmodules button': {
				click: this.onTrainingModulesButtonClicked
			},

			/* Training Upload Module Window */
			'traininguploadmodules button': {
				click: this.onTrainingModulesButtonClicked
			}
		});
	},

	manageParticipants: function(record) {
		var parent = record.up().up();
		var selected = parent.getSelectionModel().getSelection();
		if(selected.length > 0) {
			var store = Ext.create(MyIndo.getNameSpace('store.Transaction.TrainingParticipants'));
			store.proxy.extraParams.TRAINING_ID = selected[0].data.ID;
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
			Ext.Msg.confirm('Save Participant', 'Are you sure want to save this data ?', function(btn) {
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
								var TRAINING_ID = store.proxy.extraParams.TRAINING_ID;
								store.proxy.extraParams = {};
								store.proxy.extraParams.TRAINING_ID = TRAINING_ID;
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
								var TRAINING_ID = store.proxy.extraParams.TRAINING_ID;
								store.proxy.extraParams = {};
								store.proxy.extraParams.TRAINING_ID = TRAINING_ID;
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
									var TRAINING_ID = store.proxy.extraParams.TRAINING_ID;
									store.proxy.extraParams = {};
									store.proxy.extraParams.TRAINING_ID = TRAINING_ID;
									store.load();
									Ext.Msg.alert('Delete', 'Participant successfully deleted.');
								}
							}
						}
					})
				}
			});
		} else {
			Ext.Msg.alert('Application Error', 'You did not select any participant.');
		}
	},

	/* Trainers */
	manageTrainers: function(record) {
		var parent = record.up().up();
		var selected = parent.getSelectionModel().getSelection();
		if(selected.length > 0) {
			var store = Ext.create(MyIndo.getNameSpace('store.Transaction.TrainingTrainers'));
			store.proxy.extraParams.TRAINING_ID = selected[0].data.ID;
			var manageTrainersWindow = Ext.create(MyIndo.getNameSpace('view.Transaction.Trainings.ManageTrainers'), {
				store: store,
				trTrainingId: selected[0].data.ID
			});
			store.load();
			manageTrainersWindow.show();
		} else {
			Ext.Msg.alert('Application Error', 'You did not select any Training.');
		}
	},

	onManageAddTrainer: function(record) {
		var parent = record.up().up();
		var trTrainingId = parent.trTrainingId;
		var addWindow = Ext.create(MyIndo.getNameSpace('view.Transaction.Trainings.AddTrainers'));
		var form = addWindow.items.items[0].getForm();
		form.setValues({
			TRAINING_ID: trTrainingId
		});
		addWindow.show();
	},

	onAddSaveTrainer: function(record) {
		var parent = record.up().up();
		var form = parent.items.items[0].getForm();
		var me = this;
		if(form.isValid()) {
			Ext.Msg.confirm('Save Trainer', 'Are you sure want to save this data ?', function(btn) {
				if(btn == 'yes') {
					me.showLoadingWindow();
					form.submit({
						success: function(act, res) {
							var json = Ext.decode(res.response.responseText);
							me.closeLoadingWindow();
							if(me.isLogin(json)) {
								Ext.Msg.alert('Message', 'Data successfully saved.');
								var mainContent = Ext.getCmp('manage-trainer-grid');
								var store = mainContent.getStore();
								var TRAINING_ID = store.proxy.extraParams.TRAINING_ID;
								store.proxy.extraParams = {};
								store.proxy.extraParams.TRAINING_ID = TRAINING_ID;
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
				}
			});
		} else {
			Ext.Msg.alert('Application Error', 'Please complete form first.');
		}
	},

	onManageUpdateTrainer: function(record) {
		var parent = record.up().up();
		var grid = parent.items.items[0];
		var selected = grid.getSelectionModel().getSelection();
		var me = this;
		if(selected.length > 0) {
			var data = selected[0].data;
			var updateWindow = Ext.create(MyIndo.getNameSpace('view.Transaction.Trainings.UpdateTrainers'));
			var form = updateWindow.items.items[0].getForm();
			form.setValues(data);
			updateWindow.show();
		} else {
			Ext.Msg.alert('Application Error', 'You did not select any trainer.');
		}
	},

	onManageSaveUpdateTrainer: function(record) {
		var parent = record.up().up();
		var form = parent.items.items[0].getForm();
		var me = this;
		if(form.isValid()) {
			Ext.Msg.confirm('Update Trainer', 'Are you sure want to update this trainer ?', function(btn) {
				if(btn == 'yes') {
					me.showLoadingWindow();
					form.submit({
						success: function(act, res) {
							var json = Ext.decode(res.response.responseText);
							me.closeLoadingWindow();
							if(me.isLogin(json)) {
								Ext.Msg.alert('Message', 'Data successfully saved.');
								var mainContent = Ext.getCmp('manage-trainer-grid');
								var store = mainContent.getStore();
								var TRAINING_ID = store.proxy.extraParams.TRAINING_ID;
								store.proxy.extraParams = {};
								store.proxy.extraParams.TRAINING_ID = TRAINING_ID;
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

	onManageDeleteTrainer: function(record) {
		var parent = record.up().up();
		var grid = parent.items.items[0];
		var selected = grid.getSelectionModel().getSelection();
		var me = this;
		if(selected.length > 0) {
			Ext.Msg.confirm('Remove Participant', 'Are you sure want to remove this trainer ?', function(btn) {
				if(btn == 'yes') {
					me.showLoadingWindow();
					Ext.Ajax.request({
						url: MyIndo.siteUrl('trtrainingtrainers/request/destroy'),
						params: selected[0].data,
						success: function(r) {
							var json = Ext.decode(r.responseText);
							me.closeLoadingWindow();
							if(me.isLogin(json)) {
								if(me.isSuccess(json)) {
									var mainContent = Ext.getCmp('manage-trainer-grid');
									var store = mainContent.getStore();
									var TRAINING_ID = store.proxy.extraParams.TRAINING_ID;
									store.proxy.extraParams = {};
									store.proxy.extraParams.TRAINING_ID = TRAINING_ID;
									store.load();
									Ext.Msg.alert('Delete', 'Trainer successfully deleted.');
								}
							}
						}
					})
				}
			});
		} else {
			Ext.Msg.alert('Application Error', 'You did not select any trainer.');
		}
	},

	trainingModules: function(record) {
		var parent = record.up().up();
		var grid = parent.items.items[0];
		var selected = grid.getSelectionModel().getSelection();
		var me = this;
		var store = Ext.create(MyIndo.getNameSpace('store.Transaction.TrainingModules'));
		store.proxy.extraParams = {TRAINING_ID: selected[0].data.ID};
		if(selected.length > 0) {
			Ext.create(MyIndo.getNameSpace('view.Transaction.Trainings.Modules'), {
				trainingId: selected[0].data.ID,
				store: store
			}).show();
			store.load();
		} else {
			Ext.Msg.alert('Application Error', 'You did not select any training.');
		}
	},

	onTrainingModulesButtonClicked: function(record) {
		var action = record.action;
		switch(action) {
			case 'training-upload-module':
				this.trainingUploadModule(record);
				break;
			case 'training-download-module':
				this.trainingDownloadModule(record);
				break;
			case 'training-delete-module':
				this.trainingDeleteModule(record);
				break;

			/* Upload Module Window */
			case 'do-upload-module':
				this.doUploadModule(record);
				break;
			case 'cancel-upload-module':
				record.up().up().close();
				break;
		}
	},

	/* Upload Module */

	trainingUploadModule: function(record) {
		var parent = record.up().up();
		Ext.create(MyIndo.getNameSpace('view.Transaction.Trainings.UploadModule'), {
			trainingId: parent.trainingId
		}).show();
	},

	doUploadModule: function(record) {
		var parent = record.up().up();
		var form = parent.items.items[0].getForm();
		var me = this;
		var allowedFileExtension = ['ppt','doc','docx','xls','xlsx','pdf'];
		var allowed = false;
		if(form.isValid()) {
			Ext.Msg.confirm('Upload Module', 'Are you sure want to upload this module ?', function(btn) {
				if(btn == 'yes') {
					form.setValues({
						TRAINING_ID: parent.trainingId
					});
					var fileNameExploded = Ext.getCmp('upload-module-file-box').value.split('.');
					var fileExtension = fileNameExploded[fileNameExploded.length-1];
					for(var i = 0; i < allowedFileExtension.length; i++) {
						if(allowedFileExtension[i] == fileExtension) {
							allowed = true;
						}
					}
					if(allowed) {
						me.showLoadingWindow();
						form.submit({
							url: MyIndo.baseUrl('trtrainingmodules/request/create'),
							success: function(form, record) {
								var json = Ext.decode(record.response.responseText);
								if(me.isLogin(json)) {
									Ext.getCmp('training-modules-grid').getStore().load();
									Ext.Msg.alert('Upload Module', 'File successfully uploaded.');
								}
								me.closeLoadingWindow();
							},
							failure: function(form, record) {
								var json = Ext.decode(record.response.responseText);
								if(me.isLogin(json)) {
									Ext.Msg.alert('Application Error', '<strong>Error : </strong>[' + json.error_code + '] ' + json.error_message);
								}
								me.closeLoadingWindow();
							}
						});
					} else {
						Ext.Msg.alert('Application Error', 'Not allowed file extension \'' + fileExtension + '\'');
					}
				}
			});
		} else {
			Ext.Msg.alert('Application Error', 'Please complete form first.');
		}
	},

	/* End of : Uplaod Module */

	/* Download Module */
	trainingDownloadModule: function(record) {
		try {
			var parent = record.up().up();
			var grid = parent.items.get(0);
			var selected = grid.getSelectionModel().getSelection();
			if(selected.length > 0) {
				document.location = MyIndo.baseUrl(selected[0].data.FILE_PATH);
			} else {
				Ext.Msg.alert('Application Error', 'You did not select any module.');
			}
		} catch(e) {
			Ext.Msg.alert('Application Error', e);
		}
	},
	/* End of : Download Module */

	/* Delete Module */
	trainingDeleteModule: function(record) {
		var parent = record.up().up();
		var grid = parent.items.get(0);
		var selected = grid.getSelectionModel().getSelection();
		var me = this;
		if(selected.length > 0) {
			Ext.Msg.confirm('Delete Module', 'Are you sure want to delete this module ?', function(btn) {
				if(btn == 'yes') {
					me.showLoadingWindow();
					Ext.Ajax.request({
						url: MyIndo.baseUrl('trtrainingmodules/request/delete'),
						params: selected[0].data,
						success: function(r) {
							var json = Ext.decode(r.responseText);
							me.closeLoadingWindow();
							if(me.isLogin(json)) {
								if(me.isSuccess(json)) {
									Ext.getCmp('training-modules-grid').getStore().load();
									Ext.Msg.alert('Delete Module', 'Module successfully deleted.');
								}
							}
						}
					});
				}
			});
		} else {
			Ext.Msg.alert('Application Error', 'You did not select any module.');
		}
	}
});