Ext.define(MyIndo.getNameSpace('store.Report.CapacityProfile.IndividualTrainings'), {
	extend: 'MyIndo.data.Store',
	model: MyIndo.getNameSpace('model.Report.CapacityProfile.IndividualTraining'),
	proxy: {
		type: 'ajax',
		api: {
			read: MyIndo.siteUrl('reports/request/individual-trainings')
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