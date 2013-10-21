Ext.define(MyIndo.getNameSpace('view.Report.Participants.Detail'), {
	extend: 'Ext.Window',
	alias: 'widget.reportparticipantsdetail',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 550,
	
	initComponent: function() {
		Ext.apply(this, {
			title: 'Detail Participant : ' + this.participantsData.NAME,
			items: [{
				border: false,
				bodyPadding: 5,
				html: 
				'<table>' +
					'<tr>' +
						'<td>Participant Name</td><td>:</td><td>' + this.participantsData.NAME + '</td>' + 
					'</tr>' +
				'</table>'
			},{
				xtype: 'gridpanel',
				border: false,
				title: 'Training Participant List',
				minHeight: 200,
				maxHeight: 500,
				autoScroll: true,
				store: this.store,
				columns: [{
					text: 'Training Name',
					flex: 1,
					dataIndex: 'TRAINING_NAME'
				},
//				{
//					text: 'Gender',
//					width: 150,
//					align: 'center',
//					dataIndex: 'PARTICIPANT_GENDER'
//				},{
//					text: 'Province Name',
//					width: 150,
//					align: 'center',
//					dataIndex: 'ORGANIZATION_PROVINCE_NAME'
//				},
				{
					text: 'Country Name',
					width:150,
					dataIndex:'ORGANIZATION_COUNTRY_NAME'
				}],
				dockedItems: [{
					xtype: 'pagingtoolbar',
					displayInfo: true,
					dock: 'bottom',
					store: this.store
				}]
			}],
			buttons: [{
				text: 'Print',
				iconCls: 'icon-printer',
				action: 'do-print-report-participant'
			}]
		});
		this.callParent(arguments);
	}
});