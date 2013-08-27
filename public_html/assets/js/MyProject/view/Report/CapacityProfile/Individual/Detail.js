Ext.define(MyIndo.getNameSpace('view.Report.CapacityProfile.Individual.Detail'), {
	extend: 'Ext.Window',
	alias: 'widget.capacityprofileindividualdetail',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 650,
	
	initComponent: function() {
		Ext.apply(this, {
			title: 'Detail Participant : ' + this.participantData.NAME,
			items: [{
				border: false,
				bodyPadding: 5,
				html: 
				'<table>' +
					'<tr>' +
						'<td>First Name</td><td>:</td><td>' + this.participantData.FNAME + '</td>' + 
					'</tr>' +
					'<tr>' +
						'<td>Middle Name</td><td>:</td><td>' + this.participantData.MNAME + '</td>' + 
					'</tr>' +
					'<tr>' +
						'<td>Last Name</td><td>:</td><td>' + this.participantData.LNAME + '</td>' + 
					'</tr>' + '<td>Surname</td><td>:</td><td>' + this.participantData.SNAME + '</td>' +
				'</table>'
			},{
				xtype: 'gridpanel',
				border: false,
				title: 'Training List',
				minHeight: 200,
				maxHeight: 500,
				autoScroll: true,
				store: this.store,
				columns: [{
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
				action: 'do-print-capacityprofile-individual'
			}]
		});
		this.callParent(arguments);
	}
});