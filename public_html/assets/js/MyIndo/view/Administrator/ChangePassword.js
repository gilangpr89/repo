Ext.define('MyIndo.view.Administrator.ChangePassword', {
	extend: 'Ext.Window',
	alias: 'widget.changepasswordwindow',
	id: 'change-password-window',
	title: 'Change Password',
	width: 380,
	modal: true,
	resizable: false,
	draggable: true,
	closable: true,

	initComponent: function() {
		Ext.apply(this, {
			items: [{
				xtype: 'form',
				layout: 'form',
				border: false,
				bodyPadding: '5',
				items: [{
					xtype: 'textfield',
					inputType: 'password',
					fieldLabel: 'Old Password',
					name: 'OLD_PASSWORD',
					allowBlank: false
				},{
					xtype: 'textfield',
					inputType: 'password',
					fieldLabel: 'New Password',
					name: 'NEW_PASSWORD',
					allowBlank: false
				},{
					xtype: 'textfield',
					inputType: 'password',
					fieldLabel: 'New Password Confirmation',
					labelWidth: 160,
					name: 'NEW_PASSWORD_CONF',
					allowBlank: false
				}],
				buttons: [{
					text: 'Change Password',
					action: 'do-change-password'
				},{
					text: 'Cancel',
					action: 'cancel-change-password'
				}]
			}]
		});
		this.callParent(arguments);
	}
});