Ext.define(MyIndo.getNameSpace('store.Master.Venues'), {
	extend: 'MyIndo.data.Store',
	model: MyIndo.getNameSpace('model.Master.Venue'),
	proxy: {
		type: 'ajax',
		api: {
			read: MyIndo.siteUrl('venues/request/read')
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