Ext.define('MyIndo.view.Administrator.Users.Filter', {
	extend: 'Ext.Window',
	alias: 'widget.usersfilter',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 330,
	title: 'Users Filter',

	initComponent: function() {
		Ext.apply(this, {
			items: [{
				xtype: 'form',
				layout: 'form',
				bodyPadding: 5,
				border: false,
				items: [{
					xtype: 'textfield',
					fieldLabel: 'Username',
					name: 'USERNAME',
					emptyText: 'Input username..'
				},{
					xtype: 'textfield',
					fieldLabel: 'Email',
					name: 'EMAIL',
					emptyText: 'Input email..'
				}]
			}],
			buttons: [{
				text: 'Apply',
				iconCls: 'icon-accept',
				action: 'users-apply-filter'
			}]
		});
		this.callParent(arguments);
	}
});