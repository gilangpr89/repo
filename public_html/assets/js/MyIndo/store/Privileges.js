Ext.define('MyIndo.store.Privileges', {
	extend: 'Ext.data.TreeStore',
	autoLoad: false,
	proxy: {
		type: 'ajax',
		api: {
			read: MyIndo.baseUrl('privileges/request/read')
		},
		actionMethods: {
			read: 'POST'
		},
		reader: {
			type: 'json',
			root: 'data',
			successProperty: 'success'
		}
	},
	root: {
		expanded: true,
		loaded: true
	}
});