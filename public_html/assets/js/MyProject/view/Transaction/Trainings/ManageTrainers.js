Ext.define(MyIndo.getNameSpace('view.Transaction.Trainings.ManageTrainers'), {
	extend: 'Ext.Window',
	alias: 'widget.managetrtrainingtrainerswindow',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 950,
	title: 'Manage Training Trainers',

	initComponent: function() {
		Ext.apply(this, {
			items: [{
				xtype: 'gridpanel',
				id: 'manage-trainer-grid',
				border: false,
				minHeight: 200,
				store: this.store,
				columns: [{
					text: 'Full Name',
					flex: 1,
					dataIndex: 'TRAINER_NAME'
				},{
					text: 'Nickname',
					width: 120,
					dataIndex: 'TRAINER_NICKNAME'
				},{
					text: 'Roles',
					width: 150,
					align: 'center',
					dataIndex: 'ROLE_NAME'
				},{
					text: 'Mobile No',
					width: 150,
					align: 'center',
					dataIndex: 'TRAINER_MOBILE_NO'
				},{
					text: 'Phone No',
					width: 150,
					align: 'center',
					dataIndex: 'TRAINER_PHONE_NO',
					hidden: true
				},{
					text: 'Email',
					width: 150,
					align: 'center',
					dataIndex: 'TRAINER_EMAIL1',
					hidden: true
				},{
					text: 'City',
					width: 80,
					align: 'center',
					dataIndex: 'CITY_NAME'
				},{
					text: 'Province',
					width: 80,
					align: 'center',
					dataIndex: 'PROVINCE_NAME'
				},{
					text: 'Country',
					width: 80,
					align: 'center',
					dataIndex: 'COUNTRY_NAME'
				}]
			}],
			tbar: [{
				text: 'Add Trainer',
				iconCls: 'icon-accept',
				action: 'add'
			},{
				text: 'Update Trainer',
				iconCls: 'icon-pencil',
				action: 'update'
			},{
				text: 'Remove Trainer',
				iconCls: 'icon-cross',
				action: 'delete'
			}],
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