<?php
namespace TH_ESSENTIAL;
defined( 'ABSPATH' ) || exit;


class Manager{

    private static $instance;

    public function load(){

        do_action('dlTheEss/manager/before');
        
        // load enqueue manager
        Manager\Enqueue::instance()->register();

        do_action('dlTheEss/manager/after');
    }

    public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }
}

