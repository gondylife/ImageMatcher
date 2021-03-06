<?php

require_once('../config.php');

if (!isset($_SESSION['PID'])) {
    header('Location: '.BASE_URL.'login');
} else {
    if (isset($_SESSION['redirect']) AND ($_SESSION['redirect'] != BASE_URL.'admin')) {
        header('Location: '.BASE_URL.'login');
    }
}

use App\Admin\Npfims;

$entries = Npfims::retrieveAllEntries();

$personnels = Npfims::retrieveAllPersonnels();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>NPFIMS - Admin</title>
        <?php require_once(INCS_DIR.'metadata.inc.php'); ?>
    </head>
    <body>
        <div id="loadingdiv" style="z-index:5000; background-color:rgba(255,255,255,0.9); height:100%; width:100%; text-align:center; vertical-align:middle; display:none; position:absolute; padding:270px 20px 20px;"><img src="preloader.gif"><br><br><p style="font-size: 20px;"><em id="loadingText">Processing in progress...</em></div>
        <nav class="navbar navbar-default no-margin">
        <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header fixed-brand">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"  id="menu-toggle">
                    <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
                </button>
                <img src="logo.png" style="height: 50px; width: 50px; padding-top: 5px;">
            </div><!-- navbar-header-->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active" ><button class="navbar-toggle collapse in" data-toggle="collapse" id="menu-toggle-2"> <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span></button></li>
                </ul>
            </div><!-- bs-example-navbar-collapse-1 -->
        </nav>
        <div id="wrapper">
            <!-- Sidebar -->
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav nav-pills nav-stacked" id="menu">
                    <li id="personnel-menu-item" class="active">
                        <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-user-secret fa-stack-1x"></i></span> Personnels</a>
                        <ul class="nav-pills nav-stacked" style="list-style-type:none;">
                            <li><a href="" data-toggle="modal" data-target="#newPersonnelModal"><span class="fa-stack fa-lg pull-left"><i class="fa fa-plus-square-o fa-stack-1x"></i></span>Create New</a></li>
                        </ul>
                    </li>
                    <li id="entry-menu-item" class=" ">
                        <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-users fa-stack-1x"></i></span> Entries</a>
                        <ul class="nav-pills nav-stacked" style="list-style-type:none;">
                            <li><a href="" data-toggle="modal" data-target="#newEntryModal"><span class="fa-stack fa-lg pull-left"><i class="fa fa-plus-square-o fa-stack-1x"></i></span>Create New</a></li>
                        </ul>
                    </li>
                    <li><a href="internal"><span class="fa-stack fa-lg pull-left"><i class="fa fa-search-plus fa-stack-1x"></i></span>Search</a></li>
                    <li id="logout-menu-item">
                        <a href="" id="logout"><span class="fa-stack fa-lg pull-left"><i class="fa fa-sign-out fa-stack-1x"></i></span> Log Out</a>
                    </li>
                </ul>
            </div><!-- /#sidebar-wrapper -->
            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="container-fluid xyz">
                    <div class="row">
                        <div id="admin-content-div" class="col-lg-12">
                            
                        </div>
                        <div id="personnel-content" style="visibility: hidden;">
                            <h3 style="width: 140px; height: 50px; margin: 0 auto;">Personnels</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Full name</th>
                                            <th>Police ID</th>
                                            <th>Email address</th>
                                            <th>Role</th>
                                            <th>Access Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            foreach ($personnels as $id => $Details) {
                                                if ($Details['Role'] === 'A') {
                                                    $role = 'Admin';
                                                }
                                                if ($Details['Role'] === 'P') {
                                                    $role = 'Police';
                                                }
                                                if ($Details['Status'] === '1') {
                                                    $status = 'Active';
                                                    $button = '<button type="submit" class="deactivate-personnel" data-personnel="'.$Details['PoliceID'].'" title="Deactivate Personnel">Deactivate</button>';
                                                }
                                                if ($Details['Status'] === '0') {
                                                    $status = 'Inactive';
                                                    $button = '<button type="submit" class="activate-personnel" data-personnel="'.$Details['PoliceID'].'" title="Activate Personnel">Activate</button>';
                                                }
                                        ?>
                                        <tr>
                                            <td><?=$Details['Firstname'].' ' .$Details['Lastname'];?></td>
                                            <td><?=$Details['PoliceID'];?></td>
                                            <td><?=$Details['EmailAddress'];?></td>
                                            <td><?=$role;?></td>
                                            <td><?=$Details['DateTime'];?></td>
                                            <td><?=$status;?></td>
                                            <td><?=$button;?>&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="delete-personnel" data-personnel="<?=$Details['PoliceID'];?>" title="Delete Personnel">Delete</button></td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="entry-content" style="visibility: hidden;">
                            <h3 style="width: 80px; height: 50px; margin: 0 auto;">Entries</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>First name</th>
                                            <th>Last name</th>
                                            <th>Other name</th>
                                            <th>DOB</th>
                                            <th>Sex</th>
                                            <th>Phone Number</th>
                                            <th>Email address</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            foreach ($entries as $id => $Details) {
                                                $buttonEdit = '<button type="submit" class="edit-entry" data-entry="'.$Details['UniqueID'].'" data-toggle="modal" data-target="#editModal" title="Edit Entry">Edit</button>';
                                                $buttonTrain = '<button type="submit" class="train-album" data-entry="'.$Details['UniqueID'].'" data-toggle="modal" data-target="#trainModal" title="Train Album">Train</button>';
                                        ?>
                                        <tr>
                                            <td><?=$Details['Firstname'];?></td>
                                            <td><?=$Details['Lastname'];?></td>
                                            <td><?=$Details['Othername'];?></td>
                                            <td><?=$Details['DOB'];?></td>
                                            <td><?=$Details['Sex'];?></td>
                                            <td><?=$Details['Phonenumber'];?></td>
                                            <td><?=$Details['EmailAddress'];?></td>
                                            <td><?=$buttonEdit;?>&nbsp;&nbsp;&nbsp;&nbsp;<?=$buttonTrain;?></td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /#page-content-wrapper -->
        </div>
        <!-- /#wrapper -->
        <!-- jQuery -->
        <?php require_once(INCS_DIR.'scripts.inc.php'); ?>
        <?php require_once(INCS_DIR.'editentry.inc.php'); ?>
        <?php require_once(INCS_DIR.'train.inc.php'); ?>
        <?php require_once(INCS_DIR.'newpersonnel.inc.php'); ?>
        <?php require_once(INCS_DIR.'newentry.inc.php'); ?>
    </body>
</html>