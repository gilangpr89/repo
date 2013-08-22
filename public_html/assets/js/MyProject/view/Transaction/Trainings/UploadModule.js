Ext.define(MyIndo.getNameSpace('view.Transaction.Trainings.UploadModule'), {
	extend: 'Ext.Window',
	alias: 'widget.traininguploadmodules',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 400,
	title: 'Upload Module',

	initComponent: function() {
		Ext.apply(this, {
			items: [{
				xtype: 'form',
				layout: 'form',
				bodyPadding: '5',
				border: false,
				items: [{
					xtype: 'hidden',
					name: 'TRAINING_ID'
				},{
					xtype: 'textfield',
					fieldLabel: 'Module Name',
					emptyText: 'Module name..',
					name: 'FILE_NAME',
					allowBlank: false
				},{
					xtype: 'filefield',
		            emptyText: 'Select file..',
		            fieldLabel: 'Module',
		            name: 'FILE',
		            id: 'upload-module-file-box',
		            allowBlank: false
				}]
			}],
			buttons: [{
				text: 'Upload Module',
				action: 'do-upload-module'
			},{
				text: 'Cancel',
				action: 'cancel-upload-module'
			}]
		});
		this.callParent(arguments);
	}
})