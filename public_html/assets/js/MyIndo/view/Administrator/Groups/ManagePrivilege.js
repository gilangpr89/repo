Ext.define('MyIndo.view.Administrator.Groups.ManagePrivilege', {
	extend: 'Ext.panel.Panel',
	alias: 'widget.groupsmanageprivileges',
	closable: true,
	resizable: false,
	autoScroll: true,
//	id: 'manage-privilege',
	title: 'Manage Privilege',

	initComponent: function() {
		Ext.apply(this, {
			items: [{
				xtype: 'treepanel',
				rootVisible: false,
				useArrows: true,
				border: false,
				store: this.store
			}],
			tbar: [{
				text: 'Save',
				iconCls: 'icon-disk',
				action: 'save-privilege'
			}]
		});
		this.callParent(arguments);
	}
});