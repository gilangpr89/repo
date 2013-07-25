Ext.define(MyIndo.getNameSpace('view.Transaction.Trainings.ManageParticipants'), {
	extend: 'Ext.Window',
	alias: 'widget.managetrtrainingsparticipantswindow',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 500,
	title: 'Manage Training Participant',

	initComponent: function() {
		Ext.apply(this, {
			items: [{
				xtype: 'gridpanel',
				border: false,
				minHeight: 200,
				columns: [{
					text: 'Username',
					flex: 1,
					dataIndex: 'USERNAME'
				},{
					text: 'Email',
					width: 200,
					dataIndex: 'EMAIL'
				}]
			}],
			tbar: [{
				text: 'Add Participant',
				iconCls: 'icon-accept',
				action: 'add'
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