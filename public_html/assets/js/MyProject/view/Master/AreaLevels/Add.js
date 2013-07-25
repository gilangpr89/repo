Ext.define(MyIndo.getNameSpace('view.Master.AreaLevels.Add'), {
	extend: 'Ext.Window',
	alias: 'widget.arealevelsaddwindow',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 330,
	title: 'Add New Area Level',

	initComponent: function() {
		Ext.define('AreaType', {
			extend: 'Ext.data.Model',
			fields: [{
				name: 'TYPE',
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
				url: MyIndo.siteUrl('arealevels/request/create'),
				items: [{
					xtype: 'textfield',
					name: 'NAME',
					allowBlank: false,
					fieldLabel: 'Name',
					emptyText: 'Input name..'
				},{
					xtype: 'combobox',
					name: 'TYPE',
					fieldLabel: 'Type',
					store: Ext.create('Ext.data.Store', {
						autoDestroy: true,
						model: 'AreaType',
						data: [{
							"TYPE":"Country Level",
							"VALUE":"Country Level"
						},{
							"TYPE":"Regional Level",
							"VALUE":"Regional Level"
						}]
					}),
					displayField: 'TYPE',
					valueField: 'VALUE',
					emptyText: 'Select Type..',
					allowBlank: false,
					queryMode: 'local',
					editable: false
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