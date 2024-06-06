<?php
/*
  SEO_Assistant for OSC 2.2 MS2 v2.0  08.03.2004
  Originally Created by: Jack York
  Released under the GNU General Public License
  osCommerce, Open Source E-Commerce Solutions
  Copyright (c) 2008 osCommerce
  
*/ 
 
  define('NAVBAR_TITLE', 'SEO Assistant');
  define('HEADING_TITLE', '<a name="top" class="seoHead">SEO Assistant</a>');
  define('HEADING_TITLE_SUB', '<p>SEO (search engine optimization) is one the most important
  things a shop owner can do to improve his or her shop. This page contains a number of tools that
  help with that optimization process.<br />
  </p>
  ');
  
  define('HEADING_TITLE', 'Ranking Motori di ricerca');
  define('HEADING_TITLE_INDEX', '<a name="index"></a>Posizionamento Indice');
  define('HEADING_TITLE_YAHOO', 'Posizionamento su Yahoo');
  define('HEADING_TITLE_MSN', 'Posizionamento su MSN');  
  define('HEADING_TITLE_RANK', '<a name="pagerank"></a>Page Rank');
  define('HEADING_TITLE_LINKPOP', '<a name="linkpop"></a>Link Popolarit&agrave;');
  define('HEADING_TITLE_DENSITY', '<a name="density"></a>Keyword Densit&agrave;');
  define('HEADING_TITLE_CHECK_LINKS', '<a name="checklinks"></a>Controlla Links');
  define('HEADING_TITLE_CHECK_SIDS', '<a name="checksids"></a>Controlla SID');
  define('HEADING_TITLE_HEADER_STATUS', '<a name="headerstatus"></a>Header Status');
  define('HEADING_TITLE_HEADER_CODE_EXPLAIN', 'Explain Code');  
  define('HEADING_TITLE_SUPPLEMENTAL', '<a name="supplemental"></a>Supplemental Listings');
  define('TEXT_ALEXA_TRAFFIC_RANKING', 'Alexa Traffic Ranking');
  define('TEXT_ALLTHEWEB', 'Tutto il Web');
  define('TEXT_ALTAVISTA', 'AltaVista');
  define('TEXT_BROKEN_LINK', 'Link Interrotti:');
  define('TEXT_COMPARE', 'Compara: ');
  define('TEXT_COUNT', 'Conta');
  define('TEXT_DENSITY_TABLE', 'Densit&agrave;');
  define('TEXT_DOMAIN', 'DOMINIO');
  define('TEXT_DOUBLE_WORD', 'Parole doppie');
  define('TEXT_ENTER_URL', 'Inserisci URL: ');
  define('TEXT_FOUND', 'Trova ');
  define('TEXT_GOOGLE', 'Google');
  define('TEXT_HOTBOT', 'HotBot');
  define('TEXT_INCLUDE_META_TAGS', 'Includi Meta Tags: ');
  define('TEXT_MSN', 'MSN');
  define('TEXT_PAGE_RANK', 'Page Rank: ');
  define('TEXT_CHECKSUM','CheckSum: ');
  define('TEXT_PRESENT_IN_DMOZ', 'Presente in DMOZ');
  define('TEXT_PRESENT_IN_ZEAL', 'Presente in Zeal');
  define('TEXT_SEARCH', 'Cerca: ');
  define('TEXT_SEARCH_TERM', 'Inserisci i termini della ricerca: '); 
  define('TEXT_SEARCH_URL', 'Inserisci URL to search for: ');
  define('TEXT_SHOW_HISTORY', 'Vedi History: ');
  define('TEXT_SHOW_LINKS', 'Vedi Links: ');
  define('TEXT_SHOW_RESULTS', 'Vedi risultati: ');
  define('TEXT_SINGLE_WORD', 'Singola Parola');
  define('TEXT_SPIDER_WARNING', 'Attenzione! The Prevent Spiders Sessions &egrave; impostata su False nel tuo database.
    Questa opzione deve essere impostata su True nela maggior parte dei casi. Serve ad evitare sessioni ID&#39;s from 
    being added to links in the search engine listings.');
  define('TEXT_TOTAL', 'Totale');
  define('TEXT_TOTAL_LINKS_LISTED', 'Elenco totale dei Links');
  define('TEXT_TOTAL_SEARCHES', 'Enter total searches: ');
  define('TEXT_TOTAL_SIDS_FOUND', 'Totale SID trovati');
  define('TEXT_TOTAL_SUPPLEMENTAL_FOUND', 'Links Supplementari trovati');
  define('TEXT_TOTAL_WORDS', 'Parole Totali: ');
  define('TEXT_TRIPLE_WORD', 'Triple parole');
  define('TEXT_USE_PARTIAL_TOTAL', 'Usa Parziale Totale: ');
  define('TEXT_YAHOO', 'Yahoo');
  
  
  define('TEXT_POSITION', 'I motori di ricerca visualizzano i siti nelle loro pagine usando ci&ograve; che&ograve; chiamato
  "Index," (Come l&#39;indice di un libro). Pi&ugrave; alta &egrave; la tua posizione in questo Indice, maggior traffico il tuo
  sito ricever&agrave;. Questa sezione ti permette di controllare la tua posizione negli Indici di Google, Msn e Yahoo.
  Molte persone hanno i loro browsers settati per la visualizzazione dei primi 10 risultati di un ricerca, quindi,
  capitando al 20° o al 30° posto, probabilmente il tuo sito non sarebbe visitato. Il codice in questa sezione controlla
  i siti con o senza www. Di modo che se un dominio &egrave; registrato senza www, ed uno con www, sar&agrave;� trovato comunque.');

  define('TEXT_RANK', 'Il Page Rank (PR) &egrave; la misura di quanti links ci sono nel tuo sito. Ogni pagina ha il suo PR.
  Il PR &egrave; interamente determinato dal numero di links nella tua pagina e la rilevanza di questi nel tuo sito, nient&#39;altro.
  Pi&ugrave; links puoi creare (con lo scambio link, invio del tuo url in forum ed ogni altro link al di fuori del tuo sito)
  fara\' aumentare il tuo PR.');

  define('TEXT_LINKPOP', 'Il Link Popularity (LP) &egrave; molto simile al Page Rank except 
  it goes a little further. Actually, Page Rank is a subset of Link Popularity. 
  Mentre il PR &egrave; principalmentedeterminato dal numero di link in una pagina, il LP
  indica la popolarit&agrave; di questi links.  Per esempio, se tu vendi PDA e tutti gli altri 
  siti di PDA sono collegati a te, allora i motori di ricerca assegneranno maggior punti al tuo sito.');

  define('TEXT_DENSITY', 'La Keyword Density (KD) &egrave; un rapporto tra le keyword(s) scelte ed
  il totale delle parole nella pagina.  Una KD tra il 4% - 6% &egrave; considerata un buon indice. 
  Se &egrave; troppo bassa , i motori di ricerca non ti posizioneranno in alto.
  Ma se &egrave; molto alta, i motori potranno pensare che li stai ingannando, e puniranno il tuo scopo 
  bannando il tuo sito.');

  define('TEXT_CHECK_LINKS', 'Avere un codice corretto &egrave; importante per il SEO.
  If a search engine search bot cannot follow a link, it is unlikely that it will list
  it.  Having working links is also important to your visitors. If they can&#39;t
  find their way around your site, they, like the search engine bots, will 
  usually just go away.');

  define('TEXT_HEADER_STATUS', 'It is very important that your site returns the 
  proper status code to the search engines. This is what they use to determine
  if a site is being redirected and how, in part, if it contains duplicate content 
  (which can get it banned).');
  
  define('TEXT_CHECK_SIDS', 'Il Session ID&#39;s, (SID&#39;s), &grave; usato in oscommerce per tracciare 
  i movimenti di un cliente all&#39;interno del negozio. Un motore di ricerca non assegna il SID. 
  Ma pu&ograve; accadere se il settaggio del tuo negozio non sia corretto.
  Una volta che il motore di ricerca ottiene una lista dei SID, dovrai effettuare ulteriori 
  passaggi per la rimozione. Questa opzione ti permette di controllare se ci sono alcuni motori
  con i tuoi SID.');
  
  define('TEXT_SUPPLEMENTAL', 'Google ora utilizza un "Supplemental Index". Google is not forthcoming
  as to the reasons for pages being listed as supplemental. It could indicate a minor
  problem like google could not find enough information about the page, or, it could indicate
  a major problem like it is being seen as duplicate content, or, it could be something else. 
  If you have pages listed as supplemental, then you should look closer at them to try to isolate
  the cause.');
  
  define('IMAGE_GET_PAGE_RANK', 'Ottieni Page Rank');
  define('IMAGE_CHECK_DENSITY', 'Controlla Densit&agrave;');
  define('IMAGE_CHECK_LINKS', 'Controlla Links');
  define('IMAGE_CHECK_SIDS', 'Controlla SID');
  define('IMAGE_CHECK_SUPPLEMENTAL', 'Get Supplemental');
  define('IMAGE_LINK_POPULARITY', 'Link Popularity');
  define('IMAGE_GET_HEADER', 'Get Header');
  define('IMAGE_SEARCH', 'Cerca');  
?>