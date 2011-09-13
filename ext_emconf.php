<?php

########################################################################
# Extension Manager/Repository config file for ext: "cal"
#
# Auto generated 17-12-2007 14:24
#
# Manual updates:
# Only the data in the array - anything else is removed by next write.
# "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Calendar Base',
	'description' => 'A calendar combining all the functions of the existing calendar extensions plus adding some new features. It is based on the ical standard',
	'category' => 'plugin',
	'shy' => 0,
	'version' => '0.16.0',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'beta',
	'uploadfolder' => 0,
	'createDirs' => 'uploads/tx_cal/pics,uploads/tx_cal/ics,uploads/tx_cal/media',
	'modify_tables' => '',
	'clearcacheonload' => 0,
	'lockType' => '',
	'author' => 'Mario Matzulla, Jeff Segars',
	'author_email' => 'mario@matzullas.de, jeff@webempoweredchurch.org',
	'author_company' => '',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
			'php' => '4.0.0-0.0.0',
			'typo3' => '3.8.0-4.1.99',
		),
		'conflicts' => array(
		),
		'suggests' => array(
			'partner' => '',
			'tt_address' => '',
			'captcha' => '',
			'date2cal' => '',
			'rlmp_dateselectlib' => '',
			'gabriel' => '',
			'wec_map' => '',
			'static_info_tables' => '',
		),
	),
	'_md5_values_when_last_written' => 'a:293:{s:9:"ChangeLog";s:4:"387e";s:20:"class.ext_update.php";s:4:"34eb";s:11:"credits.txt";s:4:"d319";s:21:"ext_conf_template.txt";s:4:"cdbf";s:12:"ext_icon.gif";s:4:"0532";s:17:"ext_localconf.php";s:4:"4629";s:14:"ext_tables.php";s:4:"1cc9";s:14:"ext_tables.sql";s:4:"ea07";s:13:"locallang.xml";s:4:"be49";s:16:"locallang_db.xml";s:4:"8aa1";s:17:"locallang_tca.xml";s:4:"b53d";s:7:"tca.php";s:4:"ab9f";s:21:"controller/ce_wiz.gif";s:4:"0532";s:31:"controller/class.tx_cal_api.php";s:4:"978f";s:43:"controller/class.tx_cal_base_controller.php";s:4:"de67";s:36:"controller/class.tx_cal_calendar.php";s:4:"dda5";s:38:"controller/class.tx_cal_controller.php";s:4:"90c8";s:38:"controller/class.tx_cal_dateParser.php";s:4:"0cd0";s:45:"controller/class.tx_cal_event_linkHandler.php";s:4:"473a";s:37:"controller/class.tx_cal_functions.php";s:4:"a3a1";s:43:"controller/class.tx_cal_modelcontroller.php";s:4:"03ca";s:36:"controller/class.tx_cal_registry.php";s:4:"f2d5";s:32:"controller/class.tx_cal_tsfe.php";s:4:"d34f";s:42:"controller/class.tx_cal_viewcontroller.php";s:4:"587d";s:35:"controller/class.tx_cal_wizicon.php";s:4:"234d";s:24:"controller/locallang.xml";s:4:"647f";s:35:"cron/class.tx_cal_calendar_cron.php";s:4:"b654";s:35:"cron/class.tx_cal_reminder_cron.php";s:4:"a23c";s:14:"doc/manual.sxw";s:4:"8b52";s:30:"hooks/class.tx_cal_realurl.php";s:4:"19fc";s:45:"hooks/class.tx_cal_tceforms_getmainfields.php";s:4:"5096";s:44:"hooks/class.tx_cal_tcemain_processcmdmap.php";s:4:"679a";s:45:"hooks/class.tx_cal_tcemain_processdatamap.php";s:4:"8a67";s:29:"misc/class.module_example.php";s:4:"fbdf";s:36:"misc/class.module_locationloader.php";s:4:"990d";s:24:"misc/realurl_example.txt";s:4:"955c";s:22:"misc/user_htmlCrop.php";s:4:"fec8";s:37:"model/class.tx_cal_attendee_model.php";s:4:"b616";s:33:"model/class.tx_cal_base_model.php";s:4:"4f19";s:37:"model/class.tx_cal_calendar_model.php";s:4:"3457";s:37:"model/class.tx_cal_category_model.php";s:4:"f6b5";s:27:"model/class.tx_cal_date.php";s:4:"8b2e";s:31:"model/class.tx_cal_location.php";s:4:"4671";s:39:"model/class.tx_cal_location_address.php";s:4:"2553";s:37:"model/class.tx_cal_location_model.php";s:4:"4677";s:39:"model/class.tx_cal_location_partner.php";s:4:"796e";s:28:"model/class.tx_cal_model.php";s:4:"cbf9";s:32:"model/class.tx_cal_organizer.php";s:4:"a610";s:40:"model/class.tx_cal_organizer_address.php";s:4:"99c2";s:39:"model/class.tx_cal_organizer_feuser.php";s:4:"82a5";s:40:"model/class.tx_cal_organizer_partner.php";s:4:"ca41";s:41:"model/class.tx_cal_phpicalendar_model.php";s:4:"c917";s:34:"model/class.tx_model_iCalendar.php";s:4:"2e8b";s:47:"model/iCalendar/class.tx_iCalendar_daylight.php";s:4:"e055";s:47:"model/iCalendar/class.tx_iCalendar_standard.php";s:4:"22d3";s:45:"model/iCalendar/class.tx_iCalendar_valarm.php";s:4:"e68d";s:44:"model/iCalendar/class.tx_iCalendar_vcard.php";s:4:"145a";s:45:"model/iCalendar/class.tx_iCalendar_vevent.php";s:4:"52ae";s:48:"model/iCalendar/class.tx_iCalendar_vfreebusy.php";s:4:"0e91";s:47:"model/iCalendar/class.tx_iCalendar_vjournal.php";s:4:"20ad";s:44:"model/iCalendar/class.tx_iCalendar_vnote.php";s:4:"ea40";s:48:"model/iCalendar/class.tx_iCalendar_vtimezone.php";s:4:"5297";s:44:"model/iCalendar/class.tx_iCalendar_vtodo.php";s:4:"bccf";s:30:"res/class.tx_cal_customtca.php";s:4:"9878";s:34:"res/class.tx_cal_itemsProcFunc.php";s:4:"c1e9";s:27:"res/class.tx_cal_labels.php";s:4:"2ca7";s:29:"res/class.tx_cal_treeview.php";s:4:"a27a";s:39:"res/class.user_staticinfotables_div.php";s:4:"e15d";s:20:"res/flexform1_ds.xml";s:4:"d562";s:18:"res/pearLoader.php";s:4:"06ca";s:14:"res/recurui.js";s:4:"2ad6";s:17:"res/timezones.php";s:4:"079f";s:35:"res/help/locallang_csh_txcalcal.xml";s:4:"9c8a";s:35:"res/help/locallang_csh_txcalcat.xml";s:4:"65a9";s:37:"res/help/locallang_csh_txcalevent.xml";s:4:"9d4b";s:46:"res/help/locallang_csh_txcalexceptionevent.xml";s:4:"2f70";s:51:"res/help/locallang_csh_txcalexceptioneventgroup.xml";s:4:"9afc";s:40:"res/help/locallang_csh_txcallocation.xml";s:4:"483c";s:41:"res/help/locallang_csh_txcalorganizer.xml";s:4:"e034";s:34:"res/icons/icon_tx_cal_attendee.gif";s:4:"b7ab";s:34:"res/icons/icon_tx_cal_calendar.gif";s:4:"8aec";s:37:"res/icons/icon_tx_cal_calendar__h.gif";s:4:"f03c";s:41:"res/icons/icon_tx_cal_calendar_exturl.gif";s:4:"69c1";s:44:"res/icons/icon_tx_cal_calendar_exturl__h.gif";s:4:"6941";s:39:"res/icons/icon_tx_cal_calendar_feed.gif";s:4:"2e50";s:38:"res/icons/icon_tx_cal_calendar_ics.gif";s:4:"df51";s:41:"res/icons/icon_tx_cal_calendar_ics__h.gif";s:4:"1045";s:34:"res/icons/icon_tx_cal_category.gif";s:4:"d6c6";s:37:"res/icons/icon_tx_cal_category__h.gif";s:4:"28a8";s:32:"res/icons/icon_tx_cal_events.gif";s:4:"7019";s:35:"res/icons/icon_tx_cal_events__h.gif";s:4:"0b0e";s:39:"res/icons/icon_tx_cal_events_exturl.gif";s:4:"1f4a";s:42:"res/icons/icon_tx_cal_events_exturl__h.gif";s:4:"1e56";s:39:"res/icons/icon_tx_cal_events_intlnk.gif";s:4:"6481";s:42:"res/icons/icon_tx_cal_events_intlnk__h.gif";s:4:"66c8";s:40:"res/icons/icon_tx_cal_events_meeting.gif";s:4:"763a";s:41:"res/icons/icon_tx_cal_exception_event.gif";s:4:"35ac";s:44:"res/icons/icon_tx_cal_exception_event__h.gif";s:4:"e69b";s:47:"res/icons/icon_tx_cal_exception_event_group.gif";s:4:"ec7c";s:50:"res/icons/icon_tx_cal_exception_event_group__h.gif";s:4:"7a14";s:34:"res/icons/icon_tx_cal_location.gif";s:4:"ebbd";s:37:"res/icons/icon_tx_cal_location__h.gif";s:4:"6e9c";s:35:"res/icons/icon_tx_cal_organizer.gif";s:4:"e0ba";s:38:"res/icons/icon_tx_cal_organizer__h.gif";s:4:"47e7";s:39:"res/icons/icon_tx_cal_unknown_users.gif";s:4:"4e4a";s:17:"res/PEAR/Date.php";s:4:"383b";s:22:"res/PEAR/Date/Calc.php";s:4:"9a89";s:23:"res/PEAR/Date/Human.php";s:4:"d51d";s:22:"res/PEAR/Date/Span.php";s:4:"9130";s:26:"res/PEAR/Date/TimeZone.php";s:4:"2514";s:16:"service/ajax.php";s:4:"467b";s:41:"service/class.tx_cal_attendee_service.php";s:4:"c896";s:37:"service/class.tx_cal_base_service.php";s:4:"fb8e";s:41:"service/class.tx_cal_calendar_service.php";s:4:"b3b8";s:41:"service/class.tx_cal_category_service.php";s:4:"261b";s:38:"service/class.tx_cal_event_service.php";s:4:"9f31";s:42:"service/class.tx_cal_icalendar_service.php";s:4:"6edb";s:49:"service/class.tx_cal_location_address_service.php";s:4:"68b3";s:49:"service/class.tx_cal_location_partner_service.php";s:4:"4126";s:41:"service/class.tx_cal_location_service.php";s:4:"cd59";s:50:"service/class.tx_cal_organizer_address_service.php";s:4:"ef02";s:49:"service/class.tx_cal_organizer_feuser_service.php";s:4:"8934";s:50:"service/class.tx_cal_organizer_partner_service.php";s:4:"631a";s:42:"service/class.tx_cal_organizer_service.php";s:4:"f9ca";s:39:"service/class.tx_cal_rights_service.php";s:4:"4ac9";s:21:"static/ajax/setup.txt";s:4:"94b5";s:20:"static/css/setup.txt";s:4:"29cb";s:27:"static/fe-editing/setup.txt";s:4:"adf1";s:24:"static/ics/constants.txt";s:4:"d710";s:20:"static/ics/setup.txt";s:4:"c840";s:29:"static/rss_feed/constants.txt";s:4:"17ef";s:25:"static/rss_feed/setup.txt";s:4:"2ddd";s:23:"static/ts/constants.txt";s:4:"1e04";s:19:"static/ts/setup.txt";s:4:"5bd0";s:19:"template/admin.tmpl";s:4:"d37b";s:22:"template/atom_0_3.tmpl";s:4:"e4f7";s:22:"template/atom_1_0.tmpl";s:4:"7788";s:26:"template/calendar_nav.tmpl";s:4:"0273";s:30:"template/confirm_calendar.tmpl";s:4:"8829";s:30:"template/confirm_category.tmpl";s:4:"c077";s:27:"template/confirm_event.tmpl";s:4:"a755";s:30:"template/confirm_location.tmpl";s:4:"787e";s:29:"template/create_calendar.tmpl";s:4:"bbb4";s:29:"template/create_category.tmpl";s:4:"7b92";s:26:"template/create_event.tmpl";s:4:"6a85";s:31:"template/create_event_ajax.tmpl";s:4:"d043";s:29:"template/create_location.tmpl";s:4:"e60d";s:17:"template/day.tmpl";s:4:"6429";s:29:"template/delete_calendar.tmpl";s:4:"ab08";s:29:"template/delete_category.tmpl";s:4:"f5f7";s:26:"template/delete_event.tmpl";s:4:"6dde";s:29:"template/delete_location.tmpl";s:4:"9eab";s:19:"template/event.tmpl";s:4:"30dc";s:24:"template/fe_editing.tmpl";s:4:"ae99";s:17:"template/ics.tmpl";s:4:"65d4";s:21:"template/icslist.tmpl";s:4:"239a";s:20:"template/invite.tmpl";s:4:"dde3";s:28:"template/inviteOnChange.tmpl";s:4:"819a";s:18:"template/list.tmpl";s:4:"1dcc";s:27:"template/list_w_teaser.tmpl";s:4:"b798";s:22:"template/location.tmpl";s:4:"a00d";s:30:"template/location_address.tmpl";s:4:"261f";s:30:"template/location_partner.tmpl";s:4:"5c99";s:28:"template/meetingManager.tmpl";s:4:"5022";s:35:"template/module_locationloader.tmpl";s:4:"4c86";s:19:"template/month.tmpl";s:4:"1b6e";s:25:"template/month_large.tmpl";s:4:"7ff8";s:26:"template/month_medium.tmpl";s:4:"ea2e";s:25:"template/month_small.tmpl";s:4:"83c1";s:27:"template/notifyConfirm.tmpl";s:4:"e352";s:28:"template/notifyOnChange.tmpl";s:4:"d0e3";s:28:"template/notifyOnCreate.tmpl";s:4:"735d";s:28:"template/notifyOnDelete.tmpl";s:4:"b852";s:38:"template/notifyUnsubscribeConfirm.tmpl";s:4:"571d";s:23:"template/organizer.tmpl";s:4:"969f";s:31:"template/organizer_address.tmpl";s:4:"5e19";s:30:"template/organizer_feuser.tmpl";s:4:"6668";s:31:"template/organizer_partner.tmpl";s:4:"6b13";s:32:"template/phpicalendar_event.tmpl";s:4:"ca44";s:17:"template/rdf.tmpl";s:4:"4546";s:20:"template/remind.tmpl";s:4:"517e";s:22:"template/rss_0_91.tmpl";s:4:"2864";s:19:"template/rss_2.tmpl";s:4:"7b22";s:24:"template/search_all.tmpl";s:4:"eb4f";s:24:"template/search_box.tmpl";s:4:"1b3b";s:26:"template/search_event.tmpl";s:4:"5eb0";s:29:"template/search_location.tmpl";s:4:"ab5e";s:24:"template/search_old.tmpl";s:4:"ed53";s:30:"template/search_organizer.tmpl";s:4:"894f";s:21:"template/sidebar.tmpl";s:4:"ff67";s:34:"template/subscription_manager.tmpl";s:4:"07ba";s:18:"template/week.tmpl";s:4:"e91e";s:18:"template/year.tmpl";s:4:"23b3";s:18:"template/img/0.png";s:4:"c381";s:25:"template/img/ACCEPTED.png";s:4:"c9b5";s:22:"template/img/CHAIR.png";s:4:"c8ca";s:24:"template/img/DECLINE.png";s:4:"4249";s:29:"template/img/NEEDS-ACTION.png";s:4:"c381";s:20:"template/img/add.gif";s:4:"9dbe";s:20:"template/img/add.png";s:4:"1988";s:26:"template/img/add_small.png";s:4:"970f";s:25:"template/img/allday_1.gif";s:4:"35c4";s:25:"template/img/allday_2.gif";s:4:"886b";s:25:"template/img/allday_3.gif";s:4:"8a90";s:25:"template/img/allday_4.gif";s:4:"bb0d";s:25:"template/img/allday_5.gif";s:4:"a7c2";s:25:"template/img/allday_6.gif";s:4:"3407";s:25:"template/img/allday_7.gif";s:4:"7b18";s:26:"template/img/allday_bg.gif";s:4:"f2c3";s:27:"template/img/allday_dot.gif";s:4:"27b7";s:21:"template/img/back.gif";s:4:"ec99";s:23:"template/img/cancel.gif";s:4:"62d3";s:26:"template/img/cancelled.gif";s:4:"fa43";s:22:"template/img/color.gif";s:4:"66f9";s:26:"template/img/completed.gif";s:4:"6669";s:23:"template/img/config.png";s:4:"16d9";s:32:"template/img/config_calendar.gif";s:4:"d73f";s:26:"template/img/confirmed.gif";s:4:"9c8e";s:23:"template/img/create.gif";s:4:"57e0";s:32:"template/img/create_calendar.gif";s:4:"4179";s:23:"template/img/day_on.gif";s:4:"3286";s:26:"template/img/day_title.gif";s:4:"c273";s:23:"template/img/delete.gif";s:4:"90c6";s:23:"template/img/delete.png";s:4:"c292";s:24:"template/img/details.gif";s:4:"3501";s:31:"template/img/download_arrow.gif";s:4:"5f99";s:21:"template/img/edit.gif";s:4:"e0b9";s:26:"template/img/event_dot.gif";s:4:"3de5";s:20:"template/img/ics.gif";s:4:"48aa";s:26:"template/img/important.gif";s:4:"08a5";s:28:"template/img/left_arrows.gif";s:4:"6a98";s:25:"template/img/left_day.gif";s:4:"abd7";s:25:"template/img/month_on.gif";s:4:"81c2";s:27:"template/img/monthdot_1.gif";s:4:"5ac8";s:27:"template/img/monthdot_2.gif";s:4:"f880";s:27:"template/img/monthdot_3.gif";s:4:"669e";s:27:"template/img/monthdot_4.gif";s:4:"f1c7";s:27:"template/img/monthdot_5.gif";s:4:"98bb";s:27:"template/img/monthdot_6.gif";s:4:"efe9";s:27:"template/img/monthdot_7.gif";s:4:"c15b";s:30:"template/img/not_completed.gif";s:4:"be19";s:29:"template/img/phpical-logo.gif";s:4:"63f9";s:24:"template/img/printer.gif";s:4:"fc80";s:26:"template/img/recurring.gif";s:4:"c370";s:24:"template/img/refresh.gif";s:4:"3b3b";s:29:"template/img/right_arrows.gif";s:4:"114f";s:26:"template/img/right_day.gif";s:4:"7ed7";s:21:"template/img/save.gif";s:4:"c8b4";s:23:"template/img/search.gif";s:4:"7b43";s:25:"template/img/shadow_l.gif";s:4:"3190";s:25:"template/img/shadow_m.gif";s:4:"4606";s:25:"template/img/shadow_r.gif";s:4:"d224";s:24:"template/img/side_bg.gif";s:4:"8a2f";s:26:"template/img/smallicon.gif";s:4:"f3f0";s:23:"template/img/spacer.gif";s:4:"a0db";s:26:"template/img/tentative.gif";s:4:"2c7a";s:21:"template/img/tick.png";s:4:"c9b5";s:24:"template/img/time_bg.gif";s:4:"2171";s:26:"template/img/valid-rss.png";s:4:"3727";s:24:"template/img/week_on.gif";s:4:"64df";s:24:"template/img/year_on.gif";s:4:"9224";s:27:"template/js/dateformater.js";s:4:"397b";s:25:"template/js/fe-editing.js";s:4:"0110";s:31:"view/class.tx_cal_adminview.php";s:4:"2c5f";s:31:"view/class.tx_cal_base_view.php";s:4:"8bd6";s:43:"view/class.tx_cal_confirm_calendar_view.php";s:4:"96b4";s:43:"view/class.tx_cal_confirm_category_view.php";s:4:"a9ba";s:40:"view/class.tx_cal_confirm_event_view.php";s:4:"0738";s:53:"view/class.tx_cal_confirm_location_organizer_view.php";s:4:"a409";s:42:"view/class.tx_cal_create_calendar_view.php";s:4:"d7d1";s:42:"view/class.tx_cal_create_category_view.php";s:4:"0331";s:39:"view/class.tx_cal_create_event_view.php";s:4:"18d3";s:52:"view/class.tx_cal_create_location_organizer_view.php";s:4:"bef6";s:29:"view/class.tx_cal_dayview.php";s:4:"773d";s:42:"view/class.tx_cal_delete_calendar_view.php";s:4:"17bb";s:42:"view/class.tx_cal_delete_category_view.php";s:4:"e5ed";s:39:"view/class.tx_cal_delete_event_view.php";s:4:"1187";s:52:"view/class.tx_cal_delete_location_organizer_view.php";s:4:"8a5f";s:31:"view/class.tx_cal_eventview.php";s:4:"739f";s:42:"view/class.tx_cal_fe_editing_base_view.php";s:4:"f9e8";s:29:"view/class.tx_cal_icsview.php";s:4:"82ca";s:30:"view/class.tx_cal_listview.php";s:4:"b541";s:34:"view/class.tx_cal_locationview.php";s:4:"8660";s:42:"view/class.tx_cal_meeting_manager_view.php";s:4:"8e07";s:31:"view/class.tx_cal_monthview.php";s:4:"9271";s:39:"view/class.tx_cal_notification_view.php";s:4:"4229";s:35:"view/class.tx_cal_organizerview.php";s:4:"6384";s:35:"view/class.tx_cal_reminder_view.php";s:4:"a011";s:29:"view/class.tx_cal_rssview.php";s:4:"2a21";s:33:"view/class.tx_cal_searchviews.php";s:4:"dbb8";s:47:"view/class.tx_cal_subscription_manager_view.php";s:4:"3c02";s:30:"view/class.tx_cal_weekview.php";s:4:"431e";s:30:"view/class.tx_cal_yearview.php";s:4:"cf09";}',
	'suggests' => array(
	),
);

?>