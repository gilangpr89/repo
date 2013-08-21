Ext.define(MyIndo.getNameSpace('store.Report.Organizations'), {
	extend: 'MyIndo.data.Store',
	model: MyIndo.getNameSpace('model.Report.Organization'),
	proxy: {
		type: 'ajax',
		api: {
			read: MyIndo.siteUrl('organizations/request/detail')
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