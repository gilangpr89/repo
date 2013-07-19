Ext.define(MyIndo.getNameSpace('store.Master.Trainers'), {
	extend: 'MyIndo.data.Store',
	model: MyIndo.getNameSpace('model.Master.Trainer'),
	proxy: {
		type: 'ajax',
		api: {
			read: MyIndo.siteUrl('trainers/request/read')
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