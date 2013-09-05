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
			title: 'Detail Training Evaluation : ' + this.dataEvaluation.TRAINING_NAME,
			items: [{
				border: false,
				bodyPadding: 5,
				html: 
				'<table>' +
					'<tr>' +
						'<td> Name</td><td>:</td><td>' + this.dataEvaluation.TRAINING_NAME + '</td>' + 
					'</tr>' +
				'</table>'
			},{
				xtype: 'gridpanel',
				border: false,
				title: 'Training Evaluation List',
				minHeight: 200,
				maxHeight: 500,
				autoScroll: true,
				store: this.store,
				columns: [{
					text: 'Participant Name',
					flex: 1,
					dataIndex: 'PARTICIPANT_NAME'
				},{
					text: 'Pre Test',
					width: 150,
					align: 'center',
					dataIndex: 'PRE_TEST'
				},{
					text: 'Post Test',
					width: 150,
					align: 'center',
					dataIndex: 'POST_TEST'
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