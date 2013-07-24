Ext.define(MyIndo.getNameSpace('controller.Master.Trainers'), {
	extend: MyIndo.getNameSpace('controller.Master.Main'),

	requires: [
	MyIndo.getNameSpace('view.Master.Trainers.Add'),
	MyIndo.getNameSpace('view.Master.Trainers.Update'),
	MyIndo.getNameSpace('view.Master.Trainers.Filter')
	],

	init: function() {
		this.control({
			'trainersview button': {
				click: this.onButtonClicked
			},
			'trainersaddwindow button': {
				click: this.onButtonClicked
			},
			'trainersupdatewindow button': {
				click: this.onButtonClicked
			},
			'trainersfilterwindow button': {
				click: this.onButtonClicked
			}
		});
	}
});