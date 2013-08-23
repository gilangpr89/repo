Ext.define(MyIndo.getNameSpace('controller.Report'), {
	extend: 'MyIndo.app.Controller',
	
	onButtonClicked: function(record) {
		var action = record.action;
		switch(action) {
			/* Capacity Profile */
			
			// Individual : Print Button :
			case 'print-capacityprofile-individual':
				this.printIndividual(record);
				break;
			case 'do-print-capacityprofile-individual':
				this.doPrintIndividual(record);
				break;
				
			/* End of : Capacity Profile */
			default:
				console.log(action);
		}
	}
});