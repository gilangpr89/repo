Ext.define('MyIndo.view.Administrator.Groups.AddUser', {
	extend: 'Ext.Window',
	alias: 'widget.manageadduserwindow',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 360,
	title: 'Add New User',

	initComponent: function() {
		var me = this;
		Ext.apply(this, {
			items: [{
				xtype: 'form',
				layout: 'form',
				border: false,
				bodyPadding: '5 5 5 5',
				items: [{
					xtype: 'hidden',
					name: 'GROUP_ID',
					allowBlank: false
				},{
					xtype: 'combobox',
					fieldLabel: 'Username',
					name: 'USER_ID',
					allowBlank: false,
					displayField: 'USERNAME',
					valueField: 'USER_ID',
					minChars: 3,
					pageSize: 25,
					store: me.userStore,
					allowBlank: false
				}]
			}],
			buttons: [{
				text: 'Save',
				action: 'manage-add-save'
			},{
				text: 'Cancel',
				listeners: {
					click: function() {
						this.up().up().close();
					}
				}
			}]
		});
		this.callParent(arguments);
	}
});