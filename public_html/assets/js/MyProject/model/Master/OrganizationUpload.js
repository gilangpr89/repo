Ext.define(MyIndo.getNameSpace('model.Master.OrganizationUpload'), {
	extend: 'Ext.data.Model',
	fields: [{
		name: 'ID',
		type: 'string'
	},{
		name: 'ORGANIZATION_ID',
		type: 'string'
	},{
		name: 'ORGANIZATION_NAME',
		type: 'string'
	},{
		name: 'FILE_NAME',
		type: 'string'
	},{
		name: 'FILE_PATH',
		type: 'string'
	},{
		name: 'TRAINING_ID',
		type: 'string'
	},{
		name: 'TRAINING_NAME',
		type: 'string'
	},{
		name: 'CREATED_DATE',
		type: 'string'
	}]
});