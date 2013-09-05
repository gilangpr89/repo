Ext.define(MyIndo.getNameSpace('view.Report.Organization.View'), {
	extend: 'Ext.grid.Panel',
	alias: 'widget.reportorganizationview',
	border: false,
	columns: [{
		text: 'Organization',
		flex: 1,
		dataIndex: 'NAME'
	},{
		text: 'Phone',
		align: 'center',
		width: 100,
		dataIndex: 'PHONE_NO1'
	},{
		text: 'Email',
		align: 'center',
		width: 130,
		dataIndex: 'EMAIL1'
	},{
		text: 'City',
		align: 'center',
		width: 100,
		dataIndex: 'CITY_NAME'
	},{
		text: 'Province',
		align: 'center',
		width: 100,
		dataIndex: 'PROVINCE_NAME'
	},{
		text: 'Country',
		align: 'center',
		width: 100,
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
				filter: MyIndo.getNameSpace('view.Report.Organization.Filter')
			},
			filters: ['NAME'],
			url: {
				delete: MyIndo.baseUrl('organizations/request/destroy')
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