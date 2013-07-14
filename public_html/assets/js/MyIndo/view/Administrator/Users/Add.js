Ext.define('MyIndo.view.Administrator.Users.Add', {
	extend: 'Ext.Window',
	alias: 'widget.usersaddwindow',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 330,
	title: 'Add New User',

	initComponent: function() {
		Ext.apply(this, {
			items: [{
				xtype: 'form',
				layout: 'form',
				border: false,
				bodyPadding: '5 5 5 5',
				items: [{
					xtype: 'textfield',
					name: 'USERNAME',
					allowBlank: false,
					fieldLabel: 'Username',
					emptyText: 'Input username..'
				},{
					xtype: 'textfield',
					name: 'PASSWORD',
					inputType: 'password',
					allowBlank: false,
					fieldLabel: 'Password',
					emptyText: 'Input password..'
				},{
					xtype: 'textfield',
					name: 'PASSWORD2',
					inputType: 'password',
					allowBlank: false,
					fieldLabel: 'Conf. Password',
					emptyText: 'Input password confirmation..'
				},{
					xtype: 'textfield',
					name: 'EMAIL',
					allowBlank: false,
					fieldLabel: 'Email',
					vtype: 'email',
					emptyText: 'Input e-mail address..'
				}]
			}],
			buttons: [{
				text: 'Save',
				action: 'add-save'
			},{
				text: 'Cancel',
				listeners:{
					click: function() {
						this.up().up().close();
					}
				}
			}]
		});
		this.callParent(arguments);
	}
});