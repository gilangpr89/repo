Ext.define(MyIndo.getNameSpace('view.Master.Provinces.View'), {
	extend: 'Ext.grid.Panel',
	alias: 'widget.provincesview',
	border: false,
	columns: [{
		text: 'Province',
		flex: 1,
		dataIndex: 'NAME'
	},{
		text: 'Country',
		width: 200,
		dataIndex: 'COUNTRY_NAME'
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
				add: MyIndo.getNameSpace('view.Master.Provinces.Add'),
				update: MyIndo.getNameSpace('view.Master.Provinces.Update'),
				filter: MyIndo.getNameSpace('view.Master.Provinces.Filter')
			},
			filters: ['NAME'],
			url: {
				delete: MyIndo.baseUrl('provinces/request/destroy')
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