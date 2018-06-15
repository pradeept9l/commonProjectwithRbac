var csrfToken = jQuery('meta[name="csrf-token"]').attr("content");
var url = jQuery('meta[name="url"]').attr("content");

/*********************************************************************
                @ Open Vehical attribute form
*********************************************************************/
    function openForm(id,cat,subcat){
       jQuery.ajax({
            type: 'post',
            url: url + 'vehical/open-form',
            datatype: 'json',
            data: {_csrf: csrfToken, vId: id,catId: cat, subId: subcat}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            beforeSend: function () {

            },
            success: function (response) {
                if (response.status == 'success') {
                    $("#editbtn-"+subcat).attr("onclick","hideForm("+id+","+cat+","+subcat+")");
                    $("#editbtn-"+subcat).html('Cancel');
                    $( "#box-"+ subcat).html(response.data);
                } else if (response.status == 'failed') {

                }
            },
            error: function (responce) {
            }
        });
    }
/*********************************************************************
                @ Hide Vehical attribute form
*********************************************************************/
    function hideForm(id,cat,subcat){
        jQuery.ajax({
            type: 'post',
            url: url + 'vehical/hide-form',
            datatype: 'json',
            data: {_csrf: csrfToken, vId: id,catId: cat, subId: subcat}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            beforeSend: function () {

            },
            success: function (response) {
                if (response.status == 'success') {
                    $("#editbtn-"+subcat).attr("onclick","openForm("+id+","+cat+","+subcat+")");
                    $("#editbtn-"+subcat).html('Edit');
                    $( "#box-"+ subcat).html(response.data);
                } else if (response.status == 'failed') {

                }
            },
            error: function (responce) {
            }
        });
    }
/*********************************************************************
                @ Submit Vehical attribute form
*********************************************************************/
    function submitAttributeform(id, vId,cat){ 
        var form = $('#saveattributes-'+id).get(0); 
        var formdata = new FormData(form);
        formdata.append('_csrf', csrfToken);
        formdata.append('vId', vId);
        formdata.append('sId', id);
        jQuery.ajax({
            type: 'POST',
            url: url + 'vehical/save-attribute',
            datatype: 'json',
            data: formdata, 
            contentType: false, 
            cache: false,
            processData: false,
            beforeSend: function () {
                
            },
            success: function (response) { 
                if (response.status == 'success') {
                    $("#editbtn-"+id).attr("onclick","openForm("+vId+","+cat+","+id+")");
                    $("#editbtn-"+id).html('Edit');
                    $( "#box-"+ id).html(response.data);
                } else if (response.status == 'failed') {

                }
            }
        });
    }
    function submitImageform(id, vId,cat){ 
        var form = $('#saveimages-'+id).get(0); 
        var formdata = new FormData(form);
        formdata.append('_csrf', csrfToken);
        formdata.append('vId', vId);
        formdata.append('sId', id);
        jQuery.ajax({
            type: 'POST',
            url: url + 'vehical/save-images',
            datatype: 'json',
            data: formdata, 
            contentType: false, 
            cache: false,
            processData: false,
            beforeSend: function () {
                
            },
            success: function (response) { 
                if (response.status == 'success') {
                    $("#editbtn-"+id).attr("onclick","openForm("+vId+","+cat+","+id+")");
                    $("#editbtn-"+id).html('Edit');
                    $( "#box-"+ id).html(response.data);
                } else if (response.status == 'failed') {

                }
            }
        });
    }  
    function DeleteImage(val){ 
        jQuery.ajax({
            type: 'post',
            url: url+'vehical/delete-images',
            datatype: 'json',
            async: false,
            data: {_csrf: csrfToken,id:val},
            beforeSend:function(){

            },
            success: function (response) {
                if(response.status == 'success'){
                        $("#img-"+val).attr("style","display:none;");
                   }
               },
            error: function(response){

            }
        }); 
    }