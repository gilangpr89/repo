Ext.define(MyIndo.getNameSpace('view.Master.AreaLevels.View'), {
	extend: 'Ext.grid.Panel',
	alias: 'widget.arealevelsview',
	border: false,
	columns: [
	Ext.create('Ext.grid.RowNumberer'),
	{
		text: 'Area Level',
		flex: 1,
		dataIndex: 'NAME'
	},{
		text: 'Type',
		flex: 1,
		dataIndex: 'TYPE'
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
				add: MyIndo.getNameSpace('view.Master.AreaLevels.Add'),
				update: MyIndo.getNameSpace('view.Master.AreaLevels.Update'),
				filter: MyIndo.getNameSpace('view.Master.AreaLevels.Filter')
			},
			filters: ['NAME','TYPE'],
			url: {
				delete: MyIndo.baseUrl('arealevels/request/destroy')
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