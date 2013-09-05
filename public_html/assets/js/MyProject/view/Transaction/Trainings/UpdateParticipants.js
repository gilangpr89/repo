Ext.define(MyIndo.getNameSpace('view.Transaction.Trainings.UpdateParticipants'), {
	extend: 'Ext.Window',
	alias: 'widget.manageparticipantsupdatewindow',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 360,
	title: 'Update Participant',

	checker: function(c, obj) {
		if(c == 2) {
			obj.close();
		}
	},

	initComponent: function() {

		var storePositions = Ext.create(MyIndo.getNameSpace('store.Master.Positions'),{autoDestroy:true});
		var storeOrganizations = Ext.create(MyIndo.getNameSpace('store.Master.Organizations'),{autoDestroy:true});
		var LD = Ext.create('MyIndo.view.Loading');
		LD.show();
		var me = this;
		var count = 0;
		storePositions.load({
			callback: function() {
				count++;
				me.checker(count, LD);
			}
		});
		storeOrganizations.load({
			callback: function() {
				count++;
				me.checker(count, LD);
			}
		});

		Ext.apply(this, {
			items: [{
				xtype: 'form',
				layout: 'form',
				border: false,
				bodyPadding: '5 5 5 5',
				url: MyIndo.siteUrl('trainingparticipants/request/update'),
				items: [{
					xtype: 'hidden',
					name: 'ID',
					allowBlank: false
				},{
					xtype: 'hidden',
					name: 'TRAINING_ID',
					allowBlank: false
				},{
					xtype: 'hidden',
					name: 'PARTICIPANT_ID',
					allowBlank: false
				},{
					xtype: 'textfield',
					fieldLabel: 'Participant Name',
					name: 'PARTICIPANT_NAME',
					allowBlank: false,
					allowBlank: false,
					readOnly: true
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
					//editable: false
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
				action: 'update-save'
			},{
				text: 'Cancel',
				action: 'update-cancel',
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