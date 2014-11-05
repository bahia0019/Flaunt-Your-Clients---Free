<?php
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package   Flaunt Your Studio
 * @author    William Bay <william@flauntyoursite.com>
 * @license   GPL-2.0+
 * @link      http://flauntyoursite.com
 * @copyright 2014 Flaunt Your Site
 */
?>

<div class="wrap" id="admin-wrap">
	<div class="admin-header">
		<a href="http://flauntyoursite.com" class="admin-logo"></a>
        <h2 class="flaunt-admin-title">Flaunt Your Studio Options</h2>
            <div class="custom-site-cta">
                <p>Looking for a beautiful <span class="custom-site-cta-orange">Custom Designed Website</span>? Let Flaunt Your Site help you with that.</p>
                <a href="http://flauntyoursite.com" class="custom-site-cta-button" target="_blank">Find Out More!</a>
            </div>
	</div>

        <div class="icon32"></div>
        <?php settings_errors(); ?>

        <?php
            if( isset( $_GET[ 'tab' ] ) ) {
            $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'display_options';
            } // end if
        ?>


        <h2 class="nav-tab-wrapper">
            <a href="?page=fys_options&tab=display_options" class="nav-tab <?php echo $active_tab == 'display_options' ? 'nav-tab-active' : ''; ?>">Display Options</a>
            <a href="?page=fys_options&tab=social_options" class="nav-tab <?php echo $active_tab == 'social_options' ? 'nav-tab-active' : ''; ?>">Social Options</a>
            <a href="#" class="nav-tab">Display Options</a>
            <a href="#" class="nav-tab">Social Options</a>
            <a href="#" class="nav-tab">Blog Call To Actions</a>            
            <a href="#" class="nav-tab">Support</a>
            <a href="#" class="nav-tab">Tutorials</a>             
        </h2>
         
        <form method="post" action="options.php">
 
            <?php settings_fields( 'fys_display_options' ); ?>
            <?php do_settings_sections( 'fys_display_options' ); ?> 
             
            <?php settings_fields( 'fys_social_options' ); ?>
            <?php do_settings_sections( 'fys_social_options' ); ?> 

            <?php settings_fields( 'fys_display_options' ); ?>
            <?php do_settings_sections( 'fys_display_options' ); ?> 
             
            <?php settings_fields( 'fys_social_options' ); ?>
            <?php do_settings_sections( 'fys_social_options' ); ?>   

            <?php settings_fields( 'fys_support' ); ?>
            <?php do_settings_sections( 'fys_support' ); ?> 
             
            <?php settings_fields( 'fys_tutorials' ); ?>
            <?php do_settings_sections( 'fys_tutorials' ); ?>           
         
            <?php submit_button(); ?>
             
        </form>



</div>



