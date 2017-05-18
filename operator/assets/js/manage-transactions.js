var dataTable;var currentStatus, featuredStatus;
$(document).ready(function(){
    getTransactionRecords();
    function getTransactionRecords(){
            dataTable = $('#transactionslist').DataTable( {
            columnDefs: [ {
                orderable: false,
                className: 'select-checkbox',
                targets:   [0, 1]
            } ],
            select: {
                style:    'os',
                selector: 'td:first-child'
            },
            order: [[ 2, 'asc' ]],
            "processing": true,
            "serverSide": true,
            "scrollX": true,
            data: {fetchUsers: 'true'},
            "ajax":{
                url :"../REST/manage-transactions.php", 
                type: "POST",  
                data: {fetchTransactions:'true'},
                error: function(){  // error handling
                        $("#transactionslist-error").html("");
                        $("#transactionslist").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $("#transactionslist_processing").css("display","none");

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
    $('.multi-activate-transaction').click(function(){
        if(confirm("Are you sure you want to approve selected payments?")) {
            if($('#multi-action-box').prop("checked") || $('#transactionslist :checkbox:checked').length > 0) {
                var atLeastOneIsChecked = $('#transactionslist :checkbox:checked').length > 0;
                if (atLeastOneIsChecked !== false) {
                    $('#transactionslist :checkbox:checked').each(function(){
                        if(parseInt($(this).attr('data-status')) == 1) { alert('Transaction already approved.'); }
                        else{ activeTransaction($(this).attr('data-id'),$(this).attr('data-status')); }
                    });
                }
                else alert("No row selected. You must select atleast a row.");
            }
            else alert("No row selected. You must select atleast a row.");
        }
    });
    $('.multi-delete-transaction').click(function(){
        if(confirm("Are you sure you want to delete selected transaction card details?")) {
            if($('#multi-action-box').prop("checked") || $('#transactionslist :checkbox:checked').length > 0) {
                var atLeastOneIsChecked = $('#transactionslist :checkbox:checked').length > 0;
                if (atLeastOneIsChecked !== false) {
                    $('#transactionslist :checkbox:checked').each(function(){
                        deleteTransaction($(this).attr('data-id'),$(this).attr('data-media'),$(this).attr('data-image'));
                    });
                }
                else alert("No row selected. You must select atleast a row.");
            }
            else alert("No row selected. You must select atleast a row.");
        }
    });   
    
    $(document).on('click', '.activate-transaction', function() {
        if(parseInt($(this).attr('data-status')) == 1){ alert('Transaction already approved.'); }
        else{
            if(confirm("Are you sure you want to APPROVE this transaction? Transaction ID: '"+$(this).attr('data-transaction-id')+"'")) activeTransaction($(this).attr('data-id'),$(this).attr('data-status'));
        }
    });
    $(document).on('click', '.delete-transaction', function() {
        if(confirm("Are you sure you want to delete card details of transaction ID: ["+$(this).attr('data-transaction-id')+"]? ")) deleteTransaction($(this).attr('data-id'));
    });
    
    function deleteTransaction(id){
        $.ajax({
            url: "../REST/manage-transactions.php",
            type: 'POST',
            data: {deleteThisTransaction: 'true', id:id},
            cache: false,
            success : function(data, status) {
                if(data.status == 1){
                    $("#messageBox, .messageBox").html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>'+data.msg ? data.msg : data+' </div>');
                }
                else {
                    $("#messageBox, .messageBox").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>'+data.msg ? data.msg : data+'</div>');
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
                $("#messageBox, .messageBox").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Operation failed. '+erroMsg+'</div>');

                $.gritter.add({
                    title: 'Notification!',
                    text: erroMsg
                });
            }
        });
    }
    
    function activeTransaction(id, status){
        $.ajax({
            url: "../REST/manage-transactions.php",
            type: 'GET',
            data: {activeTransaction: 'true', id:id, status:status},
            cache: false,
            success : function(data, status) {
                if(data.status === 1){
                    $("#messageBox, .messageBox").html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Transaction Successfully Approved! </div>');
                }
                else {
                    $("#messageBox, .messageBox").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Transaction Approval Failed. '+data.msg+'</div>');
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
                $("#messageBox, .messageBox").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Operation failed. '+erroMsg+'</div>');

                $.gritter.add({
                    title: 'Notification!',
                    text: erroMsg
                });
            }
        });
    }
});