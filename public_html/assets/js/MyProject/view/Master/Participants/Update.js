Ext.define(MyIndo.getNameSpace('view.Master.Participants.Update'), {
	extend: 'Ext.Window',
	alias: 'widget.participantsupdatewindow',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 330,
	title: 'Update Participant',

	initComponent: function() {
		Ext.define('Gender', {
			extend: 'Ext.data.Model',
			fields: [{
				name: 'GENDER',
				type: 'string'
			},{
				name: 'VALUE',
				type: 'string'
			}]
		});
		Ext.apply(this, {
			items: [{
				xtype: 'form',
				layout: 'form',
				border: false,
				bodyPadding: '5 5 5 5',
				url: MyIndo.siteUrl('participants/request/update'),
				defaultType: 'textfield',
				items: [{
					xtype: 'hidden',
					name: 'ID',
					allowBlank: false
				},{
					name: 'FNAME',
					allowBlank: false,
					fieldLabel: 'First Name',
					emptyText: 'Input First Name..'
				},{
					name: 'MNAME',
					fieldLabel: 'Middle Name'
				},{
					name: 'LNAME',
					fieldLabel: 'Last Name'
				},{
					name: 'SNAME',
					fieldLabel: 'Surname',
					emptyText: 'Input Surname..',
					allowBlank: false
				},{
					xtype: 'combobox',
					name: 'GENDER',
					fieldLabel: 'Gender',
					store: Ext.create('Ext.data.Store', {
						autoDestroy: true,
						model: 'Gender',
						data: [{
							"GENDER":"Male",
							"VALUE":"Male"
						},{
							"GENDER":"Female",
							"VALUE":"Female"
						},{
							"GENDER":"Transgender",
							"VALUE":"Transgender"
						}]
					}),
					displayField: 'GENDER',
					valueField: 'VALUE',
					emptyText: 'Select Gender..',
					allowBlank: false,
					queryMode: 'local',
					editable: false
				},{
					xtype: 'datefield',
					name: 'BDATE',
					emptyText: 'Input Birthdate..',
					fieldLabel: 'Birthdate',
					allowBlank:false,
					format: 'Y/m/d'
				},{
					name: 'MOBILE_NO',
					fieldLabel: 'Mobile No',
					emptyText: 'Input Mobile Number..',
					allowBlank: false
				},{
					name: 'PHONE_NO',
					fieldLabel: 'Phone No'
				},{
					name: 'EMAIL1',
					fieldLabel: 'Primary Email',
					emptyText: 'Input primary Email..',
					allowBlank: false,
					vtype: 'email'
				},{
					name: 'EMAIL2',
					fieldLabel: 'Secondary Email',
					vtype: 'email'
				},{
					name: 'FB',
					fieldLabel: 'Facebook'
				},{
					name: 'TWITTER',
					fieldLabel: 'Twitter'
				}]
			}],
			buttons: [{
				text: 'Save',
				action: 'update-save'
			},{
				text: 'Cancel',
				action: 'update-cancel'
			}]
		});
		this.callParent(arguments);
	}
});