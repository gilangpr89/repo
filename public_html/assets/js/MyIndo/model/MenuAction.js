Ext.define('MyIndo.model.MenuAction', {
	extend: 'Ext.data.Model',
	fields: [{
		name: 'MENU_ID',
		type: 'string'
	},{
		name: 'MENU_TITLE',
		type: 'string'
	},{
		name: 'ACTIVE',
		type: 'int'
	},{
		name: 'INDEX',
		type: 'int'
	},{
		name: 'ACTION',
		type: 'string'
	},{
		name: 'TYPE',
		type: 'string'
	},{
		name: 'ICONCLS',
		type: 'string'
	},{
		name: 'PARENT_ID',
		type: 'string'
	},{
		name: 'CREATED_DATE',
		type: 'string'
	},{
		name: 'MODIFIED_DATE',
		type: 'string'
	}]
});