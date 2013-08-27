Ext.define(MyIndo.getNameSpace('store.Report.CapacityProfile.CboTrainings'), {
	extend: 'MyIndo.data.Store',
	model: MyIndo.getNameSpace('model.Report.CapacityProfile.CboTraining'),
	proxy: {
		type: 'ajax',
		api: {
			read: MyIndo.siteUrl('reports/request/cbo-trainings')
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