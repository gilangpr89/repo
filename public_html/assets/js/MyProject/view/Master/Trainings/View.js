Ext.define(MyIndo.getNameSpace('view.Master.Trainings.View'), {
	extend: 'Ext.grid.Panel',
	alias: 'widget.trainingsview',
	border: false,
	columns: [{
		text: 'Training',
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
				add: MyIndo.getNameSpace('view.Master.Trainings.Add'),
				update: MyIndo.getNameSpace('view.Master.Trainings.Update'),
				filter: MyIndo.getNameSpace('view.Master.Trainings.Filter')
			},
			filters: ['NAME'],
			url: {
				delete: MyIndo.baseUrl('trainings/request/destroy')
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