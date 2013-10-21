Ext.define(MyIndo.getNameSpace('view.Master.Organizations.Upload'), {
	extend: 'Ext.Window',
	alias: 'widget.organizationsuploadwindow',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 400,
	title: 'Upload Doc',

	initComponent: function() {
		var storeTrainings = Ext.create(MyIndo.getNameSpace('store.Master.Trainings'),{autoDestroy:true});
		Ext.apply(this, {
			items: [{
				xtype: 'form',
				layout: 'form',
				bodyPadding: '5',
				border: false,
				waitMsgTarget: true,
				items: [{
					xtype: 'hidden',
					name: 'ORGANIZATION_ID'
				},{
					xtype: 'textfield',
					fieldLabel: 'File Name',
					emptyText: 'File name..',
					name: 'FILE_NAME',
					allowBlank: false
				},{
					xtype: 'combobox',
					fieldLabel: 'Training Name',
					name: 'TRAINING_ID',
					allowBlank: false,
					displayField: 'NAME',
					valueField: 'ID',
					minChars: 3,
					pageSize: 25,
					store: storeTrainings,
					allowBlank: false,
					emptyText: 'Select training..'
				},{
					xtype: 'filefield',
		            emptyText: 'Select file..',
		            fieldLabel: 'File',
		            name: 'FILE',
		            id: 'upload-organization-file-box',
		            allowBlank: false
				}]
			}],
			buttons: [{
				text: 'Upload Doc',
				action: 'do-upload'
			},{
				text: 'Cancel',
				action: 'upload-cancel'
			}]
		});
		this.callParent(arguments);
	}
})