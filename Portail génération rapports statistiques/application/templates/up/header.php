<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo $title; ?></title>
        <?php
        if (!empty($description)) {
            echo '<meta name="description" content="' . $description . '"/>' . "\n";
        }

        if (!empty($keywords)) {
            echo '<meta name="keywords" content="' . $keywords . '"/>' . "\n";
        }
        ?>       

        <link href="<?php echo base_url('bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" />        
        <link rel="stylesheet" href="<?php echo base_url('jquery/jquery-ui.min.css') ?>">
            <link rel="stylesheet" href="<?php echo base_url('jquery/jquery-ui.structure.min.css') ?>">
                <link rel="stylesheet" href="<?php echo base_url('jquery/jquery-ui.theme.min.css') ?>">
                    <link rel="stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap-theme.min.css') ?>"  />  

                    <!-- JQuery et Bootstrap -->
                    <script type="text/javascript" src="<?php echo base_url('jquery/jquery-3.1.1.min.js') ?>"></script>
                    <script type="text/javascript" src="<?php echo base_url('bootstrap/js/bootstrap.min.js') ?>"></script>
                    <script type="text/javascript" src="<?php echo base_url('jquery/jquery-ui.min.js') ?>"></script>                     
            
                    <!-- Bootstrap toggle -->
                    <link href="<?php echo base_url('bootstrap-toggle/css/bootstrap-toggle.min.css') ?>" rel="stylesheet">
                        <script src="<?php echo base_url('bootstrap-toggle/js/bootstrap-toggle.min.js') ?>"></script>
                        <script type="text/javascript" src="<?php echo base_url('js/custom_dialog.js') ?>"></script>

                        <!-- Style global -->
                        <link href="<?php echo base_url('css/style.css') ?>" rel="stylesheet" type="text/css" />        

                        <!-- Style du template -->
                        <link href="<?php echo base_url('css/templates/up/template.css') ?>" rel="stylesheet" type="text/css" />        

                        <script src="<?php echo base_url('raphael/raphael.min.js') ?>"></script>
                        <script src="<?php echo base_url('morris.js/morris.js') ?>"></script>
                        <script src="http://cdnjs.cloudflare.com/ajax/libs/prettify/r224/prettify.min.js"></script>

                        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/prettify/r224/prettify.min.css">
                            <link rel="stylesheet" href="<?php echo base_url('morris.js/morris.css') ?>">




                                </head>

                                <body>