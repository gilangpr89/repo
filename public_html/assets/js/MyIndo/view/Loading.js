Ext.define('MyIndo.view.Loading', {
	extend: 'Ext.Window',
	title: 'Loading..',
	width: 200,
	resizable: false,
	draggable: false,
	modal: true,
	closable: false,
	html: '<div style="padding: 10px;text-align: center"><img width="40" height="40" src="' + MyIndo.siteUrl('resources/images/350.gif') + '"/><br/>Loading, please wait..</div>',
	listeners: {
		deactivate: function(self) {
			self.toFront();
		},
		delay: 1
	}
});