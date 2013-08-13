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