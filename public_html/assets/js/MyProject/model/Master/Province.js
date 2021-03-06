Ext.define(MyIndo.getNameSpace('model.Master.Province'), {
	extend: 'Ext.data.Model',
	fields: [{
		name: 'ID',
		type: 'string'
	},{
		name: 'COUNTRY_ID',
		type: 'string'
	},{
		name: 'COUNTRY_NAME',
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