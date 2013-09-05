Ext.define(MyIndo.getNameSpace('store.Report.TrtEvaluations'), {
	extend: 'MyIndo.data.Store',
	model: MyIndo.getNameSpace('model.Report.TrtEvaluation'),
	proxy: {
		type: 'ajax',
		api: {
			read: MyIndo.siteUrl('reports/request/Trt-Evaluation')
		},
		actionMethods: MyIndo.config.defaultActionMethods,
		reader: MyIndo.config.defaultReader
	},
	sorters: {
		property: 'PARTICIPANT_NAME',
		direction: 'ASC'
	},
	remoteSort: true
})