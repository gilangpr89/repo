Ext.define(MyIndo.getNameSpace('view.Transaction.Trainings.UploadTrainers'), {
	extend: 'Ext.Window',
	alias: 'widget.traininguploadtrainers',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 400,
	title: 'Upload CV',

	initComponent: function() {
		Ext.apply(this, {
			items: [{
				xtype: 'form',
				layout: 'form',
				bodyPadding: '5',
				border: false,
				waitMsgTarget: true,
				items: [{
					xtype: 'hidden',
					name: 'TRAINING_ID'
				},{
					xtype: 'textfield',
					fieldLabel: 'Module Name',
					emptyText: 'Doc name..',
					name: 'FILE_NAME',
					allowBlank: false
				},{
					xtype: 'filefield',
		            emptyText: 'Select file..',
		            fieldLabel: 'Module',
		            name: 'FILE',
		            id: 'upload-trainer-file-box',
		            allowBlank: false
				}]
			}],
			buttons: [{
				text: 'Upload Trainer',
				action: 'do-upload-trainer'
			},{
				text: 'Cancel',
				action: 'cancel-upload-trainer'
			}]
		});
		this.callParent(arguments);
	}
})