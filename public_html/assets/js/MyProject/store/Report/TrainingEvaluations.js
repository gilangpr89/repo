Ext.define(MyIndo.getNameSpace('store.Report.TrainingEvaluations'), {
	extend: 'MyIndo.data.Store',
	model: MyIndo.getNameSpace('model.Report.TrainingEvaluation'),
	proxy: {
		type: 'ajax',
		api: {
			read: MyIndo.siteUrl('reports/request/training')
		},
		actionMethods: MyIndo.config.defaultActionMethods,
		reader: MyIndo.config.defaultReader
	},
	sorters: {
		property: 'TRAINING_NAME',
		direction: 'ASC'
	},
	remoteSort: true
})