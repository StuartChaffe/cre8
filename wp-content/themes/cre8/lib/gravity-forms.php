<?php
/**
 * Gravity Forms: the "Discuss a project" enquiry.
 *
 * The form is defined here and created automatically the first time an admin page loads with
 * Gravity Forms active. Its ID is kept in the cre8_project_form_id option. After that, edit it in
 * Forms > Discuss a project; this definition is only used to create it again if it is deleted.
 *
 * Styling is the theme's own (layout/_gravity-forms.scss), so Gravity Forms' CSS is switched off.
 */

if ( ! class_exists( 'GFForms' ) ) {
	return;
}

add_filter( 'gform_disable_css', '__return_true' );



/**
 * The ID of the project enquiry form, creating it if needed. Returns 0 if Gravity Forms is unavailable.
 */
function cre8_project_form_id() {
	$id = (int) get_option( 'cre8_project_form_id' );
	if ( $id && GFAPI::form_id_exists( $id ) ) {
		return $id;
	}
	if ( ! is_admin() || ! current_user_can( 'gform_full_access' ) && ! current_user_can( 'manage_options' ) ) {
		return 0;
	}
	$id = GFAPI::add_form( cre8_project_form_definition() );
	if ( is_wp_error( $id ) ) {
		return 0;
	}
	update_option( 'cre8_project_form_id', $id, false );
	return $id;
}
add_action( 'admin_init', 'cre8_project_form_id' );



/**
 * Heading and intro for one step of the form. The first step's heading is the page's <h1>.
 */
function _cre8_step_intro( $number, $heading, $text, $tag = 'h2' ) {
	return sprintf(
		'<span class="question-no">%s /</span><%s class="form-step__title">%s</%s><p class="form-step__intro">%s</p>',
		$number, $tag, $heading, $tag, $text
	);
}

function cre8_project_form_definition() {
	$id    = 0;
	$field = function ( $type, $props ) use ( &$id ) {
		$id++;
		return array_merge( array( 'id' => $id, 'type' => $type, 'label' => '', 'isRequired' => false ), $props );
	};
	$break = function ( $next = 'Continue' ) use ( $field ) {
		return $field( 'page', array( 'nextButton' => array( 'type' => 'text', 'text' => $next ), 'previousButton' => array( 'type' => 'text', 'text' => 'Back' ) ) );
	};
	$needs = array( 'Electrical system design', 'EMC and filters', 'Vehicle integration', 'RF communications', 'Testing and verification', 'Something else' );

	$fields = array(
		$field( 'html', array( 'content' => _cre8_step_intro( '01', 'What can we help you achieve?', 'Select the area closest to your requirement. You can add detail in the next step.', 'h1' ), 'cssClass' => 'form-step-intro' ) ),
		$field( 'radio', array( 'label' => 'Area of work', 'labelPlacement' => 'hidden_label', 'isRequired' => true, 'cssClass' => 'answer-grid',
			'choices' => array_map( function ( $n ) { return array( 'text' => $n, 'value' => $n ); }, $needs ) ) ),
		$break(),
		$field( 'html', array( 'content' => _cre8_step_intro( '02', 'Tell us about the requirement.', 'Share what the system must do, the platform or environment, and any programme constraints you already know.' ), 'cssClass' => 'form-step-intro' ) ),
		$field( 'textarea', array( 'label' => 'Project overview', 'isRequired' => true, 'placeholder' => 'Type your answer here...' ) ),
		$break(),
		$field( 'html', array( 'content' => _cre8_step_intro( '03', 'Who should we speak with?', 'Your details will only be used to respond to this enquiry.' ), 'cssClass' => 'form-step-intro' ) ),
		$field( 'text', array( 'label' => 'Your name', 'isRequired' => true, 'placeholder' => 'Jane Smith', 'autocompleteAttribute' => 'name', 'enableAutocomplete' => true ) ),
		$field( 'email', array( 'label' => 'Work email', 'isRequired' => true, 'placeholder' => 'jane@company.com', 'autocompleteAttribute' => 'email', 'enableAutocomplete' => true ) ),
		$break(),
		$field( 'html', array( 'content' => _cre8_step_intro( '04', 'How can we contact you?', 'A telephone number helps an engineer respond efficiently. It is optional.' ), 'cssClass' => 'form-step-intro' ) ),
		$field( 'phone', array( 'label' => 'Telephone number', 'phoneFormat' => 'international', 'placeholder' => '01162 000000', 'autocompleteAttribute' => 'tel', 'enableAutocomplete' => true ) ),
		$break( 'Review enquiry' ),
		$field( 'html', array( 'content' => _cre8_step_intro( '05', 'Ready to start the conversation?', 'Submit your requirement and a member of the engineering team will respond. For urgent enquiries, call {cre8_phone}.' ), 'cssClass' => 'form-step-intro' ) ),
		$field( 'consent', array( 'label' => 'Consent', 'labelPlacement' => 'hidden_label', 'isRequired' => true, 'checkboxLabel' => 'I agree that Cre8 Associates may use these details to respond to my enquiry.', 'description' => '',
			'inputs' => array( array( 'id' => '15.1', 'label' => 'Consent' ), array( 'id' => '15.2', 'label' => 'Text', 'isHidden' => true ), array( 'id' => '15.3', 'label' => 'Description', 'isHidden' => true ) ),
			'choices' => array( array( 'text' => 'Checked', 'value' => '1' ) ) ) ),
	);

	return array(
		'title'                => 'Discuss a project',
		'description'          => '',
		'labelPlacement'       => 'top_label',
		'button'               => array( 'type' => 'text', 'text' => 'Send project enquiry' ),
		'fields'               => $fields,
		'pagination'           => array( 'type' => 'percentage', 'pages' => array( '', '', '', '', '' ), 'style' => 'blue', 'color' => '', 'backgroundColor' => '', 'display_progressbar_on_confirmation' => false ),
		'lastPageButton'       => array( 'type' => 'text', 'text' => 'Back' ),
		'firstPageCssClass'    => '',
		'enableHoneypot'       => true,
		'honeypotAction'       => 'spam',
		'enableAnimation'      => false,
		'markupVersion'        => 2,
		'validationSummary'    => false,
		'requiredIndicator'    => 'custom',
		'customRequiredIndicator' => '',
		'confirmations'        => array(
			'cre8_default' => array(
				'id'        => 'cre8_default',
				'name'      => 'Thank you',
				'isDefault' => true,
				'type'      => 'message',
				'message'   => '<span class="question-no">Thank you</span><h1 class="form-step__title">Your enquiry is on its way.</h1><p class="form-step__intro">A member of the engineering team will be in touch. For anything urgent, call {cre8_phone}.</p>',
			),
		),
		'notifications'        => array(
			'cre8_admin' => array(
				'id'      => 'cre8_admin',
				'name'    => 'Enquiry to the office',
				'isActive' => true,
				'event'   => 'form_submission',
				'toType'  => 'email',
				'to'      => '{admin_email}',
				'replyTo' => '{Work email:9}',
				'from'    => '{admin_email}',
				'fromName' => get_bloginfo( 'name' ),
				'subject' => 'Project enquiry: {Area of work:2}',
				'message' => '{all_fields}',
			),
		),
	);
}



/**
 * Send enquiries to Theme Options > Enquiries when it is filled in.
 */
add_filter( 'gform_notification', function ( $notification, $form ) {
	if ( (int) $form['id'] === (int) get_option( 'cre8_project_form_id' ) && 'cre8_admin' === $notification['id'] ) {
		$to = cre8_option( 'enquiry_email' );
		if ( $to ) {
			$notification['to'] = $to;
		}
	}
	return $notification;
}, 10, 2 );



/**
 * {cre8_phone} merge tag: the Theme Options telephone number as a link.
 */
add_filter( 'gform_replace_merge_tags', function ( $text ) {
	if ( false === strpos( $text, '{cre8_phone}' ) ) {
		return $text;
	}
	$phone = cre8_option( 'phone' );
	$link  = $phone ? '<a class="text-link" href="tel:' . esc_attr( $phone ) . '">' . esc_html( cre8_option( 'phone_display', $phone ) ) . '</a>' : 'us';
	return str_replace( '{cre8_phone}', $link, $text );
} );

// HTML fields and confirmations are not run through merge tags by default.
add_filter( 'gform_field_content', function ( $content, $field ) {
	return 'html' === $field->type ? GFCommon::replace_variables_prepopulate( $content ) : $content;
}, 10, 2 );
