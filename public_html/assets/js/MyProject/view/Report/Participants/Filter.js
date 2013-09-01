Ext.define(MyIndo.getNameSpace('view.Report.Participants.Filter'), {
	extend: 'Ext.Window',
	alias: 'widget.reportparticipantsfilterwindow',
	modal: true,
	closable: true,
	draggable: true,
	resizable: false,
	width: 400,
	title: 'Filter Participants',
	
	initComponent: function() {	
		
	    Ext.apply(this, {
			items: [{
				xtype: 'form',
				layout: 'form',
				border: false,
				bodyPadding: '5 5 5 5',
				url: MyIndo.siteUrl('participants/request/detail'),
				items: [{
					fieldLabel:'Start Date',
					xtype: 'datefield',
					anchor: '100%',
					width: 300,
					name: 'START_DATE',
					id: 'start-date',
					vtype: 'daterange',
		            endDateField: 'end-date',
					format: 'Y-m-d',
					allowBlank: false
				},{
					fieldLabel:'End Date',
					xtype: 'datefield',
					anchor: '100%',
					width: 300,
					name: 'END_DATE',
					id: 'end-date',
					vtype: 'daterange',
			        startDateField: 'start-date',
					format: 'Y-m-d',
					allowBlank: false
				}]
			}],
			buttons: [{
				text: 'Filter',
				action: 'filter-search'
			}]
		});
		this.callParent(arguments);
	}
});