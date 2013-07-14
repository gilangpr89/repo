Ext.define('MyIndo.view.Administrator.Groups.Manage', {
	extend: 'Ext.grid.Panel',
	alias: 'widget.managegroup',
	closable: true,
	border: false,
	columns: [{
		text: 'Username',
		flex: 1,
		dataIndex: 'USERNAME'
	},{
		text: 'Email',
		width: 200,
		dataIndex: 'EMAIL'
	}],
	
	initComponent: function() {
		this.store.load();
		Ext.apply(this, {
			tbar: [{
				text: 'Add User',
				iconCls: 'icon-accept',
				action: 'add'
			},{
				text: 'Delete User',
				iconCls: 'icon-cross',
				action: 'delete'
			}],
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