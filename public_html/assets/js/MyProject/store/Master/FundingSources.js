Ext.define(MyIndo.getNameSpace('store.Master.FundingSources'), {
	extend: 'MyIndo.data.Store',
	model: MyIndo.getNameSpace('model.Master.FundingSource'),
	proxy: {
		type: 'ajax',
		api: {
			read: MyIndo.siteUrl('fundingsources/request/read')
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