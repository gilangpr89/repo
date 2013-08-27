Ext.define(MyIndo.getNameSpace('store.Report.ParticipantTrainings'), {
	extend: 'MyIndo.data.Store',
	model: MyIndo.getNameSpace('model.Report.ParticipantTraining'),
	proxy: {
		type: 'ajax',
		api: {
			read: MyIndo.siteUrl('participants/request/participant-trainings')
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