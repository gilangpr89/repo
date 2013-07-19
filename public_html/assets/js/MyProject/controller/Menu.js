Ext.define(MyIndo.getNameSpace('controller.Menu'), {
	extend: 'MyIndo.controller.Menu',

	requires: [
	/* Master */
	MyIndo.getNameSpace('view.Master.City.View')
	],
	
	stores: [
	'Menus',
	'Master.Citys',
	'Master.Countrys',
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
		var store = Ext.create(MyIndo.getNameSpace('store.Master.Citys'));
		this.createPanel(menuTitle, menuId, mainContent, store, 'cityview');
	}
});