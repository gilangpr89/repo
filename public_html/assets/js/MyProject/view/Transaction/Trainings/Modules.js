Ext.define(MyIndo.getNameSpace('view.Transaction.Trainings.Modules'), {
	extend: 'Ext.Window',
	alias: 'widget.trainingmodules',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 700,
	title: 'Training Modules',

	initComponent: function() {
		Ext.apply(this, {
			items: [{
				xtype: 'gridpanel',
				id: 'training-modules-grid',
				border: false,
				minHeight: 200,
				store: this.store,
				columns: [{
					text: 'File Name',
					flex: 1,
					dataIndex: 'FILE_NAME'
				},{
					text: 'File Size',
					width: 100,
					align: 'center',
					dataIndex: 'FILE_SIZE'
				},{
					text: 'Created Date',
					width: 150,
					align: 'center',
					dataIndex: 'CREATED_DATE'
				},{
					text: 'Modified date',
					width: 150,
					align: 'center',
					dataIndex: 'MODIFIED_DATE'
				}]
			}],
			tbar: [{
				text: 'Upload Module',
				iconCls: 'icon-inbox-upload',
				action: 'training-upload-module'
			},{
				text: 'Download Module',
				iconCls: 'icon-inbox-download',
				action: 'training-download-module'
			},{
				text: 'Delete Module',
				iconCls: 'icon-cross',
				action: 'training-delete-module'
			}]
		});
		this.callParent(arguments);
	}
});