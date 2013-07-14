Ext.define('MyIndo.model.User', {
	extend: 'Ext.data.Model',
	fields: [{
		name: 'USER_ID',
		type: 'string'
	},{
		name: 'USERNAME',
		type: 'string'
	},{
		name: 'EMAIL',
		type: 'string'
	},{
		name: 'ACTIVE',
		type: 'int'
	},{
		name: 'IP_ADDRESS',
		type: 'string'
	},{
		name: 'LAST_IP_ADDRESS',
		type: 'string'
	},{
		name: 'LAST_LOGIN',
		type: 'string'
	},{
		name: 'CREATED_DATE',
		type: 'string'
	},{
		name: 'MODIFIED_DATE',
		type: 'string'
	}]
})