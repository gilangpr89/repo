Ext.define('MyIndo.view.Administrator.Users.View', {
	extend: 'Ext.grid.Panel',
	border: false,
	alias: 'widget.usersview',
	columns: [{
		text: 'Username',
		flex: 1,
		dataIndex: 'USERNAME'
	},{
		text: 'Email',
		width: 150,
		dataIndex: 'EMAIL'
	},{
		text: 'Active',
		width: 50,
		align: 'center',
		dataIndex: 'ACTIVE'
	},{
		text: 'Ip Address',
		width: 120,
		align: 'center',
		dataIndex: 'IP_ADDRESS'
	},{
		text: 'Last Ip Address',
		width: 120,
		align: 'center',
		dataIndex: 'LAST_IP_ADDRESS'
	},{
		text: 'Last Login',
		width: 150,
		align: 'center',
		dataIndex: 'LAST_LOGIN'
	},{
		text: 'Created Date',
		width: 150,
		align: 'center',
		dataIndex: 'CREATED_DATE'
	},{
		text: 'Modified Date',
		width: 150,
		align: 'center',
		dataIndex: 'MODIFIED_DATE'
	}],

	initComponent: function() {
		Ext.apply(this, {
			dockedItems: [{
				xtype: 'pagingtoolbar',
				displayInfo: true,
				dock: 'bottom',
				store: this.store
			}]
		});
		this.callParent(arguments);
	}
});