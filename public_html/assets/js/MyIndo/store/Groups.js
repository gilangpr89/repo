Ext.define('MyIndo.store.Groups', {
	extend: 'Ext.data.Store',
	model: 'MyIndo.model.Group',
	proxy: {
		type: 'ajax',
		api: {
			read: MyIndo.siteUrl('groups/request/read')
		},
		actionMethods: MyIndo.config.defaultActionMethods,
		reader: MyIndo.config.defaultReader
	},
	sorters: {
		property: 'NAME',
		direction: 'ASC'
	},
	remoteSort: true
});