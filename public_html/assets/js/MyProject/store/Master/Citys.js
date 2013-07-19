Ext.define(MyIndo.getNameSpace('store.Master.Citys'), {
	extend: 'MyIndo.data.Store',
	model: MyIndo.getNameSpace('model.Master.City'),
	proxy: {
		type: 'ajax',
		api: {
			read: MyIndo.siteUrl('city/request/read')
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