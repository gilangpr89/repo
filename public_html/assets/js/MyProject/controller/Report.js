Ext.define(MyIndo.getNameSpace('controller.Report'), {
	extend: 'MyIndo.app.Controller',
	
	onButtonClicked: function(record) {
		var action = record.action;
		switch(action) {
			/* Capacity Profile */
			/* Filter */
			case 'filter':
				this.filter(record);
				break;
			case 'filter-search':
				this.filterSearch(record);
				break;
			case 'filter-cancel':
				this.filterCancel(record);
				break;
			case 'filter-period':
				this.filterPeriod(record);
				break;
			
				// Participant : Print Button :
			case 'print-report-participant':
				this.printParticipant(record);
				break;
			case 'do-print-report-participant':
				this.doPrintParticipant(record);
				break;
				
				// Organization : Print Button :
			case 'print-report-organization':
				this.printOrganization(record);
				break;
			case 'do-print-report-organization':
				this.doPrintOrganization(record);
				break;
				
				// TrainingEvaluation : Print Button :
			case 'print-report-trainingevaluation':
				this.printTrainingEvaluation(record);
				break;
			case 'do-print-report-trainingevaluation':
				this.doPrintTrainingEvaluation(record);
				break;
			
			
			// Individual : Print Button :
			case 'print-capacityprofile-individual':
				this.printIndividual(record);
				break;
			case 'do-print-capacityprofile-individual':
				this.doPrintIndividual(record);
				break;
			
			// Cbo : Print Button :
			case 'print-capacityprofile-cbo':
				this.printCbo(record);
				break;
			case 'do-print-capacityprofile-cbo':
				this.doPrintCbo(record);
				break;
				
			//Srcountry : Print Button :
			case 'print-capacityprofile-srcountry':
				this.printSrcountry(record);
				break;
			case 'do-print-capacityprofile-srcountry':
				this.doPrintSrcountry(record);
				break;
			
			//Region : Print Button :
			case 'print-capacityprofile-region':
				this.printRegion(record);
				break;
			case 'do-print-capacityprofile-region':
				this.doPrintRegion(record);
				break;
				
//			case 'filter-period':
//				this.filterPeriod(record);
//				break;
				
			/* End of : Capacity Profile */
//			default:
//				console.log(action);
		}
	},
	
	/* Filter */
	filter: function(record) {
		var panel = Ext.getCmp('main-content');
		var activePanel = panel.getActiveTab();
		var store = activePanel.getStore();
		var extraParams = store.proxy.extraParams;
		var parent = record.up().up();
		var actions = parent.actions;
		var filterWindow = Ext.create(actions.filter);
		var form = filterWindow.items.items[0].getForm();
		form.setValues(extraParams);
		filterWindow.show();
	},

	filterSearch: function(record) {
		var panel = Ext.getCmp('main-content');
		var parent = panel.getActiveTab();
		var store = parent.getStore();
		var form = record.up().up().items.items[0].getForm();
		var val = form.getValues();
		var filters = parent.filters;
		var params = {};
		for(var i = 0; i < filters.length; i++) {
			var tmp = eval('val.' + filters[i]);
			if(tmp.length > 0) {
				eval('params.' + filters[i] + ' = ' + 'val.' + filters[i] + ';');
			}
		}
		store.proxy.extraParams = params;
		store.load({
			callback: function(eRecord, eOpt) {
				if(eRecord.length == 0) {
					Ext.Msg.alert('Filter', 'No data found, please try another value.');
					record.up().up().on('close', function() {
						store.proxy.extraParams = {};
						store.load();
					});
				} else {
					var json = Ext.decode(eOpt.response.responseText);
					Ext.Msg.alert('Filter', 'Result: [' + json.data.totalCount + '] data(s) found.');
					record.up().up().close();
				}
			}
		});
	},

	filterCancel: function(record) {
		record.up().up().close();
	},
	/* End of : Filter */
});