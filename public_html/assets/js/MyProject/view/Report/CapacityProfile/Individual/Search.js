Ext.define(MyIndo.getNameSpace('view.Report.CapacityProfile.Individual.Search'), {
	extend: 'Ext.Window',
	alias: 'widget.individusearchwindow',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 400,
	title: 'Search Individual',

	initComponent: function() {
		// Add the additional 'advanced' VTypes
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
	    Ext.apply(this, {
			items: [{
				xtype: 'form',
				layout: 'form',
				border: false,
				bodyPadding: '5 5 5 5',
				url: MyIndo.siteUrl('reports/request/individual'),
				items: [{
					fieldLabel:'Start Date',
					xtype: 'datefield',
					anchor: '100%',
					width: 300,
					name: 'SDATE',
					id: 'start-date',
					vtype: 'daterange',
		            endDateField: 'end-date',
					format: 'Y-m-d',
					allowBlank: false
				},{
					fieldLabel:'End Date',
					xtype: 'datefield',
					anchor: '100%',
					width: 300,
					name: 'EDATE',
					id: 'end-date',
					vtype: 'daterange',
			        startDateField: 'start-date',
					format: 'Y-m-d',
					allowBlank: false
				}]
			}],
			buttons: [{
				text: 'Search',
				action: 'start-search'
			}]
		});
		this.callParent(arguments);
	}
});