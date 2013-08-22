Ext.define('MyIndo.controller.Menu', {
	extend: 'MyIndo.app.Controller',

	requires: [
	'MyIndo.view.Loading',

	'MyIndo.view.Administrator.ChangePassword',

	/* Groups */
	'MyIndo.view.Administrator.Groups.View',
	'MyIndo.view.Administrator.Groups.Add',
	'MyIndo.view.Administrator.Groups.Update',
	'MyIndo.view.Administrator.Groups.Manage',
	'MyIndo.view.Administrator.Groups.AddUser',
	'MyIndo.view.Administrator.Groups.Filter',
	'MyIndo.view.Administrator.Groups.ManagePrivilege',

	/* Users */
	'MyIndo.view.Administrator.Users.View',
	'MyIndo.view.Administrator.Users.Add',
	'MyIndo.view.Administrator.Users.Update',
	'MyIndo.view.Administrator.Users.Filter'
	],
	
	stores: [
	'MyIndo.store.MenuActions',
	'MyIndo.store.Groups',
	'MyIndo.store.Users',
	'MyIndo.store.GroupUsers',
	'MyIndo.store.Privileges'
	],

	init: function() {
		this.control({
			'#main-menu': {
				itemclick: this.onMenuClicked
			},
			'#main-menu-panel': {
				render: function(panel) {
					var treePanel = panel.items.get('main-menu');
					this.reloadMenu();
				}
			},
			'northpanel button': {
				click: this.onUserMenuButtonClicked
			},
			'changepasswordwindow button': {
				click: this.onUserMenuButtonClicked
			}
		});
	},

	showLoading: function() {
		Ext.create('MyIndo.view.Loading').show();
	},
	
	createPanel: function(menuTitle, menuId, mainContent, store, xtype) {
		if(!mainContent.items.get(menuId)) {
			var menuStore = Ext.create('MyIndo.store.MenuActions');
			var me = this;
			me.showLoadingWindow();
			menuStore.proxy.extraParams = {MENU_ID: menuId};
			menuStore.load({
				callback: function(record, r) {
					var tbar = new Array();
					if(typeof(r.response) !== 'undefined') {
						store.load({
							callback: function(model, data) {
								var json = Ext.decode(data.response.responseText);
								me.isLogin(json);
							}
						});
						Ext.each(record, function(r, i) {
							tbar[i] = {
								'text'		: r.data.MENU_TITLE,
								'iconCls'	: r.data.ICONCLS,
								'action'	: r.data.ACTION
							};
						});
						mainContent.add(Ext.create(xtype, {
							title: menuTitle,
							id: menuId,
							closable: true,
							store: store,
							tbar: tbar
						}));
						mainContent.setActiveTab(menuId);
					} else {
						me.isLogin({login:false});
					}
					me.closeLoadingWindow();
				}
			});
		}
		mainContent.setActiveTab(menuId);
	},

	onMenuClicked: function(record) {
		var obj = record.getSelectionModel().getSelection();
		if(obj.length > 0) {
			if(obj[0].get('parentId') !== 'root') {
				if(obj[0].isLeaf()) {
					var menuTitle = obj[0].get('text');
					var menuId = obj[0].raw.MENU_ID;
					var menuAction = obj[0].raw.ACTION;
					var mainContent = Ext.getCmp('main-content');
					var loadingWindow = Ext.create('MyIndo.view.Loading');
					if(menuAction.length > 0) {
						try {
						eval('this.' + menuAction + '(menuTitle, menuId, mainContent)');
						} catch(e) {
							Ext.Msg.alert('Application Error', e);
						}
					}
				}
			}
		}
	},

	onUserMenuButtonClicked: function(record) {
		var action = record.action;
		switch(action) {
			case 'change-password':
				this.changePassword();
				break;
			case 'logout':
				this.logout();
				break;
			case 'tab-close':
				this.closeAllTabs();
				break;
			case 'do-change-password':
				this.doChangePassword(record);
				break;
			case 'cancel-change-password':
				this.cancelChangePassword(record);
				break;
			default:
				console.log(record);
		}
	},

	/* Change Password */
	changePassword: function() {
		if(typeof(Ext.getCmp('change-password-window')) === 'undefined') {
			Ext.create('MyIndo.view.Administrator.ChangePassword').show();
		}
	},

	doChangePassword: function(record) {
		var parentWindow = record.up().up().up();
		var form = record.up().up();
		var me = this;
		if(form.isValid()) {
			var vals = form.getValues();
			if(typeof(vals.OLD_PASSWORD) !== 'undefined' && typeof(vals.NEW_PASSWORD) !== 'undefined' && typeof(vals.NEW_PASSWORD_CONF) !== 'undefined') {
				if(vals.NEW_PASSWORD === vals.NEW_PASSWORD_CONF) {
					me.showLoadingWindow();
					form.submit({
						url: MyIndo.baseUrl('users/login/change-password'),
						success: function(data, record) {
							var json = Ext.decode(record.response.responseText);
							if(me.isLogin(json)) {
								Ext.Msg.alert('Change Password', 'Password successfully changed.');
							}
							me.closeLoadingWindow();
						},
						failure: function(data, record) {
							var json = Ext.decode(record.response.responseText);
							if(me.isLogin(json)) {
								Ext.Msg.alert('Application Error', '<strong>Error</strong> : [' + json.error_code + '] ' + json.error_message);
							}
							me.closeLoadingWindow();
						}
					});
				} else {
					Ext.Msg.alert('Change Password', 'New password does not match.');
				}
			} else {
				Ext.Msg.alert('Change Password', 'Please complete form first.');
			}
		} else {
			Ext.Msg.alert('Change Password', 'Please complete form first.');
		}
	},

	cancelChangePassword: function(record) {
		record.up().up().up().close();
	},

	/* Logout */

	logout: function() {
		var me = this;
		Ext.Msg.confirm('Logout', 'Are you sure want to logout ?', function(btn) {
			if(btn == 'yes') {
				me.showLoading();
				setTimeout(function() {
					document.location = MyIndo.baseUrl('users/login/logout');
				},1000);
			}
		});
	},

	/* Close all tabs */

	closeAllTabs: function() {
		var content = Ext.getCmp('main-content');
		if(content.items.length > 0) {
			Ext.Msg.confirm('Close All Tabs', 'Are you sure want to close all tabs ?', function(btn) {
				if(btn == 'yes') {
					content.items.each(function(item) {
						if(item.closable) {
							item.close();
						}
					});
				}
			});
		} else {
			Ext.Msg.alert('Application Error', 'There are no tab opened.');
		}
	},

	/* Groups */

	onGroupsClicked: function(menuTitle, menuId, mainContent) {
		var store = Ext.create('MyIndo.store.Groups');
		this.createPanel(menuTitle, menuId, mainContent, store, 'MyIndo.view.Administrator.Groups.View');
	},

	/* Users */

	onUsersClicked: function(menuTitle, menuId, mainContent) {
		var store = Ext.create('MyIndo.store.Users');
		this.createPanel(menuTitle, menuId, mainContent, store, 'MyIndo.view.Administrator.Users.View');
	},

	/* Menu Managements */

	onMenuManagementClicked: function(menuTitle, menuId, mainContent) {

	}
});