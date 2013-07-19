Ext.define(MyIndo.getNameSpace('store.Master.Roles'), {
	extend: 'MyIndo.data.Store',
	model: MyIndo.getNameSpace('model.Master.Role'),
	proxy: {
		type: 'ajax',
		api: {
			read: MyIndo.siteUrl('roles/request/read')
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