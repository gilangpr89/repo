Ext.define(MyIndo.getNameSpace('view.Report.Organization.View'), {
	extend: 'Ext.grid.Panel',
	alias: 'widget.reportorganizationview',
	border: false,
	// columns: [{
	// 	text: 'Training Name',
	// 	flex: 1,
	// 	dataIndex: 'TRAINING_NAME'
	// },{
	// 	text: 'Organization Name',
	// 	align: 'center',
	// 	flex: 1,
	// 	dataIndex: 'ORGANIZATION_NAME'
	// },{
	// 	text: 'Country',
	// 	align: 'center',
	// 	width: 100,
	// 	dataIndex: 'VENUE_COUNTRY_NAME'
	// },{
	// 	text: 'Total',
	// 	align: 'center',
	// 	width: 150,
	// 	dataIndex: 'TOTAL'
	// }],

	initComponent: function() {
		var columns = [{
			text: 'Training Name',
			flex: 1,
			dataIndex: 'TRAINING_NAME'
		}];

		if(typeof(this.params) !== 'undefined' && Array.isArray(this.params)) {
			var names = this.params;
			for(var i = 0; i < names.length; i++) {
				columns.push({
					text: names[i].NAME,
					width: 150,
					align: 'center',
					dataIndex: 'TOTAL_' + names[i].NAME.replace(' ', '_').toUpperCase()
				});
			}
		}

		columns.push({
			text: 'Total',
			width: 150,
			align: 'center',
			dataIndex: 'TOTAL'
		});

		Ext.apply(this, {
			columns: columns,
			actions: {
				filter: MyIndo.getNameSpace('view.Report.Organization.Filter')
			},
			filters: ['NAME'],
			url: {
				delete: MyIndo.baseUrl('organizations/request/destroy')
			},
			dockedItems: [{
				xtype: 'pagingtoolbar',
				displayInfo: true,
				dock: 'bottom',
				store: this.store
			}]
		});
		this.callParent(arguments);
	}
});