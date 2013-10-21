Ext.define(MyIndo.getNameSpace('view.Report.CapacityProfile.Individual.Detail'), {
	extend: 'Ext.Window',
	alias: 'widget.capacityprofileindividualdetail',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 550,
	
	initComponent: function() {
		Ext.apply(this, {
			title: 'Detail :' + this.participantData.NAME,
			items: [{
				border: false,
				bodyPadding: 5,
				html: 
				'<table>' +
					'<tr>' +
						'<td>Organization Name</td><td>:</td><td>' + this.participantData.NAME + '</td>' + 
					'</tr>' +
					'<tr>' +
						'<td>Country Name</td><td>:</td><td>' + this.participantData.COUNTRY_NAME + '</td>' + 
					'</tr>' +
				'</table>'
			},
//			{
//				xtype: 'form',
//				layout: 'form',
//				border: false,
//				bodyPadding: '5 5 5 5',
//				title: 'Training Period',
//				id: 'individual-detail-training-period-form',
//				items: [{
//					fieldLabel:'Start Date',
//					xtype: 'datefield',
//					//anchor: '100%',
//					width: 400,
//					name: 'START_DATE',
//					vtype: 'daterange',
//					id: 'individual-detail-training-start-date',
//		            endDateField: 'individual-detail-training-end-date',
//					format: 'Y-m-d',
//					allowBlank: false
//				},{
//					fieldLabel:'End Date',
//					xtype: 'datefield',
//					//anchor: '100%',
//					width: 400,
//					name: 'END_DATE',
//					vtype: 'daterange',
//					id: 'individual-detail-training-end-date',
//			        startDateField: 'individual-detail-training-start-date',
//					format: 'Y-m-d',
//					allowBlank: false
//				}],
//				buttons: [{
//					text: 'Filter',
//					iconCls: 'icon-filter',
//					action: 'filter-period',
//					activeStore: this.store
//				}]
//			},
			{
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
					text: 'Participant Name',
					width: 150,
					align: 'center',
					dataIndex: 'PARTICIPANT_NAME'
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
				action: 'do-print-capacityprofile-individual'
			}]
		});
		this.callParent(arguments);
	}
});