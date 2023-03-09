<?php if ( ! defined( 'WOODMART_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );}

/**
 * Activate theme and enable auto updates
 */

class WOODMART_License {

	private $_api             = null;
	private $_notices         = null;
	private $_current_version = '';
	private $_new_version     = '';
	private $_theme_name      = '';
	private $_info;
	private $_token;


	function __construct() {
		$this->_current_version = woodmart_get_theme_info( 'Version' );
		$this->_theme_name      = WOODMART_SLUG;

		$this->_api     = WOODMART_Registry()->api;
		$this->_notices = WOODMART_Registry()->notices;

		$this->process_form();

		add_filter( 'pre_set_site_transient_update_themes', array( $this, 'update_plugins_version' ), 30 );
		add_filter( 'pre_set_site_transient_update_plugins', array( $this, 'update_plugins_version' ), 30 );
		add_filter( 'woodmart_setup_wizard', array( $this, 'update_plugins_version' ), 30 );

		if ( ! woodmart_is_license_activated() ) {
			return;
		}

		add_filter( 'site_transient_update_themes', array( $this, 'update_transient' ), 20, 2 );

		add_filter( 'pre_set_site_transient_update_themes', array( $this, 'set_update_transient' ) );
		add_filter( 'themes_api', array( &$this, 'api_results' ), 10, 3 );
	}

	public function form() {
		?>
		<div class="xts-box xts-license xts-theme-style">
			<div class="xts-box-header">
				<h3>
					<?php esc_html_e( 'Theme license', 'woodmart' ); ?>
				</h3>
				<p>
					<?php esc_html_e( 'Activate your purchase code for this domain to turn on auto updates function.', 'woodmart' ); ?>
				</p>
			</div>

			<div class="xts-box-content">
				<div class="xts-row">
					<div class="xts-col-12 xts-col-xl-5 xts-license-img">
						<img src="<?php echo esc_url( WOODMART_ASSETS_IMAGES . '/dashboard/license.svg' ); ?>" alt="license banner">
					</div>

					<div class="xts-col-12 xts-col-xl-7 xts-license-content">
						<?php $this->_notices->show_msgs(); ?>

						<?php if ( woodmart_is_license_activated() ) : ?>
							<div class="xts-activated-message">
								<p>Thank you for activation. Now you are able to get automatic updates for our
									theme via <a href="<?php echo esc_url( admin_url( 'themes.php' ) ); ?>">Appearance -> Themes</a> or via <a href="<?php echo esc_url( admin_url( 'update-core.php?force-check=1' ) ); ?>">Dashboard -> Updates</a>. You can click this button to deactivate your license code from this domain if you are going to transfer your website to some other domain or server.<br>
								</p>

								<form action="" class="xts-form xts-activation-form" method="post">
									<?php wp_nonce_field( 'xts-license-deactivation' ); ?>
									<input type="hidden" name="purchase-code-deactivate" value="1"/>
									<div class="xts-license-btn xts-deactivate-btn xts-i-close">
										<input class="xts-btn xts-color-warning" type="submit" value="<?php esc_attr_e( 'Deactivate theme', 'woodmart' ); ?>" />
									</div>
								</form>
							</div>
						<?php else : ?>
							<form action="" class="xts-form xts-activation-form" method="post">
								<?php wp_nonce_field( 'xts-license-activation' ); ?>
								<?php if ( ! woodmart_get_opt( 'white_label' ) ) : ?>
									<label for="purchase-code"><?php esc_html_e( 'Purchase code', 'woodmart' ); ?> (<a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank">Where can I get my purchase code?</a>)</label>
								<?php endif; ?>

								<div class="xts-activation-form-inner">
									<input type="text" name="purchase-code" placeholder="Example: 1e71cs5f-13d9-41e8-a140-2cff01d96afb" id="purchase-code" required>
									<?php if ( woodmart_is_license_activated() ) : ?>
										<span>
											<?php esc_html_e( 'Activated', 'woodmart' ); ?>
										</span>
									<?php else : ?>
										<span>
											<?php esc_html_e( 'Not activated', 'woodmart' ); ?>
										</span>
									<?php endif; ?>
								</div>

								<div class="xts-activation-form-agree">
									<label for="agree_stored" class="agree-label" >
										<input type="checkbox" name="agree_stored" id="agree_stored" required>
										<?php if ( ! woodmart_get_opt( 'white_label' ) ) : ?>
											<?php esc_html_e( 'I agree that my purchase code and user data will be stored by xtemos.com', 'woodmart' ); ?>
										<?php else : ?>
											<?php esc_html_e( 'I agree that my purchase code and user data will be stored.', 'woodmart' ); ?>
										<?php endif; ?>
									</label>

									<div class="xts-hint">
										<div class="xts-tooltip xts-top">
											<?php esc_html_e( 'To activate the theme and receive product support, you have to register your Envato purchase code on our site. This purchase code will be stored together with support expiration dates and your user data. This is required for us to provide you with product support and other customer services.', 'woodmart' ); ?>
										</div>
									</div>
								</div>

								<div class="xts-license-btn xts-activate-btn xts-i-key">
									<input class="xts-btn xts-color-primary" name="woodmart-purchase-code" type="submit" value="<?php esc_attr_e( 'Activate theme', 'woodmart' ); ?>" />
								</div>
							</form>
						<?php endif; ?>
						<p class="xts-note">
							<?php
							echo wp_kses(
								'<span>Note:</span> you are allowed to use our theme only on one domain if you purchased a regular license. But we give you an ability to activate our theme to turn on auto updates on two domains: for the development website and for your production (live) website.
							If you need to check all your active domains or you want to remove some of them you should visit <a href="https://xtemos.com/" target="_blank">our website</a> and check the activation list in your account.',
								woodmart_get_allowed_html()
							);
							?>
						</p>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	public function process_form() {
		if ( isset( $_POST['purchase-code-deactivate'] ) ) {
			check_admin_referer( 'xts-license-deactivation' );
			$this->deactivate();
			$this->_notices->add_success( 'Theme license is successfully deactivated.' );
			return;
		}

		if ( isset( $_POST['woodmart-purchase-code'] ) && ( ! isset( $_POST['agree_stored'] ) || empty( $_POST['agree_stored'] ) ) ) {
			$this->_notices->add_error( 'You must agree to store your purchase code and user data by xtemos.com' );
			return;
		}

		if ( ! isset( $_POST['purchase-code'] ) || empty( $_POST['purchase-code'] ) ) {
			return;
		}
		check_admin_referer( 'xts-license-activation' );

		$code = sanitize_text_field( $_POST['purchase-code'] );

		$response = $this->_api->call( 'activate/' . $code . '?domain=' . $this->domain() );

		if ( isset( $_GET['xtemos_debug'] ) ) {
			ar( $response );
		}

		$response_code = wp_remote_retrieve_response_code( $response );

		if ( $response_code != '200' ) {
			$this->_notices->add_error( 'The API server can\'t be reached. Please, contact your hosting provider to check the connectivity with our xtemos.com server. If you need further help, please, contact our support center too.' );
			return;
		}

		$data = json_decode( wp_remote_retrieve_body( $response ), true );

		if ( isset( $data['error'] ) ) {
			$this->_notices->add_error( $data['error'] );
			return;
		}

		if ( ! $data['verified'] ) {
			$this->_notices->add_error( 'The purchase code is invalid. <a target="_blank" href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-">Where can I get my purchase code?</a>' );
			return;
		}

		$this->activate( $code, $data['token'] );

		$this->_notices->add_success( 'The license is verified and theme is activated successfully. Auto updates function is enabled.' );

	}

	public function domain() {
		$domain = get_option( 'siteurl' );
		$domain = str_replace( 'http://', '', $domain );
		$domain = str_replace( 'https://', '', $domain );
		$domain = str_replace( 'www', '', $domain );
		return urlencode( $domain );
	}

	public function activate( $purchase, $token ) {
		update_option( 'woodmart_token', $token );
		update_option( 'woodmart_is_activated', true );
		update_option( 'woodmart_purchase_code', $purchase );
	}

	public function deactivate() {
		$this->_api->call( 'deactivate/' . get_option( 'woodmart_token' ) );
		delete_option( 'woodmart_token' );
		delete_option( 'woodmart_is_activated' );
		delete_option( 'woodmart_purchase_code' );
		delete_option( 'woodmart-update-time' );
		delete_option( 'woodmart-update-info' );
	}


	public function update_transient( $value, $transient ) {
		if ( isset( $_GET['force-check'] ) && $_GET['force-check'] == '1' ) {
			return false;
		}
		return $value;
	}


	public function set_update_transient( $transient ) {

		$this->check_for_update();

		if ( isset( $transient ) && ! isset( $transient->response ) ) {
			$transient->response = array();
		}

		if ( ! empty( $this->_info ) && is_object( $this->_info ) ) {
			if ( $this->is_update_available() ) {
				$transient->response[ $this->_theme_name ] = json_decode( json_encode( $this->_info ), true );
			}
		}

		remove_action( 'site_transient_update_themes', array( $this, 'update_transient' ), 20, 2 );

		return $transient;
	}


	public function api_results( $result, $action, $args ) {

		$this->check_for_update();

		if ( isset( $args->slug ) && $args->slug == $this->_theme_name && $action == 'theme_information' ) {
			if ( is_object( $this->_info ) && ! empty( $this->_info ) ) {
				$result = $this->_info;
			}
		}

		return $result;
	}


	protected function check_for_update() {
		$force = false;

		if ( isset( $_GET['force-check'] ) && $_GET['force-check'] == '1' ) {
			$force = true;
		}

		// Get data
		if ( empty( $this->_info ) ) {
			$version_information = get_option( 'woodmart-update-info', false );
			$version_information = $version_information ? $version_information : new stdClass();

			$this->_info = is_object( $version_information ) ? $version_information : maybe_unserialize( $version_information );

		}

		$last_check = get_option( 'woodmart-update-time' );
		if ( $last_check == false ) {
			update_option( 'woodmart-update-time', time() );
		}

		if ( time() - $last_check > 172800 || $force || $last_check == false ) {

			$response = $this->api_info();

			update_option( 'woodmart-update-time', time() );

			$this->_info              = new stdClass();
			$this->_info->new_version = $response->version;
			$this->_info->version     = $response->version;
			$this->_info->theme       = $response->theme;
			$this->_info->checked     = time();
			$this->_info->url         = 'https://xtemos.com/woodmart-changelog.php';
			$this->_info->package     = $this->download_url();

		}

		// Save results
		update_option( 'woodmart-update-info', $this->_info );
	}

	public function api_info() {
		$version_information = new stdClass();

		$response = $this->_api->call( 'info/' . $this->_theme_name );

		if ( isset( $_GET['xtemos_debug'] ) ) {
			ar( $response );
		}

		$response_code = wp_remote_retrieve_response_code( $response );

		if ( $response_code != '200' ) {
			return array();
		}

		$response = json_decode( wp_remote_retrieve_body( $response ) );
		if ( ! $response->version ) {
			return $version_information;
		}

		return $response;
	}

	public function update_plugins_version( $transient ) {
		$api        = WOODMART_Registry()->api;
		$plugins    = array( 'js_composer', 'revslider' );
		$force      = false;
		$last_check = get_option( 'woodmart-plugins-update-time' );

		if ( ( isset( $_GET['force-check'] ) && $_GET['force-check'] == '1' ) || ( isset( $_GET['tab'] ) && 'wizard' === $_GET['tab'] ) ) {
			$force = true;
		}

		if ( ! $last_check ) {
			update_option( 'woodmart-plugins-update-time', time() );
		}

		if ( time() - $last_check > 172800 || $force || ! $last_check ) {
			update_option( 'woodmart-plugins-update-time', time() );

			foreach ( $plugins as $plugin ) {
				$query         = $api->call( 'info/' . $plugin );
				$response_code = wp_remote_retrieve_response_code( $query );

				if ( '200' !== (string) $response_code ) {
					continue;
				}

				$response = json_decode( wp_remote_retrieve_body( $query ) );

				if ( ! property_exists( $response, 'version' ) ) {
					continue;
				}

				update_option( 'woodmart_' . $plugin . '_version', $response->version );
			}
		}

		return $transient;
	}

	public function is_update_available() {
		return version_compare( $this->_current_version, $this->release_version(), '<' );
	}

	public function download_url() {
		return WOODMART_API_URL . 'files/get/' . $this->_theme_name . '.zip?token=' . get_option( 'woodmart_token' );
	}
	public function release_version() {
		$this->check_for_update();
		return $this->_info->new_version;
	}

}
