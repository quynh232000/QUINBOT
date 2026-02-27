/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
  
	// Cấu hình thanh công cụ Basic
	config.toolbar_Basic = [
        { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike'] },
        { name: 'paragraph', items: ['NumberedList', 'BulletedList', 'Blockquote'] },
        { name: 'links', items: ['Link', 'Unlink'] },
        { name: 'insert', items: ['Image','ImageCaption', 'Table', 'HorizontalRule', 'SpecialChar'] },
        { name: 'styles', items: ['Format'] },
        { name: 'about', items: ['About'] }
        
    ];
    //  removePlugins: 'font,fontsize'
 
};
