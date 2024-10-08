<?php

declare(strict_types=1);

/**
 * PureOSC, Open Source E-Commerce Solutions
 * https://pureosc.com
 *
 * Copyright (c) 2024 PureOSC
 *
 * Released under the GNU General Public License
 *
 * This file is part of the PureOSC package
 *
 *  (c) 2024 Šimon Formánek <mail@simonformanek.cz>
 *
 * https://pureosc.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

\define('HEADING_TITLE', 'Categorías / Productos');
\define('HEADING_TITLE_SEARCH', 'Buscar:');
\define('HEADING_TITLE_GOTO', 'Ir a:');

\define('TABLE_HEADING_ID', 'ID');
\define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Categorías / Productos');
\define('TABLE_HEADING_ACTION', 'Acción');
\define('TABLE_HEADING_STATUS', 'Estado');

\define('TEXT_NEW_PRODUCT', 'Nuevo Producto en &quot;%s&quot;');
\define('TEXT_CATEGORIES', 'Categorías:');
\define('TEXT_SUBCATEGORIES', 'Subcategorías:');
\define('TEXT_PRODUCTS', 'Productos:');
\define('TEXT_PRODUCTS_PRICE_INFO', 'Precio:');
\define('TEXT_PRODUCTS_TAX_CLASS', 'Tipo de Impuesto:');
\define('TEXT_PRODUCTS_AVERAGE_RATING', 'Valoración Media:');
\define('TEXT_PRODUCTS_QUANTITY_INFO', 'Cantidad:');
\define('TEXT_DATE_ADDED', 'Añadido el:');
\define('TEXT_DATE_AVAILABLE', 'Fecha de Disponibilidad:');
\define('TEXT_LAST_MODIFIED', 'Modificado el:');
\define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Inserte una nueva categoría o producto en este nivel');
\define('TEXT_PRODUCT_MORE_INFORMATION', 'Si quiere más información, visite la <a href="http://%s" target="blank"><u>página</u></a> de este producto.');
\define('TEXT_PRODUCT_DATE_ADDED', 'Este producto se añadió a nuestro catálogo el %s.');
\define('TEXT_PRODUCT_DATE_AVAILABLE', 'Este producto estará disponible el %s.');

\define('TEXT_EDIT_INTRO', 'Por favor realice los cambios necesarios');
\define('TEXT_EDIT_CATEGORIES_ID', 'ID Categoría:');
\define('TEXT_EDIT_CATEGORIES_NAME', 'Nombre Categoría:');
\define('TEXT_EDIT_CATEGORIES_IMAGE', 'Imagen Categoría:');
\define('TEXT_EDIT_SORT_ORDER', 'Orden:');

\define('TEXT_INFO_COPY_TO_INTRO', 'Elija la categoría hacia donde quiera copiar este producto');
\define('TEXT_INFO_CURRENT_CATEGORIES', 'Categorías:');

\define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Nueva Categoría');
\define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Editar Categoría');
\define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Eliminar Categoría');
\define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Mover Categoría');
\define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Eliminar Producto');
\define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Mover Producto');
\define('TEXT_INFO_HEADING_COPY_TO', 'Copiar a');

\define('TEXT_DELETE_CATEGORY_INTRO', '¿Seguro que desea eliminar esta categoría?');
\define('TEXT_DELETE_PRODUCT_INTRO', '¿Está usted seguro que desea suprimir permanentemente este producto?');

\define('TEXT_DELETE_WARNING_CHILDS', '<strong>ADVERTENCIA:</strong> Hay %s categorías que pertenecen a esta categoría!');
\define('TEXT_DELETE_WARNING_PRODUCTS', '<strong>ADVERTENCIA:</strong> Hay %s productos en esta categoría!');

\define('TEXT_MOVE_PRODUCTS_INTRO', 'Elija la categoría hacia donde quiera mover <strong>%s</strong>');
\define('TEXT_MOVE_CATEGORIES_INTRO', 'Elija la categoría hacia donde quiera mover <strong>%s</strong>');
\define('TEXT_MOVE', 'Mover <strong>%s</strong> a:');

\define('TEXT_NEW_CATEGORY_INTRO', 'Rellene la siguiente información para la nueva categoría');
\define('TEXT_CATEGORIES_NAME', 'Nombre categoría:');
\define('TEXT_CATEGORIES_IMAGE', 'Imagen categoría:');
\define('TEXT_SORT_ORDER', 'Orden:');

\define('SECTION_HEADING_GENERAL', 'General');
\define('SECTION_HEADING_DATA', 'Data');
\define('SECTION_HEADING_IMAGES', 'Images');

\define('TEXT_PRODUCTS_STATUS', 'Estado de los Productos:');
\define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Fecha de Disponibilidad:');
\define('TEXT_PRODUCT_AVAILABLE', 'Disponible');
\define('TEXT_PRODUCT_NOT_AVAILABLE', 'Agotado');
\define('TEXT_PRODUCTS_MANUFACTURER', 'Fabricante del producto:');
\define('TEXT_PRODUCTS_NAME', 'Nombre del Producto:');
\define('TEXT_PRODUCTS_DESCRIPTION', 'Descripción del producto:');
\define('TEXT_PRODUCTS_QUANTITY', 'Cantidad:');
\define('TEXT_PRODUCTS_MODEL', 'Modelo:');
\define('TEXT_PRODUCTS_IMAGE', 'Imagen:');
\define('TEXT_PRODUCTS_MAIN_IMAGE', 'Imagen Principal');
\define('TEXT_PRODUCTS_LARGE_IMAGE', 'Imagen Grande');
\define('TEXT_PRODUCTS_LARGE_IMAGE_HTML_CONTENT', 'Contenido HTML (para la ventana popup)');
\define('TEXT_PRODUCTS_ADD_LARGE_IMAGE', 'Añadir Imagen Grande');
\define('TEXT_PRODUCTS_LARGE_IMAGE_DELETE_TITLE', '¿Eliminar Imagen Grande?');
\define('TEXT_PRODUCTS_LARGE_IMAGE_CONFIRM_DELETE', 'Por favor confirme la eliminación de la Imagen Grande.');
\define('TEXT_PRODUCTS_URL', 'URL de los Productos:');
\define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(sin http://)</small>');
\define('TEXT_PRODUCTS_PRICE_NET', 'Precio del Producto (Neto):');
\define('TEXT_PRODUCTS_PRICE_GROSS', 'Precio del Producto (Bruto):');
\define('TEXT_PRODUCTS_WEIGHT', 'Peso:');

\define('EMPTY_CATEGORY', 'Categoría vacía');

\define('TEXT_HOW_TO_COPY', 'Método de copia:');
\define('TEXT_COPY_AS_LINK', 'Enlazar producto');
\define('TEXT_COPY_AS_DUPLICATE', 'Duplicar producto');

\define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Error: No se pueden enlazar productos en la misma categoría.');
\define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Error: No se puede escribir en el directorio de imágenes del catálogo: '.DIR_FS_CATALOG_IMAGES);
\define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Error: El directorio de imágenes del catálogo: '.DIR_FS_CATALOG_IMAGES.'no existe');
\define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'Error: La categoría NO puede ser movida a la categoría hijo.');

\define('TEXT_CATEGORIES_DESCRIPTION', 'Descripción de la categoría:<br><small>se muestra en la página de la categoría</small>');
\define('TEXT_EDIT_CATEGORIES_DESCRIPTION', 'Editar la Descripción de la Categoría:');
