Ext.define(MyIndo.getNameSpace('view.Transaction.Trainings.Add'), {
	extend: 'Ext.Window',
	alias: 'widget.trtrainingsaddwindow',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 360,
	title: 'Create New Training',

	initComponent: function() {

		var storeTrainings = Ext.create(MyIndo.getNameSpace('store.Master.Trainings'),{autoDestroy:true});
		var storeAreaLevels = Ext.create(MyIndo.getNameSpace('store.Master.AreaLevels'),{autoDestroy:true});
		var storeBeneficiaries = Ext.create(MyIndo.getNameSpace('store.Master.Beneficiaries'),{autoDestroy:true});
		var storeFundingSources = Ext.create(MyIndo.getNameSpace('store.Master.FundingSources'),{autoDestroy:true});
		var storeVenues = Ext.create(MyIndo.getNameSpace('store.Master.Venues'),{autoDestroy:true});
		var storeOrganizations = Ext.create(MyIndo.getNameSpace('store.Master.Organizations'),{autoDestroy:true});

		Ext.apply(this, {
			items: [{
				xtype: 'form',
				layout: 'form',
				border: false,
				bodyPadding: '5 5 5 5',
				url: MyIndo.siteUrl('trtrainings/request/create'),
				items: [{
					xtype: 'combobox',
					fieldLabel: 'Training Name',
					name: 'TRAINING_ID',
					allowBlank: false,
					displayField: 'NAME',
					valueField: 'ID',
					minChars: 3,
					pageSize: 25,
					store: storeTrainings,
					allowBlank: false,
					emptyText: 'Select training..'
				},{
					xtype: 'combobox',
					fieldLabel: 'Area Level',
					name: 'AREA_LEVEL_ID',
					allowBlank: false,
					displayField: 'DISPLAY_NAME',
					valueField: 'ID',
					minChars: 3,
					pageSize: 25,
					store: storeAreaLevels,
					allowBlank: false,
					emptyText: 'Select area level..'
				},{
					xtype: 'combobox',
					fieldLabel: 'Beneficiaries',
					name: 'BENEFICIARIES_ID',
					allowBlank: false,
					displayField: 'NAME',
					valueField: 'ID',
					minChars: 3,
					pageSize: 25,
					store: storeBeneficiaries,
					allowBlank: false,
					emptyText: 'Select beneficiaries..'
				},{
					xtype: 'combobox',
					fieldLabel: 'Funding Source',
					name: 'FUNDING_SOURCE_ID',
					allowBlank: false,
					displayField: 'NAME',
					valueField: 'ID',
					minChars: 3,
					pageSize: 25,
					store: storeFundingSources,
					allowBlank: false,
					emptyText: 'Select funding source..'
				},{
					xtype: 'combobox',
					fieldLabel: 'Venue',
					name: 'VENUE_ID',
					allowBlank: false,
					displayField: 'NAME',
					valueField: 'ID',
					minChars: 3,
					pageSize: 25,
					store: storeVenues,
					allowBlank: false,
					emptyText: 'Select venue..'
				},{
					xtype: 'combobox',
					fieldLabel: 'Host',
					name: 'ORGANIZATION_ID',
					allowBlank: false,
					displayField: 'NAME',
					valueField: 'ID',
					minChars: 3,
					pageSize: 25,
					store: storeOrganizations,
					allowBlank: false,
					emptyText: 'Select organization..'
				},{
					xtype: 'datefield',
					fieldLabel: 'Start Date',
					name: 'SDATE',
					format: 'Y/m/d',
					allowBlank: false,
					emptyText: 'Start date..'
				},{
					xtype: 'datefield',
					fieldLabel: 'Start Date',
					name: 'EDATE',
					format: 'Y/m/d',
					allowBlank: false,
					emptyText: 'End Date..'
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