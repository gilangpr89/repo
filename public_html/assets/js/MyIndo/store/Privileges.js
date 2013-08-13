Ext.define('MyIndo.store.Privileges', {
	extend: 'MyIndo.data.TreeStore',
	proxy: {
		type: 'ajax',
		url: MyIndo.siteUrl('privileges/request/read'),
		actionMethods: MyIndo.config.defaultActionMethods
	},
	sorters: {
		property: 'leaf',
		direction: 'ASC'
	}
});