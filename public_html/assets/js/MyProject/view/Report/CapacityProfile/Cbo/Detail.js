Ext.define(MyIndo.getNameSpace('view.Report.CapacityProfile.Cbo.Detail'), {
	extend: 'Ext.Window',
	alias: 'widget.capacityprofilecbodetail',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 650,
	
	initComponent: function() {
		Ext.apply(this, {
			title: 'Detail Cbo : ' + this.organizationData.NAME,
			items: [{
				border: false,
				bodyPadding: 5,
				html: 
				'<table>' +
					'<tr>' +
						'<td>Organization Name</td><td>:</td><td>' + this.organizationData.CITY_NAME + '</td>' + 
					'</tr>' +
					'<tr>' +
						'<td>Organization Province</td><td>:</td><td>' + this.organizationData.PROVINCE_NAME + '</td>' + 
					'</tr>' +
					'<tr>' +
						'<td>Organization Country</td><td>:</td><td>' + this.organizationData.COUNTRY_NAME + '</td>' + 
					'</tr>' + '<td>Organization Phone</td><td>:</td><td>' + this.organizationData.PHONE_NO1 + '</td>' +
				'</table>'
			},{
				xtype: 'gridpanel',
				border: false,
				title: 'Training List',
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
				action: 'do-print-capacityprofile-cbo'
			}]
		});
		this.callParent(arguments);
	}
});