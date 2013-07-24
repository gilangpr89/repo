Ext.define(MyIndo.getNameSpace('store.Transaction.Trainings'), {
	extend: 'MyIndo.data.Store',
	model: MyIndo.getNameSpace('model.Transaction.Training'),
	proxy: {
		type: 'ajax',
		api: {
			read: MyIndo.siteUrl('trtrainings/request/read')
		},
		actionMethods: MyIndo.config.defaultActionMethods,
		reader: MyIndo.config.defaultReader
	},
	sorters: {
		property: 'TRAINING_NAME',
		direction: 'ASC'
	},
	remoteSort: true
})