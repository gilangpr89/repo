Ext.define(MyIndo.getNameSpace('view.Report.Participants'), {
	extend: 'Ext.Window',
	alias: 'widget.reportparticipantswindow',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 950,
	title: 'List Participant',
	
	initComponent: function() {
		Ext.define('Participant', {
			extend: 'Ext.data.Model',
			fields: [{
				name: 'ID',
				type: 'string'
			}]
		});
		Ext.apply(this, {
			items: [{
				xtype: 'gridpanel',
				id: 'report-participant-grid',
				url: MyIndo.siteUrl('participants/request/report'),
				border: false,
				minHeight: 200,
				store: this.store,
				columns: [{text: 'Training Name',
					       flex:100,
					       dataIndex:'TRAINING_NAME'
				},{
					text: 'Name',
					width: 90,
					dataIndex: 'PARTICIPANT_NAME',
				    hidden: true
				},{
					text: 'First Name',
					width: 90,
					dataIndex:'PARTICIPANT_FNAME',
				    hidden: true
				},{
					text: 'Organization City',
					width: 90,
					dataIndex: 'ORGANIZATION_CITY_NAME',
					hidden: true
				},{
					text: 'Province Organization',
					width: 80,
					dataIndex: 'ORGANIZATION_PROVINCE_NAME',
					hidden: true
				},{
					text: 'Organization Country',
					width: 80,
					align: 'center',
					dataIndex: 'ORGANIZATION_COUNTRY_NAME',
					hidden: true
				},{
					text: 'Organization',
					width: 60,
					align: 'center',
					dataIndex: 'ORGANIZATION_NAME',
					hidden: true
				},{
					text: 'Organization Phone',
					width: 80,
					align: 'center',
					dataIndex: 'ORGANIZATION_PHONE_NO1',
					hidden: true
				},{
					text: 'Organization Second Phone',
					width: 100,
					align: 'center',
					dataIndex: 'ORGANIZATION_PHONE_NO2',
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
					dataIndex: 'ORGANIZATION_EMAIL1',
					hidden: true
				},{
					text: 'Organization Second Email',
					width: 100,
					align: 'left',
					dataIndex: 'ORGANIZATION_EMAIL2',
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
					dataIndex: 'ORGANIZATION_WEBSITE',
					hidden: true
				},{
					text: 'Organization Address',
					align: 'center',
					width: 60,
					dataIndex: 'ORGANIZATION_ADDRESS',
					hidden: true
				},{
					text: 'Position Name',
					align: 'center',
					flex:100,
					dataIndex: 'POSITION_NAME'
				},{
					text: 'Pre Test',
					align: 'center',
					width: 60,
					dataIndex: 'PRE_TEST',
					hidden: true
				},{
					text: 'Post Test',
					align: 'center',
					width: 60,
					dataIndex: 'POST_TEST',
					hidden: true
				},{
					text: 'Email',
					align: 'center',
					width: 100,
					dataIndex: 'EMAIL1',
					hidden: true
				},{
					text: 'Alternatif Email',
					align: 'center',
					width: 100,
					dataIndex: 'EMAIL2',
					hidden: true
				},{
					text: 'Facebook',
					align: 'center',
					width: 100,
					dataIndex: 'FB',
					hidden: true
				},{
					text: 'Twitter',
					align: 'center',
					width: 100,
					dataIndex: 'TWITTER',
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
				text: 'Download Participant',
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