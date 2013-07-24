Ext.Loader.setConfig({
	enabled: true
});

Ext.Loader.setPath('MyIndo', 'assets/js/MyIndo');

Ext.application({
	appFolder: 'assets/js/MyProject',
	name: 'MyProject',

	controllers: [
	'Menu',
	'Administrator.Users',
	'Administrator.Groups',
	'Administrator.MenuManagements',

	/* Master */
	'Master.City',
	'Master.AreaLevels',
	'Master.Beneficiaries',
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

	autoCreateViewport: true,
	launch: function() {
		
		Ext.Error.handle = function(err) {
			Ext.WindowMgr.each(function(x) {
				if(x.$className == 'MyIndo.view.Loading') {
					x.close();
				}
			});
			Ext.create('Ext.Window', {
				title: 'Application Error',
				modal: true,
				minWidth: 500,
				minHeight: 120,
				maxWidth: 780,
				maxHeight: 900,
				resizable: false,
				draggable: true,
				bodyPadding: '10 10 10 10',
				html: '<strong>Source:</strong> ' + err.sourceClass + '<br/><strong>Source Method:</strong> ' + err.sourceMethod + '<br/><strong>Message</strong>:<pre>' + err.msg + '</pre>',
				buttons: [{
					text: 'Close',
					listeners: {
						click: function() {
							this.up().up().close();
						}
					}
				}]
			}).show();
			return true;
		};

	}
});