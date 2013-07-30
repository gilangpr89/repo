Ext.define(MyIndo.getNameSpace('store.Master.AreaLevels'), {
	extend: 'MyIndo.data.Store',
	model: MyIndo.getNameSpace('model.Master.AreaLevel'),
	proxy: {
		type: 'ajax',
		api: {
			read: MyIndo.siteUrl('arealevels/request/read')
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