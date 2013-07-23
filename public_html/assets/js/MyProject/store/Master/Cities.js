Ext.define(MyIndo.getNameSpace('store.Master.Cities'), {
	extend: 'MyIndo.data.Store',
	model: MyIndo.getNameSpace('model.Master.City'),
	proxy: {
		type: 'ajax',
		api: {
			read: MyIndo.siteUrl('cities/request/read')
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