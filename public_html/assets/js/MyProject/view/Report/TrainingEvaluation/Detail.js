Ext.define(MyIndo.getNameSpace('view.Report.TrainingEvaluation.Detail'), {
	extend: 'Ext.Window',
	alias: 'widget.reporttrainingevaluationdetail',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 550,
	
	initComponent: function() {
		Ext.apply(this, {
			title: 'Detail Training Evaluation : ' + this.dataEvaluation.ORGANIZATION_NAME,
			items: [{
				border: false,
				bodyPadding: 5,
				html: 
				'<table>' +
					'<tr>' +
						'<td> Name</td><td>:</td><td>' + this.dataEvaluation.PARTICIPANT_NAME + '</td>' + 
					'</tr>' +
				'</table>'
			},{
				xtype: 'form',
				layout: 'form',
				border: false,
				bodyPadding: '5 5 5 5',
				title: 'Training Period',
				id: 'trainingevaluation-detail-training-period-form',
				items: [{
					fieldLabel:'Start Date',
					xtype: 'datefield',
					//anchor: '100%',
					width: 400,
					name: 'START_DATE',
					vtype: 'daterange',
					id: 'trainingevaluation-detail-training-start-date',
		            endDateField: 'trainingevaluation-detail-training-end-date',
					format: 'Y-m-d',
					allowBlank: false
				},{
					fieldLabel:'End Date',
					xtype: 'datefield',
					//anchor: '100%',
					width: 400,
					name: 'END_DATE',
					vtype: 'daterange',
					id: 'trainingevaluation-detail-training-end-date',
			        startDateField: 'trainingevaluation-detail-training-start-date',
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
				title: 'Training Evaluation List',
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
				action: 'do-print-report-trainingevaluation'
			}]
		});
		this.callParent(arguments);
	}
});