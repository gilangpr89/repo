Ext.define(MyIndo.getNameSpace('view.Master.Venues.Add'), {
	extend: 'Ext.Window',
	alias: 'widget.venuesaddwindow',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 330,
	title: 'Add New Venue',

	initComponent: function() {
		Ext.apply(this, {
			items: [{
				xtype: 'form',
				layout: 'form',
				border: false,
				bodyPadding: '5 5 5 5',
				url: MyIndo.siteUrl('venues/request/create'),
				items: [{
					xtype: 'textfield',
					name: 'NAME',
					allowBlank: false,
					fieldLabel: 'Name',
					emptyText: 'Input name..'
				}]
			}],
			buttons: [{
				text: 'Save',
				action: 'add-save'
			},{
				text: 'Cancel',
				action: 'add-cancel'
			}]
		});
		this.callParent(arguments);
	}
});