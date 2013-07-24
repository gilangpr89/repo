Ext.define(MyIndo.getNameSpace('view.Master.Participants.View'), {
	extend: 'Ext.grid.Panel',
	alias: 'widget.participantsview',
	border: false,
	columns: [{
		text: 'Name',
		flex: 1,
		dataIndex: 'NAME'
	},{
		text: 'Surname',
		width: 100,
		align: 'center',
		dataIndex: 'SNAME'
	},{
		text: 'Gender',
		align: 'center',
		widht: 80,
		dataIndex: 'GENDER'
	},{
		text: 'Birthdate',
		align: 'center',
		width: 80,
		dataIndex: 'BDATE'
	},{
		text: 'Email',
		width: 150,
		align: 'center',
		dataIndex: 'EMAIL1'
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
				add: MyIndo.getNameSpace('view.Master.Participants.Add'),
				update: MyIndo.getNameSpace('view.Master.Participants.Update'),
				filter: MyIndo.getNameSpace('view.Master.Participants.Filter')
			},
			filters: ['NAME'],
			url: {
				delete: MyIndo.baseUrl('participants/request/destroy')
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