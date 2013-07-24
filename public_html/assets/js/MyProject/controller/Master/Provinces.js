Ext.define(MyIndo.getNameSpace('controller.Master.Provinces'), {
	extend: MyIndo.getNameSpace('controller.Master.Main'),

	requires: [
	MyIndo.getNameSpace('view.Master.Provinces.Add'),
	MyIndo.getNameSpace('view.Master.Provinces.Update'),
	MyIndo.getNameSpace('view.Master.Provinces.Filter')
	],

	init: function() {
		this.control({
			'provincesview button': {
				click: this.onButtonClicked
			},
			'provincesaddwindow button': {
				click: this.onButtonClicked
			},
			'provincesupdatewindow button': {
				click: this.onButtonClicked
			},
			'provincesfilterwindow button': {
				click: this.onButtonClicked
			}
		});
	}
});