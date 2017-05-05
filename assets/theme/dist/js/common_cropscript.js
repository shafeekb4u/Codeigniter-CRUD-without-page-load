/**
 * HTML5 Image uploader with Jcrop
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright @ 2016
 * Author : Mohammed Shafeek.C.S
 * https://www.linkedin.com/in/web-developer-in-bangalore
 */

// convert bytes into friendly format
function bytesToSize(bytes) {
    var sizes = ['Bytes', 'KB', 'MB'];
    if (bytes == 0) return 'n/a';
    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
    return (bytes / Math.pow(1024, i)).toFixed(1) + ' ' + sizes[i];
};

// check for selected crop region
function checkForm(fieldno) {
    var inperror = 0;
    for (a=1; a<=fieldno; a++) {
      if(!parseInt($('#w'+a).val()))
      inperror++;    
    }    
    if (inperror == 0 && fieldno === parseInt(fieldno, 10) && fieldno != 0) return true;
    $('#errormsgcontent').html('Please select a crop region OR check all images exist there OR Send \'0\' input !');
    $('#errormsg').show();
    return false;
};

// update info by cropping (onChange and onSelect events handler)
function updateInfo(id,x,y,x2,y2,w,h) {
    $('#x1'+id).val(x);
    $('#y1'+id).val(y);
    $('#x2'+id).val(x2);
    $('#y2'+id).val(y2);
    $('#w'+id).val(w + 'px');
    $('#h'+id).val(h + 'px');
};

// clear info by cropping (onRelease event handler)
function clearInfo(id) {
    $('#w'+id).val('');
    $('#h'+id).val('');
};

// Create variables (in this scope) to hold the Jcrop API and image size
var jcrop_api, boundx, boundy;

function fileSelectHandler(img,width,height) {
    
    var cropwidth = parseInt(width, 10);
    var cropheight = parseInt(height, 10); 
    var preornot = ($('#defhiddenimg'+img).length > 0 ? "y" : "n");
    var defimg = preornot == "y" ? $('#defhiddenimg'+img).val() : null;
    if(defimg){
        var tmpImg = new Image();
        tmpImg.src = defimg;
        orgWidth = tmpImg.width;
        var cropw = "100%";        
        //var cropw = orgWidth+20;
    }

    var oFile = $('#image'+img)[0].files[0];
    $('.croparea'+img).css({'max-width':'100%'});   
    $('.cropimg'+img).html('<img id="preview'+img+'" class="img-responsive" />');
    
    var rFilter = /^(image\/jpeg|image\/png)$/i;
    if (! rFilter.test(oFile.type)) {
        $('#image'+img).val("");
        if(!defimg){
            $('.croparea'+img).hide();
        }
        else{
            $('.cropimg'+img).html('<img id="preview'+img+'" class="img-responsive" src="'+defimg+'" />');
            $('.croparea'+img).css({'max-width':cropw}); 
        }        
        $('#errormsgcontent').html('JPEG/PNG images are allowed!');
        $('#errormsg').show();
        return;
    }

    // check for file size
    if (oFile.size > 1000 * 1024) {
        $('#image'+img).val("");
        if(!defimg){
            $('.croparea'+img).hide();
        }
        else{
            $('.cropimg'+img).html('<img id="preview'+img+'" class="img-responsive" src="'+defimg+'" />');
            $('.croparea'+img).css({'max-width':cropw}); 
        } 
        $('#errormsgcontent').html('File size is greater than 1000KB!');
        $('#errormsg').show();
        return;
    }

    // check for width and height inputs
    if (!parseInt(width, 10) || cropwidth < 100 || !parseInt(height, 10) || cropheight < 100) {
        $('#image'+img).val("");
        if(!defimg){
            $('.croparea'+img).hide();
        }
        else{
            $('.cropimg'+img).html('<img id="preview'+img+'" class="img-responsive" src="'+defimg+'" />');
            $('.croparea'+img).css({'max-width':cropw}); 
        } 
        $('#errormsgcontent').html('crop area inputs should be valid and should be greater than 100!');
        $('#errormsg').show();
        return;
    }

    // preview element
    var oImage = document.getElementById('preview'+img);

    // prepare HTML5 FileReader
    var oReader = new FileReader();

        oReader.onload = function(e) {

        // e.target.result contains the DataURL which we can use as a source of the image
        oImage.src = e.target.result;
        oImage.onload = function () { // onload event handler
            
            $('.croparea'+img).hide();
            if (oImage.naturalWidth < cropwidth || oImage.naturalHeight < cropheight) 
            {   
                $('#image'+img).val("");                
                if(defimg){
                    $('.cropimg'+img).html('<img id="preview'+img+'" class="img-responsive" src="'+defimg+'" />');
                    $('.croparea'+img).css({'width':cropw});
                    $('.croparea'+img).show(); 
                } 
                $('#errormsgcontent').html('Width & Height should be greater than '+ cropwidth +','+ cropheight +' pixels respectively!');
                $('#errormsg').show();
                return;
            }

            // display area
            $('.croparea'+img).fadeIn(500);

            // display some basic image info
            var sResultFileSize = bytesToSize(oFile.size);
            //var imgpanwidth = $('#preview'+img).width()+20;            
            //$('.croparea'+img).css({'max-width':imgpanwidth});
            $('.croparea'+img).css({'max-width':'100%'});             

            // destroy Jcrop if it is existed
            /*if (typeof jcrop_api != 'undefined') {
                jcrop_api.destroy();
                jcrop_api = null;
            }*/

            jQuery.browser = {};
            (function () {
                jQuery.browser.msie = false;
                jQuery.browser.version = 0;
                if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
                    jQuery.browser.msie = true;
                    jQuery.browser.version = RegExp.$1;
                }
            })();

            var width1  = $('#preview'+img).prop('naturalWidth');
            var height1 = $('#preview'+img).prop('naturalHeight');
            // initialize Jcrop
            $('#preview'+img).Jcrop({
                setSelect: [ 0, 0, cropwidth, cropheight],
                allowResize : true,
                allowSelect : false,
                aspectRatio: 1.6666666666667,
                trueSize: [width1,height1],
                bgFade: true, // use fade effect
                bgOpacity: .3, // fade opacity
                onChange: function(e) {                    
                   updateInfo(img,e.x,e.y,e.x2,e.y2,e.w,e.h);
                },
                onSelect: function(e) {                    
                   updateInfo(img,e.x,e.y,e.x2,e.y2,e.w,e.h);
                },               
                onRelease: clearInfo(img)
            }, function(){
                // use the Jcrop API to get the real image size
                var bounds = this.getBounds();
                boundx = bounds[0];
                boundy = bounds[1];

                // Store the Jcrop API in the jcrop_api variable
                jcrop_api = this;
            });
        };
    };

    // read selected file as DataURL
    oReader.readAsDataURL(oFile);
}