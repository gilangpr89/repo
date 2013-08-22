Ext.define(MyIndo.getNameSpace('model.Transaction.TrainingModule'), {
	extend: 'Ext.data.Model',
	fields: [{
		name: 'ID',
		type: 'string'
	},{
		name: 'TRAINING_ID',
		type: 'string'
	},{
		name: 'FILE_NAME',
		type: 'string'
	},{
		name: 'FILE_SIZE',
		type: 'string'
	},{
		name: 'FILE_MIME_TYPE',
		type: 'string'
	},{
		name: 'FILE_PATH',
		type: 'string'
	},{
		name: 'CREATED_DATE',
		type: 'string'
	},{
		name: 'MODIFIED_DATE',
		type: 'string'
	}]
})