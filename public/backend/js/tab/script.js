var selector_lang,selector_ctxt,selector_lang_button,mediaTab;

function init_ckeditor(id_element,config) {
    if (typeof id_element == 'undefined') { return false; }
    var editor = $('.'+id_element+'-editor');
    
    if (typeof config == 'undefined') {
        config = {
            'toolbar' : id_element,
            'width'   : 800,
            'height'  : id_element == 'intro' ? 120 : 300,
            'directory' : 'bobo'
        }
    }   
    editor.each(function(){
        $(this).ckeditor(function(){},config);
    }); 
}

function entityToText(specialText) {
	var d = document.createElement("div");
	d.innerHTML = specialText;   
	return d.firstChild == null ? '' : d.firstChild.nodeValue;
}

function textToEntity(specialText) {
	var d = document.createElement("div");
	d.appendChild(document.createTextNode(specialText));
	return d.innerHTML;
}

function main_form_validate(id) {
    $("form").each(function () {
        
        var crFrmId = this.id;  //Get current form ID
        
        var crFrmSt = {
            // Multilang check error element
            invalidHandler : function(form, validator) {                
                if (selector_lang.length > 0) {
                    var self_validate_errors = validator.numberOfInvalids();                
                    if (self_validate_errors) {
                        // Get active lang
                        var activeLang = selector_lang.children('ul').children('li.active').attr('id');
                        
                        // Get error field in active lang
                        var goToFirst = true;
                        for (var i=0;i<validator.errorList.length;i++){
                            var myBad = $(validator.errorList[i].element).parent('div');
                            
                            if (myBad.hasClass('lang-'+activeLang) === true) {
                                goToFirst = false; break;    
                            }
                        }
                        
                        if (goToFirst === true && $(validator.errorList[0].element).parent('div').attr('id') !== undefined) {
                            myBad = $(validator.errorList[0].element).parent('div').attr('id').split('-')[1];
                            selector_lang_button.removeClass('active');
                            selector_lang.children('ul').children('li#'+myBad).addClass('active').trigger('click'); //Better to trigger event click, to avoid manual showing content (see next 2 commented out line code)
                             
                            //$('.tab-content.lang.active').removeClass('active').addClass('hide');
                            //$('.tab-content.lang.hide.lang-'+myBad).removeClass('hide').addClass('active');
                        }
                    }
                }
            },     
            errorPlacement : function(error, element) {
                //$(element).parent('div').siblings('.error_information')
                $(element).parent('div').siblings('.error_information')
                          .html(error); 
            },
            submitHandler : function(frm){
                //Disable submit
                if ($('.currency').length > 0)
                {
                    $('.currency').each(function(i){
                        /** _pfP[i] : Prefix, _pfT[i] : Thousand Separator, _pfD[i] : Decimal Separator, _pfL[i] = Decimal Length **/
                        var _pfO = $(this);
                        
                        var _pfField  = _pfO.val();
                		var _pfResult = "";
                        var _pfD      = typeof _pfO.attr('data-decimal') === 'undefined' ? '.' : _pfO.attr('data-decimal'); 
                        
                        for(var f in _pfField)
                        {
                            if(!isNaN(_pfField[f]) || _pfField[f] == "-" || (typeof _pfD !== 'undefined' && _pfField[f] == _pfD && _pfResult != "")) _pfResult += _pfField[f];
                        }
                        
                        _pfO.val(_pfResult.replace(_pfD,'.')); //Update value price to numeric type, and make sure decimal separate by comma         
                    });
                }
                
                //console.log($('.frm').find(':input.error').length);
                var isVld2Sbmt = true;
                //Flying CkEditor Validation
                if($('.as-ckeditor').length > 0)
                {
                  $('.as-ckeditor').each(function(){
                      var $this = $(this);
                      var thisRules = { };
                      var thisName  = $this.attr('name');
                      $this.minlength = parseInt($this.attr('ckminlength'));
                      $this.maxlength = parseInt($this.attr('ckmaxlength'));
                      editorcontent = $this.val().replace(/<[^>]*>/gi, '');    // strip tags
                      editorcontent = entityToText(editorcontent);             // remove special characters
                      
                      if ($this.hasClass('required')) {                        
                        if(editorcontent.length === 0) 
                        {
                          $this.parent('div').append('<div class="error_information"><label for="'+$this.attr('name')+'" generated="true" class="error">This field is required.</label></div>');
                          isVld2Sbmt = false;
                          //Find parent media
                          parentMedia = $this.parents('.media-container').attr('id');
                          mediaTab.children('li#'+parentMedia.replace('-container','')).trigger('click');
                          return;
                        }
                      }
                      
                      if (typeof $this.minlength !== 'undefined') { 
                        if(editorcontent.length < $this.minlength) 
                        {
                          $this.parent('div').append('<div class="error_information"><label for="'+$this.attr('name')+'" generated="true" class="error">Please enter at least ' + $this.minlength + ' characters</label></div>');
                          isVld2Sbmt = false;
                          //Find parent media
                          parentMedia = $this.parents('.media-container').attr('id');
                          mediaTab.children('li#'+parentMedia.replace('-container','')).trigger('click');
                          return;
                        }
                      } 
                      
                      if (typeof $this.maxlength !== 'undefined') { 
                        if(editorcontent.length > $this.maxlength) 
                        {
                          $this.parent('div').append('<div class="error_information"><label for="'+$this.attr('name')+'" generated="true" class="error">Please enter no more no more than ' + $this.maxlength + ' characters</label></div>');
                          isVld2Sbmt = false;
                          $this.addClass('error');
                          //Find parent media
                          parentMedia = $this.parents('.media-container').attr('id');
                          mediaTab.children('li#'+parentMedia.replace('-container','')).trigger('click');
                          return;
                        }
                      }
                  });
                }
                if($('.dynamicEditorLength').length > 0)
                {
                  $('.dynamicEditorLength').each(function(){
                      var $this = $(this);
                      var thisRules = { };
                      var thisName  = $this.attr('name');
                      $this.minlength = parseInt($this.attr('ckminlength'));
                      $this.maxlength = parseInt($this.attr('ckmaxlength'));
                      editorcontent = $this.val().replace(/<[^>]*>/gi, '');    // strip tags
                      editorcontent = entityToText(editorcontent);             // remove special characters
                      
                      if ($this.hasClass('required')) {
                        if(editorcontent.length === 0) 
                        {
                          $this.parent('div').append('<div class="error_information"><label for="'+$this.attr('name')+'" generated="true" class="error">This field is required.</label></div>');
                          isVld2Sbmt = false;
                          //Find parent media
                          parentMedia = $this.parents('.media-container').attr('id');
                          mediaTab.children('li#'+parentMedia.replace('-container','')).trigger('click');
                          return;
                        }
                      }
                      
                      if (typeof $this.minlength !== 'undefined') { 
                        if(editorcontent.length < $this.minlength) 
                        {
                          $this.parent('div').append('<div class="error_information"><label for="'+$this.attr('name')+'" generated="true" class="error">Please enter at least ' + $this.minlength + ' characters</label></div>');
                          isVld2Sbmt = false;
                          //Find parent media
                          parentMedia = $this.parents('.media-container').attr('id');
                          mediaTab.children('li#'+parentMedia.replace('-container','')).trigger('click');
                          return;
                        }
                      } 
                      
                      if (typeof $this.maxlength !== 'undefined') { 
                        if(editorcontent.length > $this.maxlength) 
                        {
                          $this.parent('div').append('<div class="error_information"><label for="'+$this.attr('name')+'" generated="true" class="error">Please enter no more no more than ' + $this.maxlength + ' characters</label></div>');
                          isVld2Sbmt = false;
                          $this.addClass('error');
                          //Find parent media
                          parentMedia = $this.parents('.media-container').attr('id');
                          mediaTab.children('li#'+parentMedia.replace('-container','')).trigger('click');
                          return;
                        }
                      }
                  });
                } 
                //End Flying Validation  
                
                if(isVld2Sbmt === true)
                {
                  $(frm).children('#submit_wrapper').addClass('success').hide();
                  $(frm).children('#cancel_wrapper').hide();
                  frm.submit();
                }
            } 
        };
        
        $("#" + crFrmId).find('#submit_wrapper').hover(function(){
            if (typeof(CKEDITOR) !== "undefined")
            {
                for( instanceName in CKEDITOR.instances ) {
                    CKEDITOR.instances[ instanceName ].updateElement() ;
                }   
            }
        });
        
        var validatorForm = $("#" + crFrmId).validate(crFrmSt);
        
        //Ck Editor Length        
        $.validator.addMethod("ckEditorMinLength",function(value,element,param) {
            CKEDITOR.instances[element.id].updateElement();     // update textarea
            
            value = $.trim(value);            
            editorcontent = value.replace(/<[^>]*>/gi, '');     // strip tags
            editorcontent = entityToText(editorcontent);        // remove special characters
            return editorcontent.length >= param;
            
        },$.validator.format("Please enter at least {0} characters."));
        
        $.validator.addMethod("ckEditorMaxLength",function(value,element,param) {
            CKEDITOR.instances[element.id].updateElement();     // update textarea
            
            value = $.trim(value);            
            editorcontent = value.replace(/<[^>]*>/gi, '');     // strip tags
            editorcontent = entityToText(editorcontent);        // remove special characters
            return editorcontent.length <= param;
                        
        },$.validator.format("Please enter no more than {0} characters."));
                        
        var ck_intro1 = $('.simple-editor');
        if (ck_intro1.length > 0) {
            ck_intro1.each(function(){
                var $this = $(this);
                var thisRules = { };
                $this.minlength = $this.attr('ckminlength');
                $this.maxlength = $this.attr('ckmaxlength');
                
                
                if ($this.hasClass('required')) {  
                    $.extend(thisRules,{ 
                        required : function(textarea) {
                            CKEDITOR.instances[textarea.id].updateElement();            // update textarea
                            editorcontent = textarea.value.replace(/<[^>]*>/gi, '');    // strip tags
                            editorcontent = entityToText(editorcontent);                // remove special characters
                            return editorcontent.length === 0;
                        }
                    });
                }
                
                if (typeof $this.minlength !== 'undefined') { 
                    $.extend(thisRules,{ 
                        ckEditorMinLength : $this.minlength
                    });
                } 
                
                if (typeof $this.maxlength !== 'undefined') {
                    $.extend(thisRules,{ 
                        ckEditorMaxLength : $this.maxlength
                    });
                }
                
                $this.rules("add",thisRules);            
            });
        }
        
        var ck_intro2 = $('.simplex-editor');
        if (ck_intro2.length > 0) {
            ck_intro2.each(function(){
                var $this = $(this);
                var thisRules = { };
                var addingRules = false;
                $this.minlength = $this.attr('ckminlength');
                $this.maxlength = $this.attr('ckmaxlength');
                
                
                if ($this.hasClass('required')) {  
                    addingRules = true;
                    $.extend(thisRules,{ 
                        required : function(textarea) {
                            CKEDITOR.instances[textarea.id].updateElement();   // update textarea
                            editorcontent = textarea.value.replace(/<[^>]*>/gi, '');    // strip tags
                            return editorcontent.length <= 0;
                        }
                    });
                }
                
                if (typeof $this.minlength !== 'undefined') { 
                    addingRules = true;
                    $.extend(thisRules,{ 
                        ckEditorMinLength : $this.minlength
                    });
                } 
                
                if (typeof $this.maxlength !== 'undefined') {
                    addingRules = true;
                    $.extend(thisRules,{ 
                        ckEditorMaxLength : $this.maxlength
                    });
                }
                
                if (addingRules === true){
                    $this.rules("add",thisRules);
                    //console.log($this);                    
                } 
                   
                         
            });
        }
        
        var ck_body = $('.full-editor');
        if (ck_body.length > 0) {
            ck_body.each(function(){
                var $this = $(this);
                var thisRules = { };
                $this.minlength = $this.attr('ckminlength');
                $this.maxlength = $this.attr('ckmaxlength');
                
                
                if ($this.hasClass('required')) {  
                    $.extend(thisRules,{ 
                        required : function(textarea) {
                            CKEDITOR.instances[textarea.id].updateElement();   // update textarea
                            editorcontent = textarea.value.replace(/<[^>]*>/gi, '');    // strip tags
                            
                            return editorcontent.length === 0;
                        }
                    });
                }
                
                if (typeof $this.minlength !== 'undefined') { 
                    $.extend(thisRules,{ 
                        ckEditorMinLength : $this.minlength
                    });
                } 
                
                if (typeof $this.maxlength !== 'undefined') {
                    $.extend(thisRules,{ 
                        ckEditorMaxLength : $this.maxlength
                    });
                }
                
                $this.rules("add",thisRules);            
            });
        }
        
        var ck_admin = $('.mega-editor');
        if (ck_admin.length > 0) {
            ck_admin.each(function(){
                var $this = $(this);
                var thisRules = { };
                $this.minlength = $this.attr('ckminlength');
                $this.maxlength = $this.attr('ckmaxlength');
                
                
                if ($this.hasClass('required')) {  
                    $.extend(thisRules,{ 
                        required : function(textarea) {
                            CKEDITOR.instances[textarea.id].updateElement();   // update textarea
                            editorcontent = textarea.value.replace(/<[^>]*>/gi, '');    // strip tags
                            
                            return editorcontent.length === 0;
                        }
                    });
                }
                
                if (typeof $this.minlength !== 'undefined') { 
                    $.extend(thisRules,{ 
                        ckEditorMinLength : $this.minlength
                    });
                } 
                
                if (typeof $this.maxlength !== 'undefined') {
                    $.extend(thisRules,{ 
                        ckEditorMaxLength : $this.maxlength
                    });
                }
                
                $this.rules("add",thisRules);            
            });
        }
        
        var crFrmStartDay = $("#" + crFrmId).find('#start_day');
        var crFrmEndDay   = $("#" + crFrmId).find('#end_day');
        
        if (
                crFrmStartDay.length == 1 &&
                crFrmEndDay.length == 1  ) {
                    /**
                     * Get current form settings validate.
                     * A powerfull way to add/remove validate rules, message etc ...
                     * This is how you would remove validation rules:
                     * var settings = $('form').validate().settings;
                     * delete settings.rules.rightform_input1;
                     * delete settings.messages.rightform_input1;
                     * And this is how you would add validation rules:
                     * 
                     * var settings = $('form').validate().settings;
                     * settings.rules.leftform_input1 = {required: true};
                     * settings.messages.leftform_input1 = "Field is required";
                     *
                     * Other way to do de extends
                     * $.extend(settings, {
                     *   rules: {
                     *       rightform_input1: { required: true },
                     *       rightform_input2: { required: true }
                     *   },
                     *   messages: {
                     *       rightform_input1: "Field is required",
                     *       rightform_input2: "Field is required"
                     *   }
                     * });
                     */    
                jQuery.validator.addMethod("dateComparison",function(value,element) {
                    var result= true;
                    
                    //var dateArray= crFrmStartDay.val().split("-");
                    //var startDateObj= new Date(dateArray[2],(dateArray[0]-1),dateArray[1],0,0,0,0);
                    var cfrmStartDayDate = crFrmStartDay.val();
                    var startDateObj     = new Date(cfrmStartDayDate);
                      
                    var endDateObj            = new Date(value);
                    var startDateMilliseconds = startDateObj.getTime();
                    var endDateMilliseconds   = endDateObj.getTime();
                				
                    if (endDateMilliseconds < startDateMilliseconds) { result= false; }
                      
                    return result;
                
                },"The ending date must be a later date than the start date");
                 
                crFrmEndDay.rules("add",{
                    dateComparison : true    
                });
        } 
    });
     
    
    // Additional rules
    co = $('.old_data');    
    if (co.length > 0) {
        is_old_data_id = new Array();
        co.each(function(i){
            elem = $(this);
            data_ajax = $.parseJSON(elem.attr('data-ajax'));
            data_url  = typeof data_ajax.url !== 'undefined' ? data_ajax.url : bs_cms+'helper/ajax/old-data';
                
            is_old_data_id[i] = elem.attr('id');
                
            data_t = typeof data_ajax.t == 'undefined' ? 0 : data_ajax.t;       //table
            data_f = typeof data_ajax.f == 'undefined' ? 0 : data_ajax.f;       //field 
            data_c = typeof data_ajax.c == 'undefined' ? 'id' : data_ajax.c;    //condition field
            data_v = typeof data_ajax.v == 'undefined' ? 0 : data_ajax.v;       //condition value
                        
            elem.rules("add", {
                remote: {
                    url  : data_url,
                    type : "post",
                    data : {
                      t  : data_t,  
                      f  : data_f,
                      c  : data_c,
                      v  : data_v,
                      chk: function() {
                        return $('.old_data#'+is_old_data_id[i]).val();
                      }
                    }
                }
            });       
        });  
    }   
    
    //Additional rules
    ci = $('.is_available')
    if (ci.length > 0) {
        is_avaiable_id = new Array();
        ci.each(function(i){
            elem = $(this);
            data_ajax = $.parseJSON(elem.attr('data-ajax'));
            data_url  = typeof data_ajax.url !== 'undefined' ? data_ajax.url : bs_cms+'helper/ajax/check-exist';
            
            if (typeof data_ajax.t == 'undefined' || typeof data_ajax.f == 'undefined') return 0; //Skip current element
            
            is_avaiable_id[i] = elem.attr('id');
            
            data_t = data_ajax.t; //table
            data_f = data_ajax.f; //field 
            data_c = typeof data_ajax.c == 'undefined' ? 'id' : data_ajax.c; //condition field
            data_v = typeof data_ajax.v == 'undefined' ? null : data_ajax.v; //condition value
            
            remoteData = {
              t  : data_t,  
              f  : data_f,
              c  : data_c,
              v  : data_v,
              chk: function() {
                return $('.is_available#'+is_avaiable_id[i]).val();
              }
            }
            
            if (typeof data_ajax.get !== 'undefined') {
                var tableOfContentGetSplit = data_ajax.get.split(',');
                $.each(tableOfContentGetSplit,function(i,v){
                    remoteData[v] = $('#'+v).val();
                });
            }
                         
            elem.rules("add", {
                remote: {
                    url  : data_url,
                    type : "post",
                    data : remoteData
                }
                , messages : {
                  remote : typeof data_ajax.m == 'undefined' ? 'Please fix this field' : data_ajax.m
                }
            });     
        });  
    }
}

//OCA(Order Challenge Ajax)
function order_challenger(el,parents) {
    if(typeof parents !== 'object') parents = {};
    
    var elementOrder = $('#ordering').length ? $('#ordering') : ( typeof sys_lang != 'undefined' ? $('#ordering-'+sys_lang) : $('#ordering') );
    
    form_type = elementOrder.attr('data-form-type');
    
    if (el.attr('data-current-value') !== 'undefined' && el.attr('data-current-value') != el.val()) {
        form_type = 'create';
    }
    
    //Parent Field
    parent_field = 'parent_id';
    
    if (typeof elementOrder.attr('data-field') !== 'undefined')
      parent_field = elementOrder.attr('data-field');
    
    parents[parent_field] = el.val();
    
    //OCA Post Data
    oca_post = {table:elementOrder.attr('data-table'),form_type:form_type,parents:parents};
    
    var ocaURL = bs_cms+'helper/ajax/order-challenge';
    
    if (typeof el.attr('data-ajax-url') !== 'undefined')
      ocaURL = el.attr('data-ajax-url');
    
    nous_process_message('Please wait for a while ...',true);
    
    setTimeout(function(){
        $.ajax({
            type    : 'POST',
            url     : ocaURL,
            data    : oca_post,
            async   : true,
            success : function(max) {
                max = $.trim(max);
                if (max !== 'false') {                        
                    elementOrder.attr('max',max).removeAttr('readonly').val(max);
                    
                    if (parseInt(max) == 1) {
                        elementOrder.attr('readonly','readonly');
                    }        
                }     
                nous_disable_message();                   
            }
        });  
    },10); 
}

function uri_sanitizer(res) {
    //default uri sanitizer value
    us = '';     
    
    //Check for tailing element
    if ($('.tailing-url').length > 0) {
        tailingUrl = $('.tailing-url option:selected').attr('data-permalink');
        if (typeof tailingUrl !== 'undefined')
            us = tailingUrl;                   
    }
    
    //Check for data referral
    if ($('.referrer').length > 0) {
        tR = $('.referrer');
        eR = tR.attr('data-referral');
        eR = $('.form-field.'+eR);
        
        if(typeof eR.attr('data-separator') == 'undefined')
            sp = '-'
        else
            sp = eR.attr('data-separator');
        
        if(typeof tR.attr('data-prefix') != 'undefined')
        {
          $.each($.parseJSON(tR.attr('data-prefix')),function(i,v){
            tP = $(i);
            ge = typeof v == 'object' ? (v[0] === 'option'?tP.children('option:selected').attr(v[1]) : tP.find(v[0]).attr(v[1])) : tP.attr(v);
            if(typeof ge !== 'undefined') us += ge + '/';
          });
        }        
        if (us != '' && us.substr(us.length-1) !== '/') us += '/';
                    
        us += cute_url(tR.val(),sp);
    } 
    
    if (typeof res !== 'undefined') {
        return us;    
    }
    
    if (eR.length > 0) {
        eR.val(us);
    }
}

function permalink_sanitizer() {    
    tP = $('.permalink');
    tV = tP.val(); 
    
    if (tP.hasClass('or-url'))
    {
        if (tV.indexOf('h') == 0 
                || tV.indexOf('ht') == 0 
                || tV.indexOf('htt') == 0 
                || tV.indexOf('http') == 0 
                || tV.indexOf('http:') == 0
                || tV.indexOf('http:/') == 0
                || tV.indexOf('http://') === 0)
        {
            return;    
        }
    }  
             
    sT = uri_sanitizer(true);
    
    if (tV == '') {
        tP.val(sT); return;        
    }
    
    if (tV.indexOf(sT) != 0) {
        tP.val(sT+'/'+tV); return;
    }
        
}

//Media Tab Handler
function showMediaTab(idElement) {
    //Show All
    if (!idElement)
        mediaTab.children('li').show();
    else if (typeof idElement === 'object')
    {
        $.each(idElement, function(i,v){
            mediaTab.children('li#media-'+v).show();                   
        });
    }    
    //Show by ID
    else
        mediaTab.children('li#media-'+idElement).show();     
}

function hideMediaTab(idElement) {
    //Hide All
    if (!idElement)
        mediaTab.children('li').hide();
    //Hide by ID          
    else
        mediaTab.children('li#media-'+idElement).hide();     
}

$(document).ready(function(){
    //Define media tab element
    mediaTab = $('ul#media-tab');

    // Language tab    
    selector_lang  = $('.tab-selector.lang');  
    if (selector_lang.length > 0) {
        selector_lang_button = selector_lang.children('ul').children('li'); 
        selector_lang_button.click(function(){
            var selector_lang_selected = $(this);            
            var selector_lang_sel_id   = selector_lang_selected.attr('id');
                        
            $('.media-container.active').removeClass('active');
            
            $('.media-container#media-content-container').addClass('active');  
                      
            selector_lang.children('ul').children('li.active').removeClass('active');  
            
            if (selector_media.length > 0) 
                selector_media.children('ul').children('li.active').removeClass('active'); 
                          
            selector_lang_selected.addClass('active');               
            $('.tab-content.lang.active').removeClass('active').addClass('hide');            
            $('.tab-content.lang.hide.lang-'+selector_lang_sel_id).removeClass('hide').addClass('active');            
            $('.tab-content.lang.lang-'+selector_lang_sel_id+' > *').stop(true,true).fadeOut(300).fadeIn(300);            
            $('form.form-generator .error').removeClass('error');            
            $('.error_information label').hide();
        });         
    } 
    
    // Normal content text
    selector_ctxt  = $('.tab-selector.content-text');  
    if (selector_ctxt.length > 0) {
        selector_ctxt_button = selector_ctxt.children('ul').children('li'); 
        selector_ctxt_button.click(function(){
            var selector_ctxt_selected = $(this);            
            var selector_ctxt_sel_id   = selector_ctxt_selected.attr('id');
                        
            $('.media-container.active').removeClass('active');
            
            $('.media-container#media-content-container').addClass('active');  
                      
            selector_ctxt.children('ul').children('li.active').removeClass('active');  
            
            if (selector_media.length > 0) 
                selector_media.children('ul').children('li.active').removeClass('active'); 
                          
            selector_ctxt_selected.addClass('active');            
            $('form.form-generator .error').removeClass('error');            
            $('.error_information label').hide();
        });         
    }
    
    // Media tab    
    selector_media = $('.tab-selector.media');  
    if (selector_media.length > 0) {
        selector_media_button = selector_media.children('ul').children('li');
        selector_media_button.click(function(){
            active_media    = $(this);
            active_container = active_media.attr('data-name');
            
            $('.media-container.active').removeClass('active');  
                          
            $('.media-container#media-'+active_container+'-container').addClass('active');
                      
            selector_media.children('ul').children('li.active').removeClass('active');  
            
            if (selector_lang.length > 0) 
                selector_lang.children('ul').children('li.active').removeClass('active'); 
            if (selector_ctxt.length > 0)
                selector_ctxt.children('ul').children('li.active').removeClass('active'); 
            
            $('.browseMedia').html('Add '+active_media.html())
            active_media.addClass('active');
        }); 
                
        //Media browsing        
        $('.browseMedia').click(function(){
            active_media_type = selector_media.children('ul').children('li.active').attr('data-type');
            
            enable_masking_layer('');
            
            $('#masking-html').css('opacity',1).html('Please wait while trying connect to the server, this may take a few seconds'); center_middle('#masking-html');
            
            setTimeout(function(){
                $.ajax({
                    type    : 'POST',
                    url     : bs_cms+"medialibrary/ajax/browser-media",
                    data    : {type:active_media_type},
                    async   : false,
                    success : function(response) {
                        enable_masking_layer(false);
                        $('#masking-html').css('opacity',0).addClass('browser-file').append(response);
                        center_middle('#masking-html');
                    }
                }); 
            },240);       
        }); 
        
        $('input.media-browse').click(function(){
            var active_media_type = selector_media.children('ul').children('li.active').attr('data-type');            
            enable_masking_layer('');            
            $('#masking-html').css('opacity',1).html('Please wait while trying connect to the server, this may take a few seconds'); center_middle('#masking-html');
            var elementName = $(this).attr('name');            
            setTimeout(function(){
                $.ajax({
                    type    : 'POST',
                    url     : bs_cms+"medialibrary/ajax/browser-media",
                    data    : {type:active_media_type,'element':elementName},
                    async   : false,
                    success : function(response) {
                        enable_masking_layer(false);
                        $('#masking-html').css('opacity',0).addClass('browser-file').append(response);
                        center_middle('#masking-html');
                    }
                }); 
            },240);       
        }); 
    }
    
    // Common tab    
    selector_common  = $('.tab-selector');  
    if (selector_common.length > 0) {
        $.each(selector_common,function(){
            thisk = $(this);
            
            if (!(thisk.hasClass('lang')) && !(thisk.hasClass('media'))) {
                
                thisk_id = thisk.attr('id');
                
                if(typeof thisk_id !== 'undefined') {                    
                    //Hide all tab content
                    $('.tab-content.'+thisk_id).addClass('hide');
                    
                    selector_common_button = thisk.children('ul').children('li'); 
                    
                    if (thisk.children('ul').children('li.active').length <= 0) {
                        selector_common_button.eq(0).addClass('active');        
                    }
                     
                    selected_common_def_id = thisk.children('ul').children('li.active').attr('id');
                    $('.tab-content.'+thisk_id+'.hide#common-'+selected_common_def_id).removeClass('hide').addClass('active');
                    
                    selector_common_button.click(function(){
                        var selector_common_selected = $(this);            
                        var selector_common_sel_id   = selector_common_selected.attr('id');
                         
                        selector_common_selected.siblings('li.active').removeClass('active');            
                        selector_common_selected.addClass('active'); 
                                   
                        $('.tab-content.'+thisk_id+'.active').removeClass('active').addClass('hide');            
                        $('.tab-content.'+thisk_id+'.hide#common-'+selector_common_sel_id).removeClass('hide').addClass('active');            
                        $('.tab-content.'+thisk_id+'#common-'+selector_common_sel_id+' > *').stop(true,true).fadeOut(300).fadeIn(300);            
                    });  
                }
            }        
        });       
    }
    
    // CKEDITOR
    var ck_intro = $('.simple-editor');
    if (ck_intro.length > 0) init_ckeditor('simple');
    
    var ck_intro = $('.simplex-editor');
    if (ck_intro.length > 0) init_ckeditor('simplex');
    
    var ck_body = $('.full-editor');
    if (ck_body.length > 0) init_ckeditor('full');
    
    var ck_admin = $('.mega-editor');
    if (ck_admin.length > 0) init_ckeditor('mega');
    
    // Cancel button
    $('button.cancel-button').click(function(e){
        e.preventDefault();
        data_link = $(this).attr('data-link');
        if (typeof data_link !== 'undefined') {
            window.location.href = data_link;
        } else {
            history.go(-1);    
        }
    });
    
    // Bind submit wrapper click event to form
    $('#submit_wrapper').click(function(){
        if( $(this).hasClass('success') ) return false;
        $(this).parents('form').attr('id');
        $(this).parents('form').trigger('submit');  
    });
    $('.submit-form').click(function(){
        $(this).parents('form').attr('id');
        $(this).parents('form').trigger('submit');  
    });
    
    // Form element information
    var selector_inf = $('.frm-hint');
    if (selector_inf.length > 0) {
        $('.frm-hint').mouseover(function(e){                                                
            var selector_inf_cur = $(this);
            var inf_text_X = e.pageX+15;//(e.pageX+5);
            var inf_text_Y = e.pageY-10;//e.pageY-$(window).scrollTop();
            var selector_inf_txt = selector_inf_cur.attr('data-hint');
            
            var selector_inf_dir = $('<div class="frm-hint-text"/>');            
            $(selector_inf_dir).text(selector_inf_txt).css({
                //top     : inf_text_Y,
                left    : inf_text_X-40,
                display : 'none'
            });            
            selector_inf_cur.after($(selector_inf_dir)); 
            $(selector_inf_dir).fadeIn(300);
        }).mouseout(function(){
            $('.frm-hint-text').fadeOut(300,function(){
                $('.frm-hint-text').remove();
            })    
        });
    }
    
    if ($('.tailing-url').length > 0) {
        $('.tailing-url').change(function(){ 
            uri_sanitizer();
        }).blur(function(){
            uri_sanitizer();
        });   
    }
    
    if ($('.referrer').length > 0) {
        $('.referrer').keyup(function(){
            uri_sanitizer();
        }).blur(function(){
            uri_sanitizer();
        });
    }
    
    if ($('.permalink').length > 0) {
        $('.permalink').keydown(function(){
            if (!$(this).hasClass('or-url'))
            {
                permalink_sanitizer();    
            }                                    
        }).blur(function(){
            permalink_sanitizer();
        });
    }
    
    if ($('#parent_id').length > 0) {
        $('#parent_id').change(function(){
            if($('#ordering').length)
              order_challenger($(this));
            if($(this).hasClass('iptUrlUpdate') && $('#permalink').length) {
              //Change url based on selected parent                 
              var urlToChange = $('#permalink').eq(0).val();
              //Cut previous parent url
              if (urlToChange.indexOf('/') >= 0)
                urlToChange = urlToChange.substr(urlToChange.lastIndexOf('/')); //Substring by the last slash
              else
                urlToChange = '/' + urlToChange; //Make sure url have one slash at the beginning
                
              //Selected data permalink
              var iptUrl = $(this).find('option:selected').attr('data-permalink');
              if (iptUrl !== undefined && $.trim(iptUrl) !== '')
                urlToChange = iptUrl + urlToChange;
              else
                urlToChange = urlToChange.substring(1); //Ups, ... no parent detected. Remove first slash for sure
              
              //Change your permalink with new value
              $('#permalink').val(urlToChange);
            }
        });
    }
    
    if ($('.challenge-order').length > 0 && ($('#ordering').length > 0 || typeof sys_lang != 'undefined')) {
        $('.challenge-order').each(function(){
            $(this).change(function(){                
                order_challenger($(this));                
            });
        });
    }
    
    if ($('.datepicker').length > 0) {
        
        var isStartEnd = $('.datepicker.start-date').length > 0 && $('.datepicker.end-date').length > 0;
        
        $('.datepicker').each(function(){
            format_date = typeof $(this).attr('data-date-format') == 'undefined' ? 'yy-mm-dd' : $(this).attr('data-date-format');
            $(this).datepicker({
                numberOfMonths  : isStartEnd ? 2 : 1,
                dateFormat      : format_date,
                onSelect        : function(pickup)
                {
                    if ($(this).hasClass('start-date')) {
                        $(".datepicker").closest('.end-date').datepicker("option","minDate", pickup); 
                    }
                    else
                    {
                        $(".datepicker").closest('.start-date').datepicker("option","maxDate", pickup); 
                    }
                }
            });
        });
    }
    
    if ($('.timepicker').length > 0) {
        $('.timepicker').each(function(){
            min_time = typeof $(this).attr('data-min-time') == 'undefined' ? '12am' : $(this).attr('data-min-time');
            max_time = typeof $(this).attr('data-max-time') == 'undefined' ? '12pm' : $(this).attr('data-max-time');
            
            $(this).timepicker({
                minTime : min_time,
                maxTime : max_time
            });
        });
    }
    
    dragAndDropCKEditor();
    
    if ($('.media-container').length > 0) {
        if ($('.isSortable').length > 0) {
            $('.isSortable').sortable({
                connectWith         : ".isSortable",
                scrollSensitivity   : 100,
                cursor              : "move",
                start: function(event,ui)
                {
                  dragAndDropCKEditor('destroy');
                },
                stop : function(event,ui)
                {
                  dragAndDropCKEditor('replace');
                }            
            });
        }
        
        $('.unlink')
        .unbind('click')
        .bind('click',function(){
            $(this).parents('.media-item-container').remove();
        }); 
    }
    
    $('.numeric').each(function(){
      obj = {};
      if (typeof $(this).attr('data-allow') !== 'undefined') { obj = {allow : $(this).attr('data-allow')}; }
      $(this).numeric(obj);  
    });
    
    
    //Filter file
    $('.filter-extension').change(function(){
        elvl = $(this).val(); 
        eldt = $(this).attr('data-type');
        elxt = elvl.substring(elvl.lastIndexOf('.') + 1).toLowerCase();
        
        if (typeof eldt !== 'undefined') {
            inObject = false;
            $.each($.parseJSON(eldt),function(i,key){
                if (elxt === key) {
                    inObject = true;
                    return;
                }
            });
                            
            if (inObject === false) {
                $(this).val('');   
                jAlert('You are selected forbidden file','Warning'); 
            }
                
        }           
    }); 
    
    //Price Picker
    if ($('.currency').length > 0)
    {
        var _pfP = [];
        var _pfT = [];
        var _pfD = [];
        var _pfL = [];
        
        $('.currency').each(function(i){
            var objCur = $(this);
                        
            _pfP[i] = typeof objCur.attr('data-prefix') === 'undefined' ? 'Rp. ' : objCur.attr('data-prefix');
            _pfT[i] = typeof objCur.attr('data-thousand') === 'undefined' ? ',' : objCur.attr('data-thousand');
            _pfD[i] = typeof objCur.attr('data-decimal') === 'undefined' ? '.' : objCur.attr('data-decimal'); 
            _pfL[i] = typeof objCur.attr('data-decimal-length') === 'undefined' ? 2 : objCur.attr('data-decimal-length');

            objCur.attr({
                'data-prefix'         : _pfP[i],    
                'data-thousand'       : _pfT[i],
                'data-decimal'        : _pfD[i],
                'data-decimal-length' : _pfL[i],
                'maxlength'           : null
            });
            
            //objCur.val(objCur.val()+'0'.repeat(_pfL[i])); //Adding zero as much as decimal length 
            
            objCur.priceFormat({
                prefix             : _pfP[i],
                thousandsSeparator : _pfT[i],
                centsSeparator     : _pfD[i],
                centsLimit         : _pfL[i]
            });
        });
    }
    
    if ($('.ss-dCB').length > 0 && typeof $('.ss-dCB').attr('data-target') !== 'undefined')
    {
        var dCTarget = $('.ss-dCB').attr('data-target').split(',');
        
        if ($('.ss-dCB').children('.append').length > 0)
        {
            var ssdCBa = $('.ss-dCB').children('.append');
            ssdCBa.bind('click',function(){                
                $('.ss-dCB').children('.delete').fadeIn();
                if ($('.xmultiple-container.hide').length == 1)
                {
                    if ($(':input',$('.xmultiple-container.hide')).find('.make-editor').length > 0)
                    {
                      config = {
                          'toolbar' : 'mega-editor',
                          'width'   : 800,
                          'height'  : 300,
                          'directory' : 'bobo'
                      };
                      
                      $(':input',$('.xmultiple-container.hide')).find('.make-editor').ckeditor(function(){},config);
                    }
                    $(':input',$('.xmultiple-container.hide')).val('');
                    
                    $('.xmultiple-container.hide').removeClass('hide').show(); 
                    
                    return false;
                }
                
                var ctcDiv = $('<div/>',{'class':'xmultiple-container'});
                
                for (i in dCTarget)
                {
                    if ($(dCTarget[i]).eq(0).hasClass('hidden')) 
                    { 
                      $(dCTarget[i]).eq(0).removeClass('hidden').show().appendTo(ctcDiv);
                      continue; 
                    }
                    else
                    {
                      var dcTText  = $(dCTarget[i]).eq(0).html();
                      var dcTClass = dCTarget[i];
                      
                      var myDiv = $('<div/>',{'class' : dCTarget[i].replace(/\./g,' ').trim(),'html':dcTText});
                      
                      myDiv.find('.cke').remove();
                      
                      myDiv.appendTo(ctcDiv);
                    }
                    //myDiv.insertBefore('.ss-dCB');
                    
                    if (ctcDiv.find('.make-editor').length > 0)
                    {
                      config = {
                          'toolbar' : 'mega-editor',
                          'width'   : 800,
                          'height'  : ctcDiv == 'intro' ? 120 : 300,
                          'directory' : 'bobo'
                      };
                      
                      ctcDiv.find('.make-editor').ckeditor(function(){},config);
                    }
                    
                    $(':input',myDiv).val('');
                }
                
                ctcDiv.insertBefore('.ss-dCB');
                
                //Re-Index Element 
                for (i in dCTarget)
                {
                  var inputLength = 0;
                  $(dCTarget[i]).each(function(j){
                      $(':input',$(dCTarget[i]).eq(j)).each(function(){
                          $(this).attr('name',$(this).attr('data-rn')+'['+inputLength+']');
                          $(this).attr('id',$(this).attr('id')+inputLength);
                      });
                      inputLength++;
                  });
                }
                
                $('.numeric').each(function(){
                  obj = {};
                  if (typeof $(this).attr('data-allow') !== 'undefined') { obj = {allow : $(this).attr('data-allow')}; }
                  $(this).numeric(obj);  
                });
                
                removeLastDeleteElement();                   
            });
        }
        
        if ($('.ss-dCB').children('.delete').length > 0)
        { 
            var ssdCBd = $('.ss-dCB').children('.delete');
            
            ssdCBd.bind('click',function(){              
                //if($(dCTarget[i]).length <= 1) return;
                for (i in dCTarget)
                {
                    if($(dCTarget[i]).length <= 1) {
                        
                        
                        $(dCTarget[i]).eq(0).find(':input').val('');
                        $(':input',$(dCTarget[i]).eq(0)).val('').addClass();
                        
                        $(dCTarget[i]).eq(0).addClass('hidden').hide();  
                        
                        continue;  
                    
                    }
                    
                    $(dCTarget[i]).eq($(dCTarget[i]).length-1).remove();
                }
                //if($(dCTarget[0]).length <= 1) $(this).fadeOut();
            }); 
        }
        
        removeLastDeleteElement();   
    }
});

function dragAndDropCKEditor(type)
{
  //Default type
  if(type === undefined) type = 'init';
  //Object
  var obj = $('.sortable').find('.as-ckeditor');
  if (obj.length > 0)
  {
    var defCon, Con;
    defCon = Con = {'toolbar':'simple','width':800,'height':120,'directory':'bobo'};
    
    obj.each(function(){
      if(type === 'destroy' && $(this).attr('name') in CKEDITOR.instances) CKEDITOR.instances[$(this).attr('name')].destroy();
      else if(type === 'replace') CKEDITOR.replace($(this).attr('name'),Con);
      else $(this).ckeditor(function(){},Con);
    });
  }
}

var removeLastDeleteElement = function()
{
    //$('.personalDeleteButton').css('display','inline-block');
    
    //$('.personalDeleteButton').last().css('display','none');
}   
   
var personalDelete = function(obj)
{
    dCTarget = $('.ss-dCB').attr('data-target').split(',');
    if($('.personalDeleteButton.btn-en').length)
    {
      if ($('.personalDeleteButton.btn-en').length > 1) 
          obj.parents("."+obj.attr('data-target')).remove();
      else
      {
       obj.parents("."+obj.attr('data-target')).addClass('hide').hide();
      }
    }
    else if($('.personalDeleteButton.btn-id').length)
    {
      if ($('.personalDeleteButton.btn-id').length > 1)
          obj.parents("."+obj.attr('data-target')).remove();
      else 
      {
        obj.parents("."+obj.attr('data-target')).addClass('hide').hide();
      }
    }
    else if($('.personalDeleteButton').length)
    {
      if ($('.personalDeleteButton').length > 1)
          obj.parents("."+obj.attr('data-target')).remove();
      else 
      {
        obj.parents("."+obj.attr('data-target')).addClass('hide').hide();
        $(':input',obj.parents("."+obj.attr('data-target'))).val('');
      }
    }
    removeLastDeleteElement();
    
    for (i in dCTarget)
    { 
        var inputLength = 0;
        $(dCTarget[i]).each(function(j){
            $(':input',$(dCTarget[i]).eq(j)).each(function(){
                $(this).attr('name',$(this).attr('data-rn')+'['+inputLength+']');
                $(this).attr('id',$(this).attr('id')+inputLength);
            });
            inputLength++;
        });
    }
} 