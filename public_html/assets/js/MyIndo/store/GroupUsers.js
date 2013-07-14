Ext.define('MyIndo.store.GroupUsers', {
	extend: 'Ext.data.Store',
	model: 'MyIndo.model.GroupUser',
	proxy: {
		type: 'ajax',
		api: {
			read: MyIndo.siteUrl('groupusers/request/read')
		},
		actionMethods: MyIndo.config.defaultActionMethods,
		reader: MyIndo.config.defaultReader
	},
	sorters: {
		property: 'USERNAME',
		direction: 'ASC'
	},
	remoteSort: true
});