Ext.define(MyIndo.getNameSpace('view.Master.FundingSources.View'), {
	extend: 'Ext.grid.Panel',
	alias: 'widget.fundingsourcesview',
	border: false,
	columns: [
	Ext.create('Ext.grid.RowNumberer'),{
		text: 'Funding Source',
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
				add: MyIndo.getNameSpace('view.Master.FundingSources.Add'),
				update: MyIndo.getNameSpace('view.Master.FundingSources.Update'),
				filter: MyIndo.getNameSpace('view.Master.FundingSources.Filter')
			},
			filters: ['NAME','CITY_ID','PROVINCE_ID','COUNTRY_ID'],
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