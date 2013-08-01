Ext.define(MyIndo.getNameSpace('view.Master.FundingSources.Add'), {
	extend: 'Ext.Window',
	alias: 'widget.fundingsourcesaddwindow',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 370,
	title: 'Add New Funding Source',

	initComponent: function() {
		var storeCity = Ext.create(MyIndo.getNameSpace('store.Master.Cities'),{autoDestroy:true});
		var storeProvince = Ext.create(MyIndo.getNameSpace('store.Master.Provinces'),{autoDestroy:true});
		var storeCountry = Ext.create(MyIndo.getNameSpace('store.Master.Countries'),{autoDestroy:true});
		Ext.apply(this, {
			items: [{
				xtype: 'form',
				layout: 'form',
				border: false,
				bodyPadding: '5 5 5 5',
				url: MyIndo.siteUrl('fundingsources/request/create'),
				defaultType: 'textfield',
				defaults: {
					labelWidth: 106
				},
				items: [{
					name: 'NAME',
					allowBlank: false,
					fieldLabel: 'Name',
					emptyText: 'Input name..'
				},{
					name: 'PHONE_NO1',
					allowBlank: false,
					fieldLabel: 'Primary Phone',
					emptyText: 'Input primary phone..'
				},{
					name: 'PHONE_NO2',
					fieldLabel: 'Secondary Phone'
				},{
					name: 'EMAIL1',
					allowBlank: false,
					fieldLabel: 'Primary Email',
					emptyText: 'Input primary email..',
					vtype: 'email'
				},{
					name: 'EMAIL2',
					fieldLabel: 'Secondary Email',
					vtype: 'email'
				},{
					name: 'WEBSITE',
					fieldLabel: 'Website'
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
				},{
					xtype: 'textarea',
					name: 'ADDRESS',
					fieldLabel: 'Address'
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