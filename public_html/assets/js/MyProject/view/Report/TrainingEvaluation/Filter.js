Ext.define(MyIndo.getNameSpace('view.Report.TrainingEvaluation.Filter'), {
	extend: 'Ext.Window',
	alias: 'widget.reporttrainingevaluationfilterwindow',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 400,
	title: 'Filter Training Evaluation',

	initComponent: function() {
	    Ext.apply(this, {
			items: [{
				xtype: 'form',
				layout: 'form',
				border: false,
				bodyPadding: '5 5 5 5',
				url: MyIndo.siteUrl(''),
				items: [{
					xtype: 'textfield',
					//required: true,
					name: 'TRAINING_NAME',
					id: 'training-name',
					allowBlank: false,
					fieldLabel: 'Name',
					emptyText: 'Input Name..'
				},{
					fieldLabel:'Start Date',
					xtype: 'datefield',
					anchor: '100%',
					width: 300,
					name: 'START_DATE',
					id: 'start-date-trainingevaluation',
					vtype: 'daterange',
		            endDateField: 'end-date-trainingevaluation',
					format: 'Y-m-d'
				},{
					fieldLabel:'End Date',
					xtype: 'datefield',
					anchor: '100%',
					width: 300,
					name: 'END_DATE',
					id: 'end-date-trainingevaluation',
					vtype: 'daterange',
			        startDateField: 'start-date-trainingevaluation',
					format: 'Y-m-d'
				}]
			}],
			buttons: [{
				text: 'Filter',
				action: 'filter-search'
			}]
		});
		this.callParent(arguments);
	}
});