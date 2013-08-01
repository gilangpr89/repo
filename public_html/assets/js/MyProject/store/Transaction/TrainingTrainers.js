Ext.define(MyIndo.getNameSpace('store.Transaction.TrainingTrainers'), {
	extend: 'MyIndo.data.Store',
	model: MyIndo.getNameSpace('model.Transaction.TrainingTrainer'),
	proxy: {
		type: 'ajax',
		api: {
			read: MyIndo.siteUrl('trtrainingtrainers/request/read')
		},
		actionMethods: MyIndo.config.defaultActionMethods,
		reader: MyIndo.config.defaultReader
	},
	sorters: {
		property: 'TRAINER_NAME',
		direction: 'ASC'
	},
	remoteSort: true
})