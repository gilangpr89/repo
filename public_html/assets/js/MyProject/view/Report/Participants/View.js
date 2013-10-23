Ext.define(MyIndo.getNameSpace('view.Report.Participants.View'), {
	extend: 'Ext.grid.Panel',
	alias: 'widget.reportparticipantsview',
	border: false,
	
	initComponent: function() {
		var columns = [{
			text: 'Training Name',
			flex: 1,
			dataIndex: 'TRAINING_NAME'
		}];

		if(typeof(this.params) !== 'undefined' && Array.isArray(this.params)) {
			var names = this.params;
//			console.log(names);
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
				filter: MyIndo.getNameSpace('view.Report.Participants.Filter')
			},
			filters: ['NAME'],
			url: {
				delete: MyIndo.baseUrl('participants/request/destroy')
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