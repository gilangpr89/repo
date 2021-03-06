Ext.define(MyIndo.getNameSpace('view.Report.CapacityProfile.Region.Detail'), {
	extend: 'Ext.Window',
	alias: 'widget.capacityprofileregiondetail',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 550,
	
	initComponent: function() {
		Ext.apply(this, {
			title: 'Detail Region : ' + this.regionData.NAME,
			items: [{
				border: false,
				bodyPadding: 5,
				html: 
				'<table>' +
					'<tr>' +
						'<td> Region Name</td><td>:</td><td>' + this.regionData.NAME + '</td>' + 
					'</tr>' +
				'</table>'
			},{
				xtype: 'form',
				layout: 'form',
				border: false,
				bodyPadding: '5 5 5 5',
				title: 'Training Period',
				id: 'region-detail-training-period-form',
				items: [{
					fieldLabel:'Start Date',
					xtype: 'datefield',
					anchor: '100%',
					width: 300,
					name: 'START_DATE',
					vtype: 'daterange',
					id: 'region-detail-training-start-date',
		            endDateField: 'region-detail-training-end-date',
					format: 'Y-m-d',
					allowBlank: false
				},{
					fieldLabel:'End Date',
					xtype: 'datefield',
					anchor: '100%',
					width: 300,
					name: 'END_DATE',
					vtype: 'daterange',
					id: 'region-detail-training-end-date',
			        startDateField: 'region-detail-training-start-date',
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