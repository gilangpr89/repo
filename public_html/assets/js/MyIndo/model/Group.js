Ext.define('MyIndo.model.Group', {
	extend: 'Ext.data.Model',
	fields: [{
		name: 'GROUP_ID',
		type: 'string'
	},{
		name: 'NAME',
		type: 'string'
	},{
		name: 'TOTAL_USER',
		type: 'int'
	},{
		name: 'ACTIVE',
		type: 'int'
	},{
		name: 'CREATED_DATE',
		type: 'string'
	},{
		name: 'MODIFIED_DATE',
		type: 'string'
	}]
});