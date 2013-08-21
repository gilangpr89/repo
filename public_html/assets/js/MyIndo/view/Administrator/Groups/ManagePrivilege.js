Ext.define('MyIndo.view.Administrator.Groups.ManagePrivilege', {
	extend: 'Ext.Window',
	alias: 'widget.groupsmanageprivileges',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 380,
	title: 'Manage Privilege',

	initComponent: function() {
		Ext.apply(this, {
			items: [{
				xtype: 'treepanel',
				rootVisible: false,
				useArrows: true,
				border: false
			}]
		});
		this.callParent(arguments);
	}
});