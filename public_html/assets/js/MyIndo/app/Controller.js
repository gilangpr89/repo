Ext.define('MyIndo.app.Controller', {
	extend: 'Ext.app.Controller',
	requires: [
	'Ext.Window'
	],
	isLogin: function(data, obj = null) {
		try {
			if(!data.login) {
				//var mainContent = Ext.getCmp('main-content');
				//var items = mainContent.items;
				
				/* Close all tabs */
				//Ext.each(items.items, function(item) {
				//	mainContent.items.get(item.id).close();
				//});

				/* Close all window */
				// Ext.WindowManager.each(function(cmp) { cmp.destroy(); });
				// Ext.WindowMgr.hideAll();

				var me = this;
				Ext.Msg.alert('Session Expired', 'Sorry you are not authenticated or session is expired, please login again.', function(btn) {
					if(typeof(Ext.getCmp('_LOGIN_FORM')) === 'undefined') {
						me.showLoginWindow();
					}
				}, obj);
			}
			return data.login;
		} catch(e) {
			Ext.Msg.alert('Application Error', e);
		}
	},

	showLoadingWindow: function() {
		if(typeof(Ext.getCmp('generatedLoadingWindow')) === 'undefined') {
			Ext.create('MyIndo.view.Loading', {
				id: 'generatedLoadingWindow'
			}).show();
		} else {
			Ext.getCmp('generatedLoadingWindow').show();
		}
	},

	closeLoadingWindow: function() {
		if(typeof(Ext.getCmp('generatedLoadingWindow')) !== 'undefined') {
			Ext.getCmp('generatedLoadingWindow').close();
		}
	},

	showLoginWindow: function() {
		var me = this;
		Ext.create('Ext.Window', {
			title: 'Login',
			width: 300,
			resizable: false,
			closable: false,
			draggable: true,
			id: '_LOGIN_FORM',
			modal: true,
			items: [{
				xtype: 'form',
				layout: 'form',
				bodyPadding: '5 5 5 5',
				id: 'login-form',
				waitMsgTarget: true,
				border: false,
				defaultType: 'textfield',
				items: [{
					fieldLabel: 'Username',
					name: 'USERNAME',
					id: '_USERNAME',
					enableKeyEvents: true,
					allowBlank: false,
					listeners: {
						keypress: function(d, e) {
							if(e.getKey() == 13) {
								me.login();
							}
						}
					}
				},{
					fieldLabel: 'Password',
					inputType: 'password',
					allowBlank: false,
					name: 'PASSWORD',
					id: '_PASSWORD',
					enableKeyEvents: true,
					listeners: {
						keypress: function(d, e) {
							if(e.getKey() == 13) {
								me.login();
							}
						}
					}
				}],
				buttons: [{
					text: 'Login',
					listeners: {
						click: function() {
							me.login();
						}
					}
				}]
			}]
		}).show();
		Ext.getCmp('_USERNAME').focus(false, 100);
	},

	login: function() {
		var form = Ext.getCmp('login-form').getForm();
		if(form.isValid()) {
			form.submit({
				url: MyIndo.baseUrl('users/login'),
				success: function(a, b) {
					var json = Ext.decode(b.response.responseText);
					Ext.Msg.alert('Message',json.data.message);
					Ext.getCmp('_LOGIN_FORM').close();
				},
				failure: function(a, b) {
					var json = Ext.decode(b.response.responseText);
					Ext.Msg.alert('Login authentication failed',json.data.message);
				},
				waitMsg: 'Authenticating, please wait..'
			});
		} else {
			Ext.Msg.alert('Message','Please complete form first !', function() {
				var _x = Ext.getCmp('_USERNAME');
				var _y = Ext.getCmp('_PASSWORD');
				if(_x.getValue().length == 0) {
					_x.focus();
				} else if(_y.getValue().length == 0) {
					_y.focus();
				}
			});
		}
	},

	isSuccess: function(data) {
		if(!data.success) {
			this.fail(data);
		}
		return data.success;
	},

	fail: function(data) {
		Ext.Msg.alert('Application Error', '<strong>Error Code: ' + data.error_code + '</strong><br/><strong>Error Message</strong>: ' + data.error_message);
	},
	
	/* Menu */
	
	reloadMenu: function() {
		var me = this;
		this.showLoadingWindow();
		Ext.Ajax.request({
			url: MyIndo.siteUrl('menus/request/read'),
			params: {
				node: 'root'
			},
			success: function(response) {
				var json = Ext.decode(response.responseText);
				me.closeLoadingWindow();
				if(me.isLogin(json)) {
					var treeStore = Ext.getStore('Menus');
					var children = me.getMenuRecursive(json.data, json.data[0].PARENT_ID);
					MyIndo.rootNode = {
						expanded: true,
						children: children
					};
					treeStore.setRootNode(MyIndo.rootNode);
				}
			}
		});
	},
	
	getMenuRecursive: function(json, parent) {
		var tree = new Array();
		var me = this;
		Ext.each(json, function(menu, index) {
			if(menu.PARENT_ID == parent && menu.TYPE != 'ACTION') {
				var idx = tree.length;
				tree[idx] = {
					text		: menu.text,
					MENU_ID		: menu.MENU_ID,
					PARENT_ID 	: menu.PARENT_ID,
					ACTION		: menu.ACTION,
					TYPE		: menu.TYPE
				};
				if(typeof(json[index].data) !== 'undefined') {
					tree[idx].children 	= me.getMenuRecursive(json[index].data, menu.MENU_ID);
					tree[idx].expanded	= true;
				} else {
					tree[idx].leaf		= true;
				}
			}
		});
		return tree;
	}
	
	/* End of : Menu */
});