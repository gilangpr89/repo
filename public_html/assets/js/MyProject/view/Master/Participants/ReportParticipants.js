Ext.define(MyIndo.getNameSpace('view.Master.Participants.ReportParticipants'), {
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
				columns: [{
					text: 'Name',
					flex: 100,
					dataIndex: 'NAME'
				},{
					text: 'First Name',
					width: 90,
					dataIndex: 'FNAME'
				},{
					text: 'Middle Name',
					width: 80,
					dataIndex: 'MNAME'
				},{
					text: 'Last name',
					width: 80,
					align: 'center',
					dataIndex: 'LNAME'
				},{
					text: 'Surname',
					width: 60,
					align: 'center',
					dataIndex: 'SNAME'
				},{
					text: 'Gender',
					width: 80,
					align: 'center',
					dataIndex: 'GENDER',
					hidden: true
				},{
					text: 'Birthday Date',
					width: 100,
					align: 'center',
					dataIndex: 'BDATE',
					hidden: true
				},{
					text: 'Mobile Number',
					width: 100,
					dataIndex: 'MOBILE_NO',
					hidden: true
				},{
					text: 'Phone Number',
					align: 'center',
					width: 60,
					dataIndex: 'PHONE_NO'
				},{
					text: 'Email',
					align: 'center',
					width: 100,
					dataIndex: 'EMAIL1'
				},{
					text: 'Alternatif Email',
					align: 'center',
					width: 100,
					dataIndex: 'EMAIL2'
				},{
					text: 'Facebook',
					align: 'center',
					width: 100,
					dataIndex: 'FB'
				},{
					text: 'Twitter',
					align: 'center',
					width: 100,
					dataIndex: 'TWITTER'
				},{
					text: 'Date',
					align: 'center',
					width: 100,
					dataIndex: 'CREATED_DATE'
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