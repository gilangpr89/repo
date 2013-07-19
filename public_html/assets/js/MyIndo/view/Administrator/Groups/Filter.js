Ext.define('MyIndo.view.Administrator.Groups.Filter', {
	extend: 'Ext.Window',
	alias: 'widget.groupsfilter',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 330,
	title: 'Groups Filter',

	initComponent: function() {
		Ext.apply(this, {
			items: [{
				xtype: 'form',
				layout: 'form',
				bodyPadding: 5,
				border: false,
				items: [{
					xtype: 'textfield',
					fieldLabel: 'Name',
					name: 'NAME',
					emptyText: 'Input group name..'
				}]
			}],
			buttons: [{
				text: 'Apply',
				iconCls: 'icon-accept',
				action: 'groups-apply-filter'
			}]
		});
		this.callParent(arguments);
	}
});