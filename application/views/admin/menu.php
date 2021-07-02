<?php $uri = explode("/", $this->uri->uri_string()); ?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <?php $css = (isset($uri[1]) && in_array($uri[1], array())) ? 'active' : ''; ?>
            <li class="treeview <?php echo $css; ?>">
                <a href="javascript:void(0)">
                    <i class="fa fa-dashboard"></i>
                    <span><?php echo lang('menu_system'); ?></span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if(control('Dashboard Management', FALSE)):?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'management') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('management_dashboard')?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_management_dashboard');?></a></li>
                    <?php endif;?>
                    <?php if(control('Dashboard Sales Report', FALSE)):?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'sales') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('sales_dashboard')?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_sales_dashboard');?></a></li>
                    <?php endif;?>
                     <?php if(control('Dashboard Marketing', FALSE)):?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'marketing') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('marketing_dashboard')?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_marketing_dashboard');?></a></li>
                    <?php endif;?>
                    <?php if(control('Dashboard Logistic Report', FALSE)):?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'logistic') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('logistic_dashboard')?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_logistic_dashboard');?></a></li>
                    <?php endif;?>
                    <?php if(control('Dashboard Dealer Report', FALSE)):?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'dealer') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('dealer_dashboard')?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_dealer_dashboard');?></a></li>
                    <?php endif;?>
                </ul>
            </li>

            <?php if(control('System', FALSE)):?>
                <?php $css = (isset($uri[1]) && in_array($uri[1], array('users', 'groups', 'permissions'))) ? 'active' : ''; ?>
                <li class="treeview <?php echo $css; ?>">
                    <a href="javascript:void(0)">
                        <i class="fa fa-gear"></i>
                        <span><?php echo lang('menu_system'); ?></span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                     <?php if(control('Permissions', FALSE)):?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'permissions') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/permissions')?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_permissions');?></a></li>
                    <?php endif;?>
                    <?php if(control('Groups', FALSE)):?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'groups') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/groups')?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_groups');?></a></li>
                    <?php endif;?>
                    <?php if(control('Users', FALSE)):?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'users') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/users')?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_users');?></a></li>
                    <?php endif;?>
                    <?php /*if (control('All Settings', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'all_settings') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/settings') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_settings'); ?></a></li>
                    <?php endif; */?>
                    <?php if (control('Logistics Settings', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'logistics_settings') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/settings/logistics_settings') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_logistics_settings'); ?></a></li>
                    <?php endif; ?>
                </ul>
            </li>
        <?php endif;?>

        <?php if(control('Master Data', FALSE)):?>
            <?php $css = (isset($uri[1]) && in_array($uri[1], array('masters', 'city-places', 'fiscal-years', 'dealers','employees', 'vehicles', 'events'))) ? 'active' : ''; ?>
            <li class="treeview <?php echo $css; ?>">
                <a href="javascript:void(0)">
                    <i class="fa fa-files-o"></i>
                    <span><?php echo lang('menu_masters'); ?></span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if(control('Masters', FALSE)):?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'masters') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/masters')?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_masters');?></a></li>
                    <?php endif;?>
                    <?php if(control('Vehicles', FALSE)):?>
                        <?php $css = (isset($uri[1]) && $uri[1] == '') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/vehicles')?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_vehicles');?></a></li>
                    <?php endif;?>
                    <?php if(control('City Places', FALSE)):?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'city-places') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/city-places')?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_city_places');?></a></li>
                    <?php endif;?>
                    <?php if(control('Fiscal Years', FALSE)):?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'fiscal-years') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/fiscal-years')?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_fiscal_years');?></a></li>
                    <?php endif;?>
                    <?php if(control('Stock Yards', FALSE)):?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'stock_yard') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/stock_yards')?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_stockyards');?></a></li>
                    <?php endif;?>
                    <?php if(control('Dealers', FALSE)):?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'dealers') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/dealers')?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_dealers');?></a></li>
                    <?php endif;?>
                    <?php if(control('Events', FALSE)):?>
                        <?php $css = (isset($uri[1]) && $uri[1] == '') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/events')?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_events');?></a></li>
                    <?php endif;?>
                    <?php if(control('Employees', FALSE)):?>
                        <?php $css = (isset($uri[1]) && $uri[1] == '') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/employees')?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_employees');?></a></li>
                    <?php endif;?>
                    <?php if (control('Workshops', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == '') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/workshops') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_workshops'); ?></a></li>
                    <?php endif; ?>
                    <?php if (control('Master Sparepart', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == '') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/spareparts') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_spareparts'); ?></a></li>
                    <?php endif; ?>
                    <?php if (control('Foc Accessoreis Partcodes', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == '') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/foc_accessoreis_partcodes') ?>"><i class="fa fa-circle-o"></i><?php echo "Accessories Parts"//lang('menu_spareparts_dealer'); ?></a></li>
                    <?php endif; ?>
                    <?php if (control('Discount Limits', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == '') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/discount_limits') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_discount_limits'); ?></a></li>
                    <?php endif; ?>
                    <?php if (control('Inquiry Transfer', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == '') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/customers/inquiry_transfer') ?>"><i class="fa fa-circle-o"></i><?php echo "Inquiry Transfer"//lang('menu_discount_limits'); ?></a></li>
                    <?php endif; ?>
                    <?php if (control('Target Records', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == '') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/target_records') ?>"><i class="fa fa-circle-o"></i><?php echo "Target Records"//lang('menu_discount_limits'); ?></a></li>
                    <?php endif; ?>
                </ul>
            </li>
        <?php endif;?>

        <?php if(control('CRM', FALSE)):?>
            <?php $css = (isset($uri[1]) && in_array($uri[1], array('customers', 'crm-reports'))) ? 'active' : ''; ?>
            <li class="treeview <?php echo $css; ?>">
                <a href="javascript:void(0)">
                    <i class="fa fa-tags"></i>
                    <span><?php echo lang('menu_crm'); ?></span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if(control('Customers', FALSE)):?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'customers') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/customers')?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_customers');?></a></li>
                        <!-- <li <?php echo $css; ?>><a href="<?php echo site_url('admin/customers/customer_list')?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_customers');?> List</a></li> -->
                    <?php endif;?>
                    <?php if(control('Customers', FALSE)):?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'customers/cancellation_report') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/customers/cancellation_report')?>"><i class="fa fa-circle-o"></i>Cancellation Report</a></li>
                    <?php endif;  ?>
                    <?php if(control('Dublicate Number Logs', FALSE)):?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'dublicate_number_logs/') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/dublicate_number_logs')?>"><i class="fa fa-circle-o"></i>Inquiry Dublications</a></li>
                    <?php endif;?>
                    <?php if(control('CRM Reports', FALSE)):?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'crm-reports') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/crm-reports')?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_crm_reports');?></a></li>
                    <?php endif;?>
                    <?php if(control('Spareparts Reports', FALSE)):?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'crm-reports') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/spareparts_report')?>"><i class="fa fa-circle-o"></i><?php echo "Sparepart Report"//lang('menu_crm_reports');?></a></li>
                    <?php endif;?>
                    <?php if (control('Discount Schemes', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'discount_schemes') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/discount_schemes') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_discount_schemes'); ?></a></li>
                    <?php endif; ?>
                    <?php if (control('Foc Requests', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'foc_requests') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/foc_requests') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_foc_request'); ?></a></li>
                    <?php endif; ?>
                    <?php if (is_group(DEALER_INCHARGE_GROUP)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'stock_records') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/stock_records') ?>"><i class="fa fa-circle-o"></i><?php echo 'Check Stock'; ?></a></li>
                    <?php endif; ?>
                </ul>
            </li>
        <?php endif;?>
        <?php if (control('Logistic', FALSE)): ?>
            <?php $css = (isset($uri[1]) && in_array($uri[1], array('customers', 'crm-reports'))) ? 'active' : ''; ?>
            <li class="treeview <?php echo $css; ?>">
                <a href="javascript:void(0)">
                    <i class="fa fa-calendar"></i>
                    <span><?php echo lang('menu_logistics'); ?></span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if (control('Monthly Plannings', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'customers') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/monthly_plannings') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_monthly_plannings'); ?></a></li>
                    <?php endif; ?>
                    <?php if (control('Logistic Msil Order', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'crm-reports') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('monthly_plannings/generate_order') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_msil_orders'); ?></a></li>
                    <?php endif; ?>
                    <?php if (control('Monthly Order', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'customers') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/msil_orders') ?>"><i class="fa fa-circle-o"></i><?php echo "Monthly Order"//lang('menu_monthly_plannings'); ?></a></li>
                    <?php endif; ?>
                    <?php if (control('Order List by Dealer', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'customers') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('dealer_orders/dealer_incharge_index') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_order_list'); ?></a></li>
                    <?php endif; ?>
                    <?php if (control('Retail Request List', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'customers') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('dealer_orders/retail_request_incharge_index') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_retail_list'); ?></a></li>
                    <?php endif; ?>
                    <?php if (control('Tracking', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'crm-reports') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('dispatch_records') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_dispatch_records'); ?></a></li>
                    <?php endif; ?>
                    <?php if (control('Credit Control', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'crm-reports') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('dealer_orders/credit_control') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_credit_control'); ?></a></li>
                    <?php endif; ?>
                    <?php if (control('Pdi Menu', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'crm-reports') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/stock_records/pdi_index') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_pdi'); ?></a></li>
                    <?php endif; ?>
                    <?php if (control('Minimum Quantities', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'crm-reports') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/minimum_quantities') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_minimum_quantities'); ?></a></li>
                    <?php endif; ?>
                    <?php if (control('Minimum level show', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'crm-reports') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/minimum_level_show') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_minimum_ktm_stock'); ?></a></li>
                    <?php endif; ?>
                    <?php if (control('Logistic Stock', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'crm-reports') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/stock_records') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_stock_records'); ?></a></li>
                    <?php endif; ?>
                    <?php if (control('Logistic Report', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'crm-reports') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('stock_records/generate') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_stock_report'); ?></a></li>
                    <?php endif; ?>
                    <?php if (control('Logistic Report', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'crm-reports') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('logistic_reports/logistic_reports') ?>"><i class="fa fa-circle-o"></i><?php echo "Excel Export"//lang('menu_stock_report'); ?></a></li>
                    <?php endif; ?>
                    <?php if (control('View Sparepart Stock', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'crm-reports') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('logistic_reports/view_stock_spareparts') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_sparepart_dealer_report'); ?></a></li>
                    <?php endif; ?>
                </ul>
            </li>
        <?php endif; ?>

        <?php if (control('Dealer Orders', FALSE) || control('Create Dealer Orders', FALSE)): ?>
            <li class="treeview" <?php echo $css; ?>>
                <a href="javascript:void(0)">
                    <i class="fa fa-list"></i>
                    <span><?php echo lang('menu_dealer_order'); ?></span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">

                    <?php if (control('Create Dealer Orders', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'customers') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('dealer_orders') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_create_dispatch_request'); ?></a></li>
                    <?php endif; ?>
                    <?php if (control('Create Retail Request', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'customers') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('dealer_orders/retail_request_list') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_create_retail_request'); ?></a></li>
                    <?php endif; ?>
                    <?php if (control('Dealer Stock Records', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'Create Dealer Orders') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('stock_records/dealer_stock') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_dealer_stock_view'); ?></a></li>
                        <li <?php echo $css; ?>><a href="<?php echo site_url('stock_records/dealer_retail') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_dealer_retail_view'); ?></a></li>
                    <?php endif; ?>
                </ul>
            </li>
        <?php endif; ?>
        <?php if (control('Sparepart Admin Menu', FALSE)): ?>
            <li class="treeview" <?php echo $css; ?>>
                <a href="javascript:void(0)">
                    <i class="fa fa-list"></i>
                    <span><?php echo lang('menu_sparepart'); ?></span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">    
                     <?php if (control('Sparepart Menu Master', FALSE)): ?>
                        <li>
                            <a href="#"><i class="fa fa-circle-o"></i><?php echo ('Master Data'); ?><span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                            <ul class="treeview-menu">
                                <?php if (control('Scan Devices', FALSE)): ?>
                                    <li <?php echo $css; ?>><a href="<?php echo site_url('admin/scan_devices') ?>"><i class="fa fa-file-text-o"></i><?php echo lang('menu_scan_devices'); ?></a></li>
                                <?php endif; ?>
                                <?php if (control('Scan People', FALSE)): ?>
                                    <li <?php echo $css; ?>><a href="<?php echo site_url('admin/scan_people') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_scan_people'); ?></a></li>
                                <?php endif; ?>
                               <?php if(control('Ser Workshop Users', FALSE)):?>
                                    <?php $css = (isset($uri[1]) && $uri[1] == '') ? 'class="active"' : ''; ?> 
                                    <li <?php echo $css; ?>><a href="<?php echo site_url('admin/ser_workshop_users')?>"><i class="fa-circle-o"></i><?php echo lang('menu_workshop_users');?></a></li>
                                <?php endif;?>

                                
                            </ul>
                        </li>
                    <?php endif?>
                    <?php //if (control('Spareparts Dealer Opening Credits', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == '') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/spareparts_dealer_sales/vehicle_detail') ?>"><i class="fa fa-circle-o"></i><?php echo "Vehicle Detail" ?></a></li>
                    <?php //endif; ?>
                                   
                    <?php if (control('Spareparts Dealer Opening Credits', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == '') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/spareparts_dealer_opening_credits') ?>"><i class="fa fa-circle-o"></i><?php echo "Dealer Opening Credit" ?></a></li>
                    <?php endif; ?>

                    <?php if (control('Sparepart Orders', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'customers') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('sparepart_orders/sparepart_incharge') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_spareparts_order'); ?></a></li>
                    <?php endif; ?>

                    <?php if (control('Spareparts Stockyard', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == '') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/stockyards') ?>"><i class="fa fa-circle-o"></i><?php echo "Sparepart Stockyard" ?></a></li>
                    <?php endif; ?>

                    <?php if (control('Sparepart Stocks', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'customers') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('sparepart_stocks') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_sparepart_stock'); ?></a></li>
                    <?php endif; ?>
                    <?php if (control('Dealer Credits', FALSE)): ?>
                        <li>
                            <a href="#"><i class="fa fa-circle-o"></i><?php echo 'Credit'; ?><span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                            <ul class="treeview-menu">
                                <?php $css = (isset($uri[1]) && $uri[1] == 'dealer_credits') ? 'class="active"' : ''; ?> 
                                <li <?php echo $css; ?>><a href="<?php echo site_url('dealer_credits') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_sparepart_dealer_credit'); ?></a></li>
                                <?php $css = (isset($uri[1]) && $uri[1] == 'dealer_credits') ? 'class="active"' : ''; ?> 
                                <li <?php echo $css; ?>><a href="<?php echo site_url('dealer_credits/payment_index') ?>"><i class="fa fa-circle-o"></i><?php echo "Payment Register"?></a></li>
                                <?php $css = (isset($uri[1]) && $uri[1] == 'daily_credits') ? 'class="active"' : ''; ?> 
                                <li <?php echo $css; ?>><a href="<?php echo site_url('daily_credits') ?>"><i class="fa fa-circle-o"></i><?php echo "Daily Credits"?></a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if (control('Dispatch Spareparts', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'customers') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('dispatch_spareparts') ?>"><i class="fa fa-circle-o"></i><?php echo "FMS ABC"//lang('menu_sparepart_fms'); ?></a></li>
                    <?php endif; ?>
                    <?php /* <?php if (control('Dispatch Spareparts', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'customers') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('dispatch_spareparts/index_generate_order') ?>"><i class="fa fa-circle-o"></i><?php echo "Generate Order" //lang('menu_sparepart_order'); ?></a></li>
                    <?php endif; ?> */ ?>
                    <?php if (control('Dispatch Spareparts', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'customers') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('msil_orders_spareparts') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_sparepart_order'); ?></a></li>
                    <?php endif; ?>
                   <?php /* <?php if (control('Msil Orders Spareparts', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'customers') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('msil_orders_spareparts/msil_dispatch') ?>"><i class="fa fa-circle-o"></i><?php echo "Msil Dispatch"//lang('menu_sparepart_order'); ?></a></li>
                    <?php endif; ?> */ ?>
                    <?php if (control('Sparepart Billing', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'customers') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('sparepart_orders/dispatch_list')?>"><i class="fa fa-circle-o"></i><?php echo "Billing";//lang('menu_sparepart_order'); ?></a></li>
                    <?php endif; ?>
                    <?php if (control('Spareparts Dealer Claims', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'customers') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('spareparts_dealer_claims')?>"><i class="fa fa-circle-o"></i><?php echo "Good Dealer Claim ";//lang('menu_sparepart_order'); ?></a></li>
                    <?php endif; ?>
                    <?php if (control('Spareparts Goods Returns', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'customers') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('spareparts_goods_returns')?>"><i class="fa fa-circle-o"></i><?php echo "Good Return Approve";//lang('menu_sparepart_order'); ?></a></li>
                    <?php endif; ?>
                    <?php if (control('Spareparts Damage Stocks', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'customers') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('spareparts_damage_stocks')?>"><i class="fa fa-circle-o"></i><?php echo "Spareparts Damage";//lang('menu_sparepart_order'); ?></a></li>
                    <?php endif; ?>
                    <?php if (control('Spareparts Stock Adjustments', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'customers') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('spareparts_stock_adjustments')?>"><i class="fa fa-circle-o"></i><?php echo "Stock Adjustment";//lang('menu_sparepart_order'); ?></a></li>
                    <?php endif; ?>
                    <?php if (control('Spareparts Stock Adjustments', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'customers') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('spareparts_stock_adjustments/incharge_index')?>"><i class="fa fa-circle-o"></i><?php echo "Stock Adjustment Approval";//lang('menu_sparepart_order'); ?></a></li>
                    <?php endif; ?>
                    <?php if(control('Sparepart Billing', FALSE)):?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'counter_sales') ? 'class="active"' : ''; ?> 
                        <?php if(!is_group(ARO) && !is_group(CG_SPAREPART_OUTLET) && !is_group(SPAREPART_INCHARGE_GROUP) && !is_group(703)){?>
                            <li <?php echo $css; ?>><a href="<?php echo site_url('admin/counter_sales')?>"><i class="fa fa-circle-o"></i><?php echo "Counter Sales"; ?></a></li>
                        <?php }elseif(is_group(SPAREPART_INCHARGE_GROUP) || is_group(703)){?>
                            <li <?php echo $css; ?>><a href="<?php echo site_url('admin/stockyard_countersales')?>"><i class="fa fa-circle-o"></i><?php echo "Counter Sales"; ?></a></li>
                        <?php }else{?>
                            <li <?php echo $css; ?>><a href="<?php echo site_url('admin/counter_sales/aro')?>"><i class="fa fa-circle-o"></i><?php echo "Counter Sales"; ?></a></li>
                        <?php }?>
                    <?php endif; ?>
                </ul>
            </li>
        <?php endif; ?> 
        <?php if (control('Sparepart Dealer Menu', FALSE)): ?>
            <li class="treeview" <?php echo $css; ?>>
                <a href="javascript:void(0)">
                    <i class="fa fa-list"></i>
                    <span><?php echo 'Dealer Spareparts'//lang('menu_sparepart'); ?></span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if (control('Sparepart Dealer Orders', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'spareparts') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('sparepart_orders') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_spareparts_dealer_order'); ?></a></li>
                    <?php endif; ?>                     
                    <?php if (control('Dealer Credits', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'spareparts') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('dealer_credits') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_sparepart_dealer_credit'); ?></a></li>
                    <?php endif; ?>
                    <?php if (control('Dealer Stocks', FALSE) && (!is_group(ARO))): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'spareparts') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('spareparts_report/dealer_index') ?>"><i class="fa fa-circle-o"></i><?php echo "Report"; ?></a></li>
                    <?php endif; ?>
                    <?php if (control('Dealer Credits', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'spareparts') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('dealer_credits/payment_index') ?>"><i class="fa fa-circle-o"></i><?php echo "Payment Register"//lang('menu_sparepart_dealer_credit'); ?></a></li>
                    <?php endif; ?>
                    <?php if (control('Dealer Stocks', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'spareparts') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('dealer_stocks')?>"><i class="fa fa-circle-o"></i><?php echo "Dealer Stock";//lang('menu_sparepart_order'); ?></a></li>
                    <?php endif; ?>                     
                    <?php if (control('Sparepart Stock Transfer Request', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'spareparts') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('stock_transfers/request_stock')?>"><i class="fa fa-circle-o"></i><?php echo "Stock Transfer Request";//lang('menu_sparepart_order'); ?></a></li>
                    <?php endif; ?>
                    <?php if (control('Spareparts Dealer Sales', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'spareparts') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('spareparts_dealer_sales')?>"><i class="fa fa-circle-o"></i><?php echo "Spareparts Dealer Sales";//lang('menu_sparepart_order'); ?></a></li>
                    <?php endif; ?>
                    <?php if (control('Dealer Stocks', FALSE) || control('Dealer Credits', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'spareparts') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('dealer_stocks/stock_check')?>"><i class="fa fa-circle-o"></i><?php echo "Check Stock";//lang('menu_sparepart_order'); ?></a></li>
                    <?php endif; ?>
                    <?php if (control('Spareparts Dealer Stock Adjustments', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'spareparts') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('spareparts_dealer_stock_adjustments')?>"><i class="fa fa-circle-o"></i><?php echo "Stock Adjustment";//lang('menu_sparepart_order'); ?></a></li>
                    <?php endif; ?>
                    <?php if (control('Spareparts Dealer Stock Adjustments', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'spareparts') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('spareparts_dealer_stock_adjustments/incharge_index')?>"><i class="fa fa-circle-o"></i><?php echo "Stock Adjustment Approve";//lang('menu_sparepart_order'); ?></a></li>
                    <?php endif; ?>
                    <?php if (control('Billing Details', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'billing_details' && !isset($uri[2])) ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/billing_details')?>"><i class="fa fa-circle-o"></i><?php echo "Dealer Billing";//lang('menu_sparepart_order'); ?></a></li>
                    <?php endif; ?>
                    <?php if (control('Billing Details', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'billing_details' && isset($uri[2]) && $uri[2] == 'dispatched_list') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/billing_details/dispatched_list')?>"><i class="fa fa-circle-o"></i><?php echo "Approve Dealer Billing";//lang('menu_sparepart_order'); ?></a></li>
                    <?php endif; ?>
                </ul>
            </li>
        <?php endif; ?> 

        <!-- service menu -->
        <?php if (control('Job Cards', FALSE)): ?>
            <li class="treeview" <?php echo $css; ?>>
                <a href="javascript:void(0)">
                    <i class="fa fa-wrench"></i>
                    <span><?php echo lang('menu_service'); ?></span>
                    <i class="fa fa-angle-left pull-right""></i>
                </a>
                <ul class="treeview-menu">
                    <?php if (control('Service Menu Master', FALSE)): ?>
                        <li>
                            <a href="#"><i class="fa fa-circle-o"></i><?php echo ('Master Data'); ?><span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                            <ul class="treeview-menu">
                                <?php if (control('Accessories', FALSE)): ?>
                                    <li <?php echo $css; ?>><a href="<?php echo site_url('admin/accessories') ?>"><i class="fa fa-file-text-o"></i><?php echo lang('menu_accessories'); ?></a></li>
                                <?php endif; ?>
                                <?php if (control('Service Types', FALSE)): ?>
                                    <li <?php echo $css; ?>><a href="<?php echo site_url('admin/service_types') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_service_types'); ?></a></li>
                                <?php endif; ?>
                                <?php if (control('Service Policies', FALSE)): ?>
                                    <li <?php echo $css; ?>><a href="<?php echo site_url('admin/service_policies') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_service_policies'); ?></a></li>
                                <?php endif; ?>
                                <?php if (control('Service Jobs', FALSE)): ?>
                                    <li <?php echo $css; ?>><a href="<?php echo site_url('admin/service_jobs') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_service_jobs'); ?></a></li>
                                <?php endif?>
                                <?php if (control('Service Warranty Policies', FALSE)): ?>
                                    <li <?php echo $css; ?>><a href="<?php echo site_url('admin/service_warranty_policies') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_service_warranty_policies'); ?></a></li>
                                <?php endif; ?>

                                
                            </ul>
                        </li>
                    <?php endif?>

                    <?php if (control('Job Cards', FALSE) && !is_group(ARO) && !is_group(CG_SPAREPART_OUTLET)): ?>
                        <li <?php echo $css; ?>>
                            <a href="<?php echo site_url('admin/job_cards'); ?>">
                                <i class="fa fa-file-text-o"></i> <span><?php echo lang('menu_job_cards'); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (control('Estimate Details', FALSE)): ?>
                        <li <?php echo $css; ?>>
                            <a href="<?php echo site_url('admin/estimate_details'); ?>">
                                <i class="fa fa-file-o"></i> <span><?php echo lang('menu_estimate_details'); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (control('User Ledgers', FALSE)):  ?>
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/user_ledgers') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_user_ledgers'); ?></a></li>
                    <?php endif; ?> 

                    <?php if (control('Purchase Orders', FALSE)): ?>
                        <li class="treeview" <?php echo $css; ?>>
                            <a href="javascript:void(0)">
                                <i class="fa fa-building-o"></i>
                                <span><?php echo lang('menu_purchase'); ?></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <?php if (control('Purchase Orders', FALSE)): ?>
                                    <?php $css = (isset($uri[1]) && $uri[1] == '') ? 'class="active"' : ''; ?> 
                                    <li <?php echo $css; ?>><a href="<?php echo site_url('admin/purchase_orders') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_purchase_orders'); ?></a></li>
                                <?php endif; ?>
                                <?php if (control('Purchase Challans', FALSE)): ?>
                                    <?php $css = (isset($uri[1]) && $uri[1] == '') ? 'class="active"' : ''; ?> 
                                    <li <?php echo $css; ?>><a href="<?php echo site_url('admin/purchase_challans') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_purchase_challans'); ?></a></li>
                                <?php endif; ?>
                                <?php if (control('Purchase Invoices', FALSE)): ?>
                                    <?php $css = (isset($uri[1]) && $uri[1] == '') ? 'class="active"' : ''; ?> 
                                    <li <?php echo $css; ?>><a href="<?php echo site_url('admin/purchase_invoices') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_purchase_invoices'); ?></a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                    
                    <?php if (control('Service Histories', FALSE)): ?>
                        <li <?php echo $css; ?> >
                            <a href="<?php echo site_url('admin/service_histories'); ?>">
                                <i class="fa fa-history "></i>
                                <span><?php echo lang('menu_service_histories'); ?></span>
                            </a>
                        </li>
                    <?php endif?>

                    <?php if (control('Service Report', FALSE)): ?>
                        <li <?php echo $css; ?>>
                            <a href="<?php echo site_url('service_reports'); ?>">
                                <i class="fa fa-wrench"></i> <span><?php echo lang('menu_service_report'); ?></span>
                            </a>
                        </li>
                        <li <?php echo $css; ?>>
                            <a href="<?php echo site_url('job_cards/service_report'); ?>">
                                <i class="fa fa-wrench"></i> <span><?php echo lang('menu_service_report'); ?> Pivot</span>
                            </a>
                        </li>
                    <?php endif?>
                    <?php if (control('Warranty Claims', FALSE)): ?>
                        <li <?php echo $css; ?> >
                            <a href="<?php echo site_url('admin/warranty_claims'); ?>">
                                <i class="fa fa-thumbs-up"></i> <span><?php echo lang('menu_warranty_claims'); ?></span>
                            </a>
                        </li>
                    <?php endif?>
                    <?php if (control('Local Purchases', FALSE)): ?>
                        <li <?php echo $css; ?> >
                            <a href="<?php echo site_url('admin/local_purchases'); ?>">
                                <i class="fa fa-circle-o"></i> <span><?php echo lang('menu_local_purchases'); ?></span>
                            </a>
                        </li>
                    <?php endif?>
                    <?php if(control('Ser Workshop Users', FALSE)):?>
                        <?php $css = (isset($uri[1]) && $uri[1] == '') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/ser_workshop_users')?>"><i class="fa fa-profile"></i><?php echo lang('menu_workshop_users');?></a></li>
                    <?php endif;?>
                </ul>
            </li>
        <?php endif;?>

        <?php if(control('Counter Sales', FALSE)): ?>
            <li <?php echo $css; ?>>
                <?php if(!is_group(ARO) && !is_group(CG_SPAREPART_OUTLET) && !is_group(SPAREPART_INCHARGE_GROUP) && !is_group(703)){?>
                    <a href="<?php echo site_url('admin/counter_sales'); ?>">
                        <i class="fa fa-cube"></i> <span><?php echo lang('menu_counter_sales'); ?></span>
                    </a>
                <?php }else{?>
                    <a href="<?php echo site_url('admin/counter_sales/aro'); ?>">
                        <i class="fa fa-cube"></i> <span><?php echo lang('menu_counter_sales'); ?></span>
                    </a>
                <?php }?>
            </li>
        <?php endif; ?>

        <?php if(is_accountant()): ?>
            <li <?php echo $css; ?>>
                <a href="<?php echo site_url('admin/service_reports/billing_summary'); ?>">
                    <i class="fa fa-money"></i> <span><?php echo 'Billing Summary'; ?></span>
                </a>
            </li>
        <?php endif; ?>
        <?php if (control('Sms Templates', FALSE)): ?>
            <li class="treeview" <?php echo $css; ?>>
                <a href="javascript:void(0)">
                    <i class="fa fa-envelope"></i>
                    <span><?php echo lang('menu_sms_templates'); ?></span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if (control('Sms Templates', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == '') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('admin/sms_templates/creator') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_sms_templates_creator'); ?></a></li>
                    <?php endif; ?>
                </ul>
            </li>
        <?php endif; ?>    

        <?php if (control('Ccd Department', FALSE)): ?>
            <li class="treeview" <?php echo $css; ?>>
                <a href="javascript:void(0)">
                    <i class="fa fa-user-secret" aria-hidden="true"></i>
                    <span><?php echo lang('menu_ccd'); ?></span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">                                       
                    <?php if (control('Ccd Inquiries', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'ccd_inquiries') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('ccd_inquiries') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_ccd_inquiries'); ?></a></li>
                    <?php endif; ?>
                    <?php if (control('Ccd Threedays', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'ccd_threedays') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('ccd_threedays') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_ccd_threedays'); ?></a></li>
                    <?php endif; ?>
                    <?php if (control('Ccd Department', FALSE)): ?>
                        <?php $css = (isset($uri[1]) && $uri[1] == 'ccd_inquiries/reports') ? 'class="active"' : ''; ?> 
                        <li <?php echo $css; ?>><a href="<?php echo site_url('ccd_inquiries/reports') ?>"><i class="fa fa-circle-o"></i><?php echo lang('menu_ccd_reports'); ?></a></li>
                    <?php endif; ?>
                </ul>
            </li>
        <?php endif; ?>      
    </ul>
</section>
<!-- /.sidebar -->
</aside>