Ext.define(MyIndo.getNameSpace('view.Master.Trainers.Add'), {
	extend: 'Ext.Window',
	alias: 'widget.trainersaddwindow',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 330,
	title: 'Add New Trainer',

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
				url: MyIndo.siteUrl('trainers/request/create'),
				defaultType: 'textfield',
				items: [{
					name: 'NAME',
					allowBlank: false,
					fieldLabel: 'Name',
					emptyText: 'Input name..',
					allowBlank: false
				},{
					name: 'NICKNAME',
					allowBlank: false,
					fieldLabel: 'Nickname',
					emptyText: 'Input nickname..',
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
						},{
							"GENDER":"MSM",
							"VALUE":"MSM"
						}]
					}),
					displayField: 'GENDER',
					valueField: 'VALUE',
					emptyText: 'Select Gender..',
					allowBlank: false,
					queryMode: 'local',
					editable: false
				},{
					xtype: 'textarea',
					name: 'ADDRESS',
					fieldLabel: 'Address',
					allowBlank: false
				},{
					xtype: 'datefield',
					name: 'BDATE',
					format: 'Y/m/d',
					allowBlank: false,
					fieldLabel: 'Birthdate',
					emptyText: 'Input Birthdate..'
				},{
					name: 'MOBILE_NO',
					allowBlank: false,
					fieldLabel: 'Mobile No.',
					emptyText: 'Input Mobile No..'
				},{
					name: 'PHONE_NO',
					fieldLabel: 'Phone No.'
				},{
					name: 'EMAIL1',
					fieldLabel: 'Primary Email',
					allowBlank: false,
					emptyText: 'Input Email..'
				},{
					name: 'EMAIL2',
					fieldLabel: 'Secondary Email'
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
				action: 'add-save'
			},{
				text: 'Cancel',
				action: 'add-cancel'
			}]
		});
		this.callParent(arguments);
	}
});