Ext.define(MyIndo.getNameSpace('view.Report.CapacityProfile.Region.View'), {
	extend: 'Ext.grid.Panel',
	alias: 'widget.capacityprofileregionview',
	border: false,
	columns: [{
		text: 'Name',
		flex: 1,
		dataIndex: 'NAME'
	},{
		text: 'Created Date',
		align: 'center',
		width: 150,
		dataIndex: 'CREATED_DATE'
	},{
		text: 'Modified Date',
		align: 'center',
		width: 150,
		dataIndex: 'MODIFIED_DATE'
	}],

	initComponent: function() {
		Ext.apply(this, {
			actions: {
				filter: MyIndo.getNameSpace('view.Report.CapacityProfile.Region.Filter')
				//onManageReportindividual: MyIndo.getNameSpace('view.Report.CapacityProfile.Srcountry.View')
			},
			filters: ['NAME'],
			url: {
				delete: MyIndo.baseUrl('report/request/destroy')
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