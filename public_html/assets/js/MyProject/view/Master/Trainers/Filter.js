Ext.define(MyIndo.getNameSpace('view.Master.Trainers.Filter'), {
	extend: 'Ext.Window',
	alias: 'widget.trainersfilterwindow',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 330,
	title: 'Filter Role',

	initComponent: function() {
		Ext.apply(this, {
			items: [{
				xtype: 'form',
				layout: 'form',
				border: false,
				bodyPadding: '5 5 5 5',
				items: [{
					xtype: 'textfield',
					name: 'NAME',
					fieldLabel: 'Name',
					emptyText: 'Input name..'
				},{
					xtype: 'textfield',
					name: 'NICKNAME',
					fieldLabel: 'Nickname',
					emptyText: 'Input nickname..'
				},{
					xtype: 'textfield',
					name: 'MOBILE_NO',
					fieldLabel: 'Mobile No.',
					emptyText: 'Input Mobile No.'
				},{
					xtype: 'textfield',
					name: 'EMAIL1',
					fieldLabel: 'Email',
					emptyText: 'Input Email..'
				}]
			}],
			buttons: [{
				text: 'Save',
				action: 'filter-search'
			},{
				text: 'Cancel',
				action: 'filter-cancel'
			}]
		});
		this.callParent(arguments);
	}
});