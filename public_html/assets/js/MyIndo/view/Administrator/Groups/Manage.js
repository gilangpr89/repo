Ext.define('MyIndo.view.Administrator.Groups.Manage', {
	extend: 'Ext.Window',
	alias: 'widget.managegroup',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 500,

	initComponent: function() {
		Ext.apply(this, {
			items: [{
				xtype: 'gridpanel',
				border: false,
				minHeight: 200,
				store: this.store,
				columns: [
				Ext.create('Ext.grid.RowNumberer'),
				{
					text: 'Username',
					flex: 1,
					dataIndex: 'USERNAME'
				},{
					text: 'Email',
					width: 200,
					dataIndex: 'EMAIL'
				}]
			}],
			tbar: [{
				text: 'Add User',
				iconCls: 'icon-accept',
				action: 'add'
			},{
				text: 'Remove User',
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