Ext.define(MyIndo.getNameSpace('view.Master.FundingSources.View'), {
	extend: 'Ext.grid.Panel',
	alias: 'widget.fundingsourcesview',
	border: false,
	columns: [{
		text: 'Funding Source',
		flex: 1,
		dataIndex: 'NAME'
	},{
		text: 'Created Date',
		align: 'center',
		width: 150,
		dataIndex: 'CREATED_DATE'
	},{
		text: 'Modified Date',
		align: 'center',
		width: 150,
		dataIndex: 'MODIFIED_DATE'
	}],

	initComponent: function() {
		Ext.apply(this, {
			actions: {
				add: MyIndo.getNameSpace('view.Master.FundingSources.Add'),
				update: MyIndo.getNameSpace('view.Master.FundingSources.Update'),
				filter: MyIndo.getNameSpace('view.Master.FundingSources.Filter')
			},
			filters: ['NAME'],
			url: {
				delete: MyIndo.baseUrl('fundingsources/request/destroy')
			},
			dockedItems: [{
				xtype: 'pagingtoolbar',
				displayInfo: true,
				dock: 'bottom',
				store: this.store
			}]
		});
		this.callParent(arguments);
	}
});