Ext.define('MyIndo.view.Layout.UserMenu', {
	extend: 'Ext.panel.Panel',
	alias: 'widget.usermenu',
	title: 'User Menu',
	border: false,
	bodyPadding: 10,
	style: {
		backgroundColor: '#AAA'
	},
	layout: 'vbox',
	defaults: {
		style: {
			marginBottom: '5px'
		}
	},
	items: [{
		xtype: 'button',
		text: 'Change Password',
		iconCls: 'icon-lock-break'
	},{
		xtype: 'button',
		text: 'Logout',
		iconCls: 'icon-exclamation',
		action: 'logout'
	}]
});