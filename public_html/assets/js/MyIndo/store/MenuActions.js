Ext.define('MyIndo.store.MenuActions', {
	extend: 'Ext.data.Store',
	model: 'MyIndo.model.MenuAction',
	proxy: {
		type: 'ajax',
		api: {
			read: MyIndo.siteUrl('menus/request/read-actions')
		},
		actionMethods: MyIndo.config.defaultActionMethods,
		reader: MyIndo.config.defaultReader
	},
	sorters: {
		property: 'INDEX',
		direction: 'ASC'
	},
	remoteSort: true
});