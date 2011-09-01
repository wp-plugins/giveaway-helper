<?php 
    /* 
    Plugin Name: Giveaway Helper 
    Plugin URI: http://www.techishare.com/giveaway-helper-a-wordpress-plugin-for-those-who-giveaway/ 
    Description: Plugin that helps you select winners through Random.org 
    Author: G. Samuel Rajkumar 
    Version: 1.1 
    Author URI: http://www.techishare.com 
    */  
function givehelp_admin_actions() {  
add_management_page('Giveaway Helper', 'Giveaway Helper', 1, 'Giveaway-helper', 'process');
}  

add_action('admin_menu', 'givehelp_admin_actions'); 

function process() {  
    include('process.php');  
	  
} 	
?>