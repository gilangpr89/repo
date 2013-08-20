Ext.define(MyIndo.getNameSpace('store.Master.Reportparticipants'), {
	extend: 'MyIndo.data.Store',
	model: MyIndo.getNameSpace('model.Master.Participant'),
	proxy: {
		type: 'ajax',
		api: {
			read: MyIndo.siteUrl('participants/request/detail')
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