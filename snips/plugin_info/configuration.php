<?php
require_once dirname(__FILE__) . '/../../../core/php/core.inc.php';
include_file('core', 'authentification', 'php');
if (!isConnect()) {
    include_file('desktop', '404', 'php');
    die();
}
?>
<form class="form-horizontal">
    <fieldset>
        <div class="form-group">
            <label class="col-lg-4 control-label" >{{IP address of the master snips site}}</label>
            <div class="col-lg-4">
                <input class="configKey form-control" data-l1key="mqttAddr" placeholder="127.0.0.1"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-4 control-label" >{{Default feedback}}</label>
            <div class="col-lg-4">
                <textarea class="configKey form-control" data-l1key="defaultTTS" placeholder="Sorry I don't understand"></textarea>
            </div>
        </div>

        <!-- <div class="form-group">
            <label class="col-lg-4 control-label" >{{Multi-dialog conversation}}</label>
            <div class="col-lg-4">
                <input type="checkbox" class="configKey" data-l1key="multiDialog"> {{Enable}}</input>
            </div>
        </div> -->

    </fieldset>
</form>

