Ext.define(MyIndo.getNameSpace('view.Report.CapacityProfile.Region.Detail'), {
	extend: 'Ext.Window',
	alias: 'widget.capacityprofileregiondetail',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 650,
	
	initComponent: function() {
		Ext.apply(this, {
			title: 'Detail Region : ' + this.regionData.NAME,
			items: [{
				border: false,
				bodyPadding: 5,
				html: 
				'<table>' +
					'<tr>' +
						'<td> Name</td><td>:</td><td>' + this.regionData.NAME + '</td>' + 
					'</tr>' +
				'</table>'
			},{
				xtype: 'gridpanel',
				border: false,
				title: 'Training Region List',
				minHeight: 200,
				maxHeight: 500,
				autoScroll: true,
				store: this.store,
				columns: [{
					text: 'Training Name',
					flex: 1,
					dataIndex: 'TRAINING_NAME'
				},{
					text: 'Start Date',
					width: 150,
					align: 'center',
					dataIndex: 'SDATE'
				},{
					text: 'End Date',
					width: 150,
					align: 'center',
					dataIndex: 'EDATE'
				}],
				dockedItems: [{
					xtype: 'pagingtoolbar',
					displayInfo: true,
					dock: 'bottom',
					store: this.store
				}]
			}],
			buttons: [{
				text: 'Print',
				iconCls: 'icon-printer',
				action: 'do-print-capacityprofile-region'
			}]
		});
		this.callParent(arguments);
	}
});