<?php
require 'templates/header.php';
?>
    <script src="js/messages.js?a=211"></script>
    <div class="col-sm-12">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default panel-table">
                <div class="panel-heading">
                    <div class="row" style="text-align: center">
                        <h3>Wiadomości</h3>
                    </div>
                </div>
                <div class="panel-body">
                    <table id="messages" class="table table-striped table-bordered table-list" style="text-align: center">
                        <thead>
                        <tr>
                            <th style="text-align: center">Temat</th>
                            <th style="text-align: center">Treść</th>
                            <th style="text-align: center">Data</th>
                            <th class="hidden-xs hidden">ID</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php
require 'templates/footer.php';
