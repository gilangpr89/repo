Ext.define(MyIndo.getNameSpace('store.Master.Positions'), {
	extend: 'MyIndo.data.Store',
	model: MyIndo.getNameSpace('model.Master.Position'),
	proxy: {
		type: 'ajax',
		api: {
			read: MyIndo.siteUrl('positions/request/read')
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