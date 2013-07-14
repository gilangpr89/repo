Ext.define('MyIndo', {
	singleton: true,
	tbar: [],
	user: {
		authKey: '',
		isLogin: false
	},
	config: {
		nameSpace: '',
		baseUrl: '',
		siteUrl: '',
		mediaUrl: '',
		defaultActionMethods: {
			read: 'POST',
			destroy: 'POST',
			create: 'POST',
			update: 'POST'
		},
		defaultReader: {
			type: 'json',
			root: 'data.items',
			totalProperty: 'data.totalCount'
		}
	},
	setNameSpace: function(str) {
		this.config.nameSpace = str;
	},
	getNameSpace: function(str) {
		return this.config.nameSpace + '.' + str;
	},
	setBaseUrl: function(url) {
		this.config.baseUrl = url;
	},
	setSiteUrl: function(url) {
		this.config.siteUrl = url;
	},
	getBaseUrl: function(url) {
		return this.config.baseUrl + url;
	},
	baseUrl: function(url) {
		return this.getBaseUrl(url);
	},
	getSiteUrl: function(url) {
		return this.config.siteUrl + url;
	},
	siteUrl: function(url) {
		return this.getSiteUrl(url);
	},
	setMediaUrl: function(url) {
		this.config.mediaUrl = url;
	},
	getMediaUrl: function(url) {
		return this.config.mediaUrl + url;
	},
	mediaUrl: function(url) {
		return this.getMediaUrl(url);
	},
	setAuthKey: function(key) {
		this.user.authKey = key;
	},
	getAuthKey: function() {
		return this.user.authKey;
	},
	setLoggedIn: function(status) {
		this.user.isLogin = status;
	},
	logout: function() {
		document.location = this.baseUrl('users/login');
	},
	base64_encode: function(data) {
		var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
		var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
			ac = 0,
			enc = "",
		    tmp_arr = [];
		if (!data) {
			return data;
		}
		do {
			o1 = data.charCodeAt(i++);
			o2 = data.charCodeAt(i++);
			o3 = data.charCodeAt(i++);
			bits = o1 << 16 | o2 << 8 | o3;
			h1 = bits >> 18 & 0x3f;
			h2 = bits >> 12 & 0x3f;
			h3 = bits >> 6 & 0x3f;
			h4 = bits & 0x3f;
		    tmp_arr[ac++] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
		} while (i < data.length);
		enc = tmp_arr.join('');
		var r = data.length % 3;
		return (r ? enc.slice(0, r - 3) : enc) + '==='.slice(r || 3);
	},
	base64_decode: function(data) {
		var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
		var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
			ac = 0,
			dec = "",
			tmp_arr = [];
		if (!data) {
		    return data;
		}
		data += '';
		do {
		    h1 = b64.indexOf(data.charAt(i++));
		    h2 = b64.indexOf(data.charAt(i++));
		    h3 = b64.indexOf(data.charAt(i++));
		    h4 = b64.indexOf(data.charAt(i++));

		    bits = h1 << 18 | h2 << 12 | h3 << 6 | h4;

		    o1 = bits >> 16 & 0xff;
		    o2 = bits >> 8 & 0xff;
		    o3 = bits & 0xff;

		    if (h3 == 64) {
		      tmp_arr[ac++] = String.fromCharCode(o1);
		    } else if (h4 == 64) {
		      tmp_arr[ac++] = String.fromCharCode(o1, o2);
		    } else {
		      tmp_arr[ac++] = String.fromCharCode(o1, o2, o3);
		    }
		} while (i < data.length);
		dec = tmp_arr.join('');
		return dec;
	}
});