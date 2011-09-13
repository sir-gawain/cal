<?php
/**
 * Language labels for database tables/fields belonging to extension "cal"
 *
 * This file is detected by the translation tool.
 */
$LOCAL_LANG = Array (
    'default' => Array (
        'tx_cal_event' => 'Calendar Event',
        'tx_cal_event.category' => 'Category',
        'tx_cal_event.title' => 'Title',
        'tx_cal_event.starttime' => 'Starttime',
        'tx_cal_event.endtime' => 'Endtime',
        'tx_cal_event.start_date' => 'Event Start Day',
        'tx_cal_event.start_time' => 'Event Start Time',
        'tx_cal_event.end_date' => 'Event End Day',
        'tx_cal_event.end_time' => 'Event End Time',
        'tx_cal_event.organizer' => 'Organizer',
        'tx_cal_event.organizer_id' => 'Cal Organizer',
        'tx_cal_event.location' => 'Location',
		'tx_cal_event.location_id' => 'Cal Location',
        'tx_cal_event.freq' => 'Frequency',
        'tx_cal_event.byday' => 'By Day (e.g.: mo,fr or all)',
        'tx_cal_event.bymonthday' => 'By Monthday (e.g.: 1,2,30 or all)',
        'tx_cal_event.bymonth' => 'By Month (e.g.: 1,2,3,4,12 or all)',
        'tx_cal_event.until' => 'Until Date',
        'tx_cal_event.count' => 'Count',
        'tx_cal_event.interval' => 'Interval',
        'tx_cal_event.description' => 'Description',
        'tx_cal_event.exception' => 'Exception',
        'tx_cal_event.fe_cruser_id' => 'Creator',
        'tx_cal_event.fe_crgroup_id' => 'Creator Group',
        'tx_cal_event.none' => 'None',
        
        /* new */
        'tx_cal_event.type' => 'Event type',
        'tx_cal_event.type.I.0' => 'Event with description',
        'tx_cal_event.type.I.1' => 'Shortcut to page',
        'tx_cal_event.type.I.2' => 'Link to external url',
        'tx_cal_event.external' => 'External URL',
        'tx_cal_event.shortcut_page' => 'Shortcut to page',
        /* new */
        'tx_cal_exception_event' => 'Calendar Exception Event',
        'tx_cal_exception_event.title' => 'Title',
        'tx_cal_exception_event.starttime' => 'Starttime',
        'tx_cal_exception_event.endtime' => 'Endtime',
        'tx_cal_exception_event.start_date' => 'Event Start Day',
        'tx_cal_exception_event.start_time' => 'Event Start Time',
        'tx_cal_exception_event.end_date' => 'Event End Day',
        'tx_cal_exception_event.end_time' => 'Event End Time',
        'tx_cal_exception_event.freq' => 'Frequency',
        'tx_cal_exception_event.byday' => 'By Day (e.g.: mo,fr or all)',
        'tx_cal_exception_event.bymonthday' => 'By Monthday (e.g.: 1,2,30 or all)',
        'tx_cal_exception_event.bymonth' => 'By Month (e.g.: 1,2,3,4,12 or all)',
        'tx_cal_exception_event.until' => 'Until Date',
        'tx_cal_exception_event.count' => 'Count',
        'tx_cal_exception_event.interval' => 'Interval',
        'tx_cal_exception_event.description' => 'Description',
        'tx_cal_exception_event_group' => 'Calendar Exception Event Group',
        'tx_cal_exception_event_group.title' => 'Title',
        'tx_cal_fe_user_event' => 'Frontend User - Event Relation',
        'tx_cal_fe_user_event.fe_user' => 'User',
        'tx_cal_fe_user_event.event' => 'Event',
        'tx_cal_fe_group_event' => 'Frontend Group - Event Relation',
        'tx_cal_fe_group_event.fe_group' => 'Group',
        'tx_cal_fe_group_event.event' => 'Event',
        'tx_cal_fe_user_event.monitor' => 'Notify on change',
        'tx_cal_category' => 'Calendar Category',
        'tx_cal_category.title' => 'Category title',
        'tx_cal_category.headercolor' => 'Header Color (e.g. green or #15E337)',
        'tx_cal_category.bodycolor' => 'Body Color',
        'tx_cal_category.headertextcolor' => 'Header Text Color',
        'tx_cal_category.bodytextcolor' => 'Body Text Color',
        'tx_cal_category.type' => 'Event type',
        'tx_cal_category.type.I.0' => 'Standard category (database)',
        'tx_cal_category.type.I.1' => 'External Calendar',
        'tx_cal_category.type.I.2' => 'Include ics file',
        'tx_cal_category.ext_url' => 'External Calendar URL',
        'tx_cal_category.ics_file' => 'ICS file',
        'tt_content.list_type' => 'Calendar',
        'tx_cal_controller_flexform.sheet_general' => '[ General Settings ]',
		'tx_cal_controller_flexform.sheet_general-mode' => 'Plugin Mode:',
		'tx_cal_controller_flexform.sheet_general-mode2.1' => 'search data',
		'tx_cal_controller_flexform.sheet_general-mode2.11' => 'select data',
		'tx_cal_controller_flexform.sheet_general-mode2.2' => 'list data',
		'tx_cal_controller_flexform.sheet_general-mode2.3' => 'view/edit data',
		'tx_cal_controller_flexform.sheet_general-mode2.4' => 'import data',
		'tx_cal_controller_flexform.sheet_general-mode2.30' => 'search+list data',
		'tx_cal_controller_flexform.sheet_general-mode2.31' => 'list+view/edit data',
		'tx_cal_controller_flexform.sheet_general-mode2.32' => 'search+list+view/edit data',
		'tx_cal_controller_flexform.sheet_general-mode2.33' => 'select+list data',
		'tx_cal_controller_flexform.sheet_general-mode2.99' => 'show info for plugin',
		'tx_cal_controller_flexform.sheet_general-debugmode' => 'Plugins Debug-Mode:',
		'tx_cal_controller_flexform.sheet_general-debugmode.0' => 'Debug Off',
		'tx_cal_controller_flexform.sheet_general-debugmode.1' => 'Debug On',
		'tx_cal_controller_flexform.sheet_general-debugmode.2' => 'Debug Verbose',
		'tx_cal_controller_flexform.sheet_general-template' => 'Template:',
		'tx_cal_controller_flexform.sheet_general-listpage' => 'PageID of Result ListPage:',
		'tx_cal_controller_flexform.sheet_general-editpage' => 'PageID of EditPage:',
		'tx_cal_controller_flexform.sheet_general-editpopup' => 'Edit in Popup-Window:',
		'tx_cal_controller_flexform.sheet_general-backpage' => 'PageID for BackButton:',
		'tx_cal_controller_flexform.sheet_more' => '[ More Settings ]',
		'tx_cal_controller_flexform.sheet_statistics' => '[ Template Settings ]',
		'tx_cal_controller_flexform.sheet_statistics-template' => 'Template:',
		'tx_cal_controller_flexform.sheet_localconf' => '[ Local Config ]',
		'tx_cal_controller_flexform.sheet_localconf-data' => 'LocalConf (TS-Style)',
		'tt_content.list_type' => 'TYPO3 Calendar',	
    ),
    'dk' => Array (
        'tx_cal_event' => 'Kalenderbegivenhed',
        'tx_cal_event.category' => 'Kategori',
        'tx_cal_event.title' => 'Titel',
        'tx_cal_event.starttime' => 'Starttid',
        'tx_cal_event.endtime' => 'Sluttid',
        'tx_cal_event.start_date' => 'Begivenheds startdato',
        'tx_cal_event.start_time' => 'Begivenheds starttid',
        'tx_cal_event.end_date' => 'Begivenheds slutdato',
        'tx_cal_event.end_time' => 'Begivenheds sluttid',
        'tx_cal_event.organizer' => 'Organisator',
        'tx_cal_event.organizer_id' => 'Cal Organisator',
        'tx_cal_event.location' => 'Sted',
		'tx_cal_event.location_id' => 'Cal sted',
        'tx_cal_event.freq' => 'Hyppighed',
        'tx_cal_event.byday' => 'Pr dag (eks.: ma, fr eller alle)',
        'tx_cal_event.bymonthday' => 'Pr m�nedsdag (eks.: 1, 2, 30 eller alle)',
        'tx_cal_event.bymonth' => 'Pr m�ned (eks.: 1, 2 ,3 ,4 , 12 eller alle)',
        'tx_cal_event.until' => 'Indtil dato',
        'tx_cal_event.count' => 'Antal',
        'tx_cal_event.interval' => 'Interval',
        'tx_cal_event.description' => 'Beskrivelse',
        'tx_cal_event.exception' => 'Undtagelse',
        'tx_cal_event.fe_cruser_id' => 'Bruger',
        'tx_cal_event.fe_crgroup_id' => 'Brugergruppe',
        /* new */
        'tx_cal_event.type' => 'Begivenhedstype',
        'tx_cal_event.type.I.0' => 'Begivenhed med beskrivelse',
        'tx_cal_event.type.I.1' => 'Genvej til side',
        'tx_cal_event.type.I.2' => 'Link til ekstern URL',
        'tx_cal_event.external' => 'Ekstern URL',
        'tx_cal_event.shortcut_page' => 'Genvej til side',
        /* new */
        'tx_cal_exception_event' => 'Kalender undtagelsesbegivenhed',
        'tx_cal_exception_event.title' => 'Titel',
        'tx_cal_exception_event.starttime' => 'Starttid',
        'tx_cal_exception_event.endtime' => 'Sluttid',
        'tx_cal_exception_event.start_date' => 'Begivenheds startdato',
        'tx_cal_exception_event.start_time' => 'Begivenheds starttid',
        'tx_cal_exception_event.end_date' => 'Begivenheds slutdato',
        'tx_cal_exception_event.end_time' => 'Begivenheds sluttid',
        'tx_cal_exception_event.freq' => 'Hyppighed',
        'tx_cal_exception_event.byday' => 'Pr dag (eks.: ma, fr eller alle)',
        'tx_cal_exception_event.bymonthday' => 'Pr m�nedsdag (eks.: 1, 2, 30 eller alle)',
        'tx_cal_exception_event.bymonth' => 'Pr m�ned (eks.: 1, 2 ,3 ,4 , 12 eller alle)',
        'tx_cal_exception_event.until' => 'Indtil dato',
        'tx_cal_exception_event.count' => 'Antal',
        'tx_cal_exception_event.interval' => 'Interval',
        'tx_cal_exception_event.description' => 'Beskrivelse',
        'tx_cal_exception_event_group' => 'Kalender undtagelsesbegivenhed gruppe',
        'tx_cal_exception_event_group.title' => 'Titel',
        'tx_cal_fe_user_event' => 'Frontend bruger - Begivenhedsrelationer',
        'tx_cal_fe_user_event.fe_user' => 'Bruger',
        'tx_cal_fe_user_event.event' => 'Begivenhed',
        'tx_cal_fe_group_event' => 'Frontend gruppe - Begivenhedsrelationer',
        'tx_cal_fe_group_event.fe_group' => 'Gruppe',
        'tx_cal_fe_group_event.event' => 'Begivenhed',
        'tx_cal_fe_user_event.monitor' => 'Rapporter �ndringer',
        'tx_cal_category' => 'Kalender kategori',
        'tx_cal_category.title' => 'Kategori titel',
        'tx_cal_category.headercolor' => 'Sidehoved farve (eks. green eller #15E337)',
        'tx_cal_category.bodycolor' => 'Br�dtekst farve (eks. green eller #15E337)',
        'tt_content.list_type' => 'Kalender',
        'tx_cal_controller_flexform.sheet_general' => '[ Generelle Indstillinger ]',
		'tx_cal_controller_flexform.sheet_general-mode' => 'Plugin Mode:',
		'tx_cal_controller_flexform.sheet_general-mode2.1' => 'search data',
		'tx_cal_controller_flexform.sheet_general-mode2.11' => 'select data',
		'tx_cal_controller_flexform.sheet_general-mode2.2' => 'list data',
		'tx_cal_controller_flexform.sheet_general-mode2.3' => 'view/edit data',
		'tx_cal_controller_flexform.sheet_general-mode2.4' => 'import data',
		'tx_cal_controller_flexform.sheet_general-mode2.30' => 'search+list data',
		'tx_cal_controller_flexform.sheet_general-mode2.31' => 'list+view/edit data',
		'tx_cal_controller_flexform.sheet_general-mode2.32' => 'search+list+view/edit data',
		'tx_cal_controller_flexform.sheet_general-mode2.33' => 'select+list data',
		'tx_cal_controller_flexform.sheet_general-mode2.99' => 'show info for plugin',
		'tx_cal_controller_flexform.sheet_general-debugmode' => 'Plugins Debug-Mode:',
		'tx_cal_controller_flexform.sheet_general-debugmode.0' => 'Debug Off',
		'tx_cal_controller_flexform.sheet_general-debugmode.1' => 'Debug On',
		'tx_cal_controller_flexform.sheet_general-debugmode.2' => 'Debug Verbose',
		'tx_cal_controller_flexform.sheet_general-template' => 'Template:',
		'tx_cal_controller_flexform.sheet_general-listpage' => 'PageID of Result ListPage:',
		'tx_cal_controller_flexform.sheet_general-editpage' => 'PageID of EditPage:',
		'tx_cal_controller_flexform.sheet_general-editpopup' => 'Edit in Popup-Window:',
		'tx_cal_controller_flexform.sheet_general-backpage' => 'PageID for BackButton:',
		'tx_cal_controller_flexform.sheet_more' => '[ More Settings ]',
		'tx_cal_controller_flexform.sheet_statistics' => '[ Template Settings ]',
		'tx_cal_controller_flexform.sheet_statistics-template' => 'Template:',
		'tx_cal_controller_flexform.sheet_localconf' => '[ Local Config ]',
		'tx_cal_controller_flexform.sheet_localconf-data' => 'LocalConf (TS-Style)',
		'tt_content.list_type' => 'TYPO3 Kalender',	
    ),
    'de' => Array (
        'tx_cal_event' => 'Kalender Event',
        'tx_cal_event.category' => 'Kategorie',
        'tx_cal_event.title' => 'Titel',
        'tx_cal_event.starttime' => 'Startzeit',
        'tx_cal_event.endtime' => 'Endzeit',
        'tx_cal_event.start_date' => 'Event Start Tag',
        'tx_cal_event.start_time' => 'Event Start Zeit',
        'tx_cal_event.end_date' => 'Event Ende Tag',
        'tx_cal_event.end_time' => 'Event Ende Zeit',
        'tx_cal_event.organizer' => 'Organisator',
        'tx_cal_event.organizer_id' => 'Cal Organisator',
        'tx_cal_event.location' => 'Ort',
		'tx_cal_event.location_id' => 'Cal Ort',
        'tx_cal_event.freq' => 'Frequenz',
        'tx_cal_event.byday' => 'Nach Tag (z.B.: mo,fr oder all)',
        'tx_cal_event.bymonthday' => 'Nach Monagstag (z.B.: 1,2,30 oder all)',
        'tx_cal_event.bymonth' => 'Nach Monat (e.g.: 1,2,3,4,12 oder all)',
        'tx_cal_event.until' => 'Bis Datum',
        'tx_cal_event.count' => 'Anzahl',
        'tx_cal_event.interval' => 'Intervall',
        'tx_cal_event.description' => 'Beschreibung',
        'tx_cal_event.exception' => 'Ausnahme',
        'tx_cal_event.fe_cruser_id' => 'Ersteller',
        'tx_cal_event.fe_crgroup_id' => 'Erstellergruppe',
        'tx_cal_exception_event' => 'Kalender Ausnahme Event',
        'tx_cal_exception_event.title' => 'Titel',
        'tx_cal_exception_event.starttime' => 'Startzeit',
        'tx_cal_exception_event.endtime' => 'Endzeit',
        'tx_cal_exception_event.start_date' => 'Event Start Tag',
        'tx_cal_exception_event.start_time' => 'Event Start Zeit',
        'tx_cal_exception_event.end_date' => 'Event End Tag',
        'tx_cal_exception_event.end_time' => 'Event End Zeit',
        'tx_cal_exception_event.freq' => 'Frequenz',
        'tx_cal_exception_event.byday' => 'Nach Tag (z.B.: mo,fr oder all)',
        'tx_cal_exception_event.bymonthday' => 'Nach Monagstag (z.B.: 1,2,30 oder all)',
        'tx_cal_exception_event.bymonth' => 'Nach Monat (e.g.: 1,2,3,4,12 oder all)',
        'tx_cal_exception_event.until' => 'Bis Datum',
        'tx_cal_exception_event.count' => 'Anzahl',
        'tx_cal_exception_event.interval' => 'Intervall',
        'tx_cal_exception_event.description' => 'Beschreibung',
        'tx_cal_exception_event_group' => 'Kalenderausnahme Eventgruppe',
        'tx_cal_exception_event_group.title' => 'Titel',
        'tx_cal_fe_user_event' => 'Frontend Benutzer - Event Relation',
        'tx_cal_fe_user_event.fe_user' => 'User',
        'tx_cal_fe_user_event.event' => 'Event',
        'tx_cal_fe_group_event' => 'Frontend Gruppe - Event Relation',
        'tx_cal_fe_group_event.fe_group' => 'Gruppe',
        'tx_cal_fe_group_event.event' => 'Event',
        'tx_cal_fe_user_event.monitor' => 'Benachrichtigung bei Änderungen',
        'tx_cal_category' => 'Kalender Kategorie',
        'tx_cal_category.title' => 'Kalendertitel',
        'tx_cal_category.headercolor' => 'Kopffarbe (z.B. green oder #15E337)',
        'tx_cal_category.bodycolor' => 'Körperfarbe (z.B. green oder #15E337)',
        'tt_content.list_type' => 'Kalender',
        'tx_cal_controller_flexform.sheet_general' => '[ Allgemeine Einstellungen ]',
		'tx_cal_controller_flexform.sheet_general-mode' => 'Plugin Modus:',
		'tx_cal_controller_flexform.sheet_general-mode2.1' => 'Daten suchen',
		'tx_cal_controller_flexform.sheet_general-mode2.11' => 'Daten auswählen',
		'tx_cal_controller_flexform.sheet_general-mode2.2' => 'Daten auflisten',
		'tx_cal_controller_flexform.sheet_general-mode2.3' => 'Daten betrachten/editieren',
		'tx_cal_controller_flexform.sheet_general-mode2.4' => 'Daten importieren',
		'tx_cal_controller_flexform.sheet_general-mode2.30' => 'Daten suchen/auflisten',
		'tx_cal_controller_flexform.sheet_general-mode2.31' => 'Daten auflisten+betrachten/editieren',
		'tx_cal_controller_flexform.sheet_general-mode2.32' => 'Daten suchen+auflisten+betrachten/editieren',
		'tx_cal_controller_flexform.sheet_general-mode2.33' => 'Daten auswählen+auflisten',
		'tx_cal_controller_flexform.sheet_general-mode2.99' => 'Infos des Plugins anzeigen',
		'tx_cal_controller_flexform.sheet_general-debugmode' => 'Plugins Debug-Modus:',
		'tx_cal_controller_flexform.sheet_general-debugmode.0' => 'Debug Aus',
		'tx_cal_controller_flexform.sheet_general-debugmode.1' => 'Debug An',
		'tx_cal_controller_flexform.sheet_general-debugmode.2' => 'Debug Verbose',
		'tx_cal_controller_flexform.sheet_general-template' => 'Template:',
		'tx_cal_controller_flexform.sheet_general-listpage' => 'PageID der Result ListPage:',
		'tx_cal_controller_flexform.sheet_general-editpage' => 'PageID der EditPage:',
		'tx_cal_controller_flexform.sheet_general-editpopup' => 'Edit in Popup-Window:',
		'tx_cal_controller_flexform.sheet_general-backpage' => 'PageID des BackButton:',
		'tx_cal_controller_flexform.sheet_more' => '[ Mehr Einstellungen ]',
		'tx_cal_controller_flexform.sheet_statistics' => '[ Template Einstellungen ]',
		'tx_cal_controller_flexform.sheet_statistics-template' => 'Template:',
		'tx_cal_controller_flexform.sheet_localconf' => '[ Local Config ]',
		'tx_cal_controller_flexform.sheet_localconf-data' => 'LocalConf (TS-Style)',
		'tt_content.list_type' => 'TYPO3 Kalender',	
    ),
    'no' => Array (
        'tx_cal_event' => 'Kalender hendelse',
        'tx_cal_event.category' => 'Kategori',
        'tx_cal_event.title' => 'Tittel',
        'tx_cal_event.starttime' => 'Starttidspunkt',
        'tx_cal_event.endtime' => 'Sluttidspunkt',
        'tx_cal_event.start_date' => 'Startdag for hendelse',
        'tx_cal_event.start_time' => 'Starttid for hendelse',
        'tx_cal_event.end_date' => 'Sluttdag for hendelse',
        'tx_cal_event.end_time' => 'Sluttid for hendelse',
        'tx_cal_event.organizer' => 'Organisator',
        'tx_cal_event.organizer_id' => 'Cal organisator',
        'tx_cal_event.location' => 'Sted',
        'tx_cal_event.freq' => 'Frekvens',
        'tx_cal_event.byday' => 'Ved dag (f.eks.: ma,fr eller alle)',
        'tx_cal_event.bymonthday' => 'Ved dag i m&aring;ned (f.eks.: 1,2,30 eller alle)',
        'tx_cal_event.bymonth' => 'Ved m&aring;ned (f.eks.: 1,2,3,4,12 or all)',
        'tx_cal_event.until' => 'Inntil dato',
        'tx_cal_event.count' => 'Antall',
        'tx_cal_event.interval' => 'Interval',
        'tx_cal_event.description' => 'Beskrivelse',
        'tx_cal_event.exception' => 'Unntak',
        'tx_cal_event.fe_cruser_id' => 'Opphavsmann',
        'tx_cal_event.fe_crgroup_id' => 'Opphavsgruppe',
        'tx_cal_exception_event' => 'Kalender unntakshendelse',
        'tx_cal_exception_event.title' => 'Tittel',
        'tx_cal_exception_event.starttime' => 'Starttidspunkt',
        'tx_cal_exception_event.endtime' => 'Sluttidspunkt',
        'tx_cal_exception_event.start_date' => 'Startdag for hendelse',
        'tx_cal_exception_event.start_time' => 'Starttid for hendelse',
        'tx_cal_exception_event.end_date' => 'Sluttdag for hendelse',
        'tx_cal_exception_event.end_time' => 'Sluttid for hendelse',
        'tx_cal_exception_event.freq' => 'Frekvens',
        'tx_cal_exception_event.byday' => 'Ved dag (f.eks.: ma,fr eller alle)',
        'tx_cal_exception_event.bymonthday' => 'Ved dag i m&aring;ned (f.eks.: 1,2,30 eller alle)',
        'tx_cal_exception_event.bymonth' => 'Ved m&aring;ned (f.eks.: 1,2,3,4,12 or all)',
        'tx_cal_exception_event.until' => 'Inntil dato',
        'tx_cal_exception_event.count' => 'Antall',
        'tx_cal_exception_event.interval' => 'Interval',
        'tx_cal_exception_event.description' => 'Beskrivelse',
        'tx_cal_exception_event_group' => 'Kalender unntak hendelsesgruppe',
        'tx_cal_exception_event_group.title' => 'Tittel',
        'tx_cal_fe_user_event' => 'Frontend bruker - hendelsesrelasjon',
        'tx_cal_fe_user_event.fe_user' => 'Bruker',
        'tx_cal_fe_user_event.event' => 'Hendelse',
        'tx_cal_fe_group_event' => 'Frontend gruppe - hendelsesrelasjon',
        'tx_cal_fe_group_event.fe_group' => 'Gruppe',
        'tx_cal_fe_group_event.event' => 'Hendelse',
        'tx_cal_fe_user_event.monitor' => 'Varsle ved endring',
        'tx_cal_category' => 'Kalender kategori',
        'tx_cal_category.title' => 'Kategori tittel',
        'tx_cal_category.headercolor' => 'Overskift farge (f.eks. green eller #15E337)',
        'tx_cal_category.bodycolor' => 'Tekstomr&aring;de farge (f.eks. green eller #15E337)',
        'tt_content.list_type' => 'TYPO3 Kalender',
    ),
    'it' => Array (
        'tx_cal_event' => 'Evento',
        'tx_cal_event.category' => 'Categoria',
        'tx_cal_event.title' => 'Titolo',
        'tx_cal_event.organizer' => 'Organizzatore',
        'tx_cal_event.location' => 'Luogo',
        'tx_cal_event.freq' => 'Frequenza',
        'tx_cal_event.until' => 'Fino al',
        'tx_cal_event.count' => 'Contatore',
        'tx_cal_event.interval' => 'Intervallo',
        'tx_cal_event.description' => 'Descrizione',
        'tx_cal_event.exception' => 'Eccezione',
        'tx_cal_event.fe_cruser_id' => 'Creatore',
        'tx_cal_exception_event.title' => 'Titolo',
        'tx_cal_exception_event.freq' => 'Frequenza',
        'tx_cal_exception_event.count' => 'Contatore',
        'tx_cal_exception_event.interval' => 'Intervallo',
        'tx_cal_exception_event.description' => 'Descrizione',
        'tx_cal_exception_event_group.title' => 'Titolo',
        'tx_cal_fe_user_event.fe_user' => 'Utente',
        'tx_cal_fe_user_event.event' => 'Evento',
        'tx_cal_fe_group_event.fe_group' => 'Gruppo',
        'tx_cal_fe_group_event.event' => 'Evento',
        'tx_cal_fe_user_event.monitor' => 'Notifica in caso di modifica',
        'tx_cal_category' => 'Categoria Calendario',
        'tx_cal_category.title' => 'Titolo Categoria',
        'tx_cal_category.color' => 'Colore (es. green o #15E337)',
        'tt_content.list_type' => 'TYPO3 Calendario',	
    ),
    'fr' => Array (
        'tx_cal_event' => '�v�nement calendrier',
        'tx_cal_event.category' => 'Cat�gorie',
        'tx_cal_event.title' => 'Titre',
        'tx_cal_event.starttime' => 'Heure de d�but',
        'tx_cal_event.endtime' => 'Heure de fin',
        'tx_cal_event.start_date' => 'Date de d�but',
        'tx_cal_event.start_time' => 'Heure de d�but',
        'tx_cal_event.end_date' => 'Date de fin',
        'tx_cal_event.end_time' => 'Heure de fin ',
        'tx_cal_event.organizer' => 'Organisateur',
        'tx_cal_event.organizer_id' => 'Organisateurs r�pertori�s',
        'tx_cal_event.location' => 'Endroit',
        'tx_cal_event.location_id' => 'Endroits r�p�rtori�s',
        'tx_cal_event.freq' => 'Fr�quence',
        'tx_cal_event.byday' => 'Par jour (ex.: mo,tu, wed, th, fr ou all)',
        'tx_cal_event.bymonthday' => 'Par jour du mois (ex.: 1,2,30 ou all)',
        'tx_cal_event.bymonth' => 'Par mois (ex.: 1,2,3,4,12 ou all)',
        'tx_cal_event.until' => 'Jusque',
        'tx_cal_event.count' => 'Nombre de r�p�titions (�v�nement de base inclus)',
        'tx_cal_event.interval' => 'Intervalle',
        'tx_cal_event.description' => 'Description',
        'tx_cal_event.exception' => 'Exception',
        'tx_cal_event.fe_cruser_id' => 'Cr�ateur',
        'tx_cal_event.fe_crgroup_id' => 'Groupe Cr�ateur',
        'tx_cal_exception_event' => 'Exception',
        'tx_cal_exception_event.title' => 'Titre',
        'tx_cal_exception_event.starttime' => 'Heure de d�but',
        'tx_cal_exception_event.endtime' => 'Heure de fin',
        'tx_cal_exception_event.start_date' => 'Date de d�but',
        'tx_cal_exception_event.start_time' => 'Heure de d�but',
        'tx_cal_exception_event.end_date' => 'Date de fin',
        'tx_cal_exception_event.end_time' => 'Heure de fin',
        'tx_cal_exception_event.freq' => 'Fr�quence',
        'tx_cal_exception_event.byday' => 'Par jour (ex.: mo,tu, wed, th, fr ou all)',
        'tx_cal_exception_event.bymonthday' => 'Par jour du mois (ex.: 1,2,30 ou all)',
        'tx_cal_exception_event.bymonth' => 'Par mois (ex.: 1,2,3,4,12 ou all)',
        'tx_cal_exception_event.until' => 'Jusque',
        'tx_cal_exception_event.count' => 'Nombre de r�p�titions (�v�nement de base inclus)',
        'tx_cal_exception_event.interval' => 'Intervalle',
        'tx_cal_exception_event.description' => 'Description',
        'tx_cal_exception_event_group' => 'Groupe Exception Calendrier',
        'tx_cal_exception_event_group.title' => 'Titre',
        'tx_cal_fe_user_event' => 'Utilisateur frontal - (Event Relation)',
        'tx_cal_fe_user_event.fe_user' => 'Afficher uniquement pour',
        'tx_cal_fe_user_event.event' => 'Ev�nement',
        'tx_cal_fe_group_event' => 'Groupe frontal - Lien �v�nement',
        'tx_cal_fe_group_event.fe_group' => 'Groupe frontal',
        'tx_cal_fe_group_event.event' => 'Ev�nement',
        'tx_cal_fe_user_event.monitor' => 'Notification en cas de changement',
        'tx_cal_category' => 'Cat�gorie de calendrier',
        'tx_cal_category.title' => 'Titre de cat�gorie',
        'tx_cal_category.color' => 'Couleur (ex. vert ou #15E337)',
        'tt_content.list_type' => 'TYPO3 Calendrier',
    ),
    'es' => Array (
    ),
    'nl' => Array (
   		'tx_cal_event' => 'Kalender gebeurtenis',
        'tx_cal_event.category' => 'Categorie',
		'tx_cal_event.title' => 'Titel',
		'tx_cal_event.starttime' => 'Aanvangstijd',
		'tx_cal_event.endtime' => 'Eindtijd',
        'tx_cal_event.start_date' => 'Gebeurtenis begindatum',
        'tx_cal_event.start_time' => 'Gebeurtenis aanvangstijd',
        'tx_cal_event.end_date' => 'Gebeurtenis einddatum',
        'tx_cal_event.end_time' => 'Gebeurtenis eindtijd',
		'tx_cal_event.organizer' => 'Organisator',
		'tx_cal_event.organizer_id' => 'Kalender organisator',
		'tx_cal_event.location' => 'Locatie',
		'tx_cal_event.freq' => 'Frequentie',
		'tx_cal_event.byday' => 'Op dag (b.v.: ma,vr of alle)',
		'tx_cal_event.bymonthday' => 'Op dag van de maand (b.v.: 1,2,30 of alle)',
		'tx_cal_event.bymonth' => 'Op maand (b.v.: 1,2,3,4,12 of alle)',
		'tx_cal_event.until' => 'Tot datum',
		'tx_cal_event.count' => 'Telling',
		'tx_cal_event.interval' => 'Interval',
		'tx_cal_event.description' => 'Omschrijving',
        'tx_cal_event.exception' => 'Uitzondering',
        'tx_cal_event.fe_cruser_id' => 'Aangemaakt door',
        'tx_cal_event.fe_crgroup_id' => 'Aanmakersgroep',
        'tx_cal_exception_event' => 'Kalender uitzonderings gebeurtenis',
        'tx_cal_exception_event.title' => 'Titel',
        'tx_cal_exception_event.starttime' => 'Aanvangstijd',
        'tx_cal_exception_event.endtime' => 'Eindtijd',
        'tx_cal_exception_event.start_date' => 'Gebeurtenis begindag',
        'tx_cal_exception_event.start_time' => 'Gebeurtenis aanvangstijd',
        'tx_cal_exception_event.end_date' => 'gebeurtenis einddag',
        'tx_cal_exception_event.end_time' => 'Gebeurtenis eindtijd',
        'tx_cal_exception_event.freq' => 'Frequentie',
        'tx_cal_exception_event.byday' => 'Op dag (b.v.: ma,vr of all)',
        'tx_cal_exception_event.bymonthday' => 'Op maanddag (b.v.: 1,2,30 of all)',
        'tx_cal_exception_event.bymonth' => 'Op maand (b.v.: 1,2,3,4,12 of all)',
        'tx_cal_exception_event.until' => 'Tot datum',
        'tx_cal_exception_event.count' => 'Telling',
        'tx_cal_exception_event.interval' => 'Interval',
        'tx_cal_exception_event.description' => 'Omschrijving',
        'tx_cal_exception_event_group' => 'Kalender gebeurtenis uitzonderingen groep',
        'tx_cal_exception_event_group.title' => 'Titel',
		'tx_cal_fe_user_event' => 'Frontendgebruiker - Relatie met gebeurtenis',
		'tx_cal_fe_user_event.fe_user' => 'Gebruiker',
		'tx_cal_fe_user_event.event' => 'Gebeurtenis',
		'tx_cal_fe_group_event' => 'Frontendgroep - Relatie met gebeurtenis',
		'tx_cal_fe_group_event.fe_group' => 'Groep',
		'tx_cal_fe_group_event.event' => 'Gebeurtenis',
		'tx_cal_fe_user_event.monitor' => 'Op de hoogte stellen bij wijziging',
		'tx_cal_category' => 'Kalender categorien',
		'tx_cal_category.title' => 'Titel van categorie',
		'tx_cal_category.headercolor' => 'Kleur (b.v. green [CSS kleuren] of #15E337 [HEX])',
		'tx_cal_category.bodycolor' => 'Kleur (b.v. green [CSS kleuren] of #15E337 [HEX])',
		'tt_content.list_type' => 'TYPO3 Kalender',
    ),
    'cz' => Array (
    ),
    'pl' => Array (
    ),
    'si' => Array (
    ),
    'fi' => Array (
    	'tx_cal_events' => 'Kalenteritapahtuma',
		'tx_cal_events.title' => 'Otsikko',
		'tx_cal_events.starttime' => 'Aloitusaika',
		'tx_cal_events.endtime' => 'P��ttymisaika',
		'tx_cal_events.organizer' => 'J�rjest�j�',
		'tx_cal_events.location' => 'Sijainti',
		'tx_cal_events.freq' => 'Toistuvuus',
		'tx_cal_events.byday' => 'P�ivitt�in (esim.: ma, pe tai kaikki)',
		'tx_cal_events.bymonthday' => 'Kuukaudenp�iv�n� (esim.: 1,2,30 tai kaikki)',
		'tx_cal_events.bymonth' => 'Kuukausittain (esim.: 1,2,3,4,12 tai kaikki)',
		'tx_cal_events.until' => 'saakka (muoto VVVVKKPP)',
		'tx_cal_events.count' => 'Lukum��r�',
		'tx_cal_events.interval' => 'Jakso',
		'tx_cal_events.description' => 'Kuvaus',
		'tx_cal_fe_user_event' => 'Edustak�ytt�j� - tapahtuma riippuvuus',
		'tx_cal_fe_user_event.fe_user' => 'K�ytt�j�',
		'tx_cal_fe_user_event.event' => 'Tapahtuma',
		'tx_cal_fe_group_event' => 'Edustak�ytt�j�ryhm�- tapahtuma riippuvuus',
		'tx_cal_fe_group_event.fe_group' => 'Ryhm�',
		'tx_cal_fe_group_event.event' => 'Tapahtuma',
		'tx_cal_fe_user_event.monitor' => 'Huomauta muutoksesta',
		'tx_cal_categories' => 'Kalenteriluokat',
		'tx_cal_categories.title' => 'Luokan nimike',
		'tx_cal_categories.color' => 'V�ri (esim. vihre� (green) tai #15E337)',
		'tt_content.list_type' => 'TYPO3 Kalenteri',
    ),
    'tr' => Array (
    ),
    'se' => Array (
    ),
    'pt' => Array (
    ),
    'ru' => Array (
    ),
    'ro' => Array (
    ),
    'ch' => Array (
    ),
    'sk' => Array (
    ),
    'lt' => Array (
    ),
    'is' => Array (
    ),
    'hr' => Array (
    ),
    'hu' => Array (
    ),
    'gl' => Array (
    ),
    'th' => Array (
    ),
    'gr' => Array (
    ),
    'hk' => Array (
    ),
    'eu' => Array (
    ),
    'bg' => Array (
    ),
    'br' => Array (
    ),
    'et' => Array (
    ),
    'ar' => Array (
    ),
    'he' => Array (
    ),
    'ua' => Array (
    ),
    'lv' => Array (
    ),
    'jp' => Array (
    ),
    'vn' => Array (
    ),
    'ca' => Array (
    ),
    'ba' => Array (
    ),
    'kr' => Array (
    ),
    'eo' => Array (
    ),
    'my' => Array (
    ),
    'hi' => Array (
    ),
);
?>