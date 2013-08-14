Ext.define(MyIndo.getNameSpace('view.Transaction.Trainings.AddTrainers'), {
	extend: 'Ext.Window',
	alias: 'widget.managetrainersaddwindow',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 360,
	title: 'Add New Trainer',

	initComponent: function() {

		var storeTrainers = Ext.create(MyIndo.getNameSpace('store.Master.Trainers'),{autoDestroy:true});
		var storeRoles = Ext.create(MyIndo.getNameSpace('store.Master.Roles'),{autoDestroy:true});
		var storeCity = Ext.create(MyIndo.getNameSpace('store.Master.Cities'),{autoDestroy:true});
		var storeProvince = Ext.create(MyIndo.getNameSpace('store.Master.Provinces'),{autoDestroy:true});
		var storeCountry = Ext.create(MyIndo.getNameSpace('store.Master.Countries'),{autoDestroy:true});

		Ext.apply(this, {
			items: [{
				xtype: 'form',
				layout: 'form',
				border: false,
				bodyPadding: '5 5 5 5',
				url: MyIndo.siteUrl('trtrainingtrainers/request/create'),
				items: [{
					xtype: 'hidden',
					name: 'TRAINING_ID',
					allowBlank: false
				},{
					xtype: 'combobox',
					fieldLabel: 'Trainer Name',
					name: 'TRAINER_ID',
					allowBlank: false,
					displayField: 'NAME',
					valueField: 'ID',
					minChars: 3,
					pageSize: 25,
					store: storeTrainers,
					allowBlank: false,
					emptyText: 'Select trainer..'
				},{
					xtype: 'combobox',
					fieldLabel: 'Role',
					name: 'ROLE_ID',
					allowBlank: false,
					displayField: 'NAME',
					valueField: 'ID',
					minChars: 3,
					pageSize: 25,
					store: storeRoles,
					allowBlank: false,
					emptyText: 'Select role..',
					editable: false
				},{
					xtype: 'combobox',
					fieldLabel: 'Country',
					name: 'COUNTRY_ID',
					allowBlank: false,
					displayField: 'NAME',
					valueField: 'ID',
					minChars: 3,
					pageSize: 25,
					store: storeCountry,
					allowBlank: false,
					emptyText: 'Select country..',
					editable: false,
					listeners: {
						change: function(obj, val) {
							storeProvince.proxy.extraParams.COUNTRY_ID = val;
							storeProvince.load();
							var form = this.up().getForm();
							form.setValues({
								PROVINCE_ID: ''
							});
						}
					}
				},{
					xtype: 'combobox',
					fieldLabel: 'Province',
					name: 'PROVINCE_ID',
					allowBlank: false,
					displayField: 'NAME',
					valueField: 'ID',
					minChars: 3,
					pageSize: 25,
					store: storeProvince,
					allowBlank: false,
					emptyText: 'Select province..',
					editable: false
				},{
					xtype: 'combobox',
					fieldLabel: 'City',
					name: 'CITY_ID',
					allowBlank: false,
					displayField: 'NAME',
					valueField: 'ID',
					minChars: 3,
					pageSize: 25,
					store: storeCity,
					allowBlank: false,
					emptyText: 'Select city..',
					editable: false
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