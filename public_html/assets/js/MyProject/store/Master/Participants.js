Ext.define(MyIndo.getNameSpace('store.Master.Participants'), {
	extend: 'MyIndo.data.Store',
	model: MyIndo.getNameSpace('model.Master.Participant'),
	proxy: {
		type: 'ajax',
		api: {
			read: MyIndo.siteUrl('participants/request/read')
		},
		actionMethods: MyIndo.config.defaultActionMethods,
		reader: MyIndo.config.defaultReader
	},
	sorters: {
		property: 'FNAME',
		direction: 'ASC'
	},
	remoteSort: true
})