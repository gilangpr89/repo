Ext.define(MyIndo.getNameSpace('store.Report.CapacityProfile.SrcountryTrainings'), {
	extend: 'MyIndo.data.Store',
	model: MyIndo.getNameSpace('model.Report.CapacityProfile.SrcountryTraining'),
	proxy: {
		type: 'ajax',
		api: {
			read: MyIndo.siteUrl('reports/request/srcountry-trainings')
		},
		actionMethods: MyIndo.config.defaultActionMethods,
		reader: MyIndo.config.defaultReader
	},
	sorters: {
		property: 'TRAINING_ID',
		direction: 'ASC'
	},
	remoteSort: true
})