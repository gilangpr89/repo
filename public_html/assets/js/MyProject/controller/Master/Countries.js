Ext.define(MyIndo.getNameSpace('controller.Master.Countries'), {
	extend: MyIndo.getNameSpace('controller.Master.Main'),

	requires: [
	MyIndo.getNameSpace('view.Master.Countries.Add'),
	MyIndo.getNameSpace('view.Master.Countries.Update'),
	MyIndo.getNameSpace('view.Master.Countries.Filter')
	],

	init: function() {
		this.control({
			'countriesview button': {
				click: this.onButtonClicked
			},
			'countriesaddwindow button': {
				click: this.onButtonClicked
			},
			'countriesupdatewindow button': {
				click: this.onButtonClicked
			},
			'countriesfilterwindow button': {
				click: this.onButtonClicked
			}
		});
	}
});