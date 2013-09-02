Ext.define(MyIndo.getNameSpace('view.Report.Organization.Detail'), {
	extend: 'Ext.Window',
	alias: 'widget.reportorganizationdetail',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 550,
	
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
				xtype: 'form',
				layout: 'form',
				border: false,
				bodyPadding: '5 5 5 5',
				title: 'Training Period',
				id: 'organization-detail-training-period-form',
				items: [{
					fieldLabel:'Start Date',
					xtype: 'datefield',
					//anchor: '100%',
					width: 400,
					name: 'START_DATE',
					vtype: 'daterange',
					id: 'organization-detail-training-start-date',
		            endDateField: 'organization-detail-training-end-date',
					format: 'Y-m-d',
					allowBlank: false
				},{
					fieldLabel:'End Date',
					xtype: 'datefield',
					//anchor: '100%',
					width: 400,
					name: 'END_DATE',
					vtype: 'daterange',
					id: 'organization-detail-training-end-date',
			        startDateField: 'organization-detail-training-start-date',
					format: 'Y-m-d',
					allowBlank: false
				}],
				buttons: [{
					text: 'Filter',
					iconCls: 'icon-filter',
					action: 'filter-period',
					activeStore: this.store
				}]
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