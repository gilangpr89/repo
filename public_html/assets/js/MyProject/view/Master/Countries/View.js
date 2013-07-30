Ext.define(MyIndo.getNameSpace('view.Master.Countries.View'), {
	extend: 'Ext.grid.Panel',
	alias: 'widget.countriesview',
	border: false,
	columns: [
	Ext.create('Ext.grid.RowNumberer'),{
		text: 'Country',
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
				add: MyIndo.getNameSpace('view.Master.Countries.Add'),
				update: MyIndo.getNameSpace('view.Master.Countries.Update'),
				filter: MyIndo.getNameSpace('view.Master.Countries.Filter')
			},
			filters: ['NAME'],
			url: {
				delete: MyIndo.baseUrl('countries/request/destroy')
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