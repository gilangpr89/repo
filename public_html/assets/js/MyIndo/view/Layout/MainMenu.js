Ext.define('MyIndo.view.Layout.MainMenu', {
	extend: 'Ext.panel.Panel',
	alias: 'widget.mainmenu',
	title: 'Main Menu',
	id: 'main-menu-panel',
	padding: '1 0 0 0',
	autoScroll: true,
	border: false,

	initComponent: function() {
		var store = Ext.getStore('Menus');
		Ext.apply(this, {
			items: [{
				xtype: 'treepanel',
				id: 'main-menu',
				border: false,
				rootVisible: false,
				store: store
			}]
		});
		this.callParent(arguments);
	}

});
	// initComponent: function() {

	// 	var me = this;
	// 	var treeStore = Ext.getStore('Menus');
	// 	if(typeof(MyIndo.rootNode) === 'undefined') {
	// 		Ext.Ajax.request({
	// 			url: MyIndo.siteUrl('myindo/request/get-list-menu'),
	// 			params: {
	// 				node: 'root'
	// 			},
	// 			success: function(response) {
	// 				var json = Ext.decode(response.responseText);
	// 				if(json.login) {
	// 					var children = me.getMenuRecursive(json.data, json.data[0].PARENT_ID);
	// 					MyIndo.rootNode = {
	// 						expanded: true,
	// 						children: children
	// 					};
	// 					treeStore.setRootNode(MyIndo.rootNode);
	// 				} else {
						
	// 					var mainContent = Ext.getCmp('main-content');
	// 					var items = mainContent.items;
						
	// 					/* Close all tabs */
	// 					Ext.each(items.items, function(item) {
	// 						mainContent.items.get(item.id).close();
	// 					});

	// 					/* Close all window */
	// 					Ext.WindowManager.each(function(cmp) { cmp.destroy(); });
						
	// 					var loginView = Ext.create('MyIndo.view.Administrator.LoginView');
	// 					loginView.show();
	// 				}
	// 			}
	// 		});
	// 	} else {
	// 		treeStore.setRootNode(MyIndo.rootNode);
	// 	}
	// 	Ext.apply(this,{
	// 		items: [{
	// 			xtype: 'treepanel',
	// 			id: 'main-menu',
	// 			border: false,
	// 			store: treeStore,
	// 			rootVisible: false
	// 		}]
	// 	});
	// 	this.callParent(arguments);
	// },
	
	// getMenuRecursive: function(json, parent) {
	// 	var tree = new Array();
	// 	var me = this;
	// 	Ext.each(json, function(menu, index) {
	// 		if(menu.PARENT_ID == parent && menu.TYPE != 'ACTION') {
	// 			var idx = tree.length;
	// 			tree[idx] = {
	// 				text		: menu.text,
	// 				MENU_ID		: menu.MENU_ID,
	// 				PARENT_ID 	: menu.PARENT_ID,
	// 				ACTION		: menu.ACTION,
	// 				TYPE		: menu.TYPE
	// 			};
	// 			if(typeof(json[index].data) !== 'undefined') {
	// 				tree[idx].children 	= me.getMenuRecursive(json[index].data, menu.MENU_ID);
	// 				tree[idx].expanded	= true;
	// 			} else {
	// 				tree[idx].leaf		= true;
	// 			}
	// 		}
	// 	});
	// 	return tree;
	// }
// });