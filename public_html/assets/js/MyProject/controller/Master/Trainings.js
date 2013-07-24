Ext.define(MyIndo.getNameSpace('controller.Master.Trainings'), {
	extend: MyIndo.getNameSpace('controller.Master.Main'),

	requires: [
	MyIndo.getNameSpace('view.Master.Trainings.Add'),
	MyIndo.getNameSpace('view.Master.Trainings.Update'),
	MyIndo.getNameSpace('view.Master.Trainings.Filter')
	],

	init: function() {
		this.control({
			'trainingsview button': {
				click: this.onButtonClicked
			},
			'trainingsaddwindow button': {
				click: this.onButtonClicked
			},
			'trainingsupdatewindow button': {
				click: this.onButtonClicked
			},
			'trainingsfilterwindow button': {
				click: this.onButtonClicked
			}
		});
	}
});