Ext.define(MyIndo.getNameSpace('store.Report.CapacityProfile.Srcountrys'), {
	extend: 'MyIndo.data.Store',
	model: MyIndo.getNameSpace('model.Report.CapacityProfile.Srcountry'),
	proxy: {
		type: 'ajax',
		api: {
			read: MyIndo.siteUrl('reports/request/srcountry')
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