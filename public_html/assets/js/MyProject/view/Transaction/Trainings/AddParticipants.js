Ext.define(MyIndo.getNameSpace('view.Transaction.Trainings.AddParticipants'), {
	extend: 'Ext.Window',
	alias: 'widget.manageparticipantsaddwindow',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 360,
	title: 'Add New Participant',

	initComponent: function() {

		var storeParticipants = Ext.create(MyIndo.getNameSpace('store.Master.Participants'),{autoDestroy:true});
		var storePositions = Ext.create(MyIndo.getNameSpace('store.Master.Positions'),{autoDestroy:true});
		var storeOrganizations = Ext.create(MyIndo.getNameSpace('store.Master.Organizations'),{autoDestroy:true});

		Ext.apply(this, {
			items: [{
				xtype: 'form',
				layout: 'form',
				border: false,
				bodyPadding: '5 5 5 5',
				url: MyIndo.siteUrl('trainingparticipants/request/create'),
				items: [{
					xtype: 'hidden',
					name: 'TRAINING_ID',
					allowBlank: false
				},{
					xtype: 'combobox',
					fieldLabel: 'Participant Name',
					name: 'PARTICIPANT_ID',
					allowBlank: false,
					displayField: 'NAME',
					valueField: 'ID',
					minChars: 3,
					pageSize: 25,
					store: storeParticipants,
					allowBlank: false,
					emptyText: 'Select participant..'
				},{
					xtype: 'combobox',
					fieldLabel: 'Organization',
					name: 'ORGANIZATION_ID',
					allowBlank: false,
					displayField: 'NAME',
					valueField: 'ID',
					minChars: 3,
					pageSize: 25,
					store: storeOrganizations,
					allowBlank: false,
					emptyText: 'Select organization..'
				},{
					xtype: 'combobox',
					fieldLabel: 'Position',
					name: 'POSITION_ID',
					allowBlank: false,
					displayField: 'NAME',
					valueField: 'ID',
					minChars: 3,
					pageSize: 25,
					store: storePositions,
					allowBlank: false,
					emptyText: 'Select position..'
				},{
					xtype: 'numberfield',
					name: 'PRE_TEST',
					fieldLabel: 'Pre Test',
					minValue: 0,
					value: 0,
					allowBlank: false
				},{
					xtype: 'numberfield',
					name: 'POST_TEST',
					fieldLabel: 'Post Test',
					minValue: 0,
					value: 0,
					allowBlank: false
				},{
					xtype: 'numberfield',
					name: 'DIFF',
					fieldLabel: 'Difference',
					minValud: 0,
					value: 0,
					allowBlank: false
				}]
			}],
			buttons: [{
				text: 'Save',
				action: 'add-save'
			},{
				text: 'Cancel',
				action: 'add-cancel',
				listeners: {
					click: function() {
						this.up().up().close();
					}
				}
			}]
		});
		this.callParent(arguments);
	}
});