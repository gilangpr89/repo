Ext.define(MyIndo.getNameSpace('view.Report.Participants.Detail'), {
	extend: 'Ext.Window',
	alias: 'widget.reportparticipantsdetail',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 650,
	
	initComponent: function() {
		Ext.apply(this, {
			title: 'Detail Participant : ' + this.participantsData.PARTICIPANT_NAME,
			items: [{
				border: false,
				bodyPadding: 5,
				html: 
				'<table>' +
					'<tr>' +
						'<td>Training Name</td><td>:</td><td>' + this.participantsData.TRAINING_NAME + '</td>' + 
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
				columns: [{text: 'TRAINING_ID',
				          width:60,
				          hidden: true
			      },{
					text: 'Training Name',
					flex: 1,
					dataIndex: 'TRAINING_NAME'
				},{
					text: 'Start Date',
					width: 150,
					align: 'center',
					dataIndex: 'SDATE'
				},{
					text: 'End Date',
					width: 150,
					align: 'center',
					dataIndex: 'EDATE'
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