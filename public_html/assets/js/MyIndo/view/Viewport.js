Ext.define('MyIndo.view.Viewport', {
	extend: 'Ext.container.Viewport',
	requires: [
	'MyIndo.view.Layout.NorthPanel',
	'MyIndo.view.Layout.MainMenu',
	'MyIndo.view.Layout.Content',
	'MyIndo.view.Layout.UserMenu'
	],
	layout: 'border',
	config: {
		items: [{
			region: 'north',
			xtype: 'northpanel',
			tbar: [{
				text: 'Change Password',
				iconCls: 'icon-lock-break'
			},{
				text: 'Logout',
				iconCls: 'icon-exclamation',
				action: 'logout'
			}]
		},{
			region: 'west',
			// autoScroll: true,
			width: 250,
			// items: [{
				xtype: 'mainmenu'
			// 	minHeight: 300
			// },{
			// 	xtype: 'usermenu'
			// }]
		},{
			region: 'center',
			xtype: 'content'
		}]
	}
});