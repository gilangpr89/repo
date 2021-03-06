Ext.define(MyIndo.getNameSpace('store.Report.CapacityProfile.Individuals'), {
	extend: 'MyIndo.data.Store',
	model: MyIndo.getNameSpace('model.Report.CapacityProfile.Individual'),
	proxy: {
		type: 'ajax',
		api: {
			read: MyIndo.siteUrl('reports/request/individual')
		},
		actionMethods: MyIndo.config.defaultActionMethods,
		reader: MyIndo.config.defaultReader
	},
	sorters: {
		property: 'NAME',
		direction: 'ASC'
	},
	remoteSort: true
})