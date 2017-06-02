<?php
require 'templates/header.php';
?>
    <div class="col-sm-12">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default panel-table">
                <div class="panel-heading">
                    <div class="row" style="text-align: center">
                        <h3>Wiadomości</h3>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-list" style="text-align: center">
                        <thead>
                        <tr>
                            <th style="text-align: center">Usuń</th>
                            <th class="hidden-xs hidden">ID</th>
                            <th style="text-align: center">Autor</th>
                            <th style="text-align: center">Temat</th>
                            <th style="text-align: center">Data</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td align="center">
                                <a class="btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                            </td>
                            <td class="hidden-xs hidden">1</td>
                            <td>John Doe</td>
                            <td>johndoe@example.com</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php
require 'templates/footer.php';
