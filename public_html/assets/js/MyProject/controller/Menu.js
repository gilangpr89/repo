Ext.define(MyIndo.getNameSpace('controller.Menu'), {
	extend: 'MyIndo.controller.Menu',

	requires: [
	/* Master */
	MyIndo.getNameSpace('view.Master.City.View'),
	MyIndo.getNameSpace('view.Master.AreaLevels.View'),
	MyIndo.getNameSpace('view.Master.Beneficiaries.View'),
	MyIndo.getNameSpace('view.Master.Countries.View'),
	MyIndo.getNameSpace('view.Master.FundingSources.View'),
	MyIndo.getNameSpace('view.Master.Organizations.View'),
	MyIndo.getNameSpace('view.Master.Participants.View'),
	MyIndo.getNameSpace('view.Master.Positions.View'),
	MyIndo.getNameSpace('view.Master.Provinces.View'),
	MyIndo.getNameSpace('view.Master.Roles.View'),
	MyIndo.getNameSpace('view.Master.Trainers.View'),
	MyIndo.getNameSpace('view.Master.Trainings.View'),
	MyIndo.getNameSpace('view.Master.Venues.View'),

	MyIndo.getNameSpace('view.Transaction.Trainings.View')
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
	'Master.Venues',
	'Master.Trainings',
	'Master.Venues',

	'Transaction.Trainings',
	'Transaction.TrainingParticipants'
	],


	/* Master */

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

	onMsOrganizationsClicked: function(menuTitle, menuId, mainContent) {
		var store = Ext.create(MyIndo.getNameSpace('store.Master.Organizations'));
		this.createPanel(menuTitle, menuId, mainContent, store, 'organizationsview');
	},

	onMsParticipantsClicked: function(menuTitle, menuId, mainContent) {
		var store = Ext.create(MyIndo.getNameSpace('store.Master.Participants'));
		this.createPanel(menuTitle, menuId, mainContent, store, 'participantsview');
	},

	onMsPositionsClicked: function(menuTitle, menuId, mainContent) {
		var store = Ext.create(MyIndo.getNameSpace('store.Master.Positions'));
		this.createPanel(menuTitle, menuId, mainContent, store, 'positionsview');
	},

	onMsProvincesClicked: function(menuTitle, menuId, mainContent) {
		var store = Ext.create(MyIndo.getNameSpace('store.Master.Provinces'));
		this.createPanel(menuTitle, menuId, mainContent, store, 'provincesview');
	},

	onMsRolesClicked: function(menuTitle, menuId, mainContent) {
		var store = Ext.create(MyIndo.getNameSpace('store.Master.Roles'));
		this.createPanel(menuTitle, menuId, mainContent, store, 'rolesview');
	},

	onMsTrainersClicked: function(menuTitle, menuId, mainContent) {
		var store = Ext.create(MyIndo.getNameSpace('store.Master.Trainers'));
		this.createPanel(menuTitle, menuId, mainContent, store, 'trainersview');
	},

	onMsTrainingsClicked: function(menuTitle, menuId, mainContent) {
		var store = Ext.create(MyIndo.getNameSpace('store.Master.Trainings'));
		this.createPanel(menuTitle, menuId, mainContent, store, 'trainingsview');
	},

	onMsVenuesClicked: function(menuTitle, menuId, mainContent) {
		var store = Ext.create(MyIndo.getNameSpace('store.Master.Venues'));
		this.createPanel(menuTitle, menuId, mainContent, store, 'venuesview');
	},

	/* End of : Master */

	onTrTrainingsClicked: function(menuTitle, menuId, mainContent) {
		var store = Ext.create(MyIndo.getNameSpace('store.Transaction.Trainings'));
		this.createPanel(menuTitle, menuId, mainContent, store, 'trtrainingsview');
	},
});