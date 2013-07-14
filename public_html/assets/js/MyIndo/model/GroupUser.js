Ext.define('MyIndo.model.GroupUser', {
	extend: 'Ext.data.Model',
	fields: [{
		name: 'GROUP_ID',
		type: 'string'
	},{
		name: 'NAME',
		type: 'string'
	},{
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
	}]
});