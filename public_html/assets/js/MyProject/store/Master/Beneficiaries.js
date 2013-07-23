Ext.define(MyIndo.getNameSpace('store.Master.Beneficiaries'), {
	extend: 'MyIndo.data.Store',
	model: MyIndo.getNameSpace('model.Master.Beneficiary'),
	proxy: {
		type: 'ajax',
		api: {
			read: MyIndo.siteUrl('beneficiaries/request/read')
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