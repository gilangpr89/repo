Ext.define(MyIndo.getNameSpace('view.Master.Trainers.View'), {
	extend: 'Ext.grid.Panel',
	alias: 'widget.trainersview',
	border: false,
	columns: [
	Ext.create('Ext.grid.RowNumberer'),{
		text: 'Name',
		flex: 1,
		dataIndex: 'NAME'
	},{
		text: 'Nickname',
		width: 80,
		dataIndex: 'NICKNAME'
	},{
		text: 'Gender',
		width: 80,
		align: 'center',
		dataIndex: 'GENDER'
	},{
		text: 'Birthdate',
		width: 80,
		align: 'center',
		dataIndex: 'BDATE'
	},{
		text: 'Mobile No.',
		width: 100,
		align: 'center',
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
				add: MyIndo.getNameSpace('view.Master.Trainers.Add'),
				update: MyIndo.getNameSpace('view.Master.Trainers.Update'),
				filter: MyIndo.getNameSpace('view.Master.Trainers.Filter')
			},
			filters: ['NAME','NICKNAME','MOBILE_NO','EMAIL1'],
			url: {
				delete: MyIndo.baseUrl('trainers/request/destroy')
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