Ext.define(MyIndo.getNameSpace('store.Report.Participants'), {
	extend: 'MyIndo.data.Store',
	//model: MyIndo.getNameSpace('model.Report.Participant'),
	proxy: {
		type: 'ajax',
		api: {
			read: MyIndo.siteUrl('participants/request/detail')
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