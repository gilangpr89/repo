Ext.define(MyIndo.getNameSpace('controller.Report.TrainingEvaluation'), {
	extend: MyIndo.getNameSpace('controller.Report'),

	requires: [
	MyIndo.getNameSpace('view.Report.TrainingEvaluation.Detail'),
	MyIndo.getNameSpace('view.Report.TrainingEvaluation.Filter'),
	MyIndo.getNameSpace('view.Report.TrainingEvaluation.View')
	],

	init: function() {
		this.control({
			'reporttrainingevaluationview button': {
				click: this.onButtonClicked
			},
			'reporttrainingevaluationdetail button': {
				click: this.onButtonClicked
			},
			'reporttrainingevaluationfilterwindow button':{ 
				click:this.onButtonClicked
			}
		});
	},
	
	printTrainingEvaluation: function(record) {
		var parent = record.up().up();
		var grid = parent.items.get(0);
		var selected = parent.getSelectionModel().getSelection();
		var store = Ext.create(MyIndo.getNameSpace('store.Report.TrainingEvaluations'));
		if(selected.length > 0) {
			store.proxy.extraParams = {
					TRAINING_ID: selected[0].data.TRAINING_ID
			};
			Ext.create(MyIndo.getNameSpace('view.Report.TrainingEvaluation.Detail'), {
				DataEvaluation: selected[0].data.TRAINING_ID,
				store: store
			}).show();
			store.load();
		} else {
			Ext.Msg.alert('Application Error', 'You did not select any Training.');
		}
	},
	
	doPrintTrainingEvaluation: function(record) {
		var parent = record.up().up();
		var me = this;
		Ext.Msg.confirm('Print TrainingEvaluation Report', 'Are you sure want to print this data ?', function(btn) {
			if(btn == 'yes') {
				if(typeof(parent.trainingData.ID) !== 'undefined') {
					me.showLoadingWindow();
					Ext.Ajax.request({
						url: MyIndo.siteUrl('reports/print/training-print'),
						params: parent.trainingData,
						success: function(r) {
							var json = Ext.decode(r.responseText);
							me.closeLoadingWindow();
							if(me.isLogin(json)) {
								if(me.isSuccess(json)) {
									window.open(MyIndo.siteUrl(json.data.path + json.data.fileName));
								}
							}
						}
					});
				} else {
					Ext.Msg.alert('Application Error', 'Invalid Training.');
				}
			}
		});
	}
});