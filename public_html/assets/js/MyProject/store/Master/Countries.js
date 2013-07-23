Ext.define(MyIndo.getNameSpace('store.Master.Countries'), {
	extend: 'MyIndo.data.Store',
	model: MyIndo.getNameSpace('model.Master.Country'),
	proxy: {
		type: 'ajax',
		api: {
			read: MyIndo.siteUrl('countries/request/read')
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