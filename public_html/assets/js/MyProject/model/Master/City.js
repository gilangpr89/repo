Ext.define(MyIndo.getNameSpace('model.Master.City'), {
	extend: 'Ext.data.Model',
	fields: [{
		name: 'ID',
		type: 'string'
	},{
		name: 'NAME',
		type: 'string'
	},{
		name: 'CREATED_DATE',
		type: 'string'
	},{
		name: 'MODIFIED_DATE',
		type: 'string'
	}]
});