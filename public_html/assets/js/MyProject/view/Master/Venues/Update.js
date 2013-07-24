Ext.define(MyIndo.getNameSpace('view.Master.Venues.Update'), {
	extend: 'Ext.Window',
	alias: 'widget.venuesupdatewindow',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 330,
	title: 'Update Venue',

	initComponent: function() {
		Ext.apply(this, {
			items: [{
				xtype: 'form',
				layout: 'form',
				border: false,
				bodyPadding: '5 5 5 5',
				url: MyIndo.siteUrl('venues/request/update'),
				items: [{
					xtype: 'hidden',
					name: 'ID',
					allowBlank: false
				},{
					xtype: 'textfield',
					name: 'NAME',
					allowBlank: false,
					fieldLabel: 'Name',
					emptyText: 'Input name..'
				}]
			}],
			buttons: [{
				text: 'Save',
				action: 'update-save'
			},{
				text: 'Cancel',
				action: 'update-cancel'
			}]
		});
		this.callParent(arguments);
	}
});