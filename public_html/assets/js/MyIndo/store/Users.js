Ext.define('MyIndo.store.Users', {
	extend: 'MyIndo.data.Store',
	model: 'MyIndo.model.User',
	proxy: {
		type: 'ajax',
		api: {
			read: MyIndo.siteUrl('users/request/read')
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