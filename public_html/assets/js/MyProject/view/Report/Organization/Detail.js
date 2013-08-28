Ext.define(MyIndo.getNameSpace('view.Report.Organization.Detail'), {
	extend: 'Ext.Window',
	alias: 'widget.reportorganizationdetail',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 650,
	
	initComponent: function() {
		Ext.apply(this, {
			title: 'Detail Organization : ' + this.organizationData.NAME,
			items: [{
				border: false,
				bodyPadding: 5,
				html: 
				'<table>' +
					'<tr>' +
						'<td> Name</td><td>:</td><td>' + this.organizationData.NAME + '</td>' + 
					'</tr>' +
					'<tr>' +
					'<td>City Name</td><td>:</td><td>' + this.organizationData.CITY_NAME + '</td>' + 
				'</tr>' +
			'<tr>' +
			'<td>Province Name</td><td>:</td><td>' + this.organizationData.PROVINCE_NAME + '</td>' + 
		'</tr>' +
		'<tr>' +
		'<td>Country Name</td><td>:</td><td>' + this.organizationData.COUNTRY_NAME + '</td>' + 
	'</tr>' +
		'<tr>' +
		'<td>Website</td><td>:</td><td>' + this.organizationData.WEBSITE + '</td>' + 
	'</tr>' +
				'</table>'
			},{
				xtype: 'gridpanel',
				border: false,
				title: 'Training Oganization List',
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
				action: 'do-print-report-organization'
			}]
		});
		this.callParent(arguments);
	}
});