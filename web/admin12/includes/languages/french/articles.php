<?php
/*
  $Id: articles.php, v1.0 2003/12/04 12:00:00 ra Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Rubriques / Articles');
define('HEADING_TITLE_SEARCH', 'Recherche:');
define('HEADING_TITLE_GOTO', 'Aller &agrave;:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_TOPICS_ARTICLES', 'Rubriques/Articles');
define('TABLE_HEADING_ACTION', 'Action');
define('TABLE_HEADING_STATUS', 'Etat');

define('TEXT_ARTICLES_CURRENT', 'Actuel:');

define('TEXT_NEW_ARTICLE', 'Nouvel Article dans &quot;%s&quot;');
define('TEXT_TOPICS', 'Rubriques:');
define('TEXT_SUBTOPICS', 'Sous-Rubrique:');
define('TEXT_ARTICLES', 'Articles:');
define('TEXT_ARTICLES_AVERAGE_RATING', 'Note moyenne:');
define('TEXT_ARTICLES_HEAD_TITLE_TAG', 'Titre de la page HTML:');
define('TEXT_ARTICLES_HEAD_DESC_TAG', 'Meta Description:<br><small>(R&eacute;sum&eacute; de l\'article =<br>%s premiers caract&egrave;res)</small>');
define('TEXT_ARTICLES_HEAD_KEYWORDS_TAG', 'Meta Mots-Clés:');
define('TEXT_DATE_ADDED', 'Date d\'ajout:');
define('TEXT_DATE_AVAILABLE', 'Date pr&eacute;vue:');
define('TEXT_LAST_MODIFIED', 'Dernière modification:');
define('TEXT_NO_CHILD_TOPICS_OR_ARTICLES', 'Veuillez ins&eacute;rer une nouvelle rubrique ou nouvel article dans ce niveau.');
define('TEXT_ARTICLE_MORE_INFORMATION', 'Pour plus d\'information, consultez cet article dans cette <a href="http://%s" ><u>page</u></a>.');
define('TEXT_ARTICLE_DATE_ADDED', 'Cet article a &eacute;t&eacute; ajout&eacute; le %s.');
define('TEXT_ARTICLE_DATE_AVAILABLE', 'Cet article sera publi&eacute; le %s.');

define('TEXT_EDIT_INTRO', 'Veuillez faire les changements n&eacute;cessaires');
define('TEXT_EDIT_TOPICS_ID', 'Rubrique ID:');
define('TEXT_EDIT_TOPICS_NAME', 'Nom de la rubrique:');
define('TEXT_EDIT_SORT_ORDER', 'Ordre de tri:');

define('TEXT_INFO_COPY_TO_INTRO', 'Sélectionnez une nouvelle rubrique o&ugrave; vous d&eacute;sirez plublier cet article');
define('TEXT_INFO_CURRENT_TOPICS', 'Rubrique courante:');

define('TEXT_INFO_HEADING_NEW_TOPIC', 'Nouvelle Rubrique');
define('TEXT_INFO_HEADING_EDIT_TOPIC', 'Modifier Rubrique');
define('TEXT_INFO_HEADING_DELETE_TOPIC', 'Supprimer Rubrique');
define('TEXT_INFO_HEADING_MOVE_TOPIC', 'D&eacute;placer Rubrique');
define('TEXT_INFO_HEADING_DELETE_ARTICLE', 'Supprimer Article');
define('TEXT_INFO_HEADING_MOVE_ARTICLE', 'D&eacute;placer Article');
define('TEXT_INFO_HEADING_COPY_TO', 'Copier vers');

define('TEXT_DELETE_TOPIC_INTRO', 'Confirmez la suppression de cette rubrique');
define('TEXT_DELETE_ARTICLE_INTRO', 'Confirmez la suppression d&eacute;finitive de cet article');

define('TEXT_DELETE_WARNING_CHILDS', '<b>ATTENTION:</b> Il y a %s sous-rubriques li&eacute;es &agrave; cette rubrique!');
define('TEXT_DELETE_WARNING_ARTICLES', '<b>ATTENTION:</b> Il y a %s articles li&eacute;s à cette rubrique!');

define('TEXT_MOVE_ARTICLES_INTRO', 'Veuillez d&eacute;signer la rubrique de destination de <b>%s</b> ');
define('TEXT_MOVE_TOPICS_INTRO', 'Veuillez d&eacute;signer la rubrique de destination de<b>%s</b>');
define('TEXT_MOVE', 'Déplacer <b>%s</b> vers:');

define('TEXT_NEW_TOPIC_INTRO', 'Veuillez remplir les informations suivantes pour cette rubrique');
define('TEXT_TOPICS_NAME', 'Nom de la Rubrique:');
define('TEXT_SORT_ORDER', 'Ordre de tri:');

define('TEXT_EDIT_TOPICS_HEADING_TITLE', 'Titre de la Rubrique:');
define('TEXT_EDIT_TOPICS_DESCRIPTION', 'Description de la Rubrique:');

define('TEXT_ARTICLES_STATUS', 'Etat de l\'Article:');
define('TEXT_ARTICLES_DATE_AVAILABLE', 'Date Pr&eacute;vue:');
define('TEXT_ARTICLE_AVAILABLE', 'Publi&eacute;');
define('TEXT_ARTICLE_NOT_AVAILABLE', 'Brouillon');
define('TEXT_ARTICLES_AUTHOR', 'Auteur:');
define('TEXT_ARTICLES_NAME', 'Nom de l\'Article:');
define('TEXT_ARTICLES_DESCRIPTION', 'Contenu de l\'Article:');
define('TEXT_ARTICLES_URL', 'URL de l\'Article:');
define('TEXT_ARTICLES_URL_WITHOUT_HTTP', '<small>(sans http://)</small>');

define('EMPTY_TOPIC', 'Rubrique vide');

define('TEXT_HOW_TO_COPY', 'Mode de copie:');
define('TEXT_COPY_AS_LINK', 'Alias article');
define('TEXT_COPY_AS_DUPLICATE', 'Duplication article');

define('ERROR_CANNOT_LINK_TO_SAME_TOPIC', 'Erreur: impossible de cr&eacute;er un Alias d\'article dans la même rubrique.');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Erreur: le r&eacute;pertoire image de la boutique est verrouill&eacute; en &eacute;criture: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Erreur: le r&eacute;pertoire image de la boutique est inexistant: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CANNOT_MOVE_TOPIC_TO_PARENT', 'Erreur: Une rubrique ne peut &ecirc;tre d&eacute;plac&eacute; dans une sous-rubrique.');

?>