Ext.define(MyIndo.getNameSpace('view.Master.Provinces.Add'), {
	extend: 'Ext.Window',
	alias: 'widget.provincesaddwindow',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 330,
	title: 'Add New Province',

	initComponent: function() {
		var store = Ext.create(MyIndo.getNameSpace('store.Master.Countries'),{autoDestroy:true});
		Ext.apply(this, {
			items: [{
				xtype: 'form',
				layout: 'form',
				border: false,
				bodyPadding: '5 5 5 5',
				url: MyIndo.siteUrl('provinces/request/create'),
				items: [{
					xtype: 'combobox',
					name: 'COUNTRY_ID',
					fieldLabel: 'Country',
					store: store,
					displayField: 'NAME',
					valueField: 'ID',
					emptyText: 'Select Country..',
					allowBlank: false,
					editable: false,
					pageSize: 25
				},{
					xtype: 'textfield',
					name: 'NAME',
					allowBlank: false,
					fieldLabel: 'Name',
					emptyText: 'Input name..'
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