
<?php if(Zf_SessionHandler::zf_getSessionVariable('agent_setup') == 'agent_setup_error'){ ?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You have some server-side form errors. Please check below.
    </div>
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('agent_setup') == 'agent_type_existence_error'){
?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        <b>Error!!</b> The agent type name entered is already in use. Please select a different one.
    </div>
<?php   
}else if(Zf_SessionHandler::zf_getSessionVariable('agent_setup') == 'agent_setup_success'){
?>
    <div class="alert alert-success display-none success-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You successfully registered the new agent type.
    </div> 
<?php 
}else if(Zf_SessionHandler::zf_getSessionVariable('agent_setup') == 'agent_update_success'){
?>
    <div class="alert alert-success display-none success-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You successfully edited agent information.
    </div> 
<?php
}
Zf_SessionHandler::zf_unsetSessionVariable("agent_setup");
?>