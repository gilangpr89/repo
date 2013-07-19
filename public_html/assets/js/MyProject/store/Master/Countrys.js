Ext.define(MyIndo.getNameSpace('store.Master.Countrys'), {
	extend: 'MyIndo.data.Store',
	model: MyIndo.getNameSpace('model.Master.Country'),
	proxy: {
		type: 'ajax',
		api: {
			read: MyIndo.siteUrl('country/request/read')
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