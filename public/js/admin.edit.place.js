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
    $('#item-form').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: '/admin/logoupload/'
    });
/*
    // Load existing files:
    $('#item-form').addClass('fileupload-processing');
    $.ajax({
        disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
        maxFileSize: 5000000,
        acceptFileTypes: /(\.|\/)(jpe?g|png)$/i,
        url: $('#item-form').fileupload('option', 'url') + $("#item-id-input").val(),
        dataType: 'json',
        context: $('#item-form')[0]
    }).always(function() {
        $(this).removeClass('fileupload-processing');
    }).done(function(result) {
        $(this).fileupload('option', 'done')
                .call(this, $.Event('done'), {result: result});
    });

     *
     *
     *
     *
     *
     **/
    /*
        $(function(){
        $('#newThread').on('click', function(e){
            e.preventDefault(); // preventing default click action
            $.ajax({
                url: '/request.php',
                type: 'post',
                data: $('#replyForm').serialize(),
                success: function(){
                    // ajax callback
                }, error: function(){
                    alert('ajax failed');
                },
            })
        })
    })
    */
    
$(function(){
        $('.delete').on('click', function(e){
            e.preventDefault(); // preventing default click action
            //console.log($(e.currentTarget).attr());
            var action = $(e.currentTarget).attr('data-url');
            
            $.ajax({
                url: action,
                type: 'get',
                success: function(){
                    console.log('chyba ok');
                }, error: function(){
                    console.log('nope');
                },
            })            
            
            
        })
   });   
    
});