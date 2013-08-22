Ext.define(MyIndo.getNameSpace('store.Transaction.TrainingModules'), {
	extend: 'MyIndo.data.Store',
	model: MyIndo.getNameSpace('model.Transaction.TrainingModule'),
	proxy: {
		type: 'ajax',
		api: {
			read: MyIndo.siteUrl('trtrainingmodules/request/read')
		},
		actionMethods: MyIndo.config.defaultActionMethods,
		reader: MyIndo.config.defaultReader
	},
	sorters: {
		property: 'FILE_NAME',
		direction: 'ASC'
	},
	remoteSort: true
});