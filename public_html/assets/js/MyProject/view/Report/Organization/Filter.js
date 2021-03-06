Ext.define(MyIndo.getNameSpace('view.Report.Organization.Filter'), {
	extend: 'Ext.Window',
	alias: 'widget.reportorganizationfilterwindow',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 400,
	title: 'Filter Organization',

	initComponent: function() {
	    Ext.apply(this, {
			items: [{
				xtype: 'form',
				layout: 'form',
				border: false,
				bodyPadding: '5 5 5 5',
				url: MyIndo.siteUrl('organizations/request/detail'),
				items: [{
					xtype: 'textfield',
					name: 'NAME',
					fieldLabel: 'Name',
					emptyText: 'Input name..'
				}]
			}],
			buttons: [{
				text: 'Filter',
				action: 'filter-search'
			}]
		});
		this.callParent(arguments);
	}
});