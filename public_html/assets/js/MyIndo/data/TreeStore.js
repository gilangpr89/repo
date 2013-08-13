Ext.define('MyIndo.data.TreeStore', {
	extend: 'Ext.data.TreeStore',
	listeners: {
		load: function(store, records, options) {
			try {
				var data = store.proxy.reader.rawData;
				var ns = eval(MyIndo.config.nameSpace);
				var controller = ns.controller.Menu.superclass.superclass;
				if(!data.login) {
					Ext.Msg.alert('Session Expired', 'Sorry you are not authenticated or session is expired, please login again.', function(btn) {
						if(typeof(Ext.getCmp('_LOGIN_FORM')) === 'undefined') {
							controller.showLoginWindow();
						}
					}, controller);
				}
			} catch(e) {
				Ext.Msg.alert('Application Error', e);
			}
		}
	}
});