Ext.define('MyIndo.view.Administrator.LoginView', {
	extend: 'Ext.Window',
	alias: 'widget.loginwindow',
	id: 'login-window',
	overlay: true,
	draggable: false,
	resizable: false,
	modal: true,
	closable: false,
	title: 'Application Login',

	initComponent: function() {

		Ext.apply(this,{
			items: [{
				xtype: 'form',
				id: 'login-form',
				bodyPadding: '5 5 5 5',
				border: false,
				items: [{
					xtype: 'textfield',
					name: 'USERNAME',
					fieldLabel: 'Username',
					allowBlank: false
				},{
					xtype: 'textfield',
					name: 'PASSWORD',
					inputType: 'password',
					fieldLabel: 'Password',
					allowBlank: false
				}]
			}],
			buttons: [{
				text: 'Login',
				action: 'login'
			}]
		});
		this.callParent(arguments);
	}
	
});