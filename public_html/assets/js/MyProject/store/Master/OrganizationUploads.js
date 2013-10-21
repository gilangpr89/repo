Ext.define(MyIndo.getNameSpace('store.Master.OrganizationUploads'), {
	extend: 'MyIndo.data.Store',
	model: MyIndo.getNameSpace('model.Master.OrganizationUpload'),
	proxy: {
		type: 'ajax',
		api: {
			read: MyIndo.siteUrl('organizations/request/file')
		},
		actionMethods: MyIndo.config.defaultActionMethods,
		reader: MyIndo.config.defaultReader
	},
	sorters: {
		property: 'FILE_NAME',
		direction: 'ASC'
	},
	remoteSort: true
})