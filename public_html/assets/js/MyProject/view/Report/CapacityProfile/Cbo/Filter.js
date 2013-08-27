Ext.define(MyIndo.getNameSpace('view.Report.CapacityProfile.Cbo.Filter'), {
	extend: 'Ext.Window',
	alias: 'widget.capacityprofilecbofilterwindow',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 400,
	title: 'Filter Cbo',

	initComponent: function() {
	    Ext.apply(this, {
			items: [{
				xtype: 'form',
				layout: 'form',
				border: false,
				bodyPadding: '5 5 5 5',
				url: MyIndo.siteUrl('reports/request/cbo'),
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
			}]
		});
		this.callParent(arguments);
	}
});