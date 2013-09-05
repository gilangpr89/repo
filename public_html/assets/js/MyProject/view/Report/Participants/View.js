Ext.define(MyIndo.getNameSpace('view.Report.Participants.View'), {
	extend: 'Ext.grid.Panel',
	alias: 'widget.reportparticipantsview',
	border: false,
	columns: [{text: 'Training Name',
	          flex:100,
	          dataIndex:'TRAINING_NAME',
	          hidden: true
			},{
				text: 'Participant Id',
				width:60,
				dataIndex:'PARTICIPANT_ID',
				hidden: true
			},{
				text: 'Name',
				flex: 100,
				dataIndex: 'PARTICIPANT_NAME',
			},{
				text: 'Surname',
				width: 90,
				dataIndex:'PARTICIPANT_SNAME',
			    hidden: true
			},{
				text: 'Gender',
				width:80,
				dataIndex:'PARTICIPANT_GENDER',
			},{
				text: 'Birth Date',
				width:80,
				dataIndex:'PARTICIPANT_BDATE',
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
				text: 'Country',
				flex:100,
				align: 'center',
				dataIndex: 'ORGANIZATION_COUNTRY_NAME',
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
				dataIndex: 'PARTICIPANT_MOBILE_NO'
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
				flex: 100,
				dataIndex: 'PARTICIPANT_EMAIL1'
			},{
				text: 'Alternatif Email',
				align: 'center',
				width: 100,
				dataIndex: 'PARTICIPANT_EMAIL2',
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
				flex: 100,
				dataIndex: 'CREATED_DATE'
			}],

	initComponent: function() {
		Ext.apply(this, {
			actions: {
				filter: MyIndo.getNameSpace('view.Report.Participants.Filter')
			},
			filters: ['START_DATE', 'END_DATE'],
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