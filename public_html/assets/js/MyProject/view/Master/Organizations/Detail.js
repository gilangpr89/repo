Ext.define(MyIndo.getNameSpace('view.Master.Organizations.Detail'), {
	extend: 'Ext.Window',
	alias: 'widget.masterorganizationdetailwindow',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 550,
	
	initComponent: function() {
		Ext.apply(this, {
			title: 'Detail : ' + this.fileData.NAME,
			items: [{
				border: false,
				bodyPadding: 5,
				html: 
				'<table>' +
					'<tr>' +
						'<td>Organization Name</td><td>:</td><td>' + this.fileData.NAME + '</td>' + 
					'</tr>' +
				'</table>'
			},{
				xtype: 'gridpanel',
				id: 'detail-organization-grid',
				border: false,
				title: 'Doc Training List',
				minHeight: 200,
				maxHeight: 500,
				autoScroll: true,
				store: this.store,
				columns: [{
					text: 'Training Name',
					flex: 1,
					dataIndex: 'TRAINING_NAME'
				},{
					text: 'File Name',
					width: 150,
					align: 'center',
					dataIndex: 'FILE_NAME'
				}],
				tbar: [{
						text: 'Download',
						iconCls: 'icon-inbox-download',
						action: 'organization-download-doc'	
				},{
					text: 'Delete',
					iconCls: 'icon-cross',
					action: 'organization-delete-doc'
				}],
				dockedItems: [{
					xtype: 'pagingtoolbar',
					displayInfo: true,
					dock: 'bottom',
					store: this.store
				}]
			}]
		});
		this.callParent(arguments);
	}
});