Ext.define(MyIndo.getNameSpace('store.Report.OrganizationTrainings'), {
	extend: 'MyIndo.data.Store',
	model: MyIndo.getNameSpace('model.Report.OrganizationTraining'),
	proxy: {
		type: 'ajax',
		api: {
			read: MyIndo.siteUrl('organizations/request/organization-trainings')
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