Ext.define(MyIndo.getNameSpace('view.Report.Organizations'), {
	extend: 'Ext.Window',
	alias: 'widget.reportorganizationswindow',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 950,
	title: 'List Organization',
	
	initComponent: function() {
		Ext.define('Organization', {
			extend: 'Ext.data.Model',
			fields: [{
				name: 'ID',
				type: 'string'
			}]
		});
	
		Ext.apply(this, {
			items: [{
				xtype: 'gridpanel',
				id: 'report-organization-grid',
				url: MyIndo.siteUrl('organizations/request/report'),
				border: false,
				minHeight: 200,
				store: this.store,
				columns: [{text: 'City Id',
					       flex:100,
					       dataIndex:'CITY_ID',
					       hidden: true
				},{
					text: 'Name',
					width: 90,
					dataIndex: 'CITY_NAME',
				    hidden: true
				},{
					text: 'First Name',
					width: 90,
					dataIndex:'PROVINCE_ID',
				    hidden: true
				},{
					text: 'Organization City',
					width: 90,
					dataIndex: 'PROVINCE_NAME'
				},{
					text: 'Province Organization',
					width: 80,
					dataIndex: 'COUNTRY_ID',
					hidden: true
				},{
					text: 'Organization Country',
					width: 80,
					align: 'center',
					dataIndex: 'COUNTRY_NAME',
					hidden: true
				},{
					text: 'Organization',
					width: 60,
					align: 'center',
					dataIndex: 'NAME',
				},{
					text: 'Organization Phone',
					width: 80,
					align: 'center',
					dataIndex: 'PHONE_NO1',
					hidden: true
				},{
					text: 'Organization Second Phone',
					width: 100,
					align: 'center',
					dataIndex: 'PHONE_NO2',
					hidden: true
				},{
					text: 'Mobile Number',
					width: 100,
					dataIndex: 'MOBILE_NO',
					hidden: true
				},{
					text: 'Organization Email',
					width: 100,
					align: 'left',
					dataIndex: 'EMAIL1',
					hidden: true
				},{
					text: 'Organization Second Email',
					width: 100,
					align: 'left',
					dataIndex: 'EMAIL2',
					hidden: true
				},{
					text: 'Phone Number',
					align: 'center',
					width: 60,
					dataIndex: 'PHONE_NO',
					hidden: true
				},{
					text: 'Organization Website',
					align: 'center',
					width: 60,
					dataIndex: 'WEBSITE',
					hidden: true
				},{
					text: 'Organization Address',
					align: 'center',
					width: 60,
					dataIndex: 'ADDRESS',
					hidden: true
				},{
					text: 'Date',
					align: 'center',
					width: 100,
					dataIndex: 'CREATED_DATE',
					hidden: true
				}]
			}],
			tbar: [{
				text: 'Print Organization',
				iconCls: 'icon-accept',
				action: 'add'
			}],
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