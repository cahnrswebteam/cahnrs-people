<?php namespace cahnrswp\cahnrs\people;
/**
* Plugin Name: CAHNRS People
* Plugin URI:  http://cahnrs.wsu.edu/communications/
* Description: Adds people content type
* Version:     1.3
* Author:      CAHNRS Communications, Danial Bleile
* Author URI:  http://cahnrs.wsu.edu/communications/
* License:     Copyright Washington State University
* License URI: http://copyright.wsu.edu
*/

class init_plugin {
	
	public $person;
	public $people_controller;
	public $people_view; 
	
	public function __construct(){
		$this->person = new person_model();
		$this->people_controller = new people_control( $this->person );
		$this->people_view = new people_view( $this->people_controller , $this->person );
		
		add_action( 'init', array( $this->person , 'register_people' ) );
		
		if( is_admin() ){ 
			\add_action( 'edit_form_after_title', array( $this->people_view , 'output_editor'  ) , 99 );
			\add_action('save_post', array( $this->person , 'save_people' ) );
		} else {
			\add_filter( 'the_content' , array( $this->people_view , 'output_public' ), 1 );
		}
	}
}

class people_control {
	
	private $person;
	
	public function __construct( $person ){
		$this->person = $person;
	}

	
	public function set_person( $post ){
		$this->person->load_person( $post );
	}
}

class person_model {
	public $post;
	public $post_meta;
	public $title;
	public $email;
	public $phone;
	public $office;
	public $address;
	public $graduate;
	public $undergraduate;
	public $biography;
	public $cv;
	
	public function register_people(){
	   $args = array(
		  'public' => true,
		  'label'  => 'People',
		  'taxonomies' => array('category','post_tag'),
		  'supports' => array( 'title', 'author', 'thumbnail', 'excerpt' )
		);
		register_post_type( 'people', $args );
	}
	
	public function load_person( $post ){
		$this->post_meta = \get_post_meta( $post->ID );
		$this->title = $this->check_legacy( '_title' , 'position' );
		$this->email = $this->check_legacy( '_email' , 'email' );
		$this->phone = $this->check_legacy( '_phone' , 'phone' );
		$this->office = $this->check_legacy( '_office' , 'office' );
		$this->address = $this->check_legacy( '_address' , 'p_address' );
		$this->graduate = $this->check_legacy( '_graduate' , 'graduate' );
		$this->undergraduate = $this->check_legacy( '_undergraduate' , 'undergraduate' );
		$this->cv = $this->check_legacy( '_cv' , 'cv' );
		$this->biography =  $post->post_content;
	}
	
	public function save_people() {
	}
	
	public function check_legacy( $current , $legacy ){
		if( isset( $this->post_meta[ $current ][0] ) && $this->post_meta[ $current ][0] ){
			return $this->post_meta[ $current ][0];
		} else {
			if( isset( $this->post_meta[ $legacy ][0] ) && $this->post_meta[ $legacy ][0] ) {
				return $this->post_meta[ $legacy ][0];
			} else {
				return '';
			}
		}
	}
}

class people_view {
	private $people_controller;
	private $person;
	
	public function __construct( $people_controller , $person ){
		$this->people_controller  = $people_controller;
		$this->person = $person;
	}
	
	
	public function output_editor( $post ){
		if( 'people' == $post->post_type ){
			$this->people_controller->set_person( $post );
			include 'inc/editor.php';
		}
		
	}
	
	public function output_public( $content ){
		if( is_singular('people' ) ){
			global $post;
			$this->people_controller->set_person( $post );
			ob_start();
				include 'inc/public.php';
			return ob_get_clean();
		} else {
			return $content;
		}
	}
}

$cahnrs_people = new init_plugin();