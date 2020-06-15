<?php if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

class Innofit_Repeater extends WP_Customize_Control {

	public $id;
	private $boxtitle = array();
	private $add_field_label = array();
	private $customizer_repeater_title_control = false;
	private $customizer_repeater_subtitle_control = false;
	private $customizer_repeater_button_text_control = false;
	private $customizer_repeater_link_control = false;
	private $customizer_repeater_slide_format = false;
	private $customizer_repeater_video_url_control = false;
	private $customizer_repeater_image_control = false;
	private $customizer_repeater_icon_control = false;
	private $customizer_repeater_color_control = false;
	private $customizer_repeater_text_control = false;
	private $customizer_repeater_designation_control = false;
	private $customizer_repeater_shortcode_control = false;
	private $customizer_repeater_repeater_control = false;
	private $customizer_repeater_checkbox_control = false;
	private $customizer_repeater_price_control = false;
	private $customizer_repeater_features_control = false;
	private $customizer_repeater_price_heighlight = false;
	
    private $customizer_icon_container = '';
    private $allowed_html = array();


	/*Class constructor*/
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
		/*Get options from customizer.php*/
		$this->add_field_label = esc_html__( 'Add new field', 'innofit' );
		if ( ! empty( $args['add_field_label'] ) ) {
			$this->add_field_label = $args['add_field_label'];
		}

		$this->boxtitle = esc_html__( 'Customizer Repeater', 'innofit' );
		if ( ! empty ( $args['item_name'] ) ) {
			$this->boxtitle = $args['item_name'];
		} elseif ( ! empty( $this->label ) ) {
			$this->boxtitle = $this->label;
		}

		if ( ! empty( $args['customizer_repeater_image_control'] ) ) {
			$this->customizer_repeater_image_control = $args['customizer_repeater_image_control'];
		}
	

		if ( ! empty( $args['customizer_repeater_icon_control'] ) ) {
			$this->customizer_repeater_icon_control = $args['customizer_repeater_icon_control'];
		}

		if ( ! empty( $args['customizer_repeater_color_control'] ) ) {
			$this->customizer_repeater_color_control = $args['customizer_repeater_color_control'];
		}

		if ( ! empty( $args['customizer_repeater_title_control'] ) ) {
			$this->customizer_repeater_title_control = $args['customizer_repeater_title_control'];
		}
		
		if ( ! empty( $args['customizer_repeater_subtitle_control'] ) ) {
			$this->customizer_repeater_subtitle_control = $args['customizer_repeater_subtitle_control'];
		}

		if ( ! empty( $args['customizer_repeater_text_control'] ) ) {
			$this->customizer_repeater_text_control = $args['customizer_repeater_text_control'];
		}
		
		if ( ! empty( $args['customizer_repeater_designation_control'] ) ) {
			$this->customizer_repeater_designation_control = $args['customizer_repeater_designation_control'];
		}
		
		if ( ! empty( $args['customizer_repeater_button_text_control'] ) ) {
			$this->customizer_repeater_button_text_control = $args['customizer_repeater_button_text_control'];
		}

		if ( ! empty( $args['customizer_repeater_link_control'] ) ) {
			$this->customizer_repeater_link_control = $args['customizer_repeater_link_control'];
		}
		
		if ( ! empty( $args['customizer_repeater_checkbox_control'] ) ) {
			$this->customizer_repeater_checkbox_control = $args['customizer_repeater_checkbox_control'];
		}
		
		if ( ! empty( $args['customizer_repeater_slide_format'] ) ) {
			$this->customizer_repeater_slide_format = $args['customizer_repeater_slide_format'];
		}
		
		if ( ! empty( $args['customizer_repeater_price_heighlight'] ) ) {
			$this->customizer_repeater_price_heighlight = $args['customizer_repeater_price_heighlight'];
		}
		
		
		
		if ( ! empty( $args['customizer_repeater_video_url_control'] ) ) {
			$this->customizer_repeater_video_url_control = $args['customizer_repeater_video_url_control'];
		}
		
		if ( ! empty( $args['customizer_repeater_price_control'] ) ) {
			$this->customizer_repeater_price_control = $args['customizer_repeater_price_control'];
		}
		
		if ( ! empty( $args['customizer_repeater_features_control'] ) ) {
			$this->customizer_repeater_features_control = $args['customizer_repeater_features_control'];
		}
		

		if ( ! empty( $args['customizer_repeater_shortcode_control'] ) ) {
			$this->customizer_repeater_shortcode_control = $args['customizer_repeater_shortcode_control'];
		}

		if ( ! empty( $args['customizer_repeater_repeater_control'] ) ) {
			$this->customizer_repeater_repeater_control = $args['customizer_repeater_repeater_control'];
		}
		

		if ( ! empty( $id ) ) {
			$this->id = $id;
		}

		if ( file_exists( INNOFIT_TEMPLATE_DIR . '/functions/customizer-repeater/inc/icons.php' ) ) {
			$this->customizer_icon_container =  'functions/customizer-repeater/inc/icons';
		}

		$allowed_array1 = wp_kses_allowed_html( 'post' );
		$allowed_array2 = array(
			'input' => array(
				'type'        => array(),
				'class'       => array(),
				'placeholder' => array()
			)
		);

		$this->allowed_html = array_merge( $allowed_array1, $allowed_array2 );
	}

	/*Enqueue resources for the control*/
	public function enqueue() {
		wp_enqueue_style( 'font-awesome', INNOFIT_TEMPLATE_DIR_URI . '/css/font-awesome/css/font-awesome.min.css', array(), 999 );

		wp_enqueue_style( 'innofit_customizer-repeater-admin-stylesheet', INNOFIT_TEMPLATE_DIR_URI . '/functions/customizer-repeater/css/admin-style.css', array(), 999 );

		wp_enqueue_style( 'wp-color-picker' );

		wp_enqueue_script( 'innofit_customizer-repeater-script', INNOFIT_TEMPLATE_DIR_URI . '/functions/customizer-repeater/js/customizer_repeater.js', array('jquery', 'jquery-ui-draggable', 'wp-color-picker' ), 999, true  );

		wp_enqueue_script( 'innofit_customizer-repeater-fontawesome-iconpicker', INNOFIT_TEMPLATE_DIR_URI . '/functions/customizer-repeater/js/fontawesome-iconpicker.js', array( 'jquery' ), 999, true );

		wp_enqueue_style( 'innofit_customizer-repeater-fontawesome-iconpicker-script', INNOFIT_TEMPLATE_DIR_URI . '/functions/customizer-repeater/css/fontawesome-iconpicker.min.css', array(), 999 );
	}

	public function render_content() {

		/*Get default options*/
		$this_default = json_decode( $this->setting->default );

		/*Get values (json format)*/
		$values = $this->value();

		/*Decode values*/
		$json = json_decode( $values );

		if ( ! is_array( $json ) ) {
			$json = array( $values );
		} ?>

		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<div class="customizer-repeater-general-control-repeater customizer-repeater-general-control-droppable">
			<?php
			if ( ( count( $json ) == 1 && '' === $json[0] ) || empty( $json ) ) {
				if ( ! empty( $this_default ) ) {
					$this->innofit_iterate_array( $this_default ); ?>
					<input type="hidden"
					       id="customizer-repeater-<?php echo esc_attr( $this->id ); ?>-colector" <?php esc_attr( $this->link() ); ?>
					       class="customizer-repeater-colector"
					       value="<?php echo esc_attr( json_encode( $this_default ) ); ?>"/>
					<?php
				} else {
					$this->innofit_iterate_array(); ?>
					<input type="hidden"
					       id="customizer-repeater-<?php echo esc_attr( $this->id ); ?>-colector" <?php esc_attr( $this->link() ); ?>
					       class="customizer-repeater-colector"/>
					<?php
				}
			} else {
				$this->innofit_iterate_array( $json ); ?>
				<input type="hidden" id="customizer-repeater-<?php echo esc_attr( $this->id ); ?>-colector" <?php esc_attr( $this->link() ); ?>
				       class="customizer-repeater-colector" value="<?php echo esc_attr( $this->value() ); ?>"/>
				<?php
			} ?>
			</div>
		<button type="button" class="button add_field customizer-repeater-new-field">
			<?php echo esc_html( $this->add_field_label ); ?>
		</button>
		<?php
	}

	private function innofit_iterate_array($array = array()){
		
		/*Counter that helps checking if the box is first and should have the delete button disabled*/
		$it = 0;
		if(!empty($array)){
			$exist_service=count($array);
			if($this->boxtitle=="Team Member")
			{
				$innofit_del_btn_id="Team_Member";
			}
			else
			{
				$innofit_del_btn_id=$this->boxtitle;
			}
			global $innofit_limit;
			global $type_with_id;
			echo '<input type="hidden" value="'.esc_attr($exist_service).'" id="exist_innofit_'.esc_attr($innofit_del_btn_id).'"/>';
			foreach($array as $icon){ 
			if($it<3)
			{
			$innofit_limit="innofit_limit";
			$type_with_id='';
			}
			else
			{
			$innofit_limit="innofit_overlimit";	
			$type_with_id=$innofit_del_btn_id."_".$it;
			}


				?>
				<div class="customizer-repeater-general-control-repeater-container customizer-repeater-draggable">
					<div class="customizer-repeater-customize-control-title">
						<?php echo esc_html( $this->boxtitle ) ?>
					</div>
					<div class="customizer-repeater-box-content-hidden">
						<?php
						$choice = $image_url = $icon_value = $title = $subtitle = $text = $slide_format = $link = $designation = $button = $open_new_tab = $shortcode = $repeater = $color = $video_url = $price = $features =$price_heighlight = '';
						if(!empty($icon->id)){
							$id = $icon->id;
						}
						if(!empty($icon->choice)){
							$choice = $icon->choice;
						}
						if(!empty($icon->image_url)){
							$image_url = $icon->image_url;
						}
						if(!empty($icon->icon_value)){
							$icon_value = $icon->icon_value;
						}
						if(!empty($icon->color)){
							$color = $icon->color;
						}
						if(!empty($icon->title)){
							$title = $icon->title;
						}
						
						if(!empty($icon->designation)){
							$designation = $icon->designation;
						}
						
						if(!empty($icon->subtitle)){
							$subtitle =  $icon->subtitle;
						}
						if(!empty($icon->text)){
							$text = $icon->text;
						}
						if(!empty($icon->video_url)){
							$video_url = $icon->video_url;
						}
						
						if(!empty($icon->slide_format)){
							$slide_format = $icon->slide_format;
						}
						
						if(!empty($icon->button_text)){
							$button = $icon->button_text;
						}
						if(!empty($icon->link)){
							$link = $icon->link;
						}
						if(!empty($icon->shortcode)){
							$shortcode = $icon->shortcode;
						}

						if(!empty($icon->social_repeater)){
							$repeater = $icon->social_repeater;
						}
						
						if(!empty($icon->open_new_tab)){
							$open_new_tab = $icon->open_new_tab;
						}
						
						if(!empty($icon->price)){
							$price = $icon->price;
						}
						
						if(!empty($icon->features)){
							$features = $icon->features;
						}
						
						if(!empty($icon->price_heighlight)){
							$price_heighlight = $icon->price_heighlight;
						}
						
						
						if($this->customizer_repeater_title_control==true){
							$this->innofit_input_control(array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Title','innofit' ), $this->id, 'customizer_repeater_title_control' ),
								'class' => 'customizer-repeater-title-control '."$innofit_limit".' '."$type_with_id".'',
                                'type'  => apply_filters('innofit_repeater_input_types_filter', '', $this->id, 'customizer_repeater_title_control' ),
							), $title);
						}
						
						
						if($this->customizer_repeater_subtitle_control==true){
							$this->innofit_input_control(array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Subtitle','innofit' ), $this->id, 'customizer_repeater_subtitle_control' ),
								'class' => 'customizer-repeater-subtitle-control '."$innofit_limit".' '."$type_with_id".'',
								'type'  => apply_filters('innofit_repeater_input_types_filter', '', $this->id, 'customizer_repeater_subtitle_control' ),
							), $subtitle);
						}
						if($this->customizer_repeater_text_control==true){
							$this->innofit_input_control(array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Description','innofit' ), $this->id, 'customizer_repeater_text_control' ),
								'class' => 'customizer-repeater-text-control '."$innofit_limit".'',
								'type'  => apply_filters('innofit_repeater_input_types_filter', 'textarea', $this->id, 'customizer_repeater_text_control' ),
							), $text);
						}
						
						if($this->customizer_repeater_features_control==true){
							$this->innofit_input_control(array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Features','innofit' ), $this->id, 'customizer_repeater_features_control' ),
								'class' => 'customizer-repeater-features-control ',
								'type'  => apply_filters('innofit_repeater_input_types_filter', 'textarea', $this->id, 'customizer_repeater_features_control' ),
							), $features);
						}
						
						
						
						
						if($this->customizer_repeater_button_text_control){
							$this->innofit_input_control(array(
							'label' => apply_filters('repeater_input_labels_filter', esc_html__('Button Text',
							'innofit'), $this->id, 'customizer_repeater_button_text_control'),
							'class' => 'customizer-repeater-button-text-control '."$innofit_limit".'',
							'type' => apply_filters('innofit_repeater_input_types_filter', '' , $this->id,
							'customizer_repeater_button_text_control'),
							), $button);
						}
						
						
						if($this->customizer_repeater_link_control){
							$this->innofit_input_control(array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Link','innofit' ), $this->id, 'customizer_repeater_link_control' ),
								'class' => 'customizer-repeater-link-control '."$innofit_limit".' '."$type_with_id".'',
								'sanitize_callback' => 'esc_url_raw',
                                'type'  => apply_filters('innofit_repeater_input_types_filter', '', $this->id, 'customizer_repeater_link_control' ),
							), $link);
						}
						
						if($this->customizer_repeater_checkbox_control == true){
							$this->innofit_testimonila_check($open_new_tab, $innofit_limit, $type_with_id);
							
						}
						
						if($this->customizer_repeater_price_control==true){
							$this->innofit_input_control(array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Price','innofit' ), $this->id, 'customizer_repeater_price_control' ),
								'class' => 'customizer-repeater-price-control',
                                'type'  => apply_filters('innofit_repeater_input_types_filter', '', $this->id, 'customizer_repeater_price_control' ),
							), $price);
						}
						
						
						
						if($this->customizer_repeater_slide_format == true){
							$this->innofit_slide_format($slide_format);
							
						}
						
						if($this->customizer_repeater_price_heighlight == true){
							$this->innofit_price_heighlight($price_heighlight);
							
						}
						
						
						
						if($this->customizer_repeater_video_url_control){
							$this->innofit_input_control(array(
							'label' => apply_filters('repeater_input_labels_filter', esc_html__('Video Url',
							'innofit'), $this->id, 'customizer_repeater_video_url_control'),
							'class' => 'customizer-repeater-video-url-control',
							'type'  => apply_filters('customizer_repeater_video_url_control', 'textarea', $this->id, 'customizer_repeater_video_url_control' ),
							), $video_url);
						}
						
						
						
						if($this->customizer_repeater_image_control == true && $this->customizer_repeater_icon_control == true) {
							$this->innofit_icon_type_choice( $choice,$innofit_limit );
						}
						if($this->customizer_repeater_image_control == true){
							$this->image_control($image_url, $choice, $innofit_limit, $it+1, $innofit_del_btn_id);
						}
						if($this->customizer_repeater_icon_control == true){
							$this->innofit_icon_picker_control($icon_value, $choice, $innofit_limit);
						}
						
					
						
						
						if($this->customizer_repeater_color_control == true){
							$this->innofit_input_control(array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Color','innofit' ), $this->id, 'customizer_repeater_color_control' ),
								'class' => 'customizer-repeater-color-control',
								'type'  => apply_filters('innofit_repeater_input_types_filter', 'color', $this->id, 'customizer_repeater_color_control' ),
								'sanitize_callback' => 'sanitize_hex_color'
							), $color);
						}
						
						
						if($this->customizer_repeater_shortcode_control==true){
							$this->innofit_input_control(array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Shortcode','innofit' ), $this->id, 'customizer_repeater_shortcode_control' ),
								'class' => 'customizer-repeater-shortcode-control',
                                'type'  => apply_filters('innofit_repeater_input_types_filter', '', $this->id, 'customizer_repeater_shortcode_control' ),
							), $shortcode);
						}
						
						if($this->customizer_repeater_designation_control==true){
							$this->innofit_input_control(array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Designation','innofit' ), $this->id, 'customizer_repeater_designation_control' ),
								'class' => 'customizer-repeater-designation-control '."$innofit_limit".'',
								'type'  => apply_filters('innofit_repeater_input_types_filter', 'textarea', $this->id, 'customizer_repeater_designation_control' ),
							), $designation);
						}
						
						if($this->customizer_repeater_repeater_control==true){
							$this->innofit_repeater_control($repeater, $innofit_limit, $type_with_id);
						} ?>

						<input type="hidden" class="social-repeater-box-id" value="<?php if ( ! empty( $id ) ) {
							echo esc_attr( $id );
						} ?>">
						<button type="button" class="social-repeater-general-control-remove-field" <?php if ( $it == 0 ) {
							echo 'style="display:none;"';
						} ?>>
							<?php esc_html_e( 'Delete ', 'innofit' ); ?><?php echo esc_html($this->boxtitle);?>
						</button>

					</div>
				</div>

				<?php
				$it++;
			}
		} else { ?>
			<div class="customizer-repeater-general-control-repeater-container">
				<div class="customizer-repeater-customize-control-title">
					<?php echo esc_html( $this->boxtitle ) ?>
				</div>
				<div class="customizer-repeater-box-content-hidden">
					<?php
					if ( $this->customizer_repeater_image_control == true && $this->customizer_repeater_icon_control == true ) {
						$this->innofit_icon_type_choice();
					}
					if ( $this->customizer_repeater_image_control == true ) {
						$this->image_control();
					}
					if ( $this->customizer_repeater_icon_control == true ) {
						$this->innofit_icon_picker_control();
					}
					
					
						
					if($this->customizer_repeater_color_control==true){
						$this->innofit_input_control(array(
							'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Color','innofit' ), $this->id, 'customizer_repeater_color_control' ),
							'class' => 'customizer-repeater-color-control',
							'type'  => apply_filters('innofit_repeater_input_types_filter', 'color', $this->id, 'customizer_repeater_color_control' ),
							'sanitize_callback' => 'sanitize_hex_color'
						) );
					}
					if ( $this->customizer_repeater_title_control == true ) {
						$this->innofit_input_control( array(
							'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Title','innofit' ), $this->id, 'customizer_repeater_title_control' ),
							'class' => 'customizer-repeater-title-control',
                            'type'  => apply_filters('innofit_repeater_input_types_filter', '', $this->id, 'customizer_repeater_title_control' ),
						) );
					}
					
					
					if ( $this->customizer_repeater_subtitle_control == true ) {
						$this->innofit_input_control( array(
							'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Subtitle','innofit' ), $this->id, 'customizer_repeater_subtitle_control' ),
							'class' => 'customizer-repeater-subtitle-control',
                            'type'  => apply_filters('innofit_repeater_input_types_filter', '', $this->id, 'customizer_repeater_subtitle_control' ),
						) );
					}
					if ( $this->customizer_repeater_text_control == true ) {
						$this->innofit_input_control( array(
							'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Description','innofit' ), $this->id, 'customizer_repeater_text_control' ),
							'class' => 'customizer-repeater-text-control',
							'type'  => apply_filters('innofit_repeater_input_types_filter', 'textarea', $this->id, 'customizer_repeater_text_control' ),
						) );
					}
					
					if ( $this->customizer_repeater_features_control == true ) {
						$this->innofit_input_control( array(
							'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Features','innofit' ), $this->id, 'customizer_repeater_features_control' ),
							'class' => 'customizer-repeater-features-control',
							'type'  => apply_filters('innofit_repeater_input_types_filter', 'textarea', $this->id, 'customizer_repeater_features_control' ),
						) );
					}
					
					
					
					if($this->customizer_repeater_button_text_control){
							$this->innofit_input_control(array(
							'label' => apply_filters('repeater_input_labels_filter', esc_html__('Button Text',
							'innofit'), $this->id, 'customizer_repeater_button_text_control'),
							'class' => 'customizer-repeater-button-text-control',
							'type' => apply_filters('innofit_repeater_input_types_filter', '' , $this->id,
							'customizer_repeater_button_text_control'),
							));
						}
						
					if ( $this->customizer_repeater_link_control == true ) {
						$this->innofit_input_control( array(
							'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Link','innofit' ), $this->id, 'customizer_repeater_link_control' ),
							'class' => 'customizer-repeater-link-control',
                            'type'  => apply_filters('innofit_repeater_input_types_filter', '', $this->id, 'customizer_repeater_link_control' ),
						) );
					}
					
					if($this->customizer_repeater_checkbox_control == true){
							$this->innofit_testimonila_check();
							
						}
					
					if ( $this->customizer_repeater_price_control == true ) {
						$this->innofit_input_control( array(
							'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Price','innofit' ), $this->id, 'customizer_repeater_price_control' ),
							'class' => 'customizer-repeater-price-control',
                            'type'  => apply_filters('innofit_repeater_input_types_filter', '', $this->id, 'customizer_repeater_price_control' ),
						) );
					}
					
					
					
					
					if($this->customizer_repeater_slide_format == true){
							$this->innofit_slide_format($slide_format);
							
					}
					
					if($this->customizer_repeater_price_heighlight == true){
							$this->innofit_price_heighlight($price_heighlight);
							
					}
					
					if($this->customizer_repeater_video_url_control){
							$this->innofit_input_control(array(
							'label' => apply_filters('repeater_input_labels_filter', esc_html__('Video Url',
							'innofit'), $this->id, 'customizer_repeater_video_url_control'),
							'class' => 'customizer-repeater-video-url-control',
							'type'  => apply_filters('customizer_repeater_video_url_control', 'textarea', $this->id, 'customizer_repeater_video_url_control' ),
							));
						}
					
					
					
					if ( $this->customizer_repeater_shortcode_control == true ) {
						$this->innofit_input_control( array(
							'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Shortcode','innofit' ), $this->id, 'customizer_repeater_shortcode_control' ),
							'class' => 'customizer-repeater-shortcode-control',
                            'type'  => apply_filters('innofit_repeater_input_types_filter', '', $this->id, 'customizer_repeater_shortcode_control' ),
						) );
					}
					
					
					if ( $this->customizer_repeater_designation_control == true ) {
						$this->innofit_input_control( array(
							'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Designation','innofit' ), $this->id, 'customizer_repeater_designation_control' ),
							'class' => 'customizer-repeater-designation-control',
							'type'  => apply_filters('innofit_repeater_input_types_filter', 'textarea', $this->id, 'customizer_repeater_designation_control' ),
						) );
					}
					
					if($this->customizer_repeater_repeater_control==true){
						$this->innofit_repeater_control();
					} ?>
					<input type="hidden" class="social-repeater-box-id">
					<button type="button" class="social-repeater-general-control-remove-field button" style="display:none;">
						<?php esc_html_e( 'Delete field', 'innofit' ); ?>
					</button>
				</div>
			</div>
			<?php
		}
	}

	private function innofit_input_control( $options, $value='' ){
//print_r($options);
	?>
		<span class="customize-control-title <?php echo esc_html( $options['label'] ); ?>" 
		<?php if($options['class']== 'customizer-repeater-video-url-control') {echo 'style="display:none;"'; }?>
		
		><?php echo esc_html( $options['label'] ); ?></span>
		<?php
		if( !empty($options['type']) ){
			switch ($options['type']) {
				case 'textarea':?>
					<textarea class="<?php echo esc_attr( $options['class'] ); ?>" placeholder="<?php echo esc_attr( $options['label'] ); ?>"><?php echo ( !empty($options['sanitize_callback']) ?  call_user_func_array( $options['sanitize_callback'], array( $value ) ) : esc_attr($value) ); ?></textarea>
					<?php
                    break;
				case 'color': ?>
					<input type="text" value="<?php echo ( !empty($options['sanitize_callback']) ?  call_user_func_array( $options['sanitize_callback'], array( $value ) ) : esc_attr($value) ); ?>" class="<?php echo esc_attr($options['class']); ?>" />
					<?php
					break;
			}
		} else { ?>
			<input type="text" value="<?php echo ( !empty($options['sanitize_callback']) ?  call_user_func_array( $options['sanitize_callback'], array( $value ) ) : esc_attr($value) ); ?>" class="<?php echo esc_attr($options['class']); ?>" placeholder="<?php echo esc_attr( $options['label'] ); ?>"/>
			<?php
		}
	}
	
	
	private function innofit_testimonila_check($value='no', $class='', $type_with_id=''){
		?>
	<div class="customize-control-title">
	<?php esc_html_e('Open link in new tab:','innofit'); ?>
	<span class="switch">
	  <input type="checkbox" name="custom_checkbox" value="yes" <?php if($value=='yes'){echo 'checked';}?> class="customizer-repeater-checkbox <?php echo esc_attr($class);?> <?php echo $type_with_id;?>">
	</span>
	</div>
	<?php
	}

	private function innofit_icon_picker_control($value = '', $show = '', $class=''){ ?>
		<div class="social-repeater-general-control-icon" <?php if( $show === 'customizer_repeater_image' || $show === 'customizer_repeater_none' ) { echo 'style="display:none;"'; } ?>>
            <span class="customize-control-title">
                <?php esc_html_e('Icon','innofit'); ?>
            </span>
			<span class="description customize-control-description">
                <?php
                echo sprintf(
	                esc_html__( 'Note: Some icons may not be displayed here. You can see the full list of icons at %1$s.', 'innofit' ),
	                sprintf( '<a href="http://fontawesome.io/icons/" rel="nofollow">%s</a>', esc_html__( 'http://fontawesome.io/icons/', 'innofit' ) )
                ); ?>
            </span>
			<div class="input-group icp-container">
				<input data-placement="bottomRight" class="<?php if($class=="innofit_limit") { echo 'icp icp-auto';} else { echo 'innofit-overlimit-icon-picker icp icp-auto';}?>" value="<?php if(!empty($value)) { echo esc_attr( $value );} ?>" type="text">
				<span class="input-group-addon">
                    <i class="fa <?php echo esc_attr($value); ?>"></i>
                </span>
			</div>
            <?php get_template_part( $this->customizer_icon_container ); ?>
		</div>
		<?php
	}

	private function image_control($value = '', $show = '', $class='', $auto='', $sections=''){ 
		if($auto==1)
		{
			$auto="one";
		}

		if($auto==2)
		{
			$auto="two";
		}
		if($auto==3)
		{
			$auto="three";
		}
		if(($sections=="Team_Member") && ($auto==4))
		{
			$team_calss="fourth_team";
		}
		else
		{
			$team_calss='';
		}
		

		?>
		<div class="customizer-repeater-image-control" <?php if( $show === 'customizer_repeater_icon' || $show === 'customizer_repeater_none' ) { echo 'style="display:none;"'; } ?>>
            <span class="customize-control-title">
                <?php esc_html_e('Image','innofit')?>
            </span>
			<input type="text" class="widefat custom-media-url <?php if($class="innofit_overlimit") { echo 'innofit-uploading-img';}?> <?php echo esc_attr($auto);?> <?php echo esc_attr($team_calss);?>" value="<?php echo esc_attr( $value ); ?>">
			<input type="button" class="button button-secondary customizer-repeater-custom-media-button <?php if($class="innofit_overlimit") { echo 'innofit-uploading-img-btn';}?> <?php echo esc_attr($auto);?> <?php echo esc_attr($team_calss);?>" value="<?php esc_html_e( 'Upload Image','innofit' ); ?>" />
		</div>
		<?php
	}
	
	
	private function innofit_slide_format($value='customizer_repeater_slide_format_standard'){?>
	
	<span class="customize-control-title">
	<?php esc_html_e('Slide Format','innofit'); ?>
	</span>
	<select class="customizer-repeater-slide-format">
		<option value="customizer_repeater_slide_format_standard" <?php selected($value,'customizer_repeater_slide_format_standard');?>>
		<?php esc_html_e('Standard','innofit') ?>
		</option>
		
		<option value="customizer_repeater_slide_format_aside" <?php selected($value,'customizer_repeater_slide_format_aside');?>>
		<?php esc_html_e('Aside','innofit') ?>
		</option>
		
		<option value="customizer_repeater_slide_format_quote" <?php selected($value,'customizer_repeater_slide_format_quote');?>>
		<?php esc_html_e('Quote','innofit') ?>
		</option>
		
		<option value="customizer_repeater_slide_format_status" <?php selected($value,'customizer_repeater_slide_format_status');?>>
		<?php esc_html_e('Status','innofit') ?>
		</option>
		
		<option value="customizer_repeater_slide_forma_video" <?php selected($value,'customizer_repeater_slide_forma_video');?>>
		<?php esc_html_e('Video','innofit') ?>
		</option>
		
	</select>
		
	<?php
	}
	
	private function innofit_price_heighlight($value='customizer_repeater_price_heighlight'){?>
	
	<span class="customize-control-title">
	<?php esc_html_e('Price highlight','innofit'); ?>
	</span>
	<select class="customizer-repeater-price-heighlight">
		<option value="customizer_repeater_price_heighlight" <?php selected($value,'customizer_repeater_price_heighlight');?>>
		<?php esc_html_e('Highlight','innofit') ?>
		</option>
		
		<option value="customizer_repeater_price_heighlight_nonlight" <?php selected($value,'customizer_repeater_price_heighlight_nonlight');?>>
		<?php esc_html_e('Non highlight','innofit') ?>
		</option>
	</select>
		
	<?php
	}
	

	private function innofit_icon_type_choice($value='customizer_repeater_icon', $innofit_limit=''){ ?>
		<span class="customize-control-title">
            <?php esc_html_e('Image type','innofit');?>
        </span>
		<select class="customizer-repeater-image-choice <?php echo esc_attr($innofit_limit);?>">
			<option value="customizer_repeater_icon" <?php selected($value,'customizer_repeater_icon');?>><?php esc_html_e('Icon','innofit'); ?></option>
			<option value="customizer_repeater_image" <?php selected($value,'customizer_repeater_image');?>><?php esc_html_e('Image','innofit'); ?></option>
			<option value="customizer_repeater_none" <?php selected($value,'customizer_repeater_none');?>><?php esc_html_e('None','innofit'); ?></option>
		</select>
		<?php
	}

	private function innofit_repeater_control($value = '', $innofit_limit='', $type_with_id=''){
		$social_repeater = array();
		$show_del        = 0; ?>
		<span class="customize-control-title"><?php esc_html_e( 'Social icons', 'innofit' ); ?></span>
		<?php
		if(!empty($value)) {
			$social_repeater = json_decode( html_entity_decode( $value ), true );
		}
		if ( ( count( $social_repeater ) == 1 && '' === $social_repeater[0] ) || empty( $social_repeater ) ) { ?>
			<div class="customizer-repeater-social-repeater">
				<div class="customizer-repeater-social-repeater-container">
					<div class="customizer-repeater-rc input-group icp-container">
						<input data-placement="bottomRight" class="icp icp-auto" value="<?php if(!empty($value)) { echo esc_attr( $value ); } ?>" type="text">
						<span class="input-group-addon"></span>
					</div>
					<?php get_template_part( $this->customizer_icon_container ); ?>
					<input type="text" class="customizer-repeater-social-repeater-link"
					       placeholder="<?php esc_html_e( 'Link', 'innofit' ); ?>">
					<input type="hidden" class="customizer-repeater-social-repeater-id" value="">
					<button class="social-repeater-remove-social-item" style="display:none">
						<?php esc_html_e( 'Remove Icon', 'innofit' ); ?>
					</button>
				</div>
				<input type="hidden" id="social-repeater-socials-repeater-colector" class="social-repeater-socials-repeater-colector" value=""/>
			</div>
			<button class="social-repeater-add-social-item button-secondary"><?php esc_html_e( 'Add Icon', 'innofit' ); ?></button>
			<?php
		} else { ?>
			<div class="customizer-repeater-social-repeater">
				<?php
				foreach ( $social_repeater as $social_icon ) {
					$show_del ++; ?>
					<div class="customizer-repeater-social-repeater-container">
						<div class="customizer-repeater-rc input-group icp-container">
							<input data-placement="bottomRight" class="icp icp-auto team_data_<?php echo esc_attr($innofit_limit);?> <?php echo esc_attr($type_with_id);?>" value="<?php if( !empty($social_icon['icon']) ) { echo esc_attr( $social_icon['icon'] ); } ?>" type="text">
							<span class="input-group-addon"><i class="fa <?php echo esc_attr( $social_icon['icon'] ); ?>"></i></span>
						</div>
						<?php get_template_part( $this->customizer_icon_container ); ?>
						<input type="text" class="customizer-repeater-social-repeater-link team_linkdata_<?php echo esc_attr($innofit_limit);?> <?php echo esc_attr($type_with_id);?>"
						       placeholder="<?php esc_html_e( 'Link', 'innofit' ); ?>"
						       value="<?php if ( ! empty( $social_icon['link'] ) ) {
							       echo esc_url( $social_icon['link'] );
						       } ?>">
						<input type="hidden" class="customizer-repeater-social-repeater-id"
						       value="<?php if ( ! empty( $social_icon['id'] ) ) {
							       echo esc_attr( $social_icon['id'] );
						       } ?>">
						<button class="social-repeater-remove-social-item"
						        style="<?php if ( $show_del == 1 ) {
							        echo "display:none";
						        } ?>"><?php esc_html_e( 'Remove Icon', 'innofit' ); ?></button>
					</div>
					<?php
				} ?>
				<input type="hidden" id="social-repeater-socials-repeater-colector"
				       class="social-repeater-socials-repeater-colector"
				       value="<?php echo esc_attr( html_entity_decode( $value ) ); ?>" />
			</div>
			<button class="social-repeater-add-social-item button-secondary <?php echo esc_attr($innofit_limit);?> <?php echo esc_attr($type_with_id);?>"><?php esc_html_e( 'Add Icon', 'innofit' ); ?></button>
			<?php
		}
	}
}
