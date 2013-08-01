Ext.define(MyIndo.getNameSpace('view.Master.Provinces.Update'), {
	extend: 'Ext.Window',
	alias: 'widget.provincesupdatewindow',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 330,
	title: 'Update Province',

	initComponent: function() {
		var store = Ext.create(MyIndo.getNameSpace('store.Master.Countries'),{autoDestroy:true});
		store.load();
		Ext.apply(this, {
			items: [{
				xtype: 'form',
				layout: 'form',
				border: false,
				bodyPadding: '5 5 5 5',
				url: MyIndo.siteUrl('provinces/request/update'),
				items: [{
					xtype: 'hidden',
					name: 'ID',
					allowBlank: false
				},{
					xtype: 'combobox',
					name: 'COUNTRY_ID',
					fieldLabel: 'Country',
					store: store,
					displayField: 'NAME',
					valueField: 'ID',
					emptyText: 'Select Country..',
					allowBlank: false,
					editable: false
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
				action: 'update-save'
			},{
				text: 'Cancel',
				action: 'update-cancel'
			}]
		});
		this.callParent(arguments);
	}
});