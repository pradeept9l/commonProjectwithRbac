var csrfToken = jQuery('meta[name="csrf-token"]').attr("content");
var url = jQuery('meta[name="url"]').attr("content");

/*********************************************************************
 @ preview main image
*********************************************************************/
function readURL(input,img) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#'+img).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}



function myFunction(){
    var val = $('#pro_cat').val();
    jQuery.ajax({
            type: 'post',
            url: url + 'products/getsubcategory',
            datatype: 'json',
            data: {_csrf: csrfToken, id: val}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            beforeSend: function () {
                
            },
            success: function (response) {
                if (response.status == 'success') {
                   $( "select#product_subcategory_id" ).html(response.data);
//                   if(val == 1 || val == 3){
//                    $("#size_dtl").attr('style','display:none');
//                   }else{
//                       $("#size_dtl").attr('style','display:none');
//                   }
//                   $("#size_dtl").html(response.size);
                   
                } else if (response.status == 'failed') {
                    
                }
            },
            error: function (responce) {
            }
        });
}
function RemoveImage(name,id){
                var current_val = $('#gal_img').val();
                var string_to_array = current_val.split(",");
                var new_val_array = 
                    jQuery.grep(string_to_array, function(value) {
                        return value != name;
                    });
                    var new_val = new_val_array.join(',');

//                     if(new_val !== ''){
//                        var all_ids = new_val+','+name;
//                    }else{
//                        var all_ids = valuee;
//                    }
                    $('#gal_img').val(new_val);
                    $('#farm_'+id).attr('style','display:none;');
//                alert(selectedid);
            }

/*********************************************************************
 @ preview image other images
*********************************************************************/
window.onload = function () {
    var newImgIndex=0;
    var allNewImages=[];
    $("#fileupload").change(function () {
        var fileUpload = document.getElementById("fileupload");
        if (typeof (FileReader) != "undefined") {
            var dvPreview = document.getElementById("dvPreview");
            var regex = /^([a-zA-Z0-9\s_\\.\-:\!\@\#\$\%\&\*\(\)])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            for (var i = 0; i < fileUpload.files.length; i++) {
                var file = fileUpload.files[i];
                allNewImages.push(fileUpload.files[i].name);
                if (regex.test(file.name.toLowerCase())) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var newItem = document.createElement("DIV");
                        var clrDIV = document.createElement("a");
                        clrDIV.className = "close-btn";
                        newItem.className = "uploaded-content other-img pull-left";
                        var img = document.createElement("IMG");
                        img.src = e.target.result;
                        img.width = "400";
                        img.height = "158";
                        dvPreview.appendChild(newItem);
                        var el = document.getElementsByClassName('remove' + j);
                        clrDIV.id = "bottom" + j;
                        newItem.id = "imgli" + j;
                        clrDIV.setAttribute("onclick", "removerOtherimg('imgli" + j + "','"+allNewImages[newImgIndex]+"')");
                        newItem.appendChild(img);
                        newItem.appendChild(clrDIV);
                        j++;
                        newImgIndex++;
                        console.log(allNewImages);
                    }
                    reader.readAsDataURL(file);
                } else {
                    dvPreview.innerHTML = "";
                    return false;
                }
            }
        } else {
            console.log("This browser does not support HTML5 FileReader.");
        }
    });
    var j = $('#hiddenImagesCount').val();
    var j = j++;
    
};
/*********************************************************************
 @ remove image on click cross icon
*********************************************************************/
function removerOtherimg(liid,name)
{   
    $('div#'+liid).remove();
    if(name){
        alreadydel = $('#hiddenImagetoDel').val();
        if(alreadydel == ''){
            newdel = name;
        }else{
        newdel = alreadydel+','+name;
        }
        $('#hiddenImagetoDel').val(newdel);
    }    
}
/*********************************************************************
 @ document ready
*********************************************************************/
$(document).ready(function(){
        $("#modelimgfileupload").change(function(){
        readURL(this,'product-main-img');
        });
        $("#modelimgfileupload-primary").change(function(){
        readURL(this,'product-main-img-primary');
        });
		$(".datepicker").datepicker({ minDate: 0 });
        $( ".datepicker" ).datepicker( "option", "dateFormat", "MM d, yy" );
/*********************************************************************
 @ integer only keyboard enabled
*********************************************************************/
            $(".intOnly").keydown(function (e) {
        // Allow: backspace, delete, tab, escape and enter
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                // Allow: Ctrl+A, Command+A
                        (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                        // Allow: home, end, left, right, down, up
                                (e.keyCode >= 35 && e.keyCode <= 40)) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
          $(".all_check").click(function(){
              var company_id = $(this).attr('comp_id') ;
              var product_id = $(this).attr('product_id') ;
              var meal_type = $(this).attr('meal_t') ;
               if ($(this).is(':checked')) {
                   var flag = 1 ;
                 }else{
                   var flag = 0 ;
                 }
             $.ajax({
                    type:'post',
                    url: url+'companies/preferences',
                    data:{_csrf:csrfToken,comp_id:company_id,prod_id:product_id,type:meal_type,flag:flag },
                    datatype: 'json',
                    success:function(response){
                           
                    },
                    error: function(){

                    }
                });
         });  
         
         
          $(".all_meals").click(function(){
              var product_id = $(this).attr('product_id') ;
              
               if ($(this).is(':checked')) {
                   var flag = 1 ;
                 }else{
                   var flag = 0 ;
                 }
                 
             $.ajax({
                    type:'post',
                    url: url+'products/select-homepage-meals',
                    data:{_csrf:csrfToken,prod_id:product_id,flag:flag },
                    datatype: 'json',
                    success:function(response){
                    },
                    error: function(){

                    }
                });
         });  
         
         
         
         $("#company_input").click(function(){
           var category = ($('#products-category_id').val())+"" ;
          
             if(category.indexOf('7') !== -1){
                 if ($(this).is(':checked')) {
                    $("#companies_div").show();
                }else{
                    $("#companies_div").hide();
                }
             }else{
                 $("#companies_div").hide();
             }
         });
        
        $('#products-category_id').click(function(){
           var cats = $(this).val();
           if(cats.indexOf('7') == -1){
              $("#companies_div").hide();
           }else{
            //    $("#companies_div").show();
           }
        });
           $(document).on("click",".checkall",function(){
                     var iden  = $(this).val() ;
                   if($(this).is(':checked'))
                    {
                        $(".checkin"+iden).attr('checked', true) ;
                    }else{
                          $(".checkin"+iden).attr('checked',false) ;
                    }
         
             });
    
})
// *******************************************/
$( function() {
    var dateFormat = "d MM, yy",
      from = $( ".startdatepicker" )
        .datepicker()
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( ".enddatepicker" ).datepicker()
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      }
      catch( error ) {
        date = null;
      }
 
      return date;
    }
  } );
  
  
 // order status function
       function evnt(status){
       csrfToken = jQuery('meta[name="csrf-token"]').attr("content");
       var keys = $('#grid').yiiGridView('getSelectedRows');
       if(keys.length==0) {
       alert('Plese select a order!');
       return false;
       }else{
     // console.log(keys);
   jQuery.ajax({
            type: 'post',
            url: url+'orders/ordstatus',
            data: {_csrf: csrfToken,keylist: keys,status: status },
            datatype: 'json',
            success: function (response) {
                },
            error: function(response){
              
            }
        });

        } 
  } ;
  function ordr(status){
       csrfToken = jQuery('meta[name="csrf-token"]').attr("content");
       var keys = $('#grid').yiiGridView('getSelectedRows');
       if(keys.length==0) {
      alert('Plese select a order!');
     return false;
       }else{$('.status-modalbox').show();
     // console.log(keys);
            }      
        } 
        
        function delivery(status){
       csrfToken = jQuery('meta[name="csrf-token"]').attr("content");
       var keys = $('#grid').yiiGridView('getSelectedRows');
       var did = $("input[name='action']:checked").val();
        if (did){
                jQuery.ajax({ 
                type: 'post',
                url: url+'orders/ordstatus',
                data: {_csrf: csrfToken,keylist: keys,status: status,did:did },
               datatype: 'json',
               success: function (response) {
                    },
                error: function(response){

               }
            });
        }
       else{
            alert('Plese select a delivery boy!');
           return false;
       }
    };
    
     $('#add').click(function(){
        send_request();
    });
    function send_request(){
         var id = $('#modalcontent').attr('data_food');
         
         jQuery.ajax({
             type: 'get',
             datatype: 'json',
             url: url+'products/add-ingredients',
             data: {_csrf: csrfToken,food_id:id}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
             success: function (response) {
           
                 $('#modal').modal('show');
                 $('#modalcontent').html(response);
           }
             
         });
    }
    //below line of code is included to enable the entry into the search input box 
     //$.fn.modal.Constructor.prototype.enforceFocus = function() {};
    
    $('body').on('beforeSubmit', 'form#form_add_ingredients', function () {
        $.post(
               $(this).attr("action") ,
               $(this).serialize()
                ).done(
                function(result){
                    if(result.status == 1){
                        alert('Ingredient has been added');
                        $('#ingredients_content').html(result.data);
                        //alert(result.data);
                        // $.pjax.reload({container:'#add_grid'});
                        // $('#modalcontent').html('');
                        //  $('#modal').modal('hide');
                        // $(form_now).trigger('reset');
                      send_request();
                   
                    }else if(result.status == 2) {
                        alert('This Ingredient already exists');
                    }
                  
                    
                }).fail(function(){
                   
                });
                return false ;
        
        
    });
    $(document).on("click",".update_quantity",function(){
        var model_id = $(this).attr('data_id'); 
        var quantity = $('#'+model_id).val();
        if((quantity != 0)&&(!isNaN(quantity))){
                   jQuery.ajax({
             type: 'post',
             datatype: 'json',
             url: url+'products/update-ingredients',
             data: {_csrf: csrfToken,ingredient_id:model_id,quantity:quantity},
             success: function (response) {
                    if(response.status == 1){
                            alert('Updated');
                             $('#ingredients_content').html(response.data);
                    }
              }
             
         });            
            
            
        }else{
            alert('Quanity can not be zero');
        }
    });
   $(document).on("click",".delete_ingredient",function(){
        var model_id = $(this).attr('data_id'); 
       
       
                   jQuery.ajax({
             type: 'post',
             datatype: 'json',
             url: url+'products/delete-ingredients',
             data: {_csrf: csrfToken,ingredient_id:model_id},
             success: function (response) {
                    if(response.status == 1){
                            alert('Deleted');
                             $('#ingredients_content').html(response.data);
                    }
              }
             
         });            
       
    });
    
  
    $(document).on("click",".breakfast",function(){
        add($(this).attr('dataDay'),$(this).attr('dataMeal'));
    });
    
 
    function create(br){
         csrfToken = jQuery('meta[name="csrf-token"]').attr("content");
        var formdata = new FormData(addform);
        formdata.append('_csrf', csrfToken);
    //console.log(formdata);
       jQuery.ajax({
            type: 'post',
            url: url+'subscriber/create',
            data: formdata,
           dataType: 'json',
           contentType: false,
           cache: false,
           processData: false,
           success: function (response) {
               if(response.status=='success'){
                $('#modal').modal('hide');
                $('#chart_data').html(response.data);
               // $('#break'+response.data).html(response.text);
              
              } }
           
        }); 
       } ;
 
 function add(day,meal){
       csrfToken = jQuery('meta[name="csrf-token"]').attr("content");
         var userid = $('#modalcontent').attr('user_id')
         var subid = $('#modalcontent').attr('data_id')
        
       jQuery.ajax({
            type: 'get',
            url: url+'subscriber/add',
            data: {_csrf: csrfToken,day:day,meal:meal,data_id:subid,user_id:userid},
            datatype: 'json',
           success: function (response) {
              $('#modal').modal('show');
              $('#modalcontent').html(response);
              }
        });
       } ;
       function subs(status){
       csrfToken = jQuery('meta[name="csrf-token"]').attr("content");
        var userid = $('#updateStatus').attr('user_id')
        var subid = $('#updateStatus').attr('data_id')
        
       jQuery.ajax({
            type: 'post',
            url: url+'subscriber/manage',
            data: {_csrf: csrfToken,status: status,data_id:subid,user_id:userid },
            datatype: 'json',
           success: function (response) {
               if(response.status=='success'){
               if(response.code== 3){
                   location.reload();
                    $('.cancel').val(response.text);
                    $('#new').hide();
                }
                     else{
                     $('#updateStatus').attr('dataStatus',response.code);
                     $('#updateStatus').val(response.text);
                     
                    }
                }}
        });
       } ;
 $(document).ready(function(){
     $('#updateStatus').click(function(){
         subs($(this).attr('dataStatus'))
     })
 })
 

 function load_ingred(thyu){
     if(thyu != ""){
         var subs_id = $("#sid").val();
         var meal_id = $("#meal_id").val();
         var day_id = $("#day_id").val() ;
         
          jQuery.ajax({ 
            type: 'post',
            url: url+'subscriber/geting',
            data: {_csrf: csrfToken,food_id:thyu,subs_id:subs_id ,meal_id : meal_id ,day_id : day_id},
            datatype: 'json',
            success: function (response) {
                if(response.status == 1){
                    $("#chart_data").html(response.chart_data);
                    $("#customise_meal").html(response.data);
                }else if (response.status == 0){
                    alert(response.message+'Please choose another option');
                     $("#customise_meal").html("");
                }
                    
                },
            error: function(response){
              
           }
        });
     }
   
 }
 
 
   $(document).on("click",".custom_update_quantity",function(e){
        e.preventDefault();
        var model_id = $(this).attr('row_id'); 
        var quantity = $('#ini_'+model_id).val();
        if((quantity != 0)&&(!isNaN(quantity))){
                   jQuery.ajax({
             type: 'post',
             datatype: 'json',
             url: url+'subscriber/update-ingredients',
             data: {_csrf: csrfToken,ingredient_id:model_id,quantity:quantity},
             success: function (response) {
                    if(response.status == 1){
                            alert('Updated');
                             $('#customise_meal').html(response.data);
                               $('#chart_data').html(response.chart_data);
                    }
              }
             
         });            
            
            
        }else{
            alert('Quanity can not be zero');
        }
    });

   $(document).on("click",".custom_delete_ingredient",function(e){
        e.preventDefault();

        var model_id = $(this).attr('row_id'); 
        jQuery.ajax({
             type: 'post',
             datatype: 'json',
             url: url+'subscriber/delete-ingredients',
             data: {_csrf: csrfToken,ingredient_id:model_id},
             success: function (response) {
                    if(response.status == 1){
                            alert('Deleted');
                            $('#customise_meal').html(response.data);
                            $('#chart_data').html(response.chart_data);
                          
                    }
              }
             
         });            
       
    });
    $(document).on("click","#activate_sub",function(){
        var subs_id = $(this).attr('subs_id'); 
        var sub_status = $(this).attr('sub_status'); 
        
       
        jQuery.ajax({
             type: 'post',
             datatype: 'json',
             url: url+'subscriber/activate',
             data: {_csrf: csrfToken,subs_id:subs_id,sub_status:sub_status},
             success: function (response) {
                    if(response.status == 1){
                        if(response.active == 0){
                              alert('Subscription Inactivated');
                              $('#activate_sub').text('Activate');
                              $('#activate_sub').attr('sub_status','0');
                        }
                        else if(response.active == 1)
                        {
                            alert('Subscription Activated');
                            $('#activate_sub').text('Inactivate');
                            $('#activate_sub').attr('sub_status','1');
                        }
                            
                    }
              }
             
         });            
       
    });
    
 function generate_orders(id){
     jQuery.ajax({
             type: 'post',
             datatype: 'json',
             url: url+'orders/generate',
             data: {_csrf: csrfToken,flag:id},
             success: function (response) {
                alert(response.message);
                location.reload();
             }
             
         });
 }
 
function sub_order(status){
  
        csrfToken = jQuery('meta[name="csrf-token"]').attr("content");
       var keys = $('#grid').yiiGridView('getSelectedRows');
       if(keys.length==0) {
            alert('Plese select a order!');
            return false;
       }
       else
       {
           
            var keys = $('#grid').yiiGridView('getSelectedRows');
             if (keys){
                 var  flag = 0 ;
                 if(status == 8){
                     status = 6 ;
                     flag = 1 ;
                 }
                 jQuery.ajax({ 
                        type: 'post',
                        url: url+'orders/suborderstatus',
                        data: {_csrf: csrfToken,keylist: keys,status: status,flag:flag},
                        datatype: 'json',
                        success: function (response) {
                               },
                        error: function(response){

                         }
                     });
                  
             }
            
        }  
       
}

function sub_order_corp(status){
  
        csrfToken = jQuery('meta[name="csrf-token"]').attr("content");
        
      
       var keys = $('#grid').yiiGridView('getSelectedRows');
      
       if(keys.length==0) {
            alert('Please select a order!');
            return false;
       }
       else
       {
 
            var keys = $('#grid').yiiGridView('getSelectedRows');
             if (keys){
                 var  flag = 0 ;
                 var corp_flag = 1 ;
                 
                 jQuery.ajax({ 
                        type: 'post',
                        url: url+'orders/suborderstatus',
                        data: {_csrf: csrfToken,keylist: keys,status: status,flag:flag,corp_flag:corp_flag},
                        datatype: 'json',
                        success: function (response) {
                          //   alert('Order status changed');
                                 location.reload() ;
//                            if(response.status == 1){
//                                 
//                            }else if(response.status == 0){
//                                 alert('Failed');
//                            }else if (response.status == 2){
//                                 alert('Not Allowed');
//                            }
                               },
                        error: function(response){

                         }
                     });
                  
             }
            
        }  
       
}


function print_div(id){
  $('#modal').modal('show');
   
//     var newWin = window.open();  
//      jQuery.ajax({ 
//                        type: 'post',
//                        url: url+'orders/printorders',
//                        data: {_csrf: csrfToken,id: id},
//                        datatype: 'json',
//                        success: function (response) {
//                            if(response.status == 1){
//                                     newWin.document.write(response.content);
//                                     newWin.document.close();
//                                     newWin.focus();
//                                     newWin.print();
//                                     newWin.close();
//                               //    window.open().document.write();
//                               //    window.stop();
//                               //    window.print();
//                                    
//                            }
//          
//                          },
//                        error: function(response){
//
//                         }
//                     });
 
}
function delay_message(){
    $("#exampleModal").show('slow');
}
function close_pop(){
    $("#exampleModal").hide('slow');
    $("#SendmessageModal").hide('slow');
}
function open_message(action){
    
//         var inputs = $('.all_subs:checkbox:checked');
        var value = $("#d_message").val();
        if(value == ''){
            alert('Message cann`t be blank.. ');
            return false;
            
        }else{
            
        }
        var inputs = $('.all_subs:checkbox:checked').map(function () {
           return this.value;
          }).get();
         
//        var obj = inputs;
//        var arr = Object.keys(obj).map(function (key) { return obj[key]; });
        //alert(arr);
      
        if(inputs.length != 0){
            jQuery.ajax({ 
                            type: 'post',
                            url: url+'orders/order-action',
                            data: {_csrf: csrfToken,data:inputs,action:action,message:value},
                            datatype: 'json',
                          beforeSend: function() {
                                $("#preloader").show() ;
                                $("#d_message").val('');
                                $("#exampleModal").hide('slow');
                              },
                            success: function (response) {
                                  $("#preloader").hide();
                                   location.reload();
                              
                            },
                            error: function(response){

                             }
                     });
        }else{
            alert('Please select some orders ');
        }
    
 
}
function order_action(action){
    
         //var inputs = $('.all_subs:checkbox:checked');
        var inputs = $('.all_subs:checkbox:checked').map(function () {
           return this.value;
          }).get();
          
        var message = "" ;
        
        if(action == 3){
                var message = $('#d_message').val();
              if(message == ''){
                alert('Message can`t be blank.. ');
                return false;
              }
        }
        var paid = 0 ;
        if(action == 99){
             paid = 1 ;
             action = 4 ;
        }
        if(action == 88){
             action = 4 ;
        }
        
         
//        var obj = inputs;
//        var arr = Object.keys(obj).map(function (key) { return obj[key]; });
        //alert(arr);
      
        if(inputs.length != 0){
            jQuery.ajax({ 
                            type: 'post',
                            url: url+'orders/order-action',
                            data: {_csrf: csrfToken,data:inputs,action:action,paid:paid,message:message},
                            datatype: 'json',
                          beforeSend: function() {
                                $("#preloader").show() ;
                              },
                            success: function (response) {
                                  $("#preloader").hide();
                                   location.reload();
                              
                            },
                            error: function(response){

                             }
                     });
        }else{
            alert('Please select some orders ');
        }
 
}

function sub_order_action_delay(action){ 
        var inputs = $('#grid').yiiGridView('getSelectedRows');
        var paid = $('input[name=paid]:checked').val();
        var value = $('#d_message').val();
        
//        alert(value);
    if(inputs.length != 0){ 
            jQuery.ajax({ 
                            type: 'post',
                            url: url+'orders/order-action',
                            data: {_csrf: csrfToken,data:inputs,action:action,paid:paid,message:value},
                            datatype: 'json',
                            beforeSend: function() {
                                $("#preloader").show() ;
                                $("#d_message").val('');
                                $("#exampleModal").hide('slow');
                              },
                            success: function (response) {
                                  $("#preloader").hide();
                                location.reload();
                              
                            },
                            error: function(response){

                             }
                     });
        }else{
            alert('Please select some orders ');
        }
 
}

function order_action_delay(action){ 
        var inputs = $('#grid').yiiGridView('getSelectedRows');
        var paid = $('input[name=paid]:checked').val();
        var value = $('#d_message').val();
        if(value == ''){
            alert('Message can`t be blank.. ');
            return false;
            
        }else{
            
        }
//        alert(value);
    if(inputs.length != 0){ 
            jQuery.ajax({ 
                            type: 'post',
                            url: url+'orders/order-action',
                            data: {_csrf: csrfToken,data:inputs,action:action,paid:paid,message:value},
                            datatype: 'json',
                            beforeSend: function() {
                                $("#preloader").show() ;
                                $("#d_message").val('');
                                $("#exampleModal").hide('slow');
                              },
                            success: function (response) {
                                  $("#preloader").hide();
                                location.reload();
                              
                            },
                            error: function(response){

                             }
                     });
        }else{
            alert('Please select some orders ');
        }
 
}
function sub_order_action(action){
        var inputs = $('#grid').yiiGridView('getSelectedRows');
         var paid = 0 ;
        if(action == 99){
             paid = 1 ;
             action = 4 ;
        }
        if(action == 88){
             action = 4 ;
        }
        
      var sku_to_be_shifted =  $("#sku_to_be_shifted").val() ;
       
     
    if(inputs.length != 0){
            jQuery.ajax({ 
                            type: 'post',
                            url: url+'orders/order-action',
                            data: {_csrf: csrfToken,data:inputs,action:action,paid:paid,sku_to_be_shifted:sku_to_be_shifted},
                            datatype: 'json',
                            beforeSend: function() {
                                $("#preloader").show() ;
                              },
                            success: function (response) {
                                  if(response.status == 1){
                                    alert('action successful');
                                    $("#preloader").hide();
                                    location.reload();
                                }else if(response.status == 3){
                                             alert('Invoices generated');
                                               $("#preloader").hide();
                                             var newWin = window.open(); 
                                             newWin.document.write(response.invoices);
                                             newWin.document.close();
                                             newWin.focus();
                                             newWin.print();
                                             
                                             
                                }
                            },
                            error: function(response){

                             }
                     });
        }else{
            alert('Please select some orders ');
        }
 
}


  $(document).on("click","#print_button",function(){
      
    var keys = $('#grid').yiiGridView('getSelectedRows');
    
    var option =  $('input[name=option]:checked').val();
    var index_of = $('input[name=print_index]').val() ;
    var id = $('input[name=flag]').val() ;
   
    var just = 0 ;
            if(option == 1){
                if(keys.length==0) {
                         alert('Please select orders first to print selected stickers !');
                         $('#modal').modal('hide');
                         just = 1 ;
                   }
            }
            
      if(just == 0){
                var newWin = window.open();  
                    jQuery.ajax({ 
                        type: 'post',
                        url: url+'orders/printorders',
                        data: {_csrf: csrfToken,id: id,keylist:keys,option:option,dex:index_of},
                        datatype: 'json',
                        success: function (response) {
                            if(response.status == 1){
                                     newWin.document.write(response.content);
                                     newWin.document.close();
                                     newWin.focus();
                                     newWin.print();
                                   // newWin.close();
                                    $('#modal').modal('hide');
                             
                         
                       
                            }
                        },
                        error: function(response){

                         }
                     });
      }
      
           
  });
  
  
  $("#select_user").autocomplete({ 
               appendTo: ".srch_place",
               source: url + 'orders/select-user',
               select: function (e, ui) { 
                      $("#buyer_id").val(ui.item.type);
           },
        })._renderItem = function(ul, item) {

            if(item.value != ''){
                return $('<li>')
                .append('<a>'+item.value+'</a>')
                .appendTo(ul);
            }else{
                return $('<li>')
                .append('<a>No results found</a>')
                .appendTo(ul);
            }
        };
        
        
        $(document).on("click", "#select_User_next", function () {
    if ($('#buyer_id').val()) {
        select_address();
    } else {
        alert('Please select the User');
    }
});

$(document).on("click","#add_address_prev",function(){
             $('input[name=address_id]').val(''); 
             $('#select_user_div').show() ;
             $('#select_address').hide() ;
  });
  
  $(document).on("click","#add_address_prev_2",function(){
             $('input[name=address_id]').val(''); 
             $('#select_address').hide() ;
              $('#select_meal').show() ;
  });
  
  
   $(document).on("click","#meals_prev",function(){
                $(".meal_id").val('');
                $(".select_meal").val('');
                $(".meal_quant").val(1);
             $('#select_address').show() ;
             $('#select_meals').hide() ;
  });
   $(document).on("click","#remove_div",function(){
                $(this).parents('.produ').remove();
  });
   $(document).on("click","#pre_last",function(){
                $('input[name=order_id]').val() ;
                 $('#confirm_the_order').hide() ;
                $('#select_meals').show() ;
  });
  
   $(document).on("click","#pre_last_new",function(){
                $('input[name=order_id]').val() ;
                 $('#confirm_the_order').hide() ;
               $('#select_address').show() ;
  });
  
  $(document).on("click","#add_address_next",function(){
       if($('input[name=address_id]').val()){
           var uid = $('#buyer_id').val() ;
            jQuery.ajax({ 
                        type: 'post',
                        url: url+'orders/check-cart',
                        data: {_csrf: csrfToken,id: uid},
                        datatype: 'json',
                        success: function (response) {
                            if(response.status == 'success'){
                                $("#product_list").append(response.data); 
                                $('#select_address').hide() ;
                                $('#select_meals').show() ;
                            } else {
                                return false;
                            }
                        } ,
                        error: function(response){

                         }
                     });
              
        }else{
            alert('Please select a address / or add new address');
        }
    
  });
  
  
  
  $(document).on("click","#products_next",function(){
          var values = [];
            $("input[name='products[]']").each(function(){
                 values.push($(this).val());
            });
           
            if(values.length){
                 $('#select_meals').hide() ;
                  select_address();
                //   $('#select_address').show() ;
             }else{
                 alert('Please add some products to place the order');
             }
            
//       if($('input[name=address_id]').val()){
//             
//        }else{
//            alert('Please select a address / or add new address');
//        }
    
  });

function select_address(){
    var buyer_id =  $('#buyer_id').val() ;
        jQuery.ajax({ 
            type: 'post',
            url: url+'orders/getuseraddress',
            data: {_csrf: csrfToken,id: buyer_id },
            datatype: 'json',
            success: function (response) {
                if(response.status == 1){
                     $('#select_user_div').hide();
                     $('#all_addresses').html(response.data);
                     $('#select_address').show();
                }

            },
            error: function(response){

             }
     });
  }
  
  $(document).on("click","#add_address",function(){
      
      var buyer_id =  $('#buyer_id').val() ;
      
     jQuery.ajax({
             type: 'POST',
             datatype: 'json',
             url: url+'orders/add-addr',
             data: {_csrf: csrfToken,user_id:buyer_id}, 
             success: function (response) {
                 $('#modal').modal('show');
                 $('#modaluser').html(response);
                 $( "select#city" ).html( response.option );
                 $(".selectpicker").selectpicker("refresh");  

           }
             
         });
  });
  
  
//  $('body').on('beforeSubmit', 'form#address-add-form', function () {
//       $.post(
//               $(this).attr("action") ,
//               $(this).serialize()
//                ).done(
//                function(result){   
//                   
//                    if(result.status == 0){
//                        alert(result.error) ;
//                    }else if(result.status == 1) {
//                         $('#modal').modal('hide');
//                         select_address() ;
//        
//                    }
//                }).fail(function(){
//                   
//                });
//                return false ;
//        
//        
//    });

  $('body').on('beforeSubmit', 'form#create-order-form', function () {
//      if($('.meal_id').val()){
           $.post(
               $(this).attr("action") ,
               $(this).serialize()
                ).done(
                function(response){
//                   if(response.status == 1){
                   $('#all_data').html(response.data) ;
                   $('input[name=order_id]').val(response.order_id) ;
                   $('#confirm_the_order').show() ;
                   $('#select_meals').hide() ;
                   $('#select_address').hide() ;
                   $("#confirm_order").attr("onclick","Checkout("+response.pm+","+response.user+")");
//                }else if(response.status == 2){
//                    alert('User account balance low.');
//                }
                }).fail(function(){
                   
                });
//      }else{
//          alert('please Enter A meal to place order');
//      }
       
      return false ;
        
        
    });
    
    $(document).ready(function(){
     $('#updateStatus').click(function(){
         subs($(this).attr('dataStatus'));
     });
     
     $("#add_user").click(function(){
 
         jQuery.ajax({
             type: 'get',
             datatype: 'json',
             url: url+'user/cuser',
             data: {_csrf: csrfToken}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
             success: function (response) {
                 $('#modal').modal('show');
                 $('#modaluser').html(response);
           }
             
         });
         
         
     });
     
 });
 
  $('body').on('beforeSubmit', 'form#create-user', function () {
        $.post(
               $(this).attr("action") ,
               $(this).serialize()
                ).done(
                function(result){
                    if(result.status == 0){
                        alert(result.error) ;
                    }else if(result.status == 1) {
                          if($('#add_user').attr('location_id')){
                              alert('User Created');
                               $('#modal').modal('hide');
                          //    setTimeout( function(){ window.location.href = url+'/orders/index' } , 1000 );
                        }else{
                                $('#buyer_id').val(result.user_id) ;
                                $('#select_user').val(result.fname) ;
                                $('#modal').modal('hide');
                                select_address() ; 
                        }
                    }
                  
                    
                }).fail(function(){
                   
                });
                return false ;
        
        
    });
    
 function Generateorder(){
     var userid = $("#user_id").val();
     var pay_m = $("#pay_method").val();
     jQuery.ajax({
             type: 'POST',
             datatype: 'json',
             url: url+'order/createorder',
             data: {_csrf: csrfToken,uID:userid,pm:pay_m}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
             success: function (response) {
                 $('#modal').modal('show');
                 $('#modaluser').html(response);
           }
             
         });
 }

$(function() {
   $("#searc").click(function(){
   
                var cat = $("#cate").val();
                var size = $("#subcat").val();
       $( "#searc" ).autocomplete({
                source: url+'orders/auto',
                //minLength: 2,
                    select: function(event, ui) {
                        event.preventDefault();
                        $(this).val(ui.item.label);
                        //window.location="#"; //location to go when you select an item
                    },
                    focus: function(event, ui) {
                        event.preventDefault();
                        $(this).val(ui.item.label);
                    },

            }).data('ui-autocomplete')._renderItem = function(ul, item) {
                if(item.category != ''){
                return $('<li id="product-auto" class="update-li-d">')
                .append('<img src="'+item.imgurl+'" />')
                .append('<a>'+item.label+' by '+item.farmer+'</a></n>')
                .append('<p style="margin-left:0;"><b>SKU NO :- </b>'+item.sku+'</p></n>')
                .append('<p style="margin-left:0;"><b>MRP :- </b>'+item.mrp+'</p></n>')
                .append('<p style="margin-left:0;color:red;"><b>Quantity left :- </b>'+item.quantity+'</p></n>')
                .appendTo(ul);
                }else{
                    return $('<li>')
                    .appendTo(ul);
                }
            };
            $( "#searc" ).autocomplete({
          select: function( event, ui ) {
                var valuee = ui.item.pid;
                var current_val = $('#p_ids').val();
                var string_to_array = current_val.split(",");
                var new_val_array = 
//                    jQuery.grep(string_to_array, function(value) {
//                        if(value == valuee){
//                            return false;
//                        }
//                        return value != valuee;
//                    });
//                    var new_val = new_val_array.join(',');
//
//                     if(new_val !== ''){
//                        var all_ids = new_val+','+valuee;
//                    }else{
//                        var all_ids = valuee;
//                    }
                    
//                alert(selectedid);
                jQuery.ajax({
                    type: 'post',
                    url: url + 'orders/selecteditem',
                    datatype: 'json',
                    data: {_csrf: csrfToken, pId: valuee, allP:current_val}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    beforeSend: function () {
                         $("#searc").val(""); 
                    },
                    success: function (response) {
                        if (response.status == 'success') {
                             $("#searc").val(""); 
                              $("#product_list").append(response.data); 
//                              $('#p_ids').val(all_ids);
                            if(response.flag == 0){
                                $('#p_ids').val(response.ids);
                            }
                        } else if (response.status == 'failed') {

                        }
                    },
                    error: function (responce) {
                    }
                });
          }
        });
   });
    
});
function removeProduct(val){
    
//                var valuee = ui.item.pid;
                var current_val = $('#p_ids').val();
                var string_to_array = current_val.split(",");
                var new_val_array = 
                    jQuery.grep(string_to_array, function(value) {
                        return value != val;
                    });
                    var new_val = new_val_array.join(',');
                    $('#p_ids').val(new_val);
                    $('.box'+val).remove();
//                alert(selectedid);
//                jQuery.ajax({
//                    type: 'post',
//                    url: url + 'orders/selecteditem',
//                    datatype: 'json',
//                    data: {_csrf: csrfToken, pId: val, allP:new_val}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
//                    beforeSend: function () {
//                         $("#searc").val(""); 
//                    },
//                    success: function (response) {
//                        if (response.status == 'success') {
//                             $("#searc").val(""); 
//                              $("#product_list").html(response.data); 
//                        } else if (response.status == 'failed') {
//
//                        }
//                    },
//                    error: function (responce) {
//                    }
//                });
}
    
    $(document).on('click','#modelpopup',function(){
        var oid = $(this).attr('data-date');
        $.get('view2',{'id':oid},function(data){
            $('#modal').modal('toggle')
                .find('#modalContent')
                .html(data);
        });
        
         
    });
  
  
  function AddAddress(val){
       jQuery.ajax({
            type: 'post',
            url: url + 'orders/add-new-address',
            datatype: 'json',
            data: {_csrf: csrfToken, uId: val}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            beforeSend: function () {
                 $("#searc").val(""); 
            },
            success: function (response) {
                if (response.status == 'success') {
                    $( "#add_form" ).html(response.data);
                    $("#prime-modal2").show();
                } else if (response.status == 'failed') {

                }
            },
            error: function (responce) {
            }
        });
  }


/*
 * MANAGE CITY
 */
 $(function () {
                function initSortable() {                    
                    $("ul.droptrue").sortable({  
                        connectWith: "ul"
                    });
                }

                initSortable();

                $(".btn1")
                        .button()
                        .click(function (event) {
                            event.preventDefault();
                        });

                function addNewLocation() {
                    var valid = true;
                    if (valid) {
                        selectedList = $('#zoneList').find(":selected").text();
                        box = $('div').find("[data-title='" + selectedList + "']");
                        boxList = box.find('ul');
                        var locationValue = $('#LocationName').val();
                        boxList.append("<li class=\"ui-state-highlight\">" + locationValue + "</li>");
                        dialog.dialog("close");
                    }
                    return valid;
                }

                dialog = $("#dialog-form-location").dialog({
                    autoOpen: false,
                    height: 380,
                    width: 350,
                    modal: true,
                    buttons: {
                        "Create New Location": addNewLocation,
                        Cancel: function () {
                            dialog.dialog("close");
                        }
                    },
                    close: function () {
//                        $("#dialog-form")[0].reset();
//                        allFields.removeClass("ui-state-error");
                    }
                });

                function addNewZone() {
                    bodyWidth = $("body").width();
                    nextWidth = bodyWidth + 300;
                    $('body').css('width', nextWidth + 'px');

                    var zoneName = $('#zonename').val();
                    var zoneVal = zoneName.replace(/\s/g, '')
                    
                    $("div.zoneListWrapper").append("<div class=\"column\">" +
                            "<div class=\"box\" data-title=\"" + zoneName + "\">" +
                            "<div class=\"header\">" +
                            "    " + zoneName +
                            "</div>" +
                            "<div class=\"body\">" +
                            "    <ul class=\"droptrue\">" +
                            "    </ul>" +
                            "</div>" +
                            "</div></div>");
                    
                    $('#zoneList').append( $('<option></option>').val(zoneVal).html(zoneName) );
                    
                    initSortable();

                    dialogList.dialog("close");
                }

                dialogList = $("#dialog-form-zone").dialog({
                    autoOpen: false,
                    height: 250,
                    width: 350,
                    modal: true,
                    buttons: {
                        "Create New Zone": addNewZone,
                         Cancel: function () {
                            dialogList.dialog("close");
                         }
                    },
                    close: function () {
//                        $("#dialog-form-list")[0].reset();
//                        allFields.removeClass("ui-state-error");
                    }
                });

                form = dialog.find("formLocation").on("submit", function (event) {
                    event.preventDefault();
                    addNewLocation();
                });

                form = dialog.find("#formZone").on("submit", function (event) {
                    event.preventDefault();
                    addNewZone();
                });

                $("#btnCreateNewLocation").button().on("click", function () {
                    dialog.dialog("open");
                });

                $("#btnCreateNewZone").button().on("click", function () {
                    dialogList.dialog("open");
                });
            });

$(document).on("change","#city",function(){ 
    
     $("#other_locality").parents('#other_input').find('.help-block').html(''); 
     $("#other_locality").parents('#other_input').find('.help-block').css('display','none');   
    
    if($(this).val() == -1){
         $("#other_input").show();
    }else{
         $("#other_input").hide();
          $("input[id=other_locality]").val('');
    }
     
    
});

 function  removeItem(u,product_ID,flag){
        jQuery.ajax({
            type: 'post',
            url: url+'orders/remove-item',
            datatype: 'json',
            data: {_csrf: csrfToken, pId:product_ID ,flag:flag,user:u}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            beforeSend:function(){
            },
            success: function (response) {
                if(response.status == 1){
                    
                    
                    
                        if(response.part == 0){
                            
                              $(".buy_but"+product_ID).show() ;
                              $(".box"+product_ID).hide() ;
                          
                            
                                $(".unique"+product_ID).html('Add to cart');
                                $(".unique"+product_ID).addClass('add-to-cart');
                                  
                                $(".unique"+product_ID).css('border-color','#cccccc');
                                $(".unique"+product_ID).css('background-color','#ffffff');
                                $(".unique"+product_ID).css('color','#777777');
                              
//                              $(".unique"+product_ID).parents('.btn-animated').css('border-color','#888');
//                              $(".unique"+product_ID).parents('.btn-animated').css('background-color','#fff');
//                              $(".unique"+product_ID).children('.add_text').css('color','#888');

//                               $(".btn-default.unique"+product_ID).children('.add_text').css('color','#fb641b');
//
//
//                               $(".btn-default.unique"+product_ID).css('border-color','#fb641b');
//                               $(".btn-default.unique"+product_ID).css('background-color','#fff');
                         }
                      
                         str =  window.location.href;
                    
                             location.reload() ;
                    
                    if(response.count == 0)
                    {
                          $('#open_fu_cart').html('');
                    }
                   else
                   { 
                         $('#open_fu_cart').html('<span class="cart-count" >'+response.count+'</span>');
                   }
                     
//                if(response.part == 0){
//                    $('#button_'+product_ID).html('<button class="add-value show-checkoutbox green-btn" type="submit" value="'+product_ID+'" >Add to cart</button>');
//                    $('#pre'+product_ID).remove();
//                }
                 $("input[name=input_quant"+product_ID+"]").val(response.quant) ;
                 
               //   $("input[name="+product_ID+"]").val(response.quant) ;
               }
               
            },
            error: function(response){
            }
        });
    }
    
    function addtocart(u,product_ID,type) {
        jQuery.ajax({
            type: 'post',
            url: url+'orders/add-to-cart',
            datatype: 'json',
            async: false,
            data: {_csrf: csrfToken, pId: product_ID,type:type,user:u},
            beforeSend:function(){
            },
            success: function (response) {
                if(response.status == 1){
                        location.reload() ;
                   }
                 else if(response.status == 2){
                       $(".unique"+product_ID).html('Out Of Stock');
                   //   alert("No more available");
                 }  
                },
            error: function(response){
              
            }
        });
      
    }
    function Checkout(val,uid){
        
        var sp = $('#spi').val();
        var vat = $('#replaced_with').val();
        var type  =  $('input[name=type]').val();
        
        jQuery.ajax({
            type: 'post',
            url: url+'orders/checkout',
            datatype: 'json',
            async: false,
            data: {_csrf: csrfToken, pay_method: val,user:uid,spI:sp,vat:vat,type:type},
            beforeSend:function(){
                $('#preloader').show();
            },
            success: function (response) {
                if(response.status == 1){
                        location.reload() ;
                   }
                 else if(response.status == 2){
                       $(".unique"+product_ID).html('Out Of Stock');
                   //   alert("No more available");
                 }  
                },
            error: function(response){
              
            }
        });
    }
    function CheckCoupon(val){
        var user_id = $('#buyer_id').val();
        jQuery.ajax({
            type: 'post',
            url: url+'orders/checkcoupon',
            datatype: 'json',
            async: false,
            data: {_csrf: csrfToken, cId: val,user:user_id},
            beforeSend:function(){
            },
            success: function (response) {
                if(response.status == 0){
                        $('#err').html('already used this coupon Code');
                        $(".selectpicker").val('');
                        $(".selectpicker").selectpicker("refresh");
                        
                   }
                 else if(response.status == 1){
                      return true;
                 }  
                },
            error: function(response){
              
            }
        });
    }
    $(window).on('load',function(){ 
         str =  window.location.href;
        if(str.indexOf("orders/index")  >= 0){
                $('body').addClass("sidebar-collapse");
        }else if(str.indexOf("orders/dispatched")  >= 0){
                $('body').addClass("sidebar-collapse");
        }
       
    });
    function hide_and_seek(){
    
      if ($("#all_data").is(":visible")) {
            $("#all_data").hide();
            $("#toggle_data").html("Show Data");
        }
        else {
             $("#all_data").show();
              $("#toggle_data").html("Hide Data");
        };
}

function change_status(){
    var action_value = $("#status_action").val();
    if(action_value == 3){
          delay_message(action_value);
    }else if (action_value == 77){
          messagePopup();
    }else{
         sub_order_action(action_value) ;
    }
}

function change_status_parent(){
    var action_value = $("#status_action").val();
    if(action_value == 3){
        delay_message(action_value);
    }else if (action_value == 77){
          messagePopup();
    }else{
          order_action(action_value) ;
    }
}


 $("#check_all_perishables").click(function(){
    if($(this).is(':checked')){
        $(".non_perishable").attr("checked",true);
    }else{
        $(".non_perishable").attr("checked",false);
    }
});

$("#check_all_perishables2").click(function(){
      
    if($(this).is(':checked')){
            $(".non_perish").attr("checked",true);
    }else{
            $(".non_perish").attr("checked",false);
    }
});

function resend_link(order_id){
        $('#alertmodel').hide();
        jQuery.ajax({
            type: 'post',
            url: url+'orders/resend-link',
            datatype: 'json',
            async: false,
            data: {_csrf: csrfToken,order_id:order_id},
            beforeSend:function(){
                   $("#preloader").show() ;
            },
            success: function (response) {
                if(response.status == 1){
                      $("#preloader").hide() ;
                        alert("Instamojo link sent");
                        
                   }
               },
            error: function(response){
              
            }
        });
  
}

function initiate_refund(order_id,sub_order_id){
    
       jQuery.ajax({
            type: 'post',
            url: url+'orders/refund-detail',
            datatype: 'json',
            async: false,
            data: {_csrf: csrfToken,order_id:order_id,sub_order_id:sub_order_id},
            beforeSend:function(){
                        //     $("#preloader").show() ;
            },
            success: function (response) { 
                if(response.status == 1){
                     // $("#preloader").hide() ;
                      $("#refund_choose").html(response.str) ;
                      $("#refund_button").show();
                      $("#refundModal").show('slow');
                      $("#mark_button").hide();
                    
                        
                   }
               },
            error: function(response){
              
            }
        });
}

function close_refund(){
     $("#refundModal").hide();
}
function refund_action(){
  var order_id = $('input[name=refund_order_id]:checked').val() ;
  var amount = $('input[name=amount]').val() ;
  var go_ahead = 1 ;
  
        if($('input[id=custom_id]').is(":checked")){
             var flag = 1 ;
             
             if(amount){
                 go_ahead = 1 ;
             }else{
                  go_ahead = 0 ;
             }
             
        }else{
             var flag = 0 ;
        }
        
     if(go_ahead == 1){
           jQuery.ajax({
               type: 'post',
               url: url+'orders/refund-action',
               datatype: 'json',
               async: false,
               data: {_csrf: csrfToken,order_id:order_id,flag:flag,amount:amount},
               beforeSend:function(){
                              $("#refund_choose").html('') ;
                              $("#refund_button").hide();
                              $("#refundModal").hide();
                              $("#preloader").show() ;
               },
               success: function (response) { 
                   if(response.status == 1){
                        $("#preloader").hide() ;
                         alert("Refund initiated for amount "+response.amount);
                       setTimeout(function() {
                          location.reload();
                       },1000);
                     }
                  },
               error: function(response){

               }
           });
     }else{
         alert('Please Enter amount to be refunded');
     }

    
}

function mark_refund(order_id,sub_order_id){
     $("#refund_choose").html("<table class='table table-striped table-bordered detail-view' ><thead></thead><tbody><tr><td>This sub order only</td><td><input type='radio' checked name='choose' value="+sub_order_id+" ></td></tr><tr><td>Total Order</td><td><input type='radio' checked name='choose' value="+order_id+" ></td></tr></tbody></table>") ;
     $("#refundModal").show('slow');
     $("#mark_button").show();
       $("#refund_button").hide();
}

function mark_action(){
     
    var order_id =  $('input[name=choose]:checked').val() ;
    
          jQuery.ajax({
            type: 'post',
            url: url+'orders/mark-refund',
            datatype: 'json',
            async: false,
            data: {_csrf: csrfToken,order_id:order_id},
            beforeSend:function(){
                    $("#refund_choose").html("") ;
                    $("#refundModal").hide();
                    $("#mark_button").hide();
                    $("#preloader").show() ;
            },
            success: function (response) { 
                if(response.status == 1){
                     $("#preloader").hide() ;
                    setTimeout(function() {
                       location.reload();
                    },1000);
                    
                        
                   }
               },
            error: function(response){
              
            }
        });
}

function create_tasks(signal,task_date,val){
    
    if(val == 5){
     var inputs = $('#grid').yiiGridView('getSelectedRows');
        if(inputs.length != 0){
            jQuery.ajax({
                type: 'post',
                url: url+'orders/create-task',
                datatype: 'json',
                async: false,
                data: {_csrf: csrfToken,signal:signal,date:task_date,ids:inputs,type:val},
                beforeSend:function(){
    //                    $("#refund_choose").html("") ;
    //                    $("#refundModal").hide();
    //                    $("#mark_button").hide();
                        $("#preloader").show() ;
                },
                success: function (response) { 
                    if(response.status == 1){
                        //$("#preloader").hide() ;
                        alert('Tasks created for tookan');
    //                    setTimeout(function() {
    //                       location.reload();
    //                    },1000);
    //                    
                       }else{
                            alert('Sorry,Something went wrong');
                       }
                          $("#preloader").hide() ;
                   },
                error: function(response){

                }
            });
        }else{
            alert('Please select some orders ');
        }
    }else{
        jQuery.ajax({
                type: 'post',
                url: url+'orders/create-task',
                datatype: 'json',
                async: false,
                data: {_csrf: csrfToken,signal:signal,date:task_date,type:val},
                beforeSend:function(){
    //                    $("#refund_choose").html("") ;
    //                    $("#refundModal").hide();
    //                    $("#mark_button").hide();
                        $("#preloader").show() ;
                },
                success: function (response) { 
                    if(response.status == 1){
                        //$("#preloader").hide() ;
                        alert('Tasks created for tookan');
    //                    setTimeout(function() {
    //                       location.reload();
    //                    },1000);
    //                    
                       }else{
                            alert('Sorry,Something went wrong');
                       }
                          $("#preloader").hide() ;
                   },
                error: function(response){

                }
            });
    }
    $('#change_status').attr('style','display:block;');
   
    
}
function MakePrepaid(status,id){ 
  
            jQuery.ajax({
            type: 'post',
            url: url+'user/prepaid-member',
            data: {_csrf: csrfToken,type: status,Uid: id },
            datatype: 'json',
            beforeSend: function() {
                $("#preloader").show() ;
              },
            success: function (response) {
                  $("#preloader").hide();
                location.reload();
            },
            error: function(response){

             }
        });
}
function AddNotes(val,oId){
    $('#orderId').html(oId);
    $('#order-id').val(val);
    $("#noteModal").show('slow');
}
function close_pop2(){
    $('#noteModal').hide();
}
function AddOrderNotes(){
    var note = $('#note').val();
    var id = $('#order-id').val();
    if(note == ''){
        alert('Note cann`t be blank.. ');
        return false;

    }else{

    }
     jQuery.ajax({
            type: 'post',
            url: url+'orders/add-notes',
            data: {_csrf: csrfToken,oId: id,notes: note },
            datatype: 'json',
            beforeSend: function() {
                $("#preloader").show() ;
              },
            success: function (response) {
                  $("#preloader").hide();
                location.reload();
            },
            error: function(response){

             }
        });
}
function messagePopup(val){
    $("#SendmessageModal").show('slow');
}
function sendMessage(){ 
 
     var value = $("#n_message").val();
        if(value == ''){
            alert('Message cann`t be blank.. ');
            return false;
            
        }else{
            
        }
        var inputs = $('#grid').yiiGridView('getSelectedRows');
         
//        var obj = inputs;
//        var arr = Object.keys(obj).map(function (key) { return obj[key]; });
        //alert(arr);
      
        if(inputs.length != 0){
            jQuery.ajax({ 
                            type: 'post',
                            url: url+'orders/send-message',
                            data: {_csrf: csrfToken,data:inputs,message:value},
                            datatype: 'json',
                          beforeSend: function() {
                                $("#preloader").show() ;
                                $("#d_message").val('');
                                $("#exampleModal").hide('slow');
                              },
                            success: function (response) {
                                if(response.status == 'success'){
                                  $("#preloader").hide();
                                   location.reload();
                               }
                              
                            },
                            error: function(response){

                             }
                     });
        }else{
            alert('Please select some orders ');
        }
}
function sendMessageparent(){ 
    
     var value = $("#n_message").val();
        if(value == ''){
            alert('Message cann`t be blank.. ');
            return false;
            
        }else{
            
        }
       var inputs = $('.all_subs:checkbox:checked').map(function () {
           return this.value;
          }).get();
        if(inputs.length != 0){
            jQuery.ajax({ 
                            type: 'post',
                            url: url+'orders/send-message',
                            data: {_csrf: csrfToken,data:inputs,message:value},
                            datatype: 'json',
                          beforeSend: function() {
                                $("#preloader").show() ;
                                $("#d_message").val('');
                                $("#exampleModal").hide('slow');
                              },
                            success: function (response) {
                                if(response.status == 'success'){
                                  $("#preloader").hide();
                                   location.reload();
                               }
                              
                            },
                            error: function(response){

                             }
                     });
        }else{
            alert('Please select some orders ');
        }
}
function changeDate(val){
     jQuery.ajax({
            type: 'post',
            url: url+'site/order-details',
            datatype: 'json',
            data: {_csrf: csrfToken,id:val}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            beforeSend:function(){
               
            },
            success: function (response) {
               if(response.status == 'success'){
                   $('.refund').html(response.refund);
                   $('.del').html(response.del);
                   $('.placed').html(response.placed);
                   $('.can').html(response.cancel);
               }else{
                   $('.err').html('This Verification code is wrong');
               }
            },
            error: function(response){
            }
        });
}

function create_tookan_tasks(){
      var tookan_value = $("#tookan_status_value").val();
      var task_date =  $("#task_date").val();
      if(task_date){
           create_tasks(tookan_value,task_date);
      }
     
}

function export_file(){
    
        var tookan_value = $("#tookan_status_value").val();
     
        if(tookan_value == 1){
              document.getElementById('export_pre_dispatched').click();
        }else if (tookan_value == 2){
              document.getElementById('export_dispatched').click();
        }
}




function display_format_data(){
        var tookan_value = $("#tookan_status_value").val();
        if(tookan_value == 1){
              document.getElementById('display_pre_dispatched_format').click();
        }else if (tookan_value == 2){
              document.getElementById('display_dispatched_format').click();
        }
}

function export_action(){
     var tookan_value = $("#tookan_status_value").val();
     var action_value = $("#action_status_value").val();
     
     if(action_value == 1){
        var task_date =  $("#task_date").val();
        if(task_date){
             create_tasks(tookan_value,task_date,1);
        }
     }else if(action_value == 2){
        if(tookan_value == 1){
              document.getElementById('export_pre_dispatched').click();
        }else if (tookan_value == 2){
              document.getElementById('export_dispatched').click();
        }
     }else if(action_value == 5){
        var task_date =  $("#task_date").val();
        if(task_date){
             create_tasks(tookan_value,task_date,5);
        }
     }else if(action_value == 3){
        if(tookan_value == 1){
              document.getElementById('export_pre_dispatched_format').click();
        }else if (tookan_value == 2){
              document.getElementById('export_dispatched_format').click();
        }
     }else if(action_value == 4){
          if(tookan_value == 1){
             flag = 0 ;
        }else if (tookan_value == 2){
              flag = 1 ;
        }
         
                  var newWin = window.open();  
                    jQuery.ajax({ 
                        type: 'get',
                        url: url+'orders/formatted-data',
                        data: {_csrf: csrfToken,flag:flag,d:1},
                        datatype: 'json',
                        success: function (response) {
                            if(response.status == 1){
                                     newWin.document.write(response.content);
                                     newWin.document.close();
                                     newWin.focus();
                                     newWin.print();
                            }
                        },
                        error: function(response){

                         }
                     });
     }
     
}

 $('body').on('keypress','.ui-autocomplete-input', function(){
     wi = $(this).width();
     $('.ui-autocomplete').css({
         maxWidth: wi+'px'
     });
 });


 $(document).on("change","#action_status_value",function(){
    
     var options  = $(this).val() ;
   //   $("#selection_perish").hide() ;
   //   $("#selection_non_perish").hide() ;
   
//     if(options.search("1") != -1){
//            $("#selection_perish").show() ;
//     }
//     
//     if(options.search("2") != -1){
//          $("#selection_non_perish").show() ;
//     }
    
 });
 
 
 $(document).on("click",".update_location",function(){
        var location_id = $(this).val();
         jQuery.ajax({
             type: 'post',
             datatype: 'json',
             url: url+'orders/loc',
             data: {_csrf: csrfToken,location_id:location_id},
             success: function (response) {
//                    if(response.status == 1){
//                            alert('Updated');
//                    }
              }
            });
    });
    
//    $(document).on("click",".update_location",function(){
//        var location_id = $(this).val(); 
//         jQuery.ajax({
//             type: 'post',
//             datatype: 'json',
//             url: url+'orders/loc',
//             data: {_csrf: csrfToken,location_id:location_id},
//             success: function (response) {
////                    if(response.status == 1){
////                            alert('Updated');
////                    }
//              }
//            });
//    });
    
  function initiate_replacement(id){
      
     var replaced_with = $("#replace"+id).val();
    
        jQuery.ajax({
            type: 'post',
            url: url+'orders/replace',
            datatype: 'json',
            async: false,
            data: {_csrf: csrfToken,replaced_with:replaced_with,order_id:id},
            beforeSend:function(){
                             $("#preloader").show() ;
            },
            success: function (response) { 
                if(response.status == 1){
                    alert('Order Replaced');
                     $("#preloader").hide() ;
                 }
               },
            error: function(response){
              
            }
        });
  }  
  
 $(document).on("change","#pay_method_choose",function(){
        var vat = $(this).val();
        
        if(vat == 7){
                $('#pe_shock').show();
        }else{
            $('#pe_shock').hide();
        }
    });
function dateWiseData(){
    var d = $("#mydate").val();
     jQuery.ajax({
        type: 'post',
        url: url+'site/get-data-datewise',
        datatype: 'json',
        async: false,
        data: {_csrf: csrfToken,date:d},
        beforeSend:function(){
        },
        success: function (response) { 
            if(response.status == 'success'){
                $("#ru").html(response.regUser);
                $("#ru").attr('style','background:#333;color:#fff;');
                $("#tu").html(response.trUser);
                $("#tu").attr('style','background:#333;color:#fff;');
                $("#ocount").html(response.orders);
                $("#ocount").attr('style','background:#333;color:#fff;');
                $("#rev").html(response.rev);
                $("#rev").attr('style','background:#333;color:#fff;');
                
                setTimeout(function() {
                    $("#ru").attr('style','background:#fff;color:#333;');
                    $("#tu").attr('style','background:#fff;color:#333;');
                    $("#ocount").attr('style','background:#fff;color:#333;');
                    $("#rev").attr('style','background:#fff;color:#333;');
                }, 10000);
             }
           },
        error: function(response){

        }
    });
}


function saveAddress(formid){ 
    
    
    var name = $('#usersaddresses-contact_person_name').val();
    var phone = $('#usersaddresses-contact_person_phone').val();
    var add = $('#usersaddresses-address_1').val();
    var locality = $('#geocomplete').val();
    var lat = $('#latitude').val();
    var pincode = $('#usersaddresses-pin_code').val();
     
    if(name == ''){
        $('.field-usersaddresses-contact_person_name .help-block').html('Contact Person Name cannot be blank.');
        $('#name').attr('style','border-bottom: 1px solid red;');
        return false;
    }
    
    if(phone == ''){
        $('.field-usersaddresses-contact_person_phone .help-block').html('Contact Person Phone cannot be blank.');
        $('#phonennumber').attr('style','border-bottom: 1px solid red;');
        return false;
    }else{
        if(isNaN(phone)){
             $('.field-usersaddresses-contact_person_phone .help-block').html('Not a Valid number.');
             $('#phonennumber').attr('style','border-bottom: 1px solid red;');
              return false;
        }else{
           if(phone.length != 10){
                    $('.field-usersaddresses-contact_person_phone .help-block').html('Not a Valid number.');
                    $('#phonennumber').attr('style','border-bottom: 1px solid red;');
                    return false;
             }
        }
    }
    if(add == ''){
        $('.field-usersaddresses-address_1 .help-block').html('Contact Person address cannot be blank.');
        $('#address').attr('style','border-bottom: 1px solid red;');
        return false;
    }
    if(locality == ''){
                $('.field-geocomplete .help-block').html('Please enter a location');
               return false;
    }else{
            if(lat == ''){
                    $('.field-geocomplete .help-block').html('Please enter a specific location');
                    return false;
             }
    }
   
   if(pincode == ''){
         $('.field-usersaddresses-pin_code .help-block').html('Please enter a pincode');
        return false;
   }else{
        if(isNaN(pincode)){
             $('.field-usersaddresses-pin_code .help-block').html('Please enter a valid pincode');
               return false;
        }else{
           if(pincode.length != 6){
                    $('.field-usersaddresses-pin_code .help-block').html('Please enter a valid pincode');
                 return false;
             }
        }
       
       var para = 0 ;
        jQuery.ajax({
                type: 'POST',
                url: url + 'user/checkpincode',
               datatype: 'json',
                async: "false",
                data: {_csrf:csrfToken,pincode:pincode},
               success: function (response) { 
                     if(response.status == 1){
                            subsaveaddress(formid);
                    }else{
                        para = 1 ;
                        $('.field-usersaddresses-pin_code .help-block').html('Sorry, we are currently not available in your area.');
                    }
                }
                
            });
            
         }
   
        if(para == 1){
              $('.field-usersaddresses-pin_code .help-block').html('Sorry, we are currently not available in your area.');
               return false ;
        }

   
}

function  subsaveaddress(formid){
    
        var form = $(formid).get(0); 
        var formdata = new FormData(form);
        formdata.append('_csrf', csrfToken);
        
        jQuery.ajax({
            type: 'POST',
            url: url + 'orders/add-addr',
            datatype: 'json',
            data: formdata, 
            contentType: false, 
            cache: false,
            processData: false,
            beforeSend: function () {
                $('#loader-circle').attr('style','display:block');
            },
            success: function (response) { 
                $('#loader-circle').attr('style','display:none');
                if(response.status == 1 ){
                        $('#name').val('');
                        $('#phonenumber').val('');
                        $('#address').val('');
                        $('#modal').modal('hide');
                        select_address() ;
                }else if(response.status == 0 ){
                    alert(response.error);
                }else if(response.status == 2 ){
                        $('#name').val('');
                        $('#phonenumber').val('');
                        $('#address').val('');
                        $('#modal').modal('hide');
                        select_address() ;
                        location.reload();
                }
            }
        });
    
    
}

$("#place-farmer-order").click(function(){
    var lot_no  = $("input[name=lot_no]").val();
    var order_quantity = $("input[name=quant_ord]").val();
    var date_of_order  = $("input[name=date_of_order]").val();
    var expected_date_of_arrival  = $("input[name=expected_arrival]").val(); 
    
    var  sku_no =  $("input[name=sku_no]").val() ;
    var  product_id =  $("input[name=product_id]").val() ;
    var  farmer_id =  $("input[name=farmer_id]").val() ;
    
    
    var quant_sent  = $("input[name=quant_sent]").val();
    var arrival_time_from = $("input[name=arrival_time_from]").val();
    var arrival_time_to  = $("input[name=arrival_time_to]").val();
    var contact_details  = $("#contact_details").val(); 
     var arrived_by  = $("#arrived_by").val();
     
     var remaining_action = $("#left_action").val();
    
    var  error = 0 ;
    
//    if(!(lot_no)){
//        error = 1 ;
//        alert('Please enter the lot no ');
//          return ;
//    }
    
     if(!(order_quantity)){
        error = 1 ;
        alert('Please enter the quantity ordered');
          return ;
    }
    
     if(!(date_of_order)){
        error = 1 ;
        alert('Please enter the day on which farmer ordered is placed ');
          return ;
    }
    
     if(!(expected_date_of_arrival)){
         error = 1 ;
         alert('Please enter the day on which farmer agreed to send the order  ');
         return ;
    }
    
     if(!(quant_sent)){
         error = 1 ;
         alert('Please enter the Quantity sent ');
         return ;
    }
     if(!(arrival_time_from)){
         error = 1 ;
         alert('Please enter the arrival time range ');
         return ;
    }
     if(!(arrival_time_to)){
         error = 1 ;
         alert('Please enter the arrival time range  ');
         return ;
    }
     if(!(contact_details)){
         error = 1 ;
         alert('Please enter the contact details ');
         return ;
    }
    
    if(error == 0){
              jQuery.ajax({
                type: 'POST',
                url: url + 'stock/updatestep1',
               datatype: 'json',
                async: "false",
                data: {_csrf:csrfToken,
                    lot_no:lot_no,
                    order_quantity:order_quantity,
                    date_of_order:date_of_order,
                    date_of_arrival:expected_date_of_arrival,
                    sku_no:sku_no,
                    product_id:product_id,
                    farmer_id:farmer_id ,
                    quant_sent:quant_sent,
                    arrival_time_from:arrival_time_from,
                    arrival_time_to :arrival_time_to ,
                    contact_details : contact_details ,
                    arrived_by:arrived_by,
                    remaining_action:remaining_action 
                    },
               success: function (response) { 
                     if(response.status == 1){
                            location.reload();
                     }
                }
                
            });
     }
     
   });
   
   $("#recieve-farmer-order").click(function(){
       
    var lot_no  = $("input[name=lot_no]").val();
    
     var recieved_on = $("input[name=recieved_on]").val();
     var quantity_recieved  = $("input[name=quant_re]").val();
     var quantity_damaged  = $("input[name=quant_dam]").val(); 
     var stock_id =  $("input[name=stock]").val() ;
     
      var remaining_action = $("#left_action2").val();
     var error = 0 ;
    
    if(!(recieved_on)){
        error = 1 ;
        alert('Please enter the date on which the famer order is recieved ');
        return ;
    }
    
     if(!(quantity_recieved)){
        error = 1 ;
        alert('Please enter the quantity recieved');
          return ;
    }
    
     if(!(quantity_damaged)){
        error = 1 ;
        alert('Please enter the quantity damaged');
          return ;
    }
    if(!(lot_no)){
        error = 1 ;
        alert('Please enter the lot no ');
          return ;
    }
    
    if(error == 0){
            jQuery.ajax({
                type: 'POST',
                url: url + 'stock/updatestep2',
               datatype: 'json',
                async: "false",
                data: {_csrf:csrfToken,recieved_on:recieved_on,quantity_recieved:quantity_recieved,quantity_damaged:quantity_damaged,stock_id:stock_id,remaining_action:remaining_action,lot_no:lot_no},
               success: function (response) { 
                     if(response.status == 1){
                            location.reload();
                     }
                }
                
            });
    }
      
   });
   

$("#change_status").click(function(){
    $(".step1input").attr('readonly','false');
    $("#place-farmer-order").show() ;
//    $(this).hide();
});

$("#send_orders").click(function(){
    var  stock_id =  $("input[name=stock]").val() ;
    var  flash = $("input[name=flash]:checked").val() ;
    var  flash_quant = $("input[name=flash_quantity]").val() ;
         jQuery.ajax({
                type: 'POST',
                url: url + 'orders/sendtopredisptach',
               datatype: 'json',
                async: "false",
                data: {_csrf:csrfToken,stock_id:stock_id,flash:flash,flash_quant:flash_quant},
               success: function (response) { 
                     if(response.status == 1){
                            location.reload();
                     }else if(response.status == 2){
                         alert("Flash Created");
                         location.reload();
                     }
                }
                
            });
});

$(function() {
        $('.picktime').timepicker({
            'interval': 30,
            'minTime': '01:00am',
            'maxTime': '23:00pm'
        });
});
 
 $("#edit_address").click(function(){
      var address_id =    $('input[name=address_id]:checked').val(); 
    
     jQuery.ajax({
             type: 'POST',
             datatype: 'json',
             url: url+'orders/add-addr',
             data: {_csrf: csrfToken,address_id:address_id}, 
             success: function (response) {
                 $('#modal').modal('show');
                 $('#modaluser').html(response);
                 $( "select#city" ).html( response.option );
                 $(".selectpicker").selectpicker("refresh");  

           }
        });
  });

//function calculate(){
//    var quant_sent  = $("input[name=quant_sent]").val();
//    var actual_placed = $('#quant_placed').html();
//    
//    if(parseInt(actual_placed) > parseInt(quant_sent)){
//       $("#left_action_div").show();
//    }else{
//        $("#left_action_div").hide();
//    }
//    
//}
//
function calculate2(){
    
    var quant_re  = $("input[name=quant_re]").val();
    var quant_dam  = $("input[name=quant_dam]").val();
//    var predispatch_count = $("input[name=predispatch_count]").val();
     
   var final = quant_re - quant_dam;
   $('#final').val(final);
    
}
 
 
 function StockSheetfilter(){
    var lot = $("#lot").val();
    var farmer = $("#farmer").val(); 
    var product = $("#product").val(); 
    var sku = $("#sku").val();
    
        if(lot){
           var l = lot;
        }else{
            if( farmer == null || farmer == ''){
                alert('Plese Select Farmer'); return false;
            }else if(product == null || product == ''){
                alert('Please Select Product'); return false;
            }else if(sku == null || sku == ''){
                alert('Please Select Sku Number'); return false; 
            }
           var l = '';
        }
        jQuery.ajax({
             type: 'get',
             datatype: 'json',
             url: url+'stock/filters',
             data: {_csrf: csrfToken,lot:l, skuno:sku}, 
             success: function (response) {
                if(response.status == 0){
                    alert('Data Not Found');
                }else{
                    window.location = url+'stock/create?id='+response.id;
                }

           }
        });
 }
 function getFarmerProduct(){
    var farmer = $("#farmer").val(); 
     jQuery.ajax({
             type: 'post',
             datatype: 'json',
             url: url+'stock/get-farmer-products',
             data: {_csrf: csrfToken,id:farmer,flag:2}, 
             success: function (response) {
                if(response.status == 1){
                    $('#product').html(response.data);
                    $('#product').selectpicker('refresh');
                }else{
                    alert('Data Not Found');
                }

           }
        });
 }
 function getChildProduct(){
    var product = $("#product").val(); 
     jQuery.ajax({
             type: 'post',
             datatype: 'json',
             url: url+'stock/get-farmer-products',
             data: {_csrf: csrfToken,id:product,flag:1}, 
             success: function (response) {
                if(response.status == 1){
                    $('#sku').html(response.data);
                    $('#sku').selectpicker('refresh');
                }else{
                    alert('Data Not Found');
                }

           }
        });
 }
 function saveStokInfo(val,formId){
    var quant = $('#quant_ord').val();
    var quant2 = $('#quantsent').val();
    var aTime = $('#aTime').val();
    var aTimeto = $('#aTimeto').val();
     if(val == 1){ 
        if(quant == ''){
             $('#quant_ord').after('<div class="red" style="color:red;">Order Quantity can not be blank.</div>');
             return false;
        }
     }else if(val == 2){
        if(quant2 == ''){
             $('#quantsent').after('<div class="red" style="color:red;">Sent Quantity can not be blank.</div>');
             return false;
        }
        if(aTime == '' || aTimeto == ''){
             $('#aTime').after('<div class="red" style="color:red;">Arrival Time can not be blank.</div>');
             return false;
        }
     }else if(val == 3){
         
     }
    var formdata = new FormData(formId[0]);
    formdata.append('_csrf', csrfToken);
    formdata.append('step', val);
    if(val == 2){
        var remaining_action = $("#left_action").val();
        formdata.append('remaining_action', remaining_action);
    }else if(val == 3){
        var remaining_action = $("#left_action2").val();
        formdata.append('remaining_action', remaining_action);
    }
    jQuery.ajax({
        type: 'post',
        url: url + 'stock/create-stock',
        data: formdata,
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
            if (response.status == 'success') {
                location.reload();
            }
        }

    }); 
 }
  $("#trans").focusout(function(){
        var totalprice = parseInt($("#totalprice").val());
        var transport = parseInt($("#trans").val());
        var transtohub = parseInt($("#hub").val());
        var pack = parseInt($("#pack").val());
        var other = parseInt($("#other").val());
        var lastmilede = parseInt($("#lastmilede").val());
        var replace = parseInt($("#replace").val());
        var advance = parseInt($("#advance").val());
        var farerpay = totalprice - (transport + transtohub + pack + other + lastmilede + replace + advance);
        $('#farmerpay').html(farerpay);
        $('.farmerpay').val(farerpay);
    });
$("#hub").focusout(function(){
        var totalprice = parseInt($("#totalprice").val());
        var transport = parseInt($("#trans").val());
        var transtohub = parseInt($("#hub").val());
        var pack = parseInt($("#pack").val());
        var other = parseInt($("#other").val());
        var lastmilede = parseInt($("#lastmilede").val());
        var replace = parseInt($("#replace").val());
        var advance = parseInt($("#advance").val());
        var farerpay = totalprice - (transport + transtohub + pack + other + lastmilede + replace + advance);
       $('#farmerpay').html(farerpay);
        $('.farmerpay').val(farerpay);
    });
$("#pack").focusout(function(){
        var totalprice = parseInt($("#totalprice").val());
        var transport = parseInt($("#trans").val());
        var transtohub = parseInt($("#hub").val());
        var pack = parseInt($("#pack").val());
        var other = parseInt($("#other").val());
        var lastmilede = parseInt($("#lastmilede").val());
        var replace = parseInt($("#replace").val());
        var advance = parseInt($("#advance").val());
        var farerpay = totalprice - (transport + transtohub + pack + other + lastmilede + replace + advance);
       $('#farmerpay').html(farerpay);
        $('.farmerpay').val(farerpay);
    });
$("#other").focusout(function(){
        var totalprice = parseInt($("#totalprice").val());
        var transport = parseInt($("#trans").val());
        var transtohub = parseInt($("#hub").val());
        var pack = parseInt($("#pack").val());
        var other = parseInt($("#other").val());
        var lastmilede = parseInt($("#lastmilede").val());
        var replace = parseInt($("#replace").val());
        var advance = parseInt($("#advance").val());
        var farerpay = totalprice - (transport + transtohub + pack + other + lastmilede + replace + advance);
       $('#farmerpay').html(farerpay);
        $('.farmerpay').val(farerpay);
    });
$("#lastmilede").focusout(function(){
        var totalprice = parseInt($("#totalprice").val());
        var transport = parseInt($("#trans").val());
        var transtohub = parseInt($("#hub").val());
        var pack = parseInt($("#pack").val());
        var other = parseInt($("#other").val());
        var lastmilede = parseInt($("#lastmilede").val());
        var replace = parseInt($("#replace").val());
        var advance = parseInt($("#advance").val());
        var farerpay = totalprice - (transport + transtohub + pack + other + lastmilede + replace + advance);
       $('#farmerpay').html(farerpay);
        $('.farmerpay').val(farerpay);
    });
$("#replace").focusout(function(){
        var totalprice = parseInt($("#totalprice").val());
        var transport = parseInt($("#trans").val());
        var transtohub = parseInt($("#hub").val());
        var pack = parseInt($("#pack").val());
        var other = parseInt($("#other").val());
        var lastmilede = parseInt($("#lastmilede").val());
        var replace = parseInt($("#replace").val());
        var advance = parseInt($("#advance").val());
        var farerpay = totalprice - (transport + transtohub + pack + other + lastmilede + replace + advance);
       $('#farmerpay').html(farerpay);
        $('.farmerpay').val(farerpay);
    });
$("#advance").focusout(function(){
        var totalprice = parseInt($("#totalprice").val());
        var transport = parseInt($("#trans").val());
        var transtohub = parseInt($("#hub").val());
        var pack = parseInt($("#pack").val());
        var other = parseInt($("#other").val());
        var lastmilede = parseInt($("#lastmilede").val());
        var replace = parseInt($("#replace").val());
        var advance = parseInt($("#advance").val());
        var farerpay = totalprice - (transport + transtohub + pack + other + lastmilede + replace + advance);
       $('#farmerpay').html(farerpay);
        $('.farmerpay').val(farerpay);
    });
function showBox(id, val){
    
    if(val == 10){
       $('.2nd').attr('style','display:none;');
    }else if(id == 5){
        $('#other6').attr('style','display:none;'); 
    }else if(id == 6){
        $('#other5').attr('style','display:none;'); 
    }
    $('#other'+id).val('');
   $('#other'+id).attr('style','display:block;');
}
function giveReason(val){
    if(val == 1){
        $('#fans').attr('style','display:block;');
    }else{
        $('#fans').attr('style','display:none;');
    }
}
$('#select').click(function() {
    if ($(this).is(':checked')) {
        $('#other').attr('style','display:block;');
    }else{
        $('#other').attr('style','display:none;');
        $('#other').val('');
    }
});
function submitFeedback(formId){
    var formdata = new FormData($(formId)[0]);
    formdata.append('_csrf', csrfToken);
    jQuery.ajax({
        type: 'post',
        url: url + 'user/submit-feedback',
        data: formdata,
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
            if (response.status == 'success') {
                location.reload();
            }
        }

    }); 
 }
 function feedbackPopup(uid, oid, name){
     $('#user').val(uid);
     $('#order').val(oid);
     $('#name').html(name);
     $('#myModal').modal('show');
 }
 
 
 function ChangeStatus(order_id){
     $('#alertmodel').hide();
    jQuery.ajax({
            type: 'post',
            url: url+'orders/resend-link',
            datatype: 'json',
            async: false,
            data: {_csrf: csrfToken,order_id:order_id,flag:1},
            beforeSend:function(){
                   $("#preloader").show() ;
            },
            success: function (response) {
                if(response.status == 1){
                      $("#preloader").hide() ;
                        alert("Instamojo link sent");
                       
                                   location.reload(); 
                   }
               },
            error: function(response){
              
            }
        });
}
 function closeUnpaidmodel(){
    $("#unpaidModel").hide('slow');
}
//function sendMessage(){ 
//  
//        if(inputs.length != 0){
//            jQuery.ajax({ 
//                            type: 'post',
//                            url: url+'orders/send-message',
//                            data: {_csrf: csrfToken,data:inputs,message:value},
//                            datatype: 'json',
//                          beforeSend: function() {
//                                $("#preloader").show() ;
//                                $("#d_message").val('');
//                                $("#exampleModal").hide('slow');
//                              },
//                            success: function (response) {
//                                if(response.status == 'success'){
//                                  $("#preloader").hide();
//                                   location.reload();
//                               }
//                              
//                            },
//                            error: function(response){
//
//                             }
//                     });
//        }else{
//            alert('Please select some orders ');
//        }
//}
function showPrimePopup(status,id){ 
 
  if(status == 1){
       $('#user_id').val(id);
        $('#status').val(status);
      $('#prime-modal').attr('style','display:block;');
  }else{
       $('#user_id1').val(id);
        $('#status1').val(status);
      $('#prime-modal-deactivate').attr('style','display:block;');
  }
}
function makePrimeMember(id){
    var type = $('#primemember-'+id).val(); 
    jQuery.ajax({
            type: 'post',
            url: url+'user/make-prime-member',
            datatype: 'json',
            async: false,
            data: {_csrf: csrfToken,id:id,type:type},
            beforeSend:function(){
                 
            },
            success: function (response) {
                if(response.status == 'success'){
                        location.reload(); 
                   }
               },
            error: function(response){
              
            }
        }); 
}
function addPrepaidMemberAmount(val){
    $('#user_id3').val(val);
    $('#myModal').modal('show');
}
function saveAmount(formId){
   var formdata = new FormData($(formId)[0]);
    formdata.append('_csrf', csrfToken);
    jQuery.ajax({
        type: 'post',
        url: url + 'user/add-prepaid-amount',
        data: formdata,
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
            if (response.status == 'success') {
                location.reload();
            }
        }

    }); 
}


 $("#select_farmer").autocomplete({ 
               appendTo: ".srch_place",
               source: url + 'stock/select-farmer',
               select: function (e, ui) { 
                      $("#farmer").val(ui.item.type);
                      getFarmerProduct();
           },
        })._renderItem = function(ul, item) {

            if(item.value != ''){
                return $('<li>')
                .append('<a>'+item.value+'</a>')
                .appendTo(ul);
            }else{
                return $('<li>')
                .append('<a>No results found</a>')
                .appendTo(ul);
            }
        };
        
        
 function export_stat(){
    var get_content = $("#search_stat").val();
    var export_url =  url+'products/statistics?search_stat='+get_content+'&export=1' ;
    window.open(export_url,'_blank');
   
 }       
 function asMarked(val){ 
    jQuery.ajax({
        type: 'post',
        url: url+'cart/make-marked',
        datatype: 'json',
        async: false,
        data: {_csrf: csrfToken,id:val},
        beforeSend:function(){

        },
        success: function (response) {
            if(response.status == 'success'){
                    location.reload(); 
               }
           },
        error: function(response){

        }
    }); 
 }
    function ShowmemberPopup(){
       $('#myModal2').modal('show');
    }
    function saveMember(formId){
        var user = $('#buyer_id').val();
        if(user == ''){
            $('#select_user').attr('style','border:1px solid red;');
            return false;
        }
       var formdata = new FormData($(formId)[0]);
        formdata.append('_csrf', csrfToken);
        jQuery.ajax({
            type: 'post',
            url: url + 'user/add-members',
            data: formdata,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                if (response.status == 'success') {
                    location.reload();
                }
            }

        }); 
    }
    function ShowalertPopup(val, action , id = null){ 
        $('#alertmodel').show();
        if(action == 1){
           $('#confirm').attr('onclick','ChangeStatus('+val+')'); 
        }else if(action == 2){
           $('#confirm').attr('onclick','resend_link('+val+')'); 
        }
        
//        else if(action == 3){
//           $('#confirm').attr('onclick','initiate_refund('+val+','+id+')'); 
//        }else if(action == 4){
//           $('#confirm').attr('onclick','mark_refund('+val+','+id+')'); 
//        }
    }
    
   $('#show_filt').click(function(){
      if($('#userfilters').is(':visible')){
            $('#userfilters').hide();
            $(this).html('Show Filters');
        }else{
             $('#userfilters').show();
             $(this).html('Hide Filters');
        }
    });
    
     $('#show_actions').click(function(){
      if($('#ord_actions').is(':visible')){
            $('#ord_actions').hide();
            $(this).html('Show Actions');
        }else{
             $('#ord_actions').show();
             $(this).html('Hide Actions');
        }
    });