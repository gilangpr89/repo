Ext.define(MyIndo.getNameSpace('view.Master.Organizations.Filter'), {
	extend: 'Ext.Window',
	alias: 'widget.organizationsfilterwindow',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 360,
	title: 'Filter Organization',

	initComponent: function() {
		var storeCity = Ext.create(MyIndo.getNameSpace('store.Master.Cities'),{autoDestroy:true});
		var storeProvince = Ext.create(MyIndo.getNameSpace('store.Master.Provinces'),{autoDestroy:true});
		var storeCountry = Ext.create(MyIndo.getNameSpace('store.Master.Countries'),{autoDestroy:true});
		storeCity.load();
		storeProvince.load();
		storeCountry.load();
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
					editable: false
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