Ext.define(MyIndo.getNameSpace('view.Transaction.Trainings.UpdateTrainers'), {
	extend: 'Ext.Window',
	alias: 'widget.managetrainerupdatewindow',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 360,
	title: 'Update Trainer',

	checker: function(c, obj) {
		if(c == 4) {
			obj.close();
		}
	},

	initComponent: function() {

		var storeRoles = Ext.create(MyIndo.getNameSpace('store.Master.Roles'),{autoDestroy:true});
		var storeCity = Ext.create(MyIndo.getNameSpace('store.Master.Cities'),{autoDestroy:true});
		var storeProvince = Ext.create(MyIndo.getNameSpace('store.Master.Provinces'),{autoDestroy:true});
		var storeCountry = Ext.create(MyIndo.getNameSpace('store.Master.Countries'),{autoDestroy:true});
		var LD = Ext.create('MyIndo.view.Loading');
		LD.show();
		var me = this;
		var count = 0;
		var loaded =false;

		storeRoles.load({
			callback: function() {
				count++;
				me.checker(count, LD);
			}
		});

		storeCity.load({
			callback: function() {
				count++;
				me.checker(count, LD);
			}
		});

		storeProvince.load({
			callback: function() {
				count++;
				me.checker(count, LD);
			}
		});

		storeCountry.load({
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
				url: MyIndo.siteUrl('trtrainingtrainers/request/update'),
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
					name: 'TRAINER_ID',
					allowBlank: false
				},{
					xtype: 'textfield',
					fieldLabel: 'Trainer Name',
					name: 'TRAINER_NAME',
					allowBlank: false,
					allowBlank: false,
					readOnly: true
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
					emptyText: 'Select role..'
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
							var val = form.getValues();
							if(loaded) {
								form.setValues({
									PROVINCE_ID: ''
								});
							}
							loaded = true;
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