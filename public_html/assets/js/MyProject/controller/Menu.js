Ext.define(MyIndo.getNameSpace('controller.Menu'), {
	extend: 'MyIndo.controller.Menu',

	requires: [
	/* Master */
	MyIndo.getNameSpace('view.Master.City.View'),
	MyIndo.getNameSpace('view.Master.AreaLevels.View'),
	MyIndo.getNameSpace('view.Master.Beneficiaries.View'),
	MyIndo.getNameSpace('view.Master.Countries.View'),
	MyIndo.getNameSpace('view.Master.FundingSources.View')
	],
	
	stores: [
	'Menus',
	'Master.AreaLevels',
	'Master.Beneficiaries',
	'Master.Cities',
	'Master.Countries',
	'Master.FundingSources',
	'Master.Organizations',
	'Master.Participants',
	'Master.Positions',
	'Master.Provinces',
	'Master.Roles',
	'Master.Trainers',
	'Master.Trainings',
	'Master.Venues'
	],

	onMsCityClicked: function(menuTitle, menuId, mainContent) {
		var store = Ext.create(MyIndo.getNameSpace('store.Master.Cities'));
		this.createPanel(menuTitle, menuId, mainContent, store, 'cityview');
	},

	onMsAreaLevelsClicked: function(menuTitle, menuId, mainContent) {
		var store = Ext.create(MyIndo.getNameSpace('store.Master.AreaLevels'));
		this.createPanel(menuTitle, menuId, mainContent, store, 'arealevelsview');
	},

	onMsBeneficiariesClicked: function(menuTitle, menuId, mainContent) {
		var store = Ext.create(MyIndo.getNameSpace('store.Master.Beneficiaries'));
		this.createPanel(menuTitle, menuId, mainContent, store, 'beneficiariesview');
	},

	onMsCountriesClicked: function(menuTitle, menuId, mainContent) {
		var store = Ext.create(MyIndo.getNameSpace('store.Master.Countries'));
		this.createPanel(menuTitle, menuId, mainContent, store, 'countriesview');
	},

	onMsFundingSourcesClicked: function(menuTitle, menuId, mainContent) {
		var store = Ext.create(MyIndo.getNameSpace('store.Master.FundingSources'));
		this.createPanel(menuTitle, menuId, mainContent, store, 'fundingsourcesview');
	},
});