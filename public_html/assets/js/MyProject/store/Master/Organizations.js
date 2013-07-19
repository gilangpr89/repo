Ext.define(MyIndo.getNameSpace('store.Master.Organizations'), {
	extend: 'MyIndo.data.Store',
	model: MyIndo.getNameSpace('model.Master.Organization'),
	proxy: {
		type: 'ajax',
		api: {
			read: MyIndo.siteUrl('organizations/request/read')
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