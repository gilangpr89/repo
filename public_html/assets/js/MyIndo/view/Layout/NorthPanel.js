Ext.define('MyIndo.view.Layout.NorthPanel', {
	extend: 'Ext.panel.Panel',
	alias: 'widget.northpanel',
	title: 'MyProject',
	border: false,
	tbar: [{
		text: 'Change Password',
		iconCls: 'icon-lock-break'
	},{
		text: 'Close All Tabs',
		iconCls: ''
	},{
		text: 'Logout',
		iconCls: 'icon-exclamation',
		action: 'logout'
	}]
//	tbar: [{
//		text: 'My Account',
//		iconCls: 'icon-user'
//	},{
//		text: 'Logout',
//		iconCls: 'icon-lock-break',
//		listeners: {
//			click: function() {
//				Ext.Msg.confirm('Logout', 'Are you sure want to logout ?', function(btn) {
//					if(btn == 'yes') {
//						document.location = MyIndo.baseUrl('users/login/logout');
//					}
//				});
//			}
//		}
//	}]
});