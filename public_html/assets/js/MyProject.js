var splashscreen;

Ext.Loader.setConfig({
	enabled: true
});

Ext.Loader.setPath('MyIndo', 'assets/js/MyIndo');


Ext.onReady(function() {
    splashscreen = Ext.getBody().mask('Loading application', 'splashscreen');
    splashscreen.addCls('splashscreen');
    Ext.DomHelper.insertFirst(Ext.query('.x-mask-msg')[0], {
        cls: 'x-splash-icon'
    });
});

Ext.application({
	appFolder: 'assets/js/MyProject',
	name: 'MyProject',

	controllers: [
	'Menu',
	'Administrator.Users',
	'Administrator.Groups',
	'Administrator.MenuManagements',

	/* Master Controller */
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
	'Master.Venues',

	/* Transaction Controller*/
	'Transaction.Trainings',
	
	/* Reports */
	'Report.Participant',
	'Report.Organization',
	'Report.TrainingEvaluation',
	'Report.CapacityProfile.Individual',
	'Report.CapacityProfile.Cbo',
	'Report.CapacityProfile.Srcountry',
	'Report.CapacityProfile.Region'
	],

	autoCreateViewport: true,
	launch: function() {
		
		Ext.apply(Ext.form.field.VTypes, {
	        daterange: function(val, field) {
	            var date = field.parseDate(val);

	            if (!date) {
	                return false;
	            }
	            if (field.startDateField && (!this.dateRangeMax || (date.getTime() != this.dateRangeMax.getTime()))) {
	                var start = field.up('form').down('#' + field.startDateField);
	                start.setMaxValue(date);
	                start.validate();
	                this.dateRangeMax = date;
	            }
	            else if (field.endDateField && (!this.dateRangeMin || (date.getTime() != this.dateRangeMin.getTime()))) {
	                var end = field.up('form').down('#' + field.endDateField);
	                end.setMinValue(date);
	                end.validate();
	                this.dateRangeMin = date;
	            }
	            /*
	             * Always return true since we're only using this vtype to set the
	             * min/max allowed values (these are tested for after the vtype test)
	             */
	            return true;
	        }
	    });
		
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

		// Setup a task to fadeOut the splashscreen
        var task = new Ext.util.DelayedTask(function() {
            // Fade out the body mask
            splashscreen.fadeOut({
                duration: 1000,
                remove:true
            });
            // Fade out the icon and message
            splashscreen.next().fadeOut({
                duration: 1000,
                remove:true,
                listeners: {
                    afteranimate: function() {
                        // Set the body as unmasked after the animation
                        Ext.getBody().unmask();
                    }
                }
            });
        });
        // Run the fade 500 milliseconds after launch.
        task.delay(500);

	}
});