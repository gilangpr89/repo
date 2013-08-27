Ext.define(MyIndo.getNameSpace('store.Report.CapacityProfile.Cbos'), {
	extend: 'MyIndo.data.Store',
	model: MyIndo.getNameSpace('model.Report.CapacityProfile.Cbo'),
	proxy: {
		type: 'ajax',
		api: {
			read: MyIndo.siteUrl('reports/request/cbo')
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