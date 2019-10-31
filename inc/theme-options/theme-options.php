<?php 
/*
 * theme-options.php
 * 
 * Table of contents:
 * 
 * 1. DEFINITIONS
 * 2. HOOKS
 * 3. RENDER FUNCTIONS
 * 4. SANITIZE FUNCTIONS
 * 5. CUSTOM SCRIPTS
 * 6. OTHER FUNCTIONS
 */



/*
 * 1. DEFINITIONS
 * Section information.
 */
$digitalscholarship_sections = [
    'section-theme-settings' => [
        'title' => 'Theme Settings',
        'desc'  => 'General theme settings.'
    ],
    'section-styling-settings' => [
        'title' => 'Styling Settings',
        'desc'  => 'Settings for editing colors, fonts and CSS.'
    ],
    'section-social-settings' => [
        'title' => 'Social Settings',
        'desc'  => 'Edit your social media profiles.'
    ]
];

/*
 * Field information.
 */
$digitalscholarship_fields = [
    'digitalscholarship-logo' => [
        'title'    => 'Default logo',
        'type'     => 'upload',
        'section'  => 'section-theme-settings',
        'default'  => '',
        'desc'     => 'Set your default logo. Upload or choose an existing one.',
        'sanitize' => ''
    ],
    'digitalscholarship-logo-alternate' => [
        'title'    => 'Alternate logo',
        'type'     => 'upload',
        'section'  => 'section-theme-settings',
        'default'  => '',
        'desc'     => 'Set your alternate logo. This can be used for an inverted background for example. Upload or choose an existing one.',
        'sanitize' => ''
    ],
    'digitalscholarship-google-analytics' => [
        'title'    => 'Google Analytics Tracking ID',
        'type'     => 'text',
        'section'  => 'section-theme-settings',
        'default'  => '',
        'desc'     => 'Only enter your tracking ID in the format: UA-XXXXX-X. For example: UA-12345-6.',
        'sanitize' => 'google-analytics'
    ],
    'digitalscholarship-search-bar' => [
        'title'    => 'Search Bar',
        'type'     => 'checkbox',
        'label'    => 'Display search bar in the site header.',
        'section'  => 'section-theme-settings',
        'default'  => 0,
        'desc'     => '',
        'sanitize' => ''
    ],
    'digitalscholarship-color-scheme' => [
        'title'    => 'Color Scheme',
        'type'     => 'radio',
        'children' => ['Light', 'Dark'],
        'section'  => 'section-styling-settings',
        'default'  => 0,
        'desc'     => '',
        'sanitize' => ''
    ],
    'digitalscholarship-font-pair' => [
        'title'    => 'Font Pair',
        'type'     => 'select',
        'children' => ['Modern', 'Classic', 'Futuristic', 'Thin', 'Narrow'],
        'section'  => 'section-styling-settings',
        'default'  => 0,
        'desc'     => '',
        'sanitize' => ''
    ],
    'digitalscholarship-custom-css' => [
        'title'    => 'Custom CSS',
        'type'     => 'textarea',
        'section'  => 'section-styling-settings',
        'default'  => '',
        'desc'     => '',
        'sanitize' => 'default'
    ],
    'digitalscholarship-social-twitter' => [
        'title'    => 'Twitter Profile',
        'type'     => 'text',
        'section'  => 'section-social-settings',
        'default'  => '',
        'desc'     => '',
        'sanitize' => 'full'
    ],
    'digitalscholarship-social-facebook' => [
        'title'    => 'Facebook Profile',
        'type'     => 'text',
        'section'  => 'section-social-settings',
        'default'  => '',
        'desc'     => '',
        'sanitize' => 'full'
    ],
    'digitalscholarship-social-googleplus' => [
        'title'    => 'Google+ Profile',
        'type'     => 'text',
        'section'  => 'section-social-settings',
        'default'  => '',
        'desc'     => '',
        'sanitize' => 'full'
    ]
];



/*
 * 2. HOOKS
 */
add_action( 'after_setup_theme', 'digitalscholarship_init_option' );
add_action( 'admin_menu', 'digitalscholarship_update_menu' );
add_action( 'admin_init', 'digitalscholarship_init_settings' );
add_action( 'admin_enqueue_scripts', 'digitalscholarship_options_custom_scripts' );



/*
 * 3. RENDER FUNCTIONS
 * Renders a section description.
 */
function digitalscholarship_render_section( $args ) {
    global $digitalscholarship_sections;

    echo "<p>" . $digitalscholarship_sections[ $args['id'] ]['desc'] . "</p>";
    echo "<hr />";
}

/*
 * Renders input fields: can be text, textarea, checkbox, radio, select, or upload
 */
function digitalscholarship_render_field( $id ) {
    global $digitalscholarship_fields;

    $options = get_option( 'digitalscholarship_options' );

    // If options are not set yet for that ID, grab the default value.
    $field_value = isset( $options[ $id ] ) ? $options[ $id ] : digitalscholarship_get_field_default( $id );

    // Generate HTML markup based on field type.
    switch ( $digitalscholarship_fields[ $id ]['type'] ) {
        case 'text': 
            echo "<input type='text' name='digitalscholarship_options[" . $id . "]' value='" . $field_value . "' />";
            echo "<p class='description'>" . $digitalscholarship_fields[ $id ]['desc'] . "</p>";
            
            break;

        case 'upload':
            $visibility_class = ( '' != $field_value ) ? "" : "hide";

            echo "<img src='" . $field_value . "' alt='Logo' class='digitalscholarship-custom-thumbnail " . $visibility_class . "' id='" . $id . "-thumbnail' />";
            echo "<input type='hidden' name='digitalscholarship_options[" . $id . "]' id='" . $id . "-upload-field' value='" . $field_value . "' />";
            echo "<input type='button' class='btn-upload-img button' value='Upload logo' data-field-id='" . $id . "' />";
            echo "<input type='button' class='btn-remove-img button " . $visibility_class . "' value='Remove logo' data-field-id='" . $id . "' id='" . $id . "-remove-button' />";
            echo "<p class='description'>" . $digitalscholarship_fields[ $id ]['desc'] . "</p>";
            
            break;

        case 'textarea': 
            echo "<textarea name='digitalscholarship_options[" . $id . "]' cols='40' rows='10'>" . $field_value . "</textarea>";
            echo "<p class='description'>" . $digitalscholarship_fields[ $id ]['desc'] . "</p>";
            
            break;

        case 'checkbox':
            echo "<input type='checkbox' name='digitalscholarship_options[" . $id . "]' id='" . $id . "' value='1' " . checked( $field_value, 1, false ) . " />";
            echo "<label for='" . $id . "'>" . $digitalscholarship_fields[ $id ]['label'] . "</label>";

            break;

        case 'radio': 
            // Generate as many radio buttons as there are children.
            for ( $i = 0; $i < sizeof( $digitalscholarship_fields[ $id ]['children'] ); $i++ ) {
                echo "<p>";
                echo "<input type='radio' name='digitalscholarship_options[" . $id . "]' id='digitalscholarship_options[" . $id . "]-" . $i . "' value='" . $i . "' " . checked( $field_value, $i, false ) . " />";
                echo "<label for='digitalscholarship_options[" . $id . "]-" . $i . "'>" . $digitalscholarship_fields[ $id ]['children'][ $i ] . "</label>";
                echo "</p>";
            }

            break;

        case 'select': 
            echo "<select name='digitalscholarship_options[" . $id . "]'>";
            for ( $i = 0; $i < sizeof( $digitalscholarship_fields[ $id ]['children'] ); $i++ ) {
                echo "<option value='" . $i . "' " . selected( $field_value, $i, false ) . ">";
                echo $digitalscholarship_fields[ $id ]['children'][ $i ];
                echo "</option>";
            }
            echo "</select>";

            break;
    }
}

/*
 * Renders the theme options page.
 */
function digitalscholarship_render_theme_options() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'You do not have sufficient permissions to access this page.' );
    } ?>

    <div class="wrap">
        <h1>Theme Options</h1>

        <?php settings_errors(); ?>

        <form action="options.php" method="post">
            <?php
                settings_fields( "digitalscholarship_options" );
                do_settings_sections( "digitalscholarship-theme-options" );
                echo "<hr />";
                submit_button();
            ?>
        </form>
    </div>
<?php }



/*
 * 4. SANITIZE FUNCTIONS
 * Sanitizes the settings.
 */
function digitalscholarship_options_validate( $input ) {
    // Define a blank array for the output.
    $output = [];

    // Do a general sanitization for every field.
    foreach ( $input as $key => $value ) {
        // Grab the sanitize option for this field.
        $field_sanitize = digitalscholarship_get_field_sanitize( $key );

        switch ( $field_sanitize ) {
            case 'default':
                $output[ $key ] = strip_tags( stripslashes( $input[ $key ] ) );
                break;
            
            case 'full':
                $output[ $key ] = esc_url_raw( strip_tags( stripslashes( $input[ $key ] ) ) );
                break;

            case 'google-analytics':
                $output[ $key ] = ( preg_match('/^UA-[0-9]+-[0-9]+$/', $input[ $key ] ) ) ? $input[ $key ] : '';
                break;

            default:
                $output[ $key ] = $input[ $key ];
                break;
        }
    }

    return $output;
}



/*
 * 5. CUSTOM SCRIPTS
 * Registers and loads custom JavaScript and CSS.
 */
function digitalscholarship_options_custom_scripts() {
    // Get information about the current page.
    $screen = get_current_screen();

    // Register a custom script that depends on jQuery, Media Upload and Thickbox (available from the Core).
    wp_register_script( 'digitalscholarship-custom-admin-scripts', get_template_directory_uri() .'/inc/theme-options/theme-options.js', array( 'jquery' ) );

    // Register custom styles.
    wp_register_style( 'digitalscholarship-custom-admin-styles', get_template_directory_uri() .'/inc/theme-options/theme-options.css' );
    
    // Only load these scripts if we're on the theme options page.
    if ( 'appearance_page_digitalscholarship-theme-options' == $screen->id ) {
        // Enqueues all scripts, styles, settings, and templates necessary to use all media JavaScript APIs.
        wp_enqueue_media();
        
        // Load our custom scripts.
        wp_enqueue_script( 'digitalscholarship-custom-admin-scripts' );

        // Load our custom styles.
        wp_enqueue_style( 'digitalscholarship-custom-admin-styles' );
    }    
}



/*
 * 6. OTHER FUNCTIONS
 * Returns the default value of a field.
 */
function digitalscholarship_get_field_default( $id ) {
    global $digitalscholarship_fields;

    return $digitalscholarship_fields[ $id ]['default'];
}

/*
 * Checks if the options exists in the database.
 */
function digitalscholarship_init_option() {
    $options = get_option( 'digitalscholarship_options' );

    if ( false === $options ) {
        add_option( 'digitalscholarship_options' );
    }
}

/*
 * Creates a sub-menu under Appearance.
 */
function digitalscholarship_update_menu() {
    add_theme_page( 'Theme Options', 'Theme Options', 'manage_options', 'digitalscholarship-theme-options', 'digitalscholarship_render_theme_options' );
}

/*
 * Registers and adds settings, sections and fields.
 */
function digitalscholarship_init_settings() {
    // Declare $digitalscholarship_sections and $digitalscholarship_fields as global.
    global $digitalscholarship_fields, $digitalscholarship_sections;

    // Register a general setting.
    // The $option_group is the same as $option_name to prevent the "Error: options page not found." problem.
    register_setting( "digitalscholarship_options", "digitalscholarship_options", "digitalscholarship_options_validate" );

    // Add sections as defined in the $digitalscholarship_sections array.
    foreach ($digitalscholarship_sections as $section_id => $section_value) {
        add_settings_section( $section_id, $section_value['title'], "digitalscholarship_render_section", "digitalscholarship-theme-options" );
    }

    // Add fields as defined in the $digitalscholarship_fields array.
    foreach ($digitalscholarship_fields as $field_id => $field_value) {
        add_settings_field( $field_id, $field_value['title'], "digitalscholarship_render_field", "digitalscholarship-theme-options", $field_value['section'], $field_id );
    }
}

/*
 * Returns the sanitized field value.
 */
function digitalscholarship_get_field_sanitize( $id ) {
    global $digitalscholarship_fields;

    return $digitalscholarship_fields[ $id ]['sanitize'];
}