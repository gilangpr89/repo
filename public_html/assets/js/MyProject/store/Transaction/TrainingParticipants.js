Ext.define(MyIndo.getNameSpace('store.Transaction.TrainingParticipants'), {
	extend: 'MyIndo.data.Store',
	model: MyIndo.getNameSpace('model.Transaction.TrainingParticipant'),
	proxy: {
		type: 'ajax',
		api: {
			read: MyIndo.siteUrl('trainingparticipants/request/read')
		},
		actionMethods: MyIndo.config.defaultActionMethods,
		reader: MyIndo.config.defaultReader
	},
	sorters: {
		property: 'PARTICIPANT_NAME',
		direction: 'ASC'
	},
	remoteSort: true
})