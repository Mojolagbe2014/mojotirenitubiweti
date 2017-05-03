var dataTable;
$(document).ready(function(){
    $("form#CreateWebPage").submit(function(e){ 
        e.stopPropagation();
        e.preventDefault();
        $(document).scrollTo('div.panel h3');
        var formDatas = new FormData($(this)[0]);
        var alertType = ["danger", "success", "danger", "error"];
        $.ajax({
            url: $(this).attr("action"),
            type: 'POST',
            data: formDatas,
            cache: false,
            contentType: false,
            async: false,
            success : function(data, status) {
                if(data.status != null && data.status !=1) { 
                    $("#messageBox, .messageBox").html('<div class="alert alert-'+alertType[data.status]+'"><button type="button" class="close" data-dismiss="alert">&times;</button>'+data.msg+' </div>');
                }
                else if(data.status != null && data.status == 1) { 
                    $("#messageBox, .messageBox").html('<div class="alert alert-'+alertType[data.status]+'"><button type="button" class="close" data-dismiss="alert">&times;</button>'+data.msg+'  </div>'); 
                    $("form#CreateWebPage")[0].reset();
                    $('form #addNewWebPage').val('addNewWebPage');
                    $('form #multi-action-catAddEdit').text('Add Web Page');
                }
                else $("#messageBox, .messageBox").html('<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert">&times;</button>'+data+'</div>');
                dataTable.ajax.reload();
                $.gritter.add({
                    title: 'Notification!',
                    text: data.msg ? data.msg : data
                });
            },
            error : function(xhr, status) {
                erroMsg = '';
                if(xhr.status===0){ erroMsg = 'There is a problem connecting to internet. Please review your internet connection.'; }
                else if(xhr.status===404){ erroMsg = 'Requested page not found.'; }
                else if(xhr.status===500){ erroMsg = 'Internal Server Error.';}
                else if(status==='parsererror'){ erroMsg = 'Error. Parsing JSON Request failed.'; }
                else if(status==='timeout'){  erroMsg = 'Request Time out.';}
                else { erroMsg = 'Unknow Error.\n'+xhr.responseText;}          
                $("#messageBox, .messageBox").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Admin details update failed. '+erroMsg+'</div>');

                $.gritter.add({
                    title: 'Notification!',
                    text: erroMsg
                });
            },
            processData: false
        });
        return false;
    });
    
    loadAllsWebpages();
    function loadAllsWebpages(){
        dataTable = $('#webpagelist').DataTable( {
            columnDefs: [ {
                orderable: false,
                className: 'select-checkbox',
                targets:   [0, 6]
            } ],
            select: {
                style:    'os',
                selector: 'td:first-child'
            },
            order: [[ 1, 'asc' ]],
            "processing": true,
            "serverSide": true,
            "scrollX": true,
            "ajax":{
                url :"../REST/manage-webpages.php", //employee-grid-data.php",// json datasource
                type: "post",  // method  , by default get
                data: {fetchWebpages:'true'},
                error: function(){  // error handling
                        $("#webpagelist-error").html("");
                        $("#webpagelist").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $("#webpagelist_processing").css("display","none");

                }
            }
        } );
    }
    //Select Multiple Values
    $("#multi-action-box").click(function () {
        var checkAll = $("#multi-action-box").prop('checked');
        if (checkAll) {
            $(".multi-action-box").prop("checked", true);
        } else {
            $(".multi-action-box").prop("checked", false);
        }
    });
    //Handler for multiple selection
    $('.multi-delete-webpage').click(function(){
        if(confirm("Are you sure you want to delete selected webpage(s)?")) {
            if($('#multi-action-box').prop("checked") || $('#webpagelist :checkbox:checked').length > 0) {
                var atLeastOneIsChecked = $('#webpagelist :checkbox:checked').length > 0;
                if (atLeastOneIsChecked !== false) {
                    $('#webpagelist :checkbox:checked').each(function(){
                        deleteWebPage($(this).attr('data-id'));
                    });
                }
                else alert("No row selected. You must select atleast a row.");
            }
            else alert("No row selected. You must select atleast a row.");
        }
    });
    
    $(document).on('click', '.delete-webpage', function() {
        if(confirm("Are you sure you want to delete this webpage? WebPage Name: '"+$(this).attr('data-name')+"'")) deleteWebPage($(this).attr('data-id'));
    });
    $(document).on('click', '.edit-webpage', function() {
        if(confirm("Are you sure you want to edit this webpage? WebPage Name: '"+$(this).attr('data-name')+"'")) editWebPage($(this).attr('data-id'), $(this).attr('data-name'), $(this).attr('data-title'), $(this).attr('data-description'), $(this).attr('data-keywords'));
    });
    
    function deleteWebPage(id){
        $.ajax({
            url: "../REST/manage-webpages.php",
            type: 'POST',
            data: {deleteThisWebPage: 'true', id:id},
            cache: false,
            success : function(data, status) {
                if(data.status === 1){
                    $("#messageBox, .messageBox").html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>'+data.msg+' </div>');
                }
                else {
                    $("#messageBox, .messageBox").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>'+data.msg+'</div>');
                }
                dataTable.ajax.reload();
                $.gritter.add({
                    title: 'Notification!',
                    text: data.msg ? data.msg : data
                });
            },
            error : function(xhr, status) {
                erroMsg = '';
                if(xhr.status===0){ erroMsg = 'There is a problem connecting to internet. Please review your internet connection.'; }
                else if(xhr.status===404){ erroMsg = 'Requested page not found.'; }
                else if(xhr.status===500){ erroMsg = 'Internal Server Error.';}
                else if(status==='parsererror'){ erroMsg = 'Error. Parsing JSON Request failed.'; }
                else if(status==='timeout'){  erroMsg = 'Request Time out.';}
                else { erroMsg = 'Unknow Error.\n'+xhr.responseText;}          
                $("#messageBox, .messageBox").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Admin details update failed. '+erroMsg+'</div>');

                $.gritter.add({
                    title: 'Notification!',
                    text: erroMsg
                });
            }
        });
    }
    
    function editWebPage(id, name, title, description, keywords){//,
        $('form #addNewWebPage').val('editWebPage');
        $('form #multi-action-catAddEdit').text('Update WebPage');
        var formVar = {id:id, name:name, title:title, description:description, keywords:keywords};
        $.each(formVar, function(key, value) {  $('form #'+key).val(value);  });
        $(document).scrollTo('div#hiddenUpdateForm');
    }
});