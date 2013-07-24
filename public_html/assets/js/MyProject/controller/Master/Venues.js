Ext.define(MyIndo.getNameSpace('controller.Master.Venues'), {
	extend: MyIndo.getNameSpace('controller.Master.Main'),

	requires: [
	MyIndo.getNameSpace('view.Master.Venues.Add'),
	MyIndo.getNameSpace('view.Master.Venues.Update'),
	MyIndo.getNameSpace('view.Master.Venues.Filter')
	],

	init: function() {
		this.control({
			'venuesview button': {
				click: this.onButtonClicked
			},
			'venuesaddwindow button': {
				click: this.onButtonClicked
			},
			'venuesupdatewindow button': {
				click: this.onButtonClicked
			},
			'venuesfilterwindow button': {
				click: this.onButtonClicked
			}
		});
	}
});