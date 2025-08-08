<?php
/**
 * Qasim Ali Portfolio Theme Functions
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define constants
define('QA_PORTFOLIO_VERSION', '1.0.0');
define('QA_PORTFOLIO_URL', get_template_directory_uri());
define('QA_PORTFOLIO_PATH', get_template_directory());

// Theme setup
function qa_portfolio_setup() {
    // Theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    
    // Remove admin bar for cleaner frontend
    show_admin_bar(false);
}
add_action('after_setup_theme', 'qa_portfolio_setup');

// Register Custom Post Types
function qa_portfolio_register_post_types() {
    
    // Experience Post Type
    register_post_type('experience', array(
        'labels' => array(
            'name' => 'Experience',
            'singular_name' => 'Experience',
            'add_new' => 'Add New Experience',
            'edit_item' => 'Edit Experience',
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => 'portfolio-settings',
        'show_in_rest' => true,
        'supports' => array('title', 'custom-fields'),
        'menu_icon' => 'dashicons-businessman',
    ));
    
    // Education Post Type
    register_post_type('education', array(
        'labels' => array(
            'name' => 'Education',
            'singular_name' => 'Education',
            'add_new' => 'Add New Education',
            'edit_item' => 'Edit Education',
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => 'portfolio-settings',
        'show_in_rest' => true,
        'supports' => array('title', 'custom-fields'),
        'menu_icon' => 'dashicons-welcome-learn-more',
    ));
    
    // Skills Post Type
    register_post_type('skills', array(
        'labels' => array(
            'name' => 'Skills',
            'singular_name' => 'Skill Category',
            'add_new' => 'Add New Category',
            'edit_item' => 'Edit Skill Category',
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => 'portfolio-settings',
        'show_in_rest' => true,
        'supports' => array('title', 'custom-fields'),
        'menu_icon' => 'dashicons-hammer',
    ));
    
    // Contact Messages Post Type
    register_post_type('contact_messages', array(
        'labels' => array(
            'name' => 'Contact Messages',
            'singular_name' => 'Contact Message',
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => 'portfolio-settings',
        'supports' => array('title', 'custom-fields'),
        'menu_icon' => 'dashicons-email-alt',
    ));
}
add_action('init', 'qa_portfolio_register_post_types');

// Add Portfolio Settings Menu
function qa_portfolio_admin_menu() {
    add_menu_page(
        'Portfolio Settings',
        'Portfolio',
        'manage_options',
        'portfolio-settings',
        'qa_portfolio_settings_page',
        'dashicons-id-alt',
        2
    );
    
    add_submenu_page(
        'portfolio-settings',
        'Personal Info',
        'Personal Info',
        'manage_options',
        'portfolio-personal',
        'qa_portfolio_personal_page'
    );
}
add_action('admin_menu', 'qa_portfolio_admin_menu');

// Portfolio Settings Page
function qa_portfolio_settings_page() {
    ?>
    <div class="wrap">
        <h1>Portfolio Settings</h1>
        <div class="welcome-panel">
            <div class="welcome-panel-content">
                <h2>Welcome to your Portfolio Dashboard</h2>
                <p>Manage your portfolio content using the menu items below:</p>
                <ul>
                    <li><strong>Personal Info:</strong> Update your name, title, contact details, and professional summary</li>
                    <li><strong>Skills:</strong> Manage your technical skills by category</li>
                    <li><strong>Experience:</strong> Add and edit your work experience</li>
                    <li><strong>Education:</strong> Manage your educational background</li>
                    <li><strong>Contact Messages:</strong> View messages from your portfolio contact form</li>
                </ul>
            </div>
        </div>
    </div>
    <?php
}

// Personal Info Settings Page
function qa_portfolio_personal_page() {
    if (isset($_POST['save_personal'])) {
        update_option('qa_personal_name', sanitize_text_field($_POST['name']));
        update_option('qa_personal_title', sanitize_text_field($_POST['title']));
        update_option('qa_personal_location', sanitize_text_field($_POST['location']));
        update_option('qa_personal_phone', sanitize_text_field($_POST['phone']));
        update_option('qa_personal_email', sanitize_email($_POST['email']));
        update_option('qa_personal_summary', sanitize_textarea_field($_POST['summary']));
        echo '<div class="notice notice-success"><p>Personal information updated!</p></div>';
    }
    
    $name = get_option('qa_personal_name', 'Qasim Ali');
    $title = get_option('qa_personal_title', 'Front-End Developer');
    $location = get_option('qa_personal_location', 'Lahore, Pakistan');
    $phone = get_option('qa_personal_phone', '03258639241');
    $email = get_option('qa_personal_email', 'qasimali20041004@gmail.com');
    $summary = get_option('qa_personal_summary', '');
    ?>
    <div class="wrap">
        <h1>Personal Information</h1>
        <form method="post">
            <table class="form-table">
                <tr>
                    <th scope="row">Name</th>
                    <td><input type="text" name="name" value="<?php echo esc_attr($name); ?>" class="regular-text" /></td>
                </tr>
                <tr>
                    <th scope="row">Title</th>
                    <td><input type="text" name="title" value="<?php echo esc_attr($title); ?>" class="regular-text" /></td>
                </tr>
                <tr>
                    <th scope="row">Location</th>
                    <td><input type="text" name="location" value="<?php echo esc_attr($location); ?>" class="regular-text" /></td>
                </tr>
                <tr>
                    <th scope="row">Phone</th>
                    <td><input type="text" name="phone" value="<?php echo esc_attr($phone); ?>" class="regular-text" /></td>
                </tr>
                <tr>
                    <th scope="row">Email</th>
                    <td><input type="email" name="email" value="<?php echo esc_attr($email); ?>" class="regular-text" /></td>
                </tr>
                <tr>
                    <th scope="row">Professional Summary</th>
                    <td><textarea name="summary" rows="10" cols="50" class="large-text"><?php echo esc_textarea($summary); ?></textarea></td>
                </tr>
            </table>
            <?php submit_button('Save Personal Information', 'primary', 'save_personal'); ?>
        </form>
    </div>
    <?php
}

// Register REST API endpoints
function qa_portfolio_register_rest_routes() {
    register_rest_route('portfolio/v1', '/personal', array(
        'methods' => 'GET',
        'callback' => 'qa_get_personal_info',
        'permission_callback' => '__return_true',
    ));
    
    register_rest_route('portfolio/v1', '/skills', array(
        'methods' => 'GET',
        'callback' => 'qa_get_skills',
        'permission_callback' => '__return_true',
    ));
    
    register_rest_route('portfolio/v1', '/experience', array(
        'methods' => 'GET',
        'callback' => 'qa_get_experience',
        'permission_callback' => '__return_true',
    ));
    
    register_rest_route('portfolio/v1', '/education', array(
        'methods' => 'GET',
        'callback' => 'qa_get_education',
        'permission_callback' => '__return_true',
    ));
    
    register_rest_route('portfolio/v1', '/contact', array(
        'methods' => 'POST',
        'callback' => 'qa_handle_contact_form',
        'permission_callback' => '__return_true',
        'args' => array(
            'name' => array('required' => true),
            'email' => array('required' => true),
            'subject' => array('required' => true),
            'message' => array('required' => true),
        ),
    ));
}
add_action('rest_api_init', 'qa_portfolio_register_rest_routes');

// REST API Callbacks
function qa_get_personal_info() {
    return array(
        'name' => get_option('qa_personal_name', 'Qasim Ali'),
        'title' => get_option('qa_personal_title', 'Front-End Developer'),
        'location' => get_option('qa_personal_location', 'Lahore, Pakistan'),
        'phone' => get_option('qa_personal_phone', '03258639241'),
        'email' => get_option('qa_personal_email', 'qasimali20041004@gmail.com'),
        'summary' => get_option('qa_personal_summary', 'Creative and detail-oriented Front-End Developer with strong proficiency in building responsive, user-friendly web applications.'),
    );
}

function qa_get_skills() {
    // Return current mock data structure
    return array(
        'frontend' => array('HTML', 'CSS3', 'JavaScript (ES6+)', 'React', 'Vue.js', 'Tailwind CSS', 'Bootstrap'),
        'backend' => array('Node.js', 'Express.js', 'REST APIs', 'MongoDB', 'SQL (basic proficiency)', 'Supabase'),
        'tools' => array('Git', 'GitHub', 'Webpack', 'Vite', 'Docker (beginner)', 'VS Code'),
        'other' => array('UI/UX Design Principles', 'Agile Methodologies', 'Technical Instruction', 'Customer Handling', 'Leadership', 'Adaptability', 'Strong Problem-Solving', 'Medical Knowledge')
    );
}

function qa_get_experience() {
    // Return current mock data structure
    return array(
        array(
            'title' => 'Front-End Developer (Freelance)',
            'location' => 'Lahore, Pakistan',
            'period' => '2022 - Present',
            'achievements' => array(
                'Improved user satisfaction by 30% through optimized UI/UX design',
                'Implemented modern CSS frameworks like Tailwind CSS to create visually appealing, mobile-first, user-friendly web applications',
                'Collaborated with clients to translate requirements into functional web solutions, ensuring timely delivery within project deadlines',
                'Integrated UI/UX design to connect front-end interfaces with back-end services, enhancing application functionality'
            )
        ),
        array(
            'title' => 'Technical Instructor (Individual Tutoring)',
            'location' => 'Lahore, Pakistan',
            'period' => '2020 - Present',
            'achievements' => array(
                'Delivered personalized instruction on front-end and introductory back-end concepts',
                'Developed customized lesson plans to teach technical concepts, resulting in improved student proficiency in coding',
                'Created mock interviews and coding assessments to prepare students for technical roles'
            )
        )
    );
}

function qa_get_education() {
    // Return current mock data structure
    return array(
        array(
            'degree' => "Bachelor's Degree in Computer Science",
            'institution' => 'NUML University, Lahore',
            'period' => '2020 - 2024',
            'coursework' => array('Web Development', 'Database Systems', 'Software Engineering', 'UI/UX Design')
        )
    );
}

function qa_handle_contact_form($request) {
    $params = $request->get_params();
    
    // Sanitize input
    $name = sanitize_text_field($params['name']);
    $email = sanitize_email($params['email']);
    $subject = sanitize_text_field($params['subject']);
    $message = sanitize_textarea_field($params['message']);
    
    // Validate email
    if (!is_email($email)) {
        return new WP_Error('invalid_email', 'Invalid email address', array('status' => 400));
    }
    
    // Save message to database
    $post_id = wp_insert_post(array(
        'post_type' => 'contact_messages',
        'post_title' => $subject . ' - From: ' . $name,
        'post_content' => $message,
        'post_status' => 'publish',
        'meta_input' => array(
            'sender_name' => $name,
            'sender_email' => $email,
            'sender_subject' => $subject,
            'submission_date' => current_time('mysql'),
        )
    ));
    
    if ($post_id) {
        // Send email notification (optional)
        wp_mail(
            get_option('qa_personal_email', 'qasimali20041004@gmail.com'),
            'New Portfolio Contact: ' . $subject,
            "Name: $name\nEmail: $email\nSubject: $subject\n\nMessage:\n$message",
            array('Reply-To: ' . $email)
        );
        
        return array(
            'success' => true,
            'message' => 'Thank you for your message! I will get back to you soon.'
        );
    } else {
        return new WP_Error('submission_failed', 'Failed to save your message', array('status' => 500));
    }
}

// Initialize default data
function qa_portfolio_init_default_data() {
    if (!get_option('qa_portfolio_initialized')) {
        // Set default personal info
        update_option('qa_personal_name', 'Qasim Ali');
        update_option('qa_personal_title', 'Front-End Developer');
        update_option('qa_personal_location', 'Lahore, Pakistan');
        update_option('qa_personal_phone', '03258639241');
        update_option('qa_personal_email', 'qasimali20041004@gmail.com');
        update_option('qa_personal_summary', 'Creative and detail-oriented Front-End Developer with strong proficiency in building responsive, user-friendly web applications. Experienced in modern JavaScript frameworks and UI/UX design principles, with a proven ability to enhance customer satisfaction through exceptional communication and tailored solutions. Proficient in back-end development with foundational skills in server-side technologies, eager to deepen expertise in this area. Additionally skilled in teaching technical concepts individually, with a passion for delivering engaging learning experiences. Demonstrates strong leadership, adaptability and problem-solving abilities, consistently delivering effective solutions and exceptional customer handling. Seeking opportunities to contribute to innovative web development projects while growing back-end capabilities.');
        
        update_option('qa_portfolio_initialized', true);
    }
}
add_action('after_switch_theme', 'qa_portfolio_init_default_data');

// Enable CORS for REST API
function qa_portfolio_cors_headers() {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Authorization');
}
add_action('rest_api_init', 'qa_portfolio_cors_headers');