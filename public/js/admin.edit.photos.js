/*
 * jQuery File Upload Plugin JS Example 8.9.1
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/* global $, window */

$(function() {
    'use strict';

    // Initialize the jQuery File Upload widget:
    $('#fileupload-galery').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: '/admin/galeryupload/'
    });

    // Load existing files:
    $('#fileupload-galery').addClass('fileupload-processing');
    $.ajax({
        disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
        maxFileSize: 5000000,
        acceptFileTypes: /(\.|\/)(jpe?g|png)$/i,
        url: $('#fileupload-galery').fileupload('option', 'url') + $("#item-id-input").val(),
        dataType: 'json',
        context: $('#fileupload-galery')[0]
    }).always(function() {
        $(this).removeClass('fileupload-processing');
    }).done(function(result) {
        $(this).fileupload('option', 'done')
                .call(this, $.Event('done'), {result: result});
    });

});