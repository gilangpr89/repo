Ext.define(MyIndo.getNameSpace('view.Report.TrainingEvaluation.View'), {
	extend: 'Ext.grid.Panel',
	alias: 'widget.reporttrainingevaluationview',
	border: false,
	columns: [{text: 'Training Id',
		       width: 60,
		       dataIndex: 'TRAINING_ID',
		       hidden: true
		   },{
		      text: 'Training Name',
	          flex:100,
	          dataIndex:'TRAINING_NAME',
			},{
				text: 'Start Date',
				align: 'center',
				width: 150,
				dataIndex: 'SDATE'
			},{
				text: 'End Date',
				align: 'center',
				width: 150,
				dataIndex: 'EDATE'
			}],

	initComponent: function() {
		Ext.apply(this, {
			actions: {
				filter: MyIndo.getNameSpace('view.Report.TrainingEvaluation.Filter')
			},
			filters: ['TRAINING_NAME','START_DATE','END_DATE'],
			url: {
				delete: MyIndo.baseUrl('participants/request/destroy')
			},
			dockedItems: [{
				xtype: 'pagingtoolbar',
				displayInfo: true,
				dock: 'bottom',
				store: this.store
			}]
		});
		this.callParent(arguments);
	}
});