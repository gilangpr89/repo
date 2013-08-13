create view TR_TRAINING_TRAINERS_VIEW as
SELECT
 trtr.ID,
 trtr.CV_NAME,
 trtr.CV_PATH,
 trtr.CV_MIME_TYPE,
 trtr.CV_SIZE,
 trtr.TRAINER_ID,
 trtr.CREATED_DATE,
 trtr.MODIFIED_DATE,
 mstrs.NAME as TRAINER_NAME,
 mstrs.NICKNAME as TRAINER_NICKNAME,
 mstrs.GENDER as TRAINER_GENDER,
 mstrs.ADDRESS as TRAINER_ADDRESS,
 mstrs.BDATE as TRAINER_BDATE,
 mstrs.MOBILE_NO as TRAINER_MOBILE_NO,
 mstrs.PHONE_NO as TRAINER_PHONE_NO,
 mstrs.EMAIL1 as TRAINER_EMAIL1,
 mstrs.EMAIL2 as TRAINER_EMAIL2,
 mstrs.FB as TRAINER_FB,
 mstrs.TWITTER as TRAINER_TWITTER,
 trtr.TRAINING_ID,
 mstr.NAME as TRAINING_NAME,
 trtr.ROLE_ID,
 msrl.NAME as ROLE_NAME,
 trtr.CITY_ID,
 msct.NAME as CITY_NAME,
 trtr.PROVINCE_ID,
 mspr.NAME as PROVINCE_NAME,
 trtr.COUNTRY_ID,
 msctr.NAME as COUNTRY_NAME
FROM
 TR_TRAINING_TRAINERS trtr,
 MS_TRAININGS mstr,
 MS_TRAINERS mstrs,
 MS_ROLES msrl,
 MS_CITY msct,
 MS_PROVINCE mspr,
 MS_COUNTRY msctr
WHERE
 trtr.TRAINING_ID = mstr.ID AND
 trtr.TRAINER_ID = mstrs.ID AND
 trtr.ROLE_ID = msrl.ID AND
 trtr.CITY_ID = msct.ID AND
 trtr.PROVINCE_ID = mspr.ID AND
 trtr.COUNTRY_ID = msctr.ID
 