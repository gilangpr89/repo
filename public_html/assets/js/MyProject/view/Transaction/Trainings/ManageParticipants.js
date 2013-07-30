Ext.define(MyIndo.getNameSpace('view.Transaction.Trainings.ManageParticipants'), {
	extend: 'Ext.Window',
	alias: 'widget.managetrtrainingsparticipantswindow',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 950,
	title: 'Manage Training Participant',

	initComponent: function() {
		Ext.apply(this, {
			items: [{
				xtype: 'gridpanel',
				id: 'manage-participant-grid',
				border: false,
				minHeight: 200,
				store: this.store,
				columns: [
				Ext.create('Ext.grid.RowNumberer'),
				{
					text: 'Name',
					flex: 1,
					dataIndex: 'PARTICIPANT_NAME'
				},{
					text: 'Surname',
					width: 90,
					dataIndex: 'PARTICIPANT_SNAME'
				},{
					text: 'Organization',
					width: 150,
					dataIndex: 'ORGANIZATION_NAME'
				},{
					text: 'Position',
					width: 80,
					align: 'center',
					dataIndex: 'POSITION_NAME'
				},{
					text: 'Gender',
					width: 60,
					align: 'center',
					dataIndex: 'PARTICIPANT_GENDER'
				},{
					text: 'Birthdate',
					width: 80,
					align: 'center',
					dataIndex: 'PARTICIPANT_BDATE',
					hidden: true
				},{
					text: 'Mobile No',
					width: 100,
					align: 'center',
					dataIndex: 'PARTICIPANT_MOBILE_NO',
					hidden: true
				},{
					text: 'Email',
					width: 120,
					dataIndex: 'PARTICIPANT_EMAIL',
					hidden: true
				},{
					text: 'Pre-Test',
					align: 'center',
					width: 60,
					dataIndex: 'PRE_TEST'
				},{
					text: 'Post-Test',
					align: 'center',
					width: 60,
					dataIndex: 'POST_TEST'
				},{
					text: 'Difference',
					align: 'center',
					width: 60,
					dataIndex: 'DIFF'
				}]
			}],
			tbar: [{
				text: 'Add Participant',
				iconCls: 'icon-accept',
				action: 'add'
			},{
				text: 'Update Participant',
				iconCls: 'icon-pencil',
				action: 'update'
			},{
				text: 'Remove Participant',
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