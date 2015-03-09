
<?php if(Zf_SessionHandler::zf_getSessionVariable('new_transaction') == 'transaction_error'){ ?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You have some server-side form errors. Please check below.
    </div>
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('new_transaction') == 'reference_code_error'){ ?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        The transaction reference code is already registered. Re-check the "<b>Transaction Reference Code</b>" and try again.
    </div>
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('new_transaction') == 'new_transaction_success'){
?>
    <div class="alert alert-success display-none success-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You successfully made a new transaction. You can view the transaction details on "<b>View transactions</b>" tab.
    </div> 
<?php 
}else if(Zf_SessionHandler::zf_getSessionVariable('new_transaction') == 'transaction_update_success'){
?>
    <div class="alert alert-success display-none success-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You successfully updated a transaction. You can view the transaction details on "<b>View transactions</b>" tab.
    </div> 
<?php 
}else if(Zf_SessionHandler::zf_getSessionVariable('new_transaction') == 'commission_error'){
 ?>
    <div class="alert alert-warning display-none success-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You successfully made a new transaction, with 0 commission. There was issue computing commission due to commission setup problems.
    </div> 
<?php   
}
Zf_SessionHandler::zf_unsetSessionVariable("new_transaction");
?>