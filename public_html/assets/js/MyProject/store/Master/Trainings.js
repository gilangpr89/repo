Ext.define(MyIndo.getNameSpace('store.Master.Trainings'), {
	extend: 'MyIndo.data.Store',
	model: MyIndo.getNameSpace('model.Master.Training'),
	proxy: {
		type: 'ajax',
		api: {
			read: MyIndo.siteUrl('trainings/request/read')
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