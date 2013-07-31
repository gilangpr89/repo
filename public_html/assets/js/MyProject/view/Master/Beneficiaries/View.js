Ext.define(MyIndo.getNameSpace('view.Master.Beneficiaries.View'), {
	extend: 'Ext.grid.Panel',
	alias: 'widget.beneficiariesview',
	border: false,
	columns: [{
		text: 'Beneficiaries',
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
				add: MyIndo.getNameSpace('view.Master.Beneficiaries.Add'),
				update: MyIndo.getNameSpace('view.Master.Beneficiaries.Update'),
				filter: MyIndo.getNameSpace('view.Master.Beneficiaries.Filter')
			},
			filters: ['NAME'],
			url: {
				delete: MyIndo.baseUrl('beneficiaries/request/destroy')
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