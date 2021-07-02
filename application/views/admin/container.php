<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $header . ' | ' . config_item('site_name'); ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link rel="shortcut icon" href="<?php echo base_url("assets/icons/favicon.ico");?> " type="image/x-icon">

        <script type="text/javascript">
        <!--
        var base_url = '<?php echo base_url();?>';
        var index_page = "";
        // -->
        </script>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/project.min.css');?>"  />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script type="text/javascript" src="<?php echo base_url('assets/js/project.min.js');?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/var.js.php');?>"></script>
        
        <?php if(isset($maps) && $maps == true): ?>
        <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?libraries=places"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/googlemaps.js');?>"></script>
        <?php endif;?>

        <?php if(isset($has_upload) && $has_upload == true): ?>
        <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.upload.js');?>"></script>
        <?php endif;?>


        <script>
            //paste this code under head tag or in a seperate js file.
            // Wait for window load
            $(window).load(function() {
                // Animate loader off screen
                // setTimeout($(".se-pre-con").fadeOut("slow"), 10000);
                $(".se-pre-con").fadeOut("slow");;
            });
            
            Number.prototype.pad = function(size) {
                var s = String(this);
                while (s.length < (size || 2)) {s = "0" + s;}
                return s;
            }
        </script>
    </head>
    
    <body class="sidebar-mini skin-blue sidebar-collapse">
        <!-- Paste this code after body tag -->
        <div class="se-pre-con"></div>
        <!-- Ends -->

        <!-- wrapper -->
        <div class="wrapper">
        <!-- header logo: style can be found in header.less -->
        <?php print $this->load->view($this->config->item('template_admin') . 'header');?>

            <!-- Left side column. contains the logo and sidebar -->
            <?php print $this->load->view($this->config->item('template_admin') . 'menu');?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <?php print $this->load->view($this->config->item('template_admin') . 'content');?>

            <!-- Footer -->
            <?php print $this->load->view($this->config->item('template_admin') . 'footer');?>
        
        </div>  
        <!-- ./wrapper -->
        <?php /*
        <script src="http://localhost:9000/socket.io/socket.io.js"></script>
        <script>

            // create a new websocket
            var socket = io.connect('http://localhost:9000/?id=1');
            // on message received we print all the data inside the #container div
            socket.on('notification', function (data) {
            var notificationList = '<a href="#" class="dropdown-toggle" data-toggle="dropdown">';
                notificationList += '<i class="fa fa-bell-o"></i>';
                notificationList += '<span class="label label-warning">'+data.users.length + '</span>';
                notificationList += '</a>';
                notificationList += '<ul class="dropdown-menu">';
                notificationList += '<li class="header">You have '+data.users.length + ' notifications</li>';
                notificationList += '<li>';
                notificationList += '<ul class="menu">';

            $.each(data.users,function(index,user){
                //console.log(user.user_name);
                notificationList +='<li><a href="#">'+ user.notification_summary +'</a></li>';
            });
            notificationList += " </ul></li>'";
            $('#my-notifications').html(notificationList);
       
           // $('time').html('Last Update:' + data.time);
          });
        </script>
        */?>
    </body>
</html>