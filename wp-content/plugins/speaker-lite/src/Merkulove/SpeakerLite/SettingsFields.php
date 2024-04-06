<?php
/**
 * {{plugin_description}}
 * Exclusively on Envato Market: {{plugin_uri}}
 *
 * @encoding        UTF-8
 * @version         1.1.7
 * @copyright       Merkulove
 * @license         (ISC OR GPL-3.0)
 * @contributors    Alexander Khmelnitskiy, Dmytro Merkulov
 * @support         help@merkulov.design
 **/

namespace Merkulove\SpeakerLite;

use Merkulove\SpeakerLite;
use Google\ApiCore\ApiException;
use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;

/** Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

/**
 * SINGLETON: Class used to render plugin settings fields.
 *
 * @since 1.0.0
 * @author Alexandr Khmelnytsky (info@alexander.khmelnitskiy.ua)
 **/
final class SettingsFields {

	/**
	 * The one true SettingsFields.
	 *
	 * @var SettingsFields
	 * @since 1.0.0
	 **/
	private static $instance;

	/**
	 * Render Download link field.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public static function link() {

		$options = [
			'none' => esc_html__( 'Do not show', 'speaker-lite' ),
			'backend' => esc_html__( 'Backend Only', 'speaker-lite' ),
			'frontend' => esc_html__( 'Frontend Only', 'speaker-lite' ),
			'backend-and-frontend' => esc_html__( 'Backend and Frontend', 'speaker-lite' )
		];

		/** Render select. */
		UI::get_instance()->render_select(
			$options,
			Settings::get_instance()->options['link'], // Selected option.
			esc_html__( 'Download link', 'speaker-lite' ),
			esc_html__( 'Position of the Download audio link', 'speaker-lite' ),
			[
                'name' => 'mdp_speaker_lite_design_settings[link]',
                'id' => 'mdp-speaker-lite-design-settings-link'
            ]
		);

	}

	/**
	 * Render Before Audio field.
	 *
	 * @since 1.0.0
	 * @access public
     *
     * @noinspection PhpUnused
	 **/
	public static function before_audio() {

		/** Render input. */
		UI::get_instance()->render_input(
			Settings::get_instance()->options['before_audio'],
			esc_html__( 'Before Audio', 'speaker-lite'),
			esc_html__( 'Add text before audio(intro).', 'speaker-lite' ),
			[
                'name'      => 'mdp_speaker_lite_settings[before_audio]',
                'id'        => 'mdp-speaker-lite-settings-before-audio',
                'maxlength' => '4500',
                'disabled'  => 'disabled',
                'badge'     => esc_html__( 'Upgrade to PRO', 'speaker-lite' ),
            ]
		);

	}

    /**
     * Render Read the Title field.
     *
     * @since 1.0.0
     * @access public
     *
     **/
    public static function read_title() {

        /** Render Read the Title switcher. */
        UI::get_instance()->render_switches(
            Settings::get_instance()->options['read_title'],
            esc_html__( 'Read the Title', 'speaker-lite' ),
            esc_html__( 'Include title in audio version.', 'speaker-lite' ),
            [
                'name'      => 'mdp_speaker_lite_settings[read_title]',
                'id'        => 'mdp-speaker-lite-settings-read-title',
                'class'     => 'mdc-switch--disabled',
                'disabled'  => 'disabled',
                'badge'     => esc_html__( 'Upgrade to PRO', 'speaker-lite' ),
            ]
        );

    }

	/**
	 * Render Auto Generation field.
	 *
	 * @since 1.0.0
	 * @access public
     *
     * @noinspection PhpUnused
	 **/
	public static function auto_generation() {

		/** Render Auto Generation switcher. */
		UI::get_instance()->render_switches(
			Settings::get_instance()->options['auto_generation'],
			esc_html__( 'Synthesize audio on save', 'speaker-lite' ),
			esc_html__( 'This significantly increases your expenses in Google Cloud.', 'speaker-lite' ),
			[
				'name' => 'mdp_speaker_lite_settings[auto_generation]',
				'id' => 'mdp_speaker_lite_settings_auto_generation',
                'class'     => 'mdc-switch--disabled',
                'disabled'  => 'disabled',
                'badge'     => esc_html__( 'Upgrade to PRO', 'speaker-lite' ),
			]
		);

	}

	/**
	 * Render After Audio field.
	 *
	 * @since 1.0.0
	 * @access public
	 *
     **/
	public static function after_audio() {

		/** Render input. */
		UI::get_instance()->render_input(
			Settings::get_instance()->options['after_audio'],
			esc_html__( 'After Audio', 'speaker-lite'),
			esc_html__( 'Add a text after audio(outro).', 'speaker-lite' ),
			[
                'name'      => 'mdp_speaker_lite_settings[after_audio]',
                'id'        => 'mdp-speaker-lite-settings-after-audio',
                'maxlength' => '4500',
                'disabled'  => 'disabled',
                'badge'     => esc_html__( 'Upgrade to PRO', 'speaker-lite' ),
            ]
		);

	}

	/**
	 * Render Player Position field.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public static function position() {

		$options = [
			"before-content" => esc_html__( 'Before Content', 'speaker-lite' ),
			"after-content" => esc_html__( 'After Content', 'speaker-lite' ),
			"top-fixed" => esc_html__( 'Top Fixed', 'speaker-lite' ),
			"bottom-fixed" => esc_html__( 'Bottom Fixed', 'speaker-lite' ),
			"before-title" => esc_html__( 'Before Title', 'speaker-lite' ),
			"after-title" => esc_html__( 'After Title', 'speaker-lite' ),
			"shortcode" => esc_html__( 'Shortcode [speaker]', 'speaker-lite' )
		];

		/** Render select. */
		UI::get_instance()->render_select(
			$options,
			Settings::get_instance()->options['position'], // Selected option.
			esc_html__('Position', 'speaker-lite' ),
			esc_html__( 'Select the Player position or use shortcode.', 'speaker-lite' ),
			['name' => 'mdp_speaker_lite_design_settings[position]']
		);

	}

    /**
     * Render Default Speech Templates field.
     *
     * @since 1.0.0
     * @access public
     **/
    public static function default_templates() {

        /** All available post types. */
        $custom_posts = self::get_cpt();

        /** Prepare options for ST select. */
        $options = MetaBox::get_instance()->get_st_options();

        ?>
        <div class="mdc-data-table">
            <table id="mdp-custom-posts-tbl" class="mdc-data-table__table" aria-label="<?php esc_attr_e( 'Default Speech Templates', 'speaker-lite' ); ?>">
                <thead>
                    <tr class="mdc-data-table__header-row">
                        <th class="mdc-data-table__header-cell" role="columnheader" scope="col"><?php esc_html_e( 'Post Type', 'speaker-lite' ); ?></th>
                        <th class="mdc-data-table__header-cell" role="columnheader" scope="col"><?php esc_html_e( 'Default Speech Template', 'speaker-lite' ); ?></th>
                    </tr>
                </thead>
                <tbody class="mdc-data-table__content">
                    <?php foreach ( $custom_posts as $key => $post_type ) : ?>
                        <tr class="mdc-data-table__row">
                            <td class="mdp-post-type mdp-sc-name mdc-data-table__cell">
                                <span data-post-type="<?php esc_attr_e( $key ); ?>">
                                    <?php esc_html_e( $post_type ); ?>
                                    <span>(<?php esc_html_e( $key ); ?>)</span>
                                </span>
                            </td>
                            <td class="mdp-sc-name mdc-data-table__cell">

                                <?php

                                /** Return default ST for current post type. */
                                $default = MetaBox::get_instance()->get_default_st( $key );

                                /** Render Speech Template Select. */
                                UI::get_instance()->render_select(
                                $options,
                                $default, // Selected option.
                                esc_html__( 'Speech Template', 'speaker-lite' ),
                                '',
                                [
                                    'name' => 'mdp_speaker_lite_default_speech_template_for__' . $key,
                                    'id' => 'mdp-speaker-lite-default-speech-template-for--' . $key,
                                ] );

                                ?>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <p class="mdp-speaker-full-text"><?php echo esc_html__( 'Speech Templates for Custom Post Types are not available in the Speaker Lite. Go ', 'speaker-lite' ) . '<a href="https://1.envato.market/speaker" target="_blank">' . esc_html__( 'PRO', 'speaker-lite' ) . "</a>" . esc_html__( ' to unlock additional functionality.', 'speaker-lite' )?></p>
        <?php

    }

	/**
	 * Render Post Types field.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public static function cpt_support() {

		/** All available post types. */
		$options = self::get_cpt();

		UI::get_instance()->render_chosen_dropdown(
			$options,
			Settings::get_instance()->options['cpt_support'],
			esc_html__( 'Select post types for which the plugin will work.', 'speaker-lite' ),
			[
				'name' => 'mdp_speaker_lite_post_types_settings[cpt_support][]',
				'id' => 'mdp-speaker-lite-post-types-settings-cpt-support',
				'multiple' => 'multiple',
				'badge'     => esc_html__( 'Upgrade to PRO', 'speaker-lite' ),
			]
		);

	}

	/**
	 * Return list of Custom Post Types.
	 *
	 * @param array $cpt Array with posts types to exclude.
	 *
	 * @since 1.0.0
	 * @access private
	 * @return array
	 **/
	private static function get_cpt( $cpt = [] ) {

		$defaults = [
			'exclude' => [
                'attachment',
                'elementor_library',
                'notification'
            ],
		];

		$cpt = array_merge( $defaults, $cpt );

		$post_types_objects = get_post_types(
			[
				'public' => true,
			], 'objects'
		);

		/**
		 * Filters the list of post type objects used by plugin.
		 *
		 * @since 1.0.0
		 *
		 * @param array $post_types_objects List of post type objects used by plugin.
		 **/
		$post_types_objects = apply_filters( 'speaker/post_type_objects', $post_types_objects );

		$cpt['options'] = [];

		foreach ( $post_types_objects as $cpt_slug => $post_type ) {

			if ( in_array( $cpt_slug, $cpt['exclude'], true ) ) {
				continue;
			}

			$cpt['options'][ $cpt_slug ] = $post_type->labels->name;

		}

		return $cpt['options'];

	}

	/**
	 * Render Style field.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public static function style() {

		$options = [
			'speaker-lite-round' => esc_html__( 'Round player', 'speaker-lite' ),
			'speaker-lite-rounded' => esc_html__( 'Rounded player', 'speaker-lite' ),
			'speaker-lite-squared' => esc_html__( 'Squared player', 'speaker-lite' ),
			'speaker-lite-wp-default' => esc_html__( 'WordPress default player', 'speaker-lite' ),
			'speaker-lite-browser-default' => esc_html__( 'Browser default player', 'speaker-lite' )
		];

		/** Render select. */
		UI::get_instance()->render_select(
			$options,
			Settings::get_instance()->options['style'], // Selected option.
			esc_html__( 'Player Style', 'speaker-lite' ),
			esc_html__( 'Select one of the Player styles', 'speaker-lite' ),
			['name' => 'mdp_speaker_lite_design_settings[style]']
		);

	}

	/**
	 * Render Player Background Color field.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public static function bgcolor() {

		/** Render colorpicker. */
		UI::get_instance()->render_colorpicker(
			Settings::get_instance()->options['bgcolor'],
			esc_html__( 'Background Color', 'speaker-lite' ),
			esc_html__( 'Select the Player background-color', 'speaker-lite' ),
			[
				'name' => 'mdp_speaker_lite_design_settings[bgcolor]',
				'id' => 'mdp-speaker-lite-bgcolor',
				'readonly' => 'readonly'
			]
		);

	}

	/**
	 * Render Pitch field.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public static function pitch() {

		/** Render slider. */
		UI::get_instance()->render_slider(
			Settings::get_instance()->options['pitch'],
			-20,
			20,
			0.1,
			esc_html__( 'Pitch', 'speaker-lite'),
			esc_html__( 'Current pitch:', 'speaker-lite') . ' <strong>' . esc_html( Settings::get_instance()->options['pitch'] ) . '</strong>',
			[
				'name' => 'mdp_speaker_lite_settings[pitch]',
				'class' => 'mdc-slider-width',
				'id' => 'mdp_speaker_lite_settings_pitch'
			],
			false
		);

	}

    /**
     * Render Volume Gain field.
     *
     * @since 1.0.0
     * @access public
     **/
    public static function volume() {

        /** Render slider. */
        UI::get_instance()->render_slider(
            Settings::get_instance()->options['volume'],
            -10,
            15,
            0.1,
            esc_html__( 'Volume Gain', 'speaker-lite'),
            esc_html__( 'Current volume gain:', 'speaker-lite') .
            ' <strong>' . esc_html( Settings::get_instance()->options['volume'] ) . '</strong>' .
            esc_html__( ' dB', 'speaker-lite'),
            [
                'name' => 'mdp_speaker_lite_settings[volume]',
                'class' => 'mdc-slider-width',
                'id' => 'mdp-speaker-lite-settings-volume'
            ],
            false
        );

    }

	/**
	 * Render Speaking Rate/Speed field.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public static function speaking_rate() {

		/** Render slider. */
		UI::get_instance()->render_slider(
			Settings::get_instance()->options['speaking-rate'],
			0.25,
			4.0,
			0.25,
			esc_html__( 'Speaking Rate/Speed', 'speaker-lite'),
			esc_html__( 'Speaking rate:', 'speaker-lite') . ' <strong>' . esc_html( Settings::get_instance()->options['speaking-rate'] ) . '</strong><br>',
			[
				'name' => 'mdp_speaker_lite_settings[speaking-rate]',
				'class' => 'mdc-slider-width',
				'id' => 'mdp_speaker_lite_settings_rate'
			],
			false
		);

	}

	/**
	 * Render Audio Profile field.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public static function audio_profile() {

		/** Prepare options for select. */
		$options = [
			'wearable-class-device' => esc_html__( 'Smart watches and other wearables', 'speaker-lite' ),
			'handset-class-device' => esc_html__( 'Smartphones', 'speaker-lite' ),
			'headphone-class-device' => esc_html__( 'Earbuds or headphones', 'speaker-lite' ),
			'small-bluetooth-speaker-lite-class-device' => esc_html__( 'Small home speakers', 'speaker-lite' ),
			'medium-bluetooth-speaker-lite-class-device' => esc_html__( 'Smart home speakers', 'speaker-lite' ),
			'large-home-entertainment-class-device' => esc_html__( 'Home entertainment systems', 'speaker-lite' ),
			'large-automotive-class-device' => esc_html__( 'Car speakers', 'speaker-lite' ),
			'telephony-class-application' => esc_html__( 'Interactive Voice Response', 'speaker-lite' ),
		];

		/** Render select. */
		UI::get_instance()->render_select(
			$options,
			Settings::get_instance()->options['audio-profile'], // Selected option.
			esc_html__( 'Audio Profile', 'speaker-lite' ),
			esc_html__( 'Optimize the synthetic speech for playback on different types of hardware.', 'speaker-lite' ),
			['name' => 'mdp_speaker_lite_settings[audio-profile]']
		);

	}

	/**
	 * Return Voice Type.
	 *
	 * @param $lang_name - Google voice name.
	 *
	 * @return string
	 * @since 1.0.0
	 * @access public
	 **/
	public static function render_voice_type( $lang_name ) {

		$wavenet = strpos( $lang_name, 'Wavenet' );
		if ( $wavenet !== false ) {
			return wp_sprintf(
				'<img src="%s" alt="%s">%s',
				SpeakerLite::$url . 'images/wavenet.svg',
				esc_html__( 'WaveNet voice', 'speaker' ),
				esc_html( 'WaveNet' )
			);
		}

		$neural = strpos( $lang_name, 'Neural' );
		if ( $neural !== false ) {
			return wp_sprintf(
				'<img src="%s" alt="%s">%s',
				SpeakerLite::$url . 'images/neural.svg',
				esc_html__( 'Neural2 voice', 'speaker' ),
				esc_html( 'Neural2' )
			);
		}

		$news = strpos( $lang_name, 'News' );
		if ( $news !== false ) {
			return wp_sprintf(
				'<img src="%s" alt="%s">%s',
				SpeakerLite::$url . 'images/news.svg',
				esc_html__( 'News voice', 'speaker' ),
				esc_html( 'News' )
			);
		}

		$studio = strpos( $lang_name, 'Studio' );
		if ( $studio !== false ) {
			return wp_sprintf(
				'<img src="%s" alt="%s">%s',
				SpeakerLite::$url . 'images/studio.svg',
				esc_html__( 'Studio voice', 'speaker' ),
				esc_html( 'Studio' )
			);
		}

		return wp_sprintf(
			'<img src="%s" alt="%s">%s',
			SpeakerLite::$url . 'images/standard.svg',
			esc_html__( 'Standard voice', 'speaker' ),
			esc_html( 'Standard' )
		);

    }

    /**
     * Return Voice Type.
     *
     * @param $lang_name - Google voice name.
     *
     * @return string
     * @since 1.0.0
     * @access public
     **/
    public static function get_voice_type( $lang_name, $strtolower = true ) {

        $parts = explode( '-', $lang_name );

        if ( is_array( $parts ) ) {

            return isset( $parts[ 2 ] ) ?
                $strtolower ?
                    strtolower( $parts[ 2 ] ) :
                    $parts[ 2 ] :
                'unknown';

        }
        return 'unknown';

    }

	/**
	 * Render Drag & Drop API Key field.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public static function dnd_api_key() {

		$key_exist = false;
		if ( Settings::get_instance()->options['dnd-api-key'] ) { $key_exist = true; }

	    ?>
        <div class="mdp-dnd">
            <!--suppress HtmlFormInputWithoutLabel -->
            <div class="mdc-text-field mdc-input-width mdc-text-field--outlined mdc-hidden">
                <!--suppress HtmlFormInputWithoutLabel -->
                <input  type="text"
                        class="mdc-text-field__input"
                        name="mdp_speaker_lite_settings[dnd-api-key]"
                        id="mdp-speaker-lite-settings-dnd-api-key"
                        value="<?php esc_attr_e( Settings::get_instance()->options['dnd-api-key'] ); ?>"
                >
                <div class="mdc-notched-outline mdc-notched-outline--upgraded mdc-notched-outline--notched">
                    <div class="mdc-notched-outline__leading"></div>
                    <div class="mdc-notched-outline__notch">
                        <label for="mdp-speaker-lite-settings-dnd-api-key" class="mdc-floating-label mdc-floating-label--float-above"><?php esc_html_e( 'API Key', 'speaker-lite' ); ?></label>
                    </div>
                    <div class="mdc-notched-outline__trailing"></div>
                </div>
            </div>
            <div id="mdp-api-key-drop-zone" class="<?php if ( $key_exist ) : ?>mdp-key-uploaded<?php endif; ?>">
                <?php if ( $key_exist ) : ?>
                    <span class="material-icons">check_circle_outline</span><?php esc_html_e( 'API Key file exist', 'speaker-lite' ); ?>
                    <span class="mdp-drop-zone-hover"><?php esc_html_e( 'Drop Key file here or click to upload', 'speaker-lite' ); ?></span>
                <?php else : ?>
                    <span class="material-icons">cloud</span><?php esc_html_e( 'Drop Key file here or click to upload.', 'speaker-lite' ); ?>
                <?php endif; ?>
            </div>
            <?php if ( $key_exist ) : ?>
                <div class="mdp-messages mdc-text-field-helper-line mdc-text-field-helper-text mdc-text-field-helper-text--persistent">
                    <?php esc_html_e( 'Drag and drop or click on the form to replace API key. |', 'speaker-lite' ); ?>
                    <a href="#" class="mdp-reset-key-btn"><?php esc_html_e( 'Reset API Key', 'speaker-lite' ); ?></a>
                </div>
            <?php else : ?>
                <div class="mdp-messages mdc-text-field-helper-line mdc-text-field-helper-text mdc-text-field-helper-text--persistent">
                    <?php esc_html_e( 'Drag and drop or click on the form to add API key.', 'speaker-lite' ); ?>
                </div>
            <?php endif; ?>
            <input id="mdp-dnd-file-input" type="file" name="name" class="mdc-hidden" />
        </div>
        <?php

    }

	/**
	 * Render Current Language
	 */
	public static function current_language() {

		?>
        <div class="mdp-now-used">
            <div>
                <strong><?php echo esc_attr( Settings::get_instance()->options['language'] ); ?></strong>
            </div>
            <div>
                <audio controls="">
                    <source src="https://cloud.google.com/text-to-speech/docs/audio/<?php echo esc_attr( Settings::get_instance()->options['language'] ); ?>.mp3" type="audio/mp3">
                    <source src="https://cloud.google.com/text-to-speech/docs/audio/<?php echo esc_attr( Settings::get_instance()->options['language'] ); ?>.wav" type="audio/mp3">
					<?php esc_html_e( 'Your browser does not support the audio element.', 'speaker-lite' ); ?>
                </audio>
            </div>
        </div>
		<?php

	}



	/**
	 * Render Language field.
	 *
	 * @return void
	 *
	 * @throws ApiException
	 * @since 1.0.0
	 * @access public
	 *
	 * @noinspection PhpUnhandledExceptionInspection
	 **/
	public static function language() {

        /** Setting custom exception handler. */
		set_exception_handler( [ ErrorHandler::class, 'exception_handler' ] );

		/** Create client object. */
		$client = new TextToSpeechClient();

		/** Perform list voices request. */
		$response = $client->listVoices();
		$voices   = $response->getVoices();

		/** Show a warning if it was not possible to get a list of voices. */
		if ( count( $voices ) === 0 ) {

			?>
            <div class="mdp-key-error">
                <?php esc_html_e( 'Failed to get the list of languages. 
                The request failed. It looks like a problem with your API Key File. 
                Make sure that you are using the correct key file, and that the quotas have not been exceeded. 
                If you set security restrictions on a key, make sure that the current domain is added to the exceptions.', 'speaker-lite' ); ?>
            </div>
            <?php

			return;

		}

		/** Prepare Languages Options. */
		$options = [];
		$options[] = esc_html__( 'Select Language', 'speaker-lite' );
		foreach ( $voices as $voice ) {

			$lang = Language::get_lang_by_code( $voice->getLanguageCodes() );

			/** Skip missing language. */
			if ( false === $lang ) { continue; }

			$options[$lang] = $lang;

		}
		ksort( $options ); // Sort by language name.

		/** Render Language select. */
		UI::get_instance()->render_select(
			$options,
			'',
			esc_html__('Language', 'speaker-lite' ),
			'',
			[
				'name' => 'mdp_speaker_lite_language_filter',
				'id' => 'mdp-speaker-lite-language-filter'
			]
		);

		?>

        <div class="mdc-text-field-helper-line mdp-speaker-lite-helper-padding">
            <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent"><?php esc_html_e( 'The list includes both standard and', 'speaker-lite' ); ?>
                <a href="https://cloud.google.com/text-to-speech/docs/wavenet"
                   target="_blank"><?php esc_html_e( 'WaveNet voices', 'speaker-lite' ); ?></a>.
				<?php esc_html_e( 'WaveNet voices are higher quality voices with different', 'speaker-lite' ); ?>
                <a href="https://cloud.google.com/text-to-speech/pricing"
                   target="_blank"><?php esc_html_e( 'pricing', 'speaker-lite' ); ?></a>;
				<?php esc_html_e( 'in the list, they have the voice type "WaveNet".', 'speaker-lite' ); ?>
            </div>
        </div>

        <table id="mdp-speaker-lite-settings-language-tbl" class="display stripe hidden">
            <thead>
            <tr>
                <th><?php esc_html_e( 'Language', 'speaker-lite' ); ?></th>
                <th><?php esc_html_e( 'Voice', 'speaker-lite' ); ?></th>
                <th><?php esc_html_e( 'Gender', 'speaker-lite' ); ?></th>
            </tr>
            </thead>
            <tbody>
			<?php

			$rendered_voices = array();
            $table = array();

			foreach ( $voices as $voice ) :

				/** Skip already rendered voices. */
				if ( in_array( $voice->getName(), $rendered_voices ) ) {
					continue;
				} else {
					$rendered_voices[] = $voice->getName();
				}

                /** Get language name */
                $lang_name = Language::get_lang_by_code( $voice->getLanguageCodes() );
                if ( false === $lang_name ) { continue; } // Skip missing language

                /** Prepare classes. */
                $class = 'mdp-speaker-lite-voice-type-' . self::get_instance()->get_voice_type( $voice->getName() );
                if ( $voice->getName() === Settings::get_instance()->options['language'] ) {
                    $class .= ' selected ';
                }

                $voice_markup = wp_sprintf(
	                '<span class="mdp-lang-code" title="%1$s">%1$s</span> - <span>%2$s</span> - <span class="mdp-voice-name" title="%3$s">%4$s</span>',
	                esc_html( $voice->getLanguageCodes()[0] ),
	                self::get_voice_type( $voice->getName(), false ),
	                esc_html( $voice->getName() ),
	                esc_html( substr( $voice->getName(), -1 ) )
                );

				$ssmlVoiceGender = [ 'SSML_VOICE_GENDER_UNSPECIFIED', 'Male', 'Female', 'Neutral' ];
                $gender_markup =  wp_sprintf(
					'<span title="%1$s"><img src="%2$s" alt="%1$s">%3$s</span>',
					esc_attr( $ssmlVoiceGender[ $voice->getSsmlGender() ] ),
					SpeakerLite::$url . 'images/' . strtolower( $ssmlVoiceGender[ $voice->getSsmlGender() ] ) . '.svg',
					esc_html__( $ssmlVoiceGender[ $voice->getSsmlGender() ], 'speaker' )
				);

                $lang_code = $voice->getLanguageCodes()[0];

                $lang_type = self::get_voice_type( $voice->getName() );
				$lang_type_index = $lang_type === 'standard' ? 0 : 1;

                $table[ $lang_code ][ $lang_type_index ][] = array(
                    'lang_name' => $lang_name,
                    'voice' => $voice_markup,
                    'gender' => $gender_markup,
                    'class' => $class
                );

			endforeach;
            ksort( $table ); // Sort by language code

            foreach( $table as $lang ) {

                ksort( $lang );

                foreach ( $lang as $type ) {

                    foreach ( $type as $row ) {

	                    echo wp_sprintf(
		                    '<tr class="%1$s">
                                <td class="mdp-lang-name">%2$s</td>
                                <td>%3$s</td>
                                <td>%4$s</td>
                            </tr>',
		                    esc_attr( $row['class'] ),
		                    esc_html( $row['lang_name'] ),
		                    $row[ 'voice' ],
		                    $row[ 'gender' ]
	                    );

                    }

                }

            }

			$client->close();

			?>
            </tbody>

        </table>

        <input id="mdp-speaker-lite-settings-language" type='hidden' name='mdp_speaker_lite_settings[language]'
               value='<?php echo esc_attr( Settings::get_instance()->options['language'] ); ?>'>
        <input id="mdp-speaker-lite-settings-language-code" type='hidden' name='mdp_speaker_lite_settings[language-code]'
               value='<?php echo esc_attr( Settings::get_instance()->options['language-code'] ); ?>'>
		<?php

        /** Restore previous exception handler. */
        restore_exception_handler();

	}

	/**
	 * Render CSS field.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public static function custom_css() {
		?>
		<div>
            <label>
                <textarea
                    id="mdp_custom_css_fld"
                    name="mdp_speaker_lite_css_settings[custom_css]"
                    class="mdp_custom_css_fld"><?php echo esc_textarea( Settings::get_instance()->options['custom_css'] ); ?></textarea>
            </label>
			<p class="description"><?php esc_html_e( 'Add custom CSS here.', 'speaker-lite' ); ?></p>
		</div>
		<?php
	}

    /**
     * Render Purchase Code field.
     *
     * @since 1.0.0
     * @access public
     **/
    public function render_go_pro() {

	    $this->render_PRO(); ?>

        <div class="mdp-activation">

            <?php $this->render_FAQ(); ?>
            <?php $this->render_subscribe(); ?>

        </div>

        <?php
    }

	/**
	 * Render GO PRO block.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public function render_PRO() {
	    ?>

        <div class="mdp-go-pro-box">
            <h3><?php esc_html_e( 'Unlock additional functionality!', 'speaker-lite' ); ?></h3>
            <p>
				<?php esc_html_e( 'Speaker Lite includes only the basic functions. Go ', 'speaker-lite' ); ?>
                <a href="https://speaker.merkulov.design/lite" target="_blank"><?php esc_html_e( 'Speaker PRO', 'speaker-lite' ); ?></a>
				<?php esc_html_e( ' to get more awesome features. Buy a license and gain access to all hidden features.', 'speaker-lite' ); ?>
            </p>
            <div class="mdp-pro-features">
                <ul>
                    <li>
                        <i class="material-icons">label_important</i>
                        <span>No prohibitions or restrictions</span>
                    </li>
                    <li>
                        <i class="material-icons">label_important</i>
                        <span>More High-end Voices</span>
                    </li>
                    <li>
                        <i class="material-icons">label_important</i>
                        <span>Full power of SSML</span>
                    </li>
                    <li>
                        <i class="material-icons">label_important</i>
                        <span>Automatically Speech Synthesizing​</span>
                    </li>
                </ul>
                <ul>
                    <li>
                        <i class="material-icons">label_important</i>
                        <span>Full support of Custom Post Types</span>
                    </li>
                    <li>
                        <i class="material-icons">label_important</i>
                        <span>Visual Speech Template Editor</span>
                    </li>
                    <li>
                        <i class="material-icons">label_important</i>
                        <span>Batch Pages Processing</span>
                    </li>
                    <li>
                        <i class="material-icons">label_important</i>
                        <span>Premium Customer Support</span>
                    </li>
                </ul>
            </div>
            <div class="mdp-pro-buttons">
                <a href="https://1.envato.market/speaker-buy" target="_blank" class="mdp-button-pro">
					<?php esc_html_e( 'Upgrade to PRO', 'speaker-lite' ); ?>
                </a>
                <a href="https://speaker.merkulov.design/lite#speaker-compare" target="_blank" class="mdp-button-compare">
					<?php esc_html_e( 'Compare Speaker', 'speaker-lite' ); ?>
                </a>
            </div>

        </div>

        <?php
    }

    /**
     * Render FAQ block.
     *
     * @since 1.0.0
     * @access public
     **/
    public function render_FAQ() {
        ?>

        <div class="mdp-activation-faq">

            <div class="mdc-accordion" data-mdc-accordion="showfirst: true">

                <h3><?php esc_html_e( 'FAQ\'S', 'speaker-lite' ); ?></h3>

                <div class="mdc-accordion-title">
                    <i class="material-icons">help</i>
                    <span class="mdc-list-item__text"><?php esc_html_e( 'Why should I go to Pro version?', 'speaker-lite' ); ?></span>
                </div>
                <div class="mdc-accordion-content">
                    <p><?php esc_html_e( 'The Speaker Pro provides ', 'speaker-lite' ); ?>
                        <a href="https://speaker.merkulov.design/lite/#speaker-compare" target="_blank"><?php esc_html_e( ' advanced features', 'speaker-lite' );?></a>
                        <?php esc_html_e( 'including custom post types support and speech templates, which makes the plugin compatible with most themes and plugins. You can create audio for posts with any number of characters and explore other useful functions to work with your project. ', 'speaker-lite' ); ?>
                    </p>
                </div>

                <div class="mdc-accordion-title">
                    <i class="material-icons">help</i>
                    <span class="mdc-list-item__text"><?php esc_html_e( 'Can I use one license for multiple sites?', 'speaker-lite' ); ?></span>
                </div>
                <div class="mdc-accordion-content">
                    <p>
                        <?php esc_html_e( 'According to the Envato rules, all products with a', 'speaker-lite' ); ?>
                        <a href="https://themeforest.net/licenses/terms/regular" target="_blank"><?php esc_html_e( 'regular license', 'speaker-lite' );?></a>
                        <?php esc_html_e( 'can be used only for one end product except the situation when several sites are used for one project. Otherwise, a separate license is needed for each site.', 'speaker-lite' ); ?>
                    </p>
                </div>

                <div class="mdc-accordion-title">
                    <i class="material-icons">help</i>
                    <span class="mdc-list-item__text"><?php esc_html_e( 'Are there any restrictions in the Pro version?', 'speaker-lite' ); ?></span>
                </div>
                <div class="mdc-accordion-content">
                    <p>
                        <?php esc_html_e( 'For our part, we provide all the available functions for the Speaker Pro but please note the plugin based on Google Cloud API, which provides a free quota of 4 million characters every month. If your website consumes more, then each next million characters will cost $4. Here is', 'speaker-lite' ); ?>
                        <a href="https://cloud.google.com/text-to-speech/pricing" target="_blank"><?php esc_html_e( 'Google Pricing', 'speaker-lite' );?></a>
                        <?php esc_html_e( '. In the Google settings, there are quotas for dropping money from the card, and you can set them to $0. And when the free characters quota ends, the plugin will stop working until next month.', 'speaker-lite' ); ?>
                    </p>
                </div>

            </div>

        </div>
        <?php
    }

	/**
	 * Render e-sputnik Subscription Form block.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public function render_subscribe() {
	    ?>
        <div class="mdp-activation-form">

            <h3><?php esc_html_e( 'Subscribe to news', 'speaker-lite' ); ?></h3>
            <p><?php esc_html_e( 'Sign up for the newsletter to be the first to know about news and discounts on Speaker and other WordPress plugins.', 'speaker-lite' ); ?></p>

			<?php
			/** Render Name. */
			UI::get_instance()->render_input(
				'',
				esc_html__( 'Your Name', 'speaker-lite'),
				'',
				[
					'name' => 'mdp-speaker-lite-subscribe-name',
					'id' => 'mdp-speaker-lite-subscribe-name'
				]
			);

			/** Render e-Mail. */
			UI::get_instance()->render_input(
				'',
				esc_html__( 'Your E-Mail', 'speaker-lite'),
				'',
				[
					'name'  => 'mdp-speaker-lite-subscribe-mail',
					'id'    => 'mdp-speaker-lite-subscribe-mail',
					'type'  => 'email',
				]
			);

			/** Render button. */
			UI::get_instance()->render_button(
				esc_html__( 'Subscribe', 'speaker-lite' ),
				'',
				[
					"name"  => "mdp-speaker-lite-subscribe",
					"id"    => "mdp-speaker-lite-subscribe",
					"class" => "mdp-reset"
				],
				''
			);
			?>

        </div>
        <?php
    }

	/**
	 * Render "Settings Saved" nags.
	 *
     * @return void
	 * @since 1.0.0
	 **/
	public function render_nags() {

		if ( ! isset( $_GET['settings-updated'] ) ) { return; }

		if ( strcmp( $_GET['settings-updated'], 'true' ) === 0 ) {

			/** Render "Settings Saved" message. */
			UI::get_instance()->render_snackbar( esc_html__( 'Settings saved!', 'speaker-lite' ) );

		}

	}

	/**
	 * Main SettingsFields Instance.
	 *
	 * Insures that only one instance of SettingsFields exists in memory at any one time.
	 *
	 * @static
	 * @return SettingsFields
	 * @since 1.0.0
	 **/
	public static function get_instance() {

		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof self ) ) {

			self::$instance = new self;

		}

		return self::$instance;

	}

} // End Class SettingsFields.
