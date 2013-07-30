Ext.define(MyIndo.getNameSpace('view.Master.Participants.View'), {
	extend: 'Ext.grid.Panel',
	alias: 'widget.participantsview',
	border: false,
	columns: [
	Ext.create('Ext.grid.RowNumberer'),{
		text: 'Name',
		width: 263,
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
		text: 'Mobile No.',
		align: 'center',
		width: 100,
		dataIndex: 'MOBILE_NO'
	},{
		text: 'Phone No.',
		align: 'center',
		width: 100,
		dataIndex: 'PHONE_NO',
		hidden: true
	},{
		text: 'Primary Email',
		width: 170,
		align: 'center',
		dataIndex: 'EMAIL1'
	},{
		text: 'Secondary Email',
		width: 150,
		align: 'center',
		dataIndex: 'EMAIL2',
		hidden: true
	},{
		text: 'Facebook',
		width: 150,
		dataIndex: 'FB',
		hidden: true
	},{
		text: 'Twitter',
		width: 100,
		dataIndex: 'TWITER',
		hidden: true
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
			filters: ['NAME','SNAME','MOBILE_NO','EMAIL1'],
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