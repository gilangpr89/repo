Ext.define(MyIndo.getNameSpace('model.Report.CapacityProfile.IndividualTraining'), {
	extend: 'Ext.data.Model',
	fields: [{
		name: 'ID',
		type: 'string'
	},{
		name: 'TRAINING_ID',
		type: 'string'
	},{
		name: 'TRAINING_NAME',
		type: 'string'
	},{
		name: 'PARTICIPANT_ID',
		type: 'string'
	},{
		name: 'PARTICIPANT_NAME',
		type: 'string'
	},{
		name: 'PARTICIPANT_FNAME',
		type: 'string'
	},{
		name: 'PARTICIPANT_MNANE',
		type: 'string'
	},{
		name: 'PARTICIPANT_LNAME',
		type: 'string'
	},{
		name: 'PARTICIPANT_SNAME',
		type: 'string'
	},{
		name: 'PARTICIPANT_GENDER',
		type: 'string'
	},{
		name: 'PARTICIPANT_BDATE',
		type: 'string'
	},{
		name: 'PARTICIPANT_MOBILE_NO',
		type: 'string'
	},{
		name: 'PARTICIPANT_PHONE_NO',
		type: 'string'
	},{
		name: 'PARTICIPANT_EMAIL1',
		type: 'string'
	},{
		name: 'PARTICIPANT_EMAIL2',
		type: 'string'
	},{
		name: 'PARTICIPANT_FB',
		type: 'string'
	},{
		name: 'PARTICIPANT_TWITTER',
		type: 'string'
	},{
		name: 'ORGANIZATION_ID',
		type: 'string'
	},{
		name: 'ORGANIZATION_CITY_ID',
		type: 'string'
	},{
		name: 'ORGANIZATION_CITY_NAME',
		type: 'string'
	},{
		name: 'ORGANIZATION_PROVINCE_ID',
		type: 'string'
	},{
		name: 'ORGANIZATION_PROVINCE_NAME',
		type: 'string'
	},{
		name: 'ORGANIZATION_COUNTRY_ID',
		type: 'string'
	},{
		name: 'ORGANIZATION_COUNTRY_NAME',
		type: 'string'
	},{
		name: 'ORGANIZATION_NAME',
		type: 'string'
	},{
		name: 'ORGANIZATION_PHONE_NO1',
		type: 'string'
	},{
		name: 'ORGANIZATION_PHONE_NO2',
		type: 'string'
	},{
		name: 'ORGANIZATION_EMAIL1',
		type: 'string'
	},{
		name: 'ORGANIZATION_EMAIL2',
		type: 'string'
	},{
		name: 'ORGANIZATION_WEBSITE',
		type: 'string'
	},{
		name: 'ORGANIZATION_ADDRESS',
		type: 'string'
	},{
		name: 'POSITION_ID',
		type: 'string'
	},{
		name: 'POSITION_NAME',
		type: 'string'
	},{
		name: 'PRE_TEST',
		type: 'float'
	},{
		name: 'POST_TEST',
		type: 'float'
	},{
		name: 'DIFF',
		type: 'float'
	},{
		name: 'CREATED_DATE',
		type: 'string'
	},{
		name: 'MODIFIED_DATE',
		type: 'string'
	}]
});
//	extend: 'Ext.data.Model',
//	fields: [{
//		name: 'ID',
//		type: 'string'
//	},{
//		name: 'USER_ID',
//		type: 'string'
//	},{
//		name: 'USERNAME',
//		type: 'string'
//	},{
//		name: 'TRAINING_ID',
//		type: 'string'
//	},{
//		name: 'TRAINING_NAME',
//		type: 'string'
//	},{
//		name: 'AREA_LEVEL_ID',
//		type: 'string'
//	},{
//		name: 'AREA_LEVEL_NAME',
//		type: 'string'
//	},{
//		name: 'BENEFICIARIES_ID',
//		type: 'string'
//	},{
//		name: 'BENEFICIARIES_NAME',
//		type: 'string'
//	},{
//		name: 'FUNDING_SOURCE_ID',
//		type: 'string'
//	},{
//		name: 'FUNDING_SOURCE_NAME',
//		type: 'string'
//	},{
//		name: 'FUNDING_SOURCE_CITY_ID',
//		type: 'string'
//	},{
//		name: 'FUNDING_SOURCE_CITY_NAME',
//		type: 'string'
//	},{
//		name: 'FUNDING_SOURCE_PROVINCE_ID',
//		type: 'string'
//	},{
//		name: 'FUNDING_SOURCE_PROVINCE_NAME',
//		type: 'string'
//	},{
//		name: 'FUNDING_SOURCE_COUNTRY_ID',
//		type: 'string'
//	},{
//		name: 'FUNDING_SOURCE_COUNTRY_NAME',
//		type: 'string'
//	},{
//		name: 'FUNDING_SOURCE_PHONE_NO1',
//		type: 'string'
//	},{
//		name: 'FUNDING_SOURCE_PHONE_NO2',
//		type: 'string'
//	},{
//		name: 'FUNDING_SOURCE_EMAIL1',
//		type: 'string'
//	},{
//		name: 'FUNDING_SOURCE_EMAIL2',
//		type: 'string'
//	},{
//		name: 'FUNDING_SOURCE_WEBSITE',
//		type: 'string'
//	},{
//		name: 'FUNDING_SOURCE_ADDRESS',
//		type: 'string'
//	},{
//		name: 'VENUE_ID',
//		type: 'string'
//	},{
//		name: 'VENUE_NAME',
//		type: 'string'
//	},{
//		name: 'VENUE_CITY_ID',
//		type: 'string'
//	},{
//		name: 'VENUE_CITY_NAME',
//		type: 'string'
//	},{
//		name: 'VENUE_PROVINCE_ID',
//		type: 'string'
//	},{
//		name: 'VENUE_PROVINCE_NAME',
//		type: 'string'
//	},{
//		name: 'VENUE_COUNTRY_ID',
//		type: 'string'
//	},{
//		name: 'VENUE_COUNTRY_NAME',
//		type: 'string'
//	},{
//		name: 'VENUE_PHONE_NO1',
//		type: 'string'
//	},{
//		name: 'VENUE_PHONE_NO2',
//		type: 'string'
//	},{
//		name: 'VENUE_EMAIL1',
//		type: 'string'
//	},{
//		name: 'VENUE_EMAIL2',
//		type: 'string'
//	},{
//		name: 'VENUE_WEBSITE',
//		type: 'string'
//	},{
//		name: 'VENUE_ADDRESS',
//		type: 'string'
//	},{
//		name: 'ORGANIZATION_ID',
//		type: 'string'
//	},{
//		name: 'ORGANIZATION_NAME',
//		type: 'string'
//	},{
//		name: 'ORGANIZATION_CITY_ID',
//		type: 'string'
//	},{
//		name: 'ORGANIZATION_CITY_NAME',
//		type: 'string'
//	},{
//		name: 'ORGANIZATION_PROVINCE_ID',
//		type: 'string'
//	},{
//		name: 'ORGANIZATION_PROVINCE_NAME',
//		type: 'string'
//	},{
//		name: 'ORGANIZATION_COUNTRY_ID',
//		type: 'string'
//	},{
//		name: 'ORGANIZATION_COUNTRY_NAME',
//		type: 'string'
//	},{
//		name: 'ORGANIZATION_PHONE_NO1',
//		type: 'string'
//	},{
//		name: 'ORGANIZATION_PHONE_NO2',
//		type: 'string'
//	},{
//		name: 'ORGANIZATION_EMAIL1',
//		type: 'string'
//	},{
//		name: 'ORGANIZATION_EMAIL2',
//		type: 'string'
//	},{
//		name: 'ORGANIZATION_WEBSITE',
//		type: 'string'
//	},{
//		name: 'ORGANIZATION_ADDRESS',
//		type: 'string'
//	},{
//		name: 'SDATE',
//		type: 'string'
//	},{
//		name: 'EDATE',
//		type: 'string'
//	},{
//		name: 'CREATED_DATE',
//		type: 'string'
//	},{
//		name: 'MODIFIED_DATE',
//		type: 'string'
//	}]
//});