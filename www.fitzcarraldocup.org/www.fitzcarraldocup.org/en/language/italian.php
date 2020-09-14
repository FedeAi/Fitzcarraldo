<?php
/**
* @version $Id: english.php 2526 2006-02-22 15:33:24Z vamba $
* @package Joomla
* @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

// Site page note found
define( '_404', 'Siamo spiacenti ma la pagina richiesta non pu&#242; essere trovata.' );
define( '_404_RTS', 'Ritorna al sito' );

// common
DEFINE('_LANGUAGE','it');
DEFINE('_NOT_AUTH','Spiacenti, non sei autorizzato a visualizzare questa risorsa.');
DEFINE("_DO_LOGIN","Se hai gi&#224; un account registrato, <a href='index.php?option=com_login&task=login'>Accedi</a> in caso contrario <a href='index.php?option=com_registration&task=register'>registra un account</a> adesso.<br />");
DEFINE('_VALID_AZ09',"Per favore, inserisci un campo %s valido. Senza spazi, con pi&#249; di %d caratteri che comprendano 0-9,a-z,A-Z");
DEFINE('_CMN_YES','Si');
DEFINE('_CMN_NO','No');
DEFINE('_CMN_SHOW','Mostra');
DEFINE('_CMN_HIDE','Nascondi');

DEFINE('_CMN_NAME','Nome');
DEFINE('_CMN_DESCRIPTION','Descrizione');
DEFINE('_CMN_SAVE','Salva');
DEFINE('_CMN_CANCEL','Annulla');
DEFINE('_CMN_PRINT','Stampa');
DEFINE('_CMN_PDF','PDF');
DEFINE('_CMN_EMAIL','E-mail');
DEFINE('_ICON_SEP','|');
DEFINE('_CMN_PARENT','Indietro');
DEFINE('_CMN_ORDERING','Ordina');
DEFINE('_CMN_ACCESS','Livello accesso');
DEFINE('_CMN_SELECT','Seleziona');

DEFINE('_CMN_NEXT','Pross.');
DEFINE('_CMN_NEXT_ARROW'," &gt;&gt;");
DEFINE('_CMN_PREV','Prec.');
DEFINE('_CMN_PREV_ARROW',"&lt;&lt; ");

DEFINE('_CMN_SORT_NONE','Nessun ordine');
DEFINE('_CMN_SORT_ASC','Ordine ascendente');
DEFINE('_CMN_SORT_DESC','Ordine discendente');

DEFINE('_CMN_NEW','Nuovo');
DEFINE('_CMN_NONE','Nessuno');
DEFINE('_CMN_LEFT','Sinistra');
DEFINE('_CMN_RIGHT','Destra');
DEFINE('_CMN_CENTER','Al centro');
DEFINE('_CMN_ARCHIVE','Archivia');
DEFINE('_CMN_UNARCHIVE','Ripristina');
DEFINE('_CMN_TOP','In alto');
DEFINE('_CMN_BOTTOM','In basso');

DEFINE('_CMN_PUBLISHED','Pubblicato');
DEFINE('_CMN_UNPUBLISHED','Sospeso');

DEFINE('_CMN_EDIT_HTML','Mod. HTML');
DEFINE('_CMN_EDIT_CSS','Mod. CSS');

DEFINE('_CMN_DELETE','Cancella');

DEFINE('_CMN_FOLDER','Cartella');
DEFINE('_CMN_SUBFOLDER','Sotto-cartella');
DEFINE('_CMN_OPTIONAL','Facoltativo');
DEFINE('_CMN_REQUIRED','Richiesto');

DEFINE('_CMN_CONTINUE','Continua');

DEFINE('_CMN_NEW_ITEM_LAST','I nuovi oggetti assumono di default l&acute;ultima posizione');
DEFINE('_CMN_NEW_ITEM_FIRST','I nuovi oggetti assumono di default la prima posizione');
DEFINE('_LOGIN_INCOMPLETE','Per favore compila i campi nome utente e password.');
DEFINE('_LOGIN_BLOCKED','Il tuo account &#232; stato bloccato. Per favore contatta gli amministratori.');
DEFINE('_LOGIN_INCORRECT','Nome utente o password non validi. Per favore prova ancora.');
DEFINE('_LOGIN_NOADMINS','Non puoi loggarti. Non ci sono amministratori settati.');
DEFINE('_CMN_JAVASCRIPT','!Attenzione! Javascript deve essere abilitato per una corretta operazione.');

DEFINE('_NEW_MESSAGE','Arrivato un nuovo messaggio privato');
DEFINE('_MESSAGE_FAILED','Questo utente ha bloccato la sua mailbox. Comunicazione fallita.');

DEFINE('_CMN_IFRAMES', 'Questa scelta non funziona correttamente in quanto il browser utilizzato non supporta gli Inline Frames');

DEFINE('_INSTALL_WARN','Per sicurezza rimuovi completamente la cartella installazione incluse tutte le cartelle e sotto-cartelle in essa contenute. <br /> Fatto questo ricarica pure questa pagina');
DEFINE('_TEMPLATE_WARN','<font color=\"red\"><b>File Template non trovato!</b></font><br />Hai recentemente effettuato un aggiornamento? <br />Se si <b>DEVI</b> aggiornare anche il tuo database<br />Loggati come Amministratore e seleziona Aggiorna Database dal menu');
DEFINE('_NO_PARAMS','Nessun parametro per questo modulo');
DEFINE('_HANDLER','Gestore non definito per tipo');

/** mambots */
DEFINE('_TOC_JUMPTO','Indice articolo');

/**  content */
DEFINE('_READ_MORE','Leggi tutto...');
DEFINE('_READ_MORE_REGISTER','Registrati per leggere tutto...');
DEFINE('_MORE','Altri articoli...');
DEFINE('_ON_NEW_CONTENT', "Nuovo contenuto inviato da [ %s ]  titolo [ %s ]  dalla sezione [ %s ]  e categoria  [ %s ]" );
DEFINE('_SEL_CATEGORY','- Seleziona categoria -');
DEFINE('_SEL_SECTION','- Seleziona sezione -');
DEFINE('_SEL_AUTHOR','- Seleziona autore -');
DEFINE('_SEL_POSITION','- Seleziona posizione -');
DEFINE('_SEL_TYPE','- Seleziona tipo -');
DEFINE('_EMPTY_CATEGORY','Categoria vuota');
DEFINE('_EMPTY_BLOG','Non ci sono articoli da visualizzare');
DEFINE('_NOT_EXIST','La pagina alla quale stai provando ad accedere non esiste.<br />Per favore seleziona una pagina dal menu principale.');

/** classes/html/modules.php */
DEFINE('_BUTTON_VOTE','Vota');
DEFINE('_BUTTON_RESULTS','Risultati');
DEFINE('_USERNAME','Username');
DEFINE('_LOST_PASSWORD','Password dimenticata?');
DEFINE('_PASSWORD','Password');
DEFINE('_BUTTON_LOGIN','Entra');
DEFINE('_BUTTON_LOGOUT','Esci');
DEFINE('_NO_ACCOUNT','Non hai ancora un account?');
DEFINE('_CREATE_ACCOUNT','Registrati');
DEFINE('_VOTE_POOR','Scarso');
DEFINE('_VOTE_BEST','Ottimo');
DEFINE('_USER_RATING','Valutazione utente');
DEFINE('_RATE_BUTTON','Valuta questo articolo');
DEFINE('_REMEMBER_ME','Ricordami');

/** contact.php */
DEFINE('_ENQUIRY','Richiesta Informazioni');
DEFINE('_ENQUIRY_TEXT','E-mail di richiesta informazioni da parte di ');
DEFINE('_COPY_TEXT','Ricevi copia del seguente messaggio che hai inviato ad un amministratore di %s');
DEFINE('_COPY_SUBJECT','Copia di: ');
DEFINE('_THANK_MESSAGE','Ti ringraziamo per averci contattato');
DEFINE('_CLOAKING','Indirizzo e-mail protetto dal bots spam , deve abilitare Javascript per vederlo');
DEFINE('_CONTACT_HEADER_NAME','Nome');
DEFINE('_CONTACT_HEADER_POS','Posizione');
DEFINE('_CONTACT_HEADER_EMAIL','Email');
DEFINE('_CONTACT_HEADER_PHONE','Telefono');
DEFINE('_CONTACT_HEADER_FAX','Fax');
DEFINE('_CONTACTS_DESC','La lista di contatti di questo sito.');

/** classes/html/contact.php */
DEFINE('_CONTACT_TITLE','Contatti');
DEFINE('_EMAIL_DESCRIPTION','Scrivici una e-mail:');
DEFINE('_NAME_PROMPT',' Inserisci il tuo nome:');
DEFINE('_EMAIL_PROMPT',' Inserisci il tuo indirizzo e-mail:');
DEFINE('_MESSAGE_PROMPT',' Inserisci il tuo messaggio:');
DEFINE('_SEND_BUTTON','Invia');
DEFINE('_CONTACT_FORM_NC','Assicurati che il modulo sia completo e valido.');
DEFINE('_CONTACT_TELEPHONE','Telefono: ');
DEFINE('_CONTACT_MOBILE','Cellulare: ');
DEFINE('_CONTACT_FAX','Fax: ');
DEFINE('_CONTACT_EMAIL','Email: ');
DEFINE('_CONTACT_NAME','Nome: ');
DEFINE('_CONTACT_POSITION','Posizione: ');
DEFINE('_CONTACT_ADDRESS','Indirizzo: ');
DEFINE('_CONTACT_MISC','Informazioni: ');
DEFINE('_CONTACT_SEL','Seleziona contatto:');
DEFINE('_CONTACT_NONE','Non ci sono Contatti elencati.');
DEFINE('_EMAIL_A_COPY','Manda una copia di questa mail al tuo indirizzo.');
DEFINE('_CONTACT_DOWNLOAD_AS','Scarica informazioni');
DEFINE('_VCARD','VCard');

/** pageNavigation */
DEFINE('_PN_LT','&lt;');
DEFINE('_PN_RT','&gt;');
DEFINE('_PN_PAGE','Pagina');
DEFINE('_PN_OF','di');
DEFINE('_PN_START','Inizio');
DEFINE('_PN_PREVIOUS','Prec.');
DEFINE('_PN_NEXT','Pross.');
DEFINE('_PN_END','Fine');
DEFINE('_PN_DISPLAY_NR','Mostra #');
DEFINE('_PN_RESULTS','Risultati');

/** emailfriend */
DEFINE('_EMAIL_TITLE','Segnala ad un amico');
DEFINE('_EMAIL_FRIEND','Segnala questa pagina ad un amico.');
DEFINE('_EMAIL_FRIEND_ADDR','Indirizzo e-mail del tuo amico:');
DEFINE('_EMAIL_YOUR_NAME','Il tuo nome:');
DEFINE('_EMAIL_YOUR_MAIL','Il tuo indirizzo e-mail:');
DEFINE('_SUBJECT_PROMPT','Oggetto del messaggio:');
DEFINE('_BUTTON_SUBMIT_MAIL','Invia e-mail');
DEFINE('_BUTTON_CANCEL','Annulla');
DEFINE('_EMAIL_ERR_NOINFO','Devi inserire il tuo indirizzo e-mail e un indirizzo e-mail valido a cui inviarlo.');
DEFINE('_EMAIL_MSG',' La seguente pagina del sito "%s" inviata da %s ( %s ).

Potete visualizzarla utilizzando la seguente URL:
%s');
DEFINE('_EMAIL_INFO','Articolo inviato da');
DEFINE('_EMAIL_SENT','Questo articolo è stato inviato a');
DEFINE('_PROMPT_CLOSE','Chiudi finestra');

/** classes/html/content.php */
DEFINE('_AUTHOR_BY', ' Inviato da');
DEFINE('_WRITTEN_BY', ' Scritto da');
DEFINE('_LAST_UPDATED', 'Ultimo aggiornamento');
DEFINE('_BACK','[Indietro]');
DEFINE('_LEGEND','Legenda');
DEFINE('_DATE','Data');
DEFINE('_ORDER_DROPDOWN','Ordina per');
DEFINE('_HEADER_TITLE','Titolo');
DEFINE('_HEADER_AUTHOR','Autore');
DEFINE('_HEADER_SUBMITTED','Inviato');
DEFINE('_HEADER_HITS','Visite');
DEFINE('_E_EDIT','Modifica');
DEFINE('_E_ADD','Aggiungi');
DEFINE('_E_WARNUSER','Per favore Annulla o Salva le modifiche correnti');
DEFINE('_E_WARNTITLE','Il contenuto deve avere un titolo');
DEFINE('_E_WARNTEXT','Il contenuto deve avere un testo introduttivo');
DEFINE('_E_WARNCAT','Per favore, seleziona una categoria');
DEFINE('_E_CONTENT','Contenuto');
DEFINE('_E_TITLE','Titolo:');
DEFINE('_E_CATEGORY','Categoria:');
DEFINE('_E_INTRO','Testo introduttivo:');
DEFINE('_E_MAIN','Testo esteso:');
DEFINE('_E_MOSIMAGE','INSERISCI {mosimage}');
DEFINE('_E_IMAGES','Immagini');
DEFINE('_E_GALLERY_IMAGES','Galleria immagini');
DEFINE('_E_CONTENT_IMAGES','Immagini del contenuto');
DEFINE('_E_EDIT_IMAGE','Modifica immagine');
DEFINE('_E_INSERT','Inserisci');
DEFINE('_E_UP','Su');
DEFINE('_E_DOWN','Gi&#249;');
DEFINE('_E_REMOVE','Elimina');
DEFINE('_E_SOURCE','Sorgente:');
DEFINE('_E_ALIGN','Allineamento:');
DEFINE('_E_ALT','Didascalia:');
DEFINE('_E_BORDER','Bordo:');
DEFINE('_E_CAPTION','Didascalia');
DEFINE('_E_APPLY','Applica');
DEFINE('_E_PUBLISHING','Pubblicazione');
DEFINE('_E_STATE','Stato:');
DEFINE('_E_AUTHOR_ALIAS','Autore:');
DEFINE('_E_ACCESS_LEVEL','Livello di accesso:');
DEFINE('_E_ORDERING','Ordinamento:');
DEFINE('_E_START_PUB','Inizio pubblicazione:');
DEFINE('_E_FINISH_PUB','Termine pubblicazione:');
DEFINE('_E_SHOW_FP','Mostra in Home Page:');
DEFINE('_E_HIDE_TITLE','Nascondere il titolo?:');
DEFINE('_E_METADATA','Metadata');
DEFINE('_E_M_DESC','Descrizione:');
DEFINE('_E_M_KEY','Parole chiave:');
DEFINE('_E_SUBJECT','Soggetto:');
DEFINE('_E_EXPIRES','Data di scadenza:');
DEFINE('_E_VERSION','Versione:');
DEFINE('_E_ABOUT','Crediti');
DEFINE('_E_CREATED','Creazione:');
DEFINE('_E_LAST_MOD','Ultima modifica:');
DEFINE('_E_HITS','Visite:');
DEFINE('_E_SAVE','Salva');
DEFINE('_E_CANCEL','Annulla');
DEFINE('_E_REGISTERED','Solo utenti registrati');
DEFINE('_E_ITEM_INFO','Informazioni');
DEFINE('_E_ITEM_SAVED','Salvato correttamente.');
DEFINE('_ITEM_PREVIOUS','&lt; Prec.');
DEFINE('_ITEM_NEXT','Pros. &gt;');


/** content.php */
DEFINE('_SECTION_ARCHIVE_EMPTY','Attualmente non esiste nessun archivio per questa Sezione, per favore torna in un altro momento');
DEFINE('_CATEGORY_ARCHIVE_EMPTY','Attualmente non esiste nessun archivio per questa Categoría, per favore torna in un altro momento');
DEFINE('_HEADER_SECTION_ARCHIVE','Archivio di Sezione');
DEFINE('_HEADER_CATEGORY_ARCHIVE','Archivio delle Categorie');
DEFINE('_ARCHIVE_SEARCH_FAILURE','Non ci sono archivi per %s %s');	// values are month then year
DEFINE('_ARCHIVE_SEARCH_SUCCESS','Ecco le entrate archiviate per %s %s');	// values are month then year
DEFINE('_FILTER','Filtro');
DEFINE('_ORDER_DROPDOWN_DA','Data asc');
DEFINE('_ORDER_DROPDOWN_DD','Data disc');
DEFINE('_ORDER_DROPDOWN_TA','Titolo asc');
DEFINE('_ORDER_DROPDOWN_TD','Titolo disc');
DEFINE('_ORDER_DROPDOWN_HA','N. visite asc');
DEFINE('_ORDER_DROPDOWN_HD','N. visite disc');
DEFINE('_ORDER_DROPDOWN_AUA','Autore asc');
DEFINE('_ORDER_DROPDOWN_AUD','Autore disc');
DEFINE('_ORDER_DROPDOWN_O','Ordinamento...');

/** poll.php */
DEFINE('_ALERT_ENABLED','I cookies devono essere abilitati!');
DEFINE('_ALREADY_VOTE','Spiacente, ma hai gi&#224; votato per questo sondaggio!');
DEFINE('_NO_SELECTION','Non hai effettuato alcuna selezione, riprova!');
DEFINE('_THANKS','Grazie per il tuo voto!');
DEFINE('_SELECT_POLL','Seleziona un sondaggio dalla lista');

/** classes/html/poll.php */
DEFINE('_JAN','Gennaio');
DEFINE('_FEB','Febbraio');
DEFINE('_MAR','Marzo');
DEFINE('_APR','Aprile');
DEFINE('_MAY','Maggio');
DEFINE('_JUN','Giugno');
DEFINE('_JUL','Luglio');
DEFINE('_AUG','Agosto');
DEFINE('_SEP','Settembre');
DEFINE('_OCT','Ottobre');
DEFINE('_NOV','Novembre');
DEFINE('_DEC','Dicembre');
DEFINE('_POLL_TITLE','Sondaggio - Risultati');
DEFINE('_SURVEY_TITLE','Titolo:');
DEFINE('_NUM_VOTERS','Numero di votanti:');
DEFINE('_FIRST_VOTE','Primo voto:');
DEFINE('_LAST_VOTE','Ultimo voto:');
DEFINE('_SEL_POLL','Seleziona sondaggio:');
DEFINE('_NO_RESULTS','Non ci sono risultati per il sondaggio.');

/** registration.php */
DEFINE('_ERROR_PASS','Spiacenti, nessun utente corrispondente trovato');
DEFINE('_NEWPASS_MSG','Account utente $checkusername associato a questo indirizzo e-mail.\n'
.'Un utente del sito $mosConfig_live_site ha richiesto un invio di una nuova password.\n\n'
.' Nuova Password: $newpass\n\nSe non ne hai fatto richiesta personalmente, non preoccuparti.'
.' Solo tu puoi leggere questo messaggio. Se si tratta di un errore puoi effettuare il Login con la tua'
.' nuova Password e modificarla a tuo piacimento.');
DEFINE('_NEWPASS_SUB','$_sitename :: Nuova password per - $checkusername');
DEFINE('_NEWPASS_SENT','Nuova Password utente creata ed inviata!');
DEFINE('_REGWARN_NAME','Inserisci il tuo nome');
DEFINE('_REGWARN_UNAME','Inserisci un Username');
DEFINE('_REGWARN_MAIL','Inserisci un indirizzo e-mail valido');
DEFINE('_REGWARN_PASS','Inserisci una Password valida. Senza spazi, con più di 6 caratteri e contenente caratteri 0-9,a-z,A-Z');
DEFINE('_REGWARN_VPASS1','Verifica Password.');
DEFINE('_REGWARN_VPASS2','Password e Verifica non corrispondono, per favore riprova.');
DEFINE('_REGWARN_INUSE','Questi username/password sono già in uso. Provane altri.');
DEFINE('_REGWARN_EMAIL_INUSE', 'Questa indirizzo e-mail esiste nel nostro database. Se hai dimenticato la password clicca su "Hai perso la tua password" e una nuova password ti sarà reinviata.');
DEFINE('_SEND_SUB','Dettagli Account per %s su %s');
DEFINE('_USEND_MSG_ACTIVATE', 'Salve %s,

Grazie per esserti registrato su %s. Abbiamo creato il tuo account ma deve essere attivato prima che tu possa utilizzarlo.
Per attivarlo clicca sul link seguente o fai un copia e incolla nel tuo browser:
%s

Dopo averlo attivato, potrai accedere alle aree riservate di %s usando le seguenti username e password:

Username - %s
Password - %s');
DEFINE('_USEND_MSG', "Salve %s,

Grazie per esserti registrato su %s.

Da adesso puoi loggarti su %s utilizzando username e  password con la quale ti sei registrato.");
DEFINE('_USEND_MSG_NOPASS','Salve $name,\n\nSei diventato un utente di $mosConfig_live_site.\n'
.'Ora puoi accedere a $_live_site utilizzando username e  password con le quali ti sei registrato.\n\n'
.'Per favore non rispondere a questo messaggio in quanto generato automaticamente solo a scopo informativo\n');
DEFINE('_ASEND_MSG','Salve %s,

Nuovo utente registrato su %s.
Questa e-mail contiene i suoi dati:

Name - %s
e-mail - %s
Username - %s

Per favore non rispondere a questo messaggio in quanto generato automaticamente solo a scopo informativo');
DEFINE('_REG_COMPLETE_NOPASS','<div class="componentheading">Registrazione Completata!</div><br />&nbsp;&nbsp;'
.'Ora puoi loggarti.<br />&nbsp;&nbsp;');
DEFINE('_REG_COMPLETE', '<div class="componentheading">Registrazione Completata!</div><br />Ora puoi loggarti.');
DEFINE('_REG_COMPLETE_ACTIVATE', '<div class="componentheading">Registrazione Completata!</div><br />Account creato ed il collegamento web di attivazione viene inviato al&#180;indirizzo email che hai indicato in fase di registrazione. Ricorda che per attivare il tuo account devi cliccare sul collegamento web di attivazione quando riceverai una email prima di effettuare il login.');
DEFINE('_REG_ACTIVATE_COMPLETE', '<div class="componentheading">Attivazione effettuata!</div><br />Accoun attivato correttamente. Da ora puoi loggarti con username e password che hai scelto durante la registrazione.');
DEFINE('_REG_ACTIVATE_NOT_FOUND', '<div class="componentheading">Link di attivazione non valido!</div><br />Non esiste alcun account in attesa di attivazione nel nostro database oppure questo account &#232; stato gi&#224; attivato.');

/** classes/html/registration.php */
DEFINE('_PROMPT_PASSWORD','Hai perso la Password?');
DEFINE('_NEW_PASS_DESC','Inserisci il tuo Username ed il tuo indirizzo e-mail, quindi premi il tasto Invia Password.<br />'
.'Riceverai al pi&#249; presto una nuova Password. Utilizza la nuova Password per accedere al sito.');
DEFINE('_PROMPT_UNAME','Username:');
DEFINE('_PROMPT_EMAIL','Indirizzo e-mail:');
DEFINE('_BUTTON_SEND_PASS','Invia Password');
DEFINE('_REGISTER_TITLE','Registrazione');
DEFINE('_REGISTER_NAME','Nome:');
DEFINE('_REGISTER_UNAME','Username:');
DEFINE('_REGISTER_EMAIL','Indirizzo e-mail:');
DEFINE('_REGISTER_PASS','Password:');
DEFINE('_REGISTER_VPASS','Verifica Password:');
DEFINE('_REGISTER_REQUIRED','I campi con il simbolo (*) sono obbligatori.');
DEFINE('_BUTTON_SEND_REG','Invia Registrazione');
DEFINE('_SENDING_PASSWORD','La tua Password sar&#224; inviata alla e-mail qui sopra fornita.<br/ >Una volta ricevuta la'
.' Password potrai effettuare il login e modificarla.');

/** classes/html/search.php */
DEFINE('_SEARCH_TITLE','Cerca');
DEFINE('_PROMPT_KEYWORD','Parola Chiave:');
DEFINE('_SEARCH_MATCHES','trovate %d corrispondenze');
DEFINE('_CONCLUSION','Trovati $totalRows risultati. Cerca <b>$searchword</b> con');
DEFINE('_NOKEYWORD','Nessun risultato trovato');
DEFINE('_IGNOREKEYWORD','Una o pi&#249; parole comuni verranno ignorate durante la ricerca');
DEFINE('_SEARCH_ANYWORDS','Alcune parole');
DEFINE('_SEARCH_ALLWORDS','Tutte le parole');
DEFINE('_SEARCH_PHRASE','Frase esatta');
DEFINE('_SEARCH_NEWEST','Prima i pi&#249; nuovi');
DEFINE('_SEARCH_OLDEST','Prima i pi&#249; vecchi');
DEFINE('_SEARCH_POPULAR','I pi&#249; popolari');
DEFINE('_SEARCH_ALPHABETICAL','Alfabeticamente');
DEFINE('_SEARCH_CATEGORY','Sezione/Categoria');
DEFINE('_SEARCH_MESSAGE','I termini di ricerca devono esere almeno di 3 caratteri fino ad un massimo di 20 caratteri');
DEFINE('_SEARCH_ARCHIVED','Archiviati');
DEFINE('_SEARCH_CATBLOG','Blog Categoria');
DEFINE('_SEARCH_CATLIST','Lista Categoria');
DEFINE('_SEARCH_NEWSFEEDS','Newsfeeds');
DEFINE('_SEARCH_SECLIST','Lista Sezione');
DEFINE('_SEARCH_SECBLOG','Blog Sezione');

/** templates/*.php */
DEFINE('_ISO','charset=iso-8859-1');
DEFINE('_DATE_FORMAT','l F d Y');  //Uses PHP's DATE Command Format - Depreciated
/**
* Modify this line to reflect how you want the date to appear in your site
*
*e.g. DEFINE("_DATE_FORMAT_LC","%A %d %B %Y %H:%M"); //Uses PHP's strftime Command Format
*/
DEFINE('_DATE_FORMAT_LC',"%A %d %B %Y"); //Uses PHP's strftime Command Format
DEFINE('_DATE_FORMAT_LC2',"%A %d %B %Y %H:%M");
DEFINE('_SEARCH_BOX','cerca nel sito...');
DEFINE('_NEWSFLASH_BOX','Notizie flash!');
DEFINE('_MAINMENU_BOX','Menu Principale');

/** classes/html/usermenu.php */
DEFINE('_UMENU_TITLE','Menu Utente');
DEFINE('_HI','Salve, ');

/** user.php */
DEFINE('_SAVE_ERR','Compilare tutti i campi.');
DEFINE('_THANK_SUB','Ti ringraziamo per la collaborazione. Il contributo prima di essere pubblicato sul sito deve essere approvato da un amministratore.');
DEFINE('_THANK_SUB_PUB','Ti ringraziamo per la segnalazione.');
DEFINE('_UP_SIZE','Non puoi caricare file di dimensioni maggiori di 15KB.');
DEFINE('_UP_EXISTS','Immagine $userfile_name esiste gi&#224; . Per favore rinomina il file e riprova.');
DEFINE('_UP_COPY_FAIL','Copia fallita');
DEFINE('_UP_TYPE_WARN','Puoi caricare solo immagini gif o jpg.');
DEFINE('_MAIL_SUB','Nuovo Inserimento');
DEFINE('_MAIL_MSG','Salve $adminName,\n\nNuovo contributo $type\n [ $title ]\n  inviato da:\n [ $author ]\n'
.' per il sito $mosConfig_live_site.\n'
.'Vai su $mosConfig_live_site/administrator/index.php per visionare e approvare questo $type.\n\n'
.'Per favore non rispondere a questo messaggio in quanto generato automaticamente solo a scopo informativo\n');
DEFINE('_PASS_VERR1','Per modificare la tua Password inseriscila nuovamente per Verifica.');
DEFINE('_PASS_VERR2','Per modificare la tua Password assicurati che Password e Verifica corrispondano.');
DEFINE('_UNAME_INUSE','Questo nome utente &#232; gi&#224; in uso.');
DEFINE('_UPDATE','Aggiorna');
DEFINE('_USER_DETAILS_SAVE','Nuova configurazione dettagli utente salvata.');
DEFINE('_USER_LOGIN','Acceso Utente');

/** components/com_user */
DEFINE('_EDIT_TITLE','Modifica i tuoi dettagli');
DEFINE('_YOUR_NAME','Il tuo nome:');
DEFINE('_EMAIL','e-mail:');
DEFINE('_UNAME','Nome utente:');
DEFINE('_PASS','Password:');
DEFINE('_VPASS','Verifica password:');
DEFINE('_SUBMIT_SUCCESS','Invio avvenuto!');
DEFINE('_SUBMIT_SUCCESS_DESC','Contributo inviato. Sar&#224; visionato prima della pubblicazione sul sito.');
DEFINE('_WELCOME','Benvenuto!');
DEFINE('_WELCOME_DESC','Benvenuto nella sezione utente del nostro sito');
DEFINE('_CONF_CHECKED_IN','Verifica tutti gli oggetti');
DEFINE('_CHECK_TABLE','Controllo tabella');
DEFINE('_CHECKED_IN','Controllato ');
DEFINE('_CHECKED_IN_ITEMS',' oggetti');
DEFINE('_PASS_MATCH','Password non valida');

/** components/com_banners */
DEFINE('_BNR_CLIENT_NAME','Devi selezionare un nome per il cliente.');
DEFINE('_BNR_CONTACT','Devi selezionare un contatto per il cliente.');
DEFINE('_BNR_VALID_EMAIL','Devi selezionare una mail valida per il cliente.');
DEFINE('_BNR_CLIENT','Devi selezionare un cliente');
DEFINE('_BNR_NAME','Devi selezionare un nome per il banner.');
DEFINE('_BNR_IMAGE','Devi selezionare una immagine per il banner.');
DEFINE('_BNR_URL','Devi selezionare un URL/codice personalizzato per il banner.');

/** components/com_login */
DEFINE('_ALREADY_LOGIN','Sei connesso!');
DEFINE('_LOGOUT','Clicca qui per sconnetterti');
DEFINE('_LOGIN_TEXT','Utilizza i campi login a password per entrare');
DEFINE('_LOGIN_SUCCESS','Sei correttamente entrato');
DEFINE('_LOGOUT_SUCCESS','Sei correttamente uscito');
DEFINE('_LOGIN_DESCRIPTION','Per accedere alle aree riservate di questo sito devi essere un utente registrato');
DEFINE('_LOGOUT_DESCRIPTION','Sei attualmente collegato ad un&acute;area riservata di questo sito');


/** components/com_weblinks */
DEFINE('_WEBLINKS_TITLE','Collegamento Web');
DEFINE('_WEBLINKS_DESC','Scegli un argomento tra quelli elencati qua sotto, quindi seleziona una URL da visitare.');
DEFINE('_HEADER_TITLE_WEBLINKS','Collegamenti Web');
DEFINE('_SECTION','Sezione:');
DEFINE('_SUBMIT_LINK','Invia un Web Link');
DEFINE('_URL','URL:');
DEFINE('_URL_DESC','Descrizione:');
DEFINE('_NAME','Nome:');
DEFINE('_WEBLINK_EXIST','Esite un weblink con questo nome nel nostro database, per favore riprova.');
DEFINE('_WEBLINK_TITLE','Il tuo Weblink deve avere un titolo.');

/** components/com_newfeeds */
DEFINE('_FEED_NAME','Nome Feed');
DEFINE('_FEED_ARTICLES','# Articoli');
DEFINE('_FEED_LINK','Feed Link');

/** whos_online.php */
DEFINE('_WE_HAVE', 'Abbiamo ');
DEFINE('_AND', ' e ');
DEFINE('_GUEST_COUNT','$guest_array visitatore');
DEFINE('_GUESTS_COUNT','$guest_array visitatori');
DEFINE('_MEMBER_COUNT','$user_array utente');
DEFINE('_MEMBERS_COUNT','$user_array utenti');
DEFINE('_ONLINE',' online');
DEFINE('_NONE','Nessun utente online');

/** modules/mod_stats.php */
DEFINE('_TIME_STAT','Ora');
DEFINE('_MEMBERS_STAT','Utenti');
DEFINE('_HITS_STAT','Visite');
DEFINE('_NEWS_STAT','Notizie');
DEFINE('_LINKS_STAT','Collegamenti web');
DEFINE('_VISITORS','Visitatori');

/** /adminstrator/components/com_menus/admin.menus.html.php */
DEFINE('_MAINMENU_HOME','* Il primo oggetto  pubblicato in questo menu [mainmenu] diventa di default la `Homepage` del sito *');
DEFINE('_MAINMENU_DEL','* Non Puoi `cancellare` questo menu in quanto richiesto dalle funzioni di JOOMLA *');
DEFINE('_MENU_GROUP','* Alcuni `Tipi Menu` possono apparire in pi&#249; gruppi *');


/** administrators/components/com_users */
DEFINE('_NEW_USER_MESSAGE_SUBJECT', 'Dettagli nuovo utente' );
DEFINE('_NEW_USER_MESSAGE', 'Salve %s,


tu sei stato aggiunto come utente di %s da un Amministratore.

Questa email contiene la tua username e password per accedere a %s:

Username - %s
Password - %s

Per favore non rispondere a questo messaggio in quanto generato automaticamente solo a scopo informativo.');

/** administrators/components/com_massmail */
DEFINE('_MASSMAIL_MESSAGE', "Questa mail giunge da '%s'

Messaggio:
" );


/** includes/pdf.php */
DEFINE('_PDF_GENERATED','Generata:');
DEFINE('_PDF_POWERED','Realizzata con Joomla!');
?>