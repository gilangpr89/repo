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

	MyIndo.getNameSpace('view.Transaction.Trainings.View'),
	/* Reports */
	MyIndo.getNameSpace('view.Report.Participants.View'),
	MyIndo.getNameSpace('view.Report.Organization.View'),
	MyIndo.getNameSpace('view.Report.TrainingEvaluation.View'),
	MyIndo.getNameSpace('view.Report.CapacityProfile.Individual.View'),
	MyIndo.getNameSpace('view.Report.CapacityProfile.Cbo.View'),
	MyIndo.getNameSpace('view.Report.CapacityProfile.Srcountry.View'),
	MyIndo.getNameSpace('view.Report.CapacityProfile.Region.View')
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
	'Transaction.TrainingParticipants',
	'Transaction.TrainingTrainers',
	'Transaction.TrainingModules',
	
	/* Reports */
	'Report.Participants',
	'Report.ParticipantTrainings',
	'Report.Organizations',
	'Report.OrganizationTrainings',
	'Report.TrainingEvaluations',
	'Report.CapacityProfile.Individuals',
	'Report.CapacityProfile.IndividualTrainings',
	
	'Report.CapacityProfile.Cbos',
	'Report.CapacityProfile.CboTrainings',
	'Report.CapacityProfile.Srcountrys',
	'Report.CapacityProfile.SrcountryTrainings',
	'Report.CapacityProfile.Regions',
	'Report.CapacityProfile.RegionTrainings'
	],


	/* Master */

	onMsCityClicked: function(menuTitle, menuId, mainContent) {
		var store = Ext.create(MyIndo.getNameSpace('store.Master.Cities'));
		this.createPanel(menuTitle, menuId, mainContent, store, MyIndo.getNameSpace('view.Master.City.View'));
	},

	onMsAreaLevelsClicked: function(menuTitle, menuId, mainContent) {
		var store = Ext.create(MyIndo.getNameSpace('store.Master.AreaLevels'));
		this.createPanel(menuTitle, menuId, mainContent, store, MyIndo.getNameSpace('view.Master.AreaLevels.View'));
	},

	onMsBeneficiariesClicked: function(menuTitle, menuId, mainContent) {
		var store = Ext.create(MyIndo.getNameSpace('store.Master.Beneficiaries'));
		this.createPanel(menuTitle, menuId, mainContent, store, MyIndo.getNameSpace('view.Master.Beneficiaries.View'));
	},

	onMsCountriesClicked: function(menuTitle, menuId, mainContent) {
		var store = Ext.create(MyIndo.getNameSpace('store.Master.Countries'));
		this.createPanel(menuTitle, menuId, mainContent, store, MyIndo.getNameSpace('view.Master.Countries.View'));
	},

	onMsFundingSourcesClicked: function(menuTitle, menuId, mainContent) {
		var store = Ext.create(MyIndo.getNameSpace('store.Master.FundingSources'));
		this.createPanel(menuTitle, menuId, mainContent, store, MyIndo.getNameSpace('view.Master.FundingSources.View'));
	},

	onMsOrganizationsClicked: function(menuTitle, menuId, mainContent) {
		var store = Ext.create(MyIndo.getNameSpace('store.Master.Organizations'));
		this.createPanel(menuTitle, menuId, mainContent, store, MyIndo.getNameSpace('view.Master.Organizations.View'));
	},

	onMsParticipantsClicked: function(menuTitle, menuId, mainContent) {
		var store = Ext.create(MyIndo.getNameSpace('store.Master.Participants'));
		this.createPanel(menuTitle, menuId, mainContent, store, MyIndo.getNameSpace('view.Master.Participants.View'));
	},

	onMsPositionsClicked: function(menuTitle, menuId, mainContent) {
		var store = Ext.create(MyIndo.getNameSpace('store.Master.Positions'));
		this.createPanel(menuTitle, menuId, mainContent, store, MyIndo.getNameSpace('view.Master.Positions.View'));
	},

	onMsProvincesClicked: function(menuTitle, menuId, mainContent) {
		var store = Ext.create(MyIndo.getNameSpace('store.Master.Provinces'));
		this.createPanel(menuTitle, menuId, mainContent, store, MyIndo.getNameSpace('view.Master.Provinces.View'));
	},

	onMsRolesClicked: function(menuTitle, menuId, mainContent) {
		var store = Ext.create(MyIndo.getNameSpace('store.Master.Roles'));
		this.createPanel(menuTitle, menuId, mainContent, store, MyIndo.getNameSpace('view.Master.Roles.View'));
	},

	onMsTrainersClicked: function(menuTitle, menuId, mainContent) {
		var store = Ext.create(MyIndo.getNameSpace('store.Master.Trainers'));
		this.createPanel(menuTitle, menuId, mainContent, store, MyIndo.getNameSpace('view.Master.Trainers.View'));
	},

	onMsTrainingsClicked: function(menuTitle, menuId, mainContent) {
		var store = Ext.create(MyIndo.getNameSpace('store.Master.Trainings'));
		this.createPanel(menuTitle, menuId, mainContent, store, MyIndo.getNameSpace('view.Master.Trainings.View'));
	},

	onMsVenuesClicked: function(menuTitle, menuId, mainContent) {
		var store = Ext.create(MyIndo.getNameSpace('store.Master.Venues'));
		this.createPanel(menuTitle, menuId, mainContent, store, MyIndo.getNameSpace('view.Master.Venues.View'));
	},

	/* End of : Master */

	onTrTrainingsClicked: function(menuTitle, menuId, mainContent) {
		var store = Ext.create(MyIndo.getNameSpace('store.Transaction.Trainings'));
		this.createPanel(menuTitle, menuId, mainContent, store, MyIndo.getNameSpace('view.Transaction.Trainings.View'));
	},
	
	/* Report Panel */
	onReportParticipantsClicked: function(menuTitle, menuId, mainContent) {
		var store = Ext.create(MyIndo.getNameSpace('store.Report.Participants'));
		this.createPanel(menuTitle, menuId, mainContent, store, MyIndo.getNameSpace('view.Report.Participants.View'));
	},
	
	onReportOrganizationClicked: function(menuTitle, menuId, mainContent) {
		var store = Ext.create(MyIndo.getNameSpace('store.Report.Organizations'));
		this.createPanel(menuTitle, menuId, mainContent, store, MyIndo.getNameSpace('view.Report.Organization.View'));
	},
	
	onReportTrainingEvaluationClicked: function(menuTitle, menuId, mainContent) {
		var store = Ext.create(MyIndo.getNameSpace('store.Report.TrainingEvaluations'));
		this.createPanel(menuTitle, menuId, mainContent, store, MyIndo.getNameSpace('view.Report.TrainingEvaluation.View'));
	},
	
	onReportCapacityProfileIndividualClicked: function(menuTitle, menuId, mainContent) {
		var store = Ext.create(MyIndo.getNameSpace('store.Report.CapacityProfile.Individuals'));
		this.createPanel(menuTitle, menuId, mainContent, store, MyIndo.getNameSpace('view.Report.CapacityProfile.Individual.View'));
	},
	
	onReportCapacityProfileCboClicked: function(menuTitle, menuId, mainContent) {	
		var store = Ext.create(MyIndo.getNameSpace('store.Report.CapacityProfile.Cbos'));
		this.createPanel(menuTitle, menuId, mainContent, store, MyIndo.getNameSpace('view.Report.CapacityProfile.Cbo.View'));
	},
	
	onReportCapacityProfileSrClicked: function(menuTitle, menuId, mainContent) {
			var store = Ext.create(MyIndo.getNameSpace('store.Report.CapacityProfile.Srcountrys'));
			this.createPanel(menuTitle, menuId, mainContent, store, MyIndo.getNameSpace('view.Report.CapacityProfile.Srcountry.View'));	
	},
	
	onReportCapacityProfileRegionClicked: function(menuTitle, menuId, mainContent) {	
		var store = Ext.create(MyIndo.getNameSpace('store.Report.CapacityProfile.Regions'));
		this.createPanel(menuTitle, menuId, mainContent, store, MyIndo.getNameSpace('view.Report.CapacityProfile.Region.View'));
	},
});