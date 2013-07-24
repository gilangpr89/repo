Ext.define(MyIndo.getNameSpace('view.Master.Provinces.Filter'), {
	extend: 'Ext.Window',
	alias: 'widget.provincesfilterwindow',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 330,
	title: 'Filter Province',

	initComponent: function() {
		Ext.apply(this, {
			items: [{
				xtype: 'form',
				layout: 'form',
				border: false,
				bodyPadding: '5 5 5 5',
				items: [{
					xtype: 'textfield',
					name: 'NAME',
					fieldLabel: 'Name',
					emptyText: 'Input name..'
				}]
			}],
			buttons: [{
				text: 'Save',
				action: 'filter-search'
			},{
				text: 'Cancel',
				action: 'filter-cancel'
			}]
		});
		this.callParent(arguments);
	}
});