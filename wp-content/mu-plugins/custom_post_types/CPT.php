<?php
class Custom_Post_Type
{
    public $post_type_name;
    public $post_type_args;
    public $post_type_labels;


      public function __construct( $name, $args = array(), $labels = array() )
      {

          $this->post_type_name        = strtolower( str_replace( ' ', '_', $name ) );
          $this->post_type_args        = $args;
          $this->post_type_labels  = $labels;


          if( ! post_type_exists( $this->post_type_name ) )
          {
              add_action( 'init', array( &$this, 'register_post_type' ) );
          }

      }


    public function register_post_type()
    {

        $name       =  self::beautify( $this->post_type_name ) ;
        $plural     =  self::pluralize( $name ) ;


        $labels = array_merge(

            // Default
            array(
                'name'                  => _x( $plural, 'post type general name' ),
                'singular_name'         => _x( $name, 'post type singular name' ),
                'add_new'               => _x( 'Add New', strtolower( $name ) ),
                'add_new_item'          => __( 'Add New ' . $name ),
                'edit_item'             => __( 'Edit ' . $name ),
                'new_item'              => __( 'New ' . $name ),
                'all_items'             => __( 'All ' . $plural ),
                'view_item'             => __( 'View ' . $name ),
                'search_items'          => __( 'Search ' . $plural ),
                'not_found'             => __( 'No ' . self::uglify( $plural ) . ' found'),
                'not_found_in_trash'    => __( 'No ' . self::uglify( $plural ) . ' found in Trash'),
                'parent_item_colon'     => '',
                'menu_name'             => $plural
            ),


            $this->post_type_labels

        );


        $args = array_merge(

            // Default
            array(
                'label'                 => $plural,
                'labels'                => $labels,
                'public'                => true,
                'supports'              => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
                'show_in_nav_menus'     => true,
								'taxonomies' => array('post_tag')
            ),

            // Given args
            $this->post_type_args

        );

        // Register the post type
        register_post_type( $this->post_type_name, $args );
    }

  public static function pluralize( $string )
  {
      $last = $string[strlen( $string ) - 1];

      if( $last == 'y' )
      {
          $cut = substr( $string, 0, -1 );
          //convert y to ies
          $plural = $cut . 'ies';
      }
      else
      {

          $plural = $string . 's';
      }

      return $plural;
  }

	public static function beautify( $string )
	{
				return ucwords( str_replace( '_', ' ', $string ) );
	}

	public static function uglify( $string )
	{
				return strtolower( str_replace( ' ', '_', $string ) );
	}


}

?>
