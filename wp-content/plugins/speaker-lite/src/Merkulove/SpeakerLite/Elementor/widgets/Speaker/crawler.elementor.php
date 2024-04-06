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

/** Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
    header( 'Status: 403 Forbidden' );
    header( 'HTTP/1.1 403 Forbidden' );
    exit;
}

use Elementor\Widget_Base;
use Merkulove\SpeakerLite;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Plugin;
use Elementor\Controls_Manager;
use Elementor\Repeater;

/** @noinspection PhpUnused */
/**
 * Crawler - Custom Elementor Widget.
 **/
class crawler_elementor extends Widget_Base {

    /**
     * Use this to sort widgets.
     * A smaller value means earlier initialization of the widget.
     * Can take negative values.
     * Default widgets and widgets from 3rd party developers have 0 $mdp_order
     **/
    public $mdp_order = 1;

    /**
     * Widget base constructor.
     * Initializing the widget base class.
     *
     * @access public
     * @throws Exception If arguments are missing when initializing a full widget instance.
     * @param array      $data Widget data. Default is an empty array.
     * @param array|null $args Optional. Widget default arguments. Default is null.
     *
     * @return void
     **/
    public function __construct( $data = [], $args = null ) {

        parent::__construct( $data, $args );

        wp_register_style( 'mdp-ticker-elementor', SpeakerLite::$url . 'css/ticker-elementor' . SpeakerLite::$suffix . '.css', [], SpeakerLite::$version );
	    wp_register_script( 'mdp-ticker-elementor', SpeakerLite::$url . 'js/ticker-elementor' . SpeakerLite::$suffix . '.js', [ 'elementor-frontend' ], SpeakerLite::$version, true );

    }

    /**
     * Return a widget name.
     *
     * @return string
     **/
    public function get_name() {

        return 'mdp-ticker-elementor';

    }

    /**
     * Return the widget title that will be displayed as the widget label.
     *
     * @return string
     **/
    public function get_title() {

        return esc_html__( 'Ticker', 'speaker-lite' );

    }

    /**
     * Set the widget icon.
     *
     * @return string
     */
    public function get_icon() {

	    return 'eicon-shortcode';

    }

    /**
     * Set the category of the widget.
     *
     * @return array with category names
     **/
    public function get_categories() {

        return [ 'general' ];

    }

    /**
     * Get widget keywords. Retrieve the list of keywords the widget belongs to.
     *
     * @access public
     *
     * @return array Widget keywords.
     **/
    public function get_keywords() {

        return [ 'Merkulove', 'Crawler', 'ticker' ];

    }

    /**
     * Get style dependencies.
     * Retrieve the list of style dependencies the widget requires.
     *
     * @access public
     *
     * @return array Widget styles dependencies.
     **/
    public function get_style_depends() {

        return [ 'mdp-ticker-elementor' ];

    }

	/**
	 * Get script dependencies.
	 * Retrieve the list of script dependencies the element requires.
	 *
	 * @access public
     *
	 * @return array Element scripts dependencies.
	 **/
	public function get_script_depends() {

		return [ 'mdp-ticker-elementor' ];

    }

    /**
     * Add the widget controls.
     *
     * @access protected
     * @return void with category names
     **/
    protected function _register_controls() {

        /** Content Tab. */
        $this->tab_content();

        /** Style Tab. */
        $this->tab_style();

    }

    /**
     * Add widget controls on Content tab.
     *
     * @since 1.0.0
     * @access private
     *
     * @return void
     **/
    private function tab_content() {

        /** Content -> General Content Section. */
        $this->section_content_general();

        /** Content -> Content Content Section. */
        $this->section_content_content();

        /** Content -> Content Slider Section. */
        $this->section_content_slider();

    }

    /**
     * Add widget controls on Style tab.
     *
     * @since 1.0.0
     * @access private
     *
     * @return void
     **/
    private function tab_style() {

        /** Style -> Section Style Ticker Item. */
        $this->section_style_ticker_item();

        /** Style -> Section Style Label. */
        $this->section_style_label();

        /** Style -> Section Style Arrows. */
        $this->section_style_arrows();

        /** Style -> Section Style Separator. */
        $this->section_style_separator();

    }

    /**
     * Add widget controls: Content -> General Content Section.
     *
     * @since 1.0.0
     * @access private
     *
     * @return void
     **/
    private function section_content_general() {

        $this->start_controls_section( 'section_content_general', [
            'label' => esc_html__( 'General', 'speaker-lite' ),
            'tab'   => Controls_Manager::TAB_CONTENT
        ] );

        $this->add_control(
            'show_label',
            [
                'label' => esc_html__( 'Show label', 'speaker-lite' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'speaker-lite' ),
                'label_off' => esc_html__( 'No', 'speaker-lite' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'hide_label_mobile',
            [
                'label' => esc_html__( 'Hide label on mobile', 'speaker-lite' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'speaker-lite' ),
                'label_off' => esc_html__( 'No', 'speaker-lite' ),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    'show_label' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'label_title',
            [
                'label' => esc_html__( 'Title', 'speaker-lite' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Type label title here', 'speaker-lite' ),
                'default' => esc_html__( 'News', 'speaker-lite' ),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                        'show_label' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'label_icon',
            [
                'label' => esc_html__( 'Label icon', 'speaker-lite' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
                'condition' => [
                    'show_label' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'icon_position',
            [
                'label' => esc_html__( 'Icon position', 'speaker-lite' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'before',
                'options' => [
                    'before' => esc_html__( 'Before', 'speaker-lite' ),
                    'after' => esc_html__( 'After', 'speaker-lite' ),
                    'above-left' => esc_html__( 'Above left', 'speaker-lite' ),
                    'above-center' => esc_html__( 'Above center', 'speaker-lite' ),
                    'above-right' => esc_html__( 'Above right', 'speaker-lite' ),
                    'under-left' => esc_html__( 'Under left', 'speaker-lite' ),
                    'under-center' => esc_html__( 'Under center', 'speaker-lite' ),
                    'under-right' => esc_html__( 'Under right', 'speaker-lite' )
                ],
                'condition' => [
                    'show_label' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'label_alignment',
            [
                'label' => esc_html__( 'Label alignment', 'speaker-lite' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'speaker-lite' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'speaker-lite' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => true,
                'condition' => [
                        'show_label' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'label_text_alignment',
            [
                'label' => esc_html__( 'Label text alignment', 'speaker-lite' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'speaker-lite' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'speaker-lite' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Right', 'speaker-lite' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'separator' => 'after',
                'condition' => [
                    'show_label' => 'yes'
                ],
                'selectors' => [
                        '{{WRAPPER}} .mdp-ticker-elementor-ticker-label' => 'justify-content: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'ticker_type',
            [
                'label' => esc_html__( 'Ticker type', 'speaker-lite' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'ticker',
                'options' => [
                    'ticker' => esc_html__( 'Ticker', 'speaker-lite' ),
                    'slider' => esc_html__( 'Slider', 'speaker-lite' ),
                ],
            ]
        );

        $this->add_control(
            'ticker_direction',
            [
                'label' => esc_html__( 'Ticker direction', 'speaker-lite' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'mdp-ticker-elementor-ticker-animation-normal',
                'options' => [
                    'mdp-ticker-elementor-ticker-animation-normal' => esc_html__( 'Left', 'speaker-lite' ),
                    'mdp-ticker-elementor-ticker-animation-reverse' => esc_html__( 'Right', 'speaker-lite' ),
                ],
                'condition' => [
                    'ticker_type' => 'ticker'
                ]
            ]
        );

        $this->add_control(
            'ticker_speed',
            [
                'label' => esc_html__( 'Ticker speed', 'speaker-lite' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 's' ],
                'range' => [
                    's' => [
                        'min' => 0.1,
                        'max' => 30,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 's',
                    'size' => 10,
                ],
                'condition' => [
                    'ticker_type' => 'ticker'
                ],
                'selectors' => [
                        '{{WRAPPER}} .mdp-ticker-elementor-ticker-ticker-type .mdp-ticker-elementor-ticker-content' => 'animation-duration: {{SIZE}}{{UNIT}}'
                ]
            ]
        );

        $this->add_control(
            'pause_ticker_hover',
            [
                'label' => esc_html__( 'Pause ticker on hover', 'speaker-lite' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'speaker-lite' ),
                'label_off' => esc_html__( 'No', 'speaker-lite' ),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                        'ticker_type' => 'ticker'
                ]
            ]
        );

        $this->add_control(
            'ticker_item_separator',
            [
                'label' => esc_html__( 'Separator', 'speaker-lite' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'speaker-lite' ),
                'label_off' => esc_html__( 'No', 'speaker-lite' ),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                        'ticker_type' => 'ticker'
                ]
            ]
        );

        $this->add_control(
            'separator_type',
            [
                'label' => esc_html__( 'Separator type', 'speaker-lite' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'text',
                'options' => [
                    'date' => esc_html__( 'Date', 'speaker-lite' ),
                    'icon' => esc_html__( 'Icon', 'speaker-lite' ),
                    'text' => esc_html__( 'Text', 'speaker-lite' ),
                ],
                'condition' => [
                    'ticker_item_separator' => 'yes',
                    'ticker_type' => 'ticker'
                ]
            ]
        );

        $this->add_control(
            'separator_icon',
            [
                'label' => esc_html__( 'Separator icon', 'speaker-lite' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
                'condition' => [
                    'separator_type' => 'icon',
                    'ticker_item_separator' => 'yes',
                    'ticker_type' => 'ticker'
                ]
            ]
        );

        $this->add_control(
            'separator_text',
            [
                'label' => esc_html__( 'Separator text', 'speaker-lite' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Type label title here', 'speaker-lite' ),
                'condition' => [
                    'separator_type' => 'text',
                    'ticker_item_separator' => 'yes',
                    'ticker_type' => 'ticker'
                ]
            ]
        );

        $this->end_controls_section();

    }


    /**
     * Add widget controls: Content -> General Content Section.
     *
     * @since 1.0.0
     * @access private
     *
     * @return void
     **/
    private function section_content_content()
    {

        $this->start_controls_section('section_content_content_content', [
            'label' => esc_html__('Content', 'speaker-lite'),
            'tab' => Controls_Manager::TAB_CONTENT
        ]);

        $post_types_options['custom'] = 'Custom';

        $this->add_control(
            'post_type',
            [
                'label' => esc_html__( 'Content type', 'speaker-lite' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'custom',
                'options' => $post_types_options,
                'description' => '<a href="https://1.envato.market/crawler-elementor" target="_blank">' . esc_html__( 'Get' ) . '</a> ' . esc_html__( 'additional Content types by purchasing the paid version of the ticker' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'custom_item_title', [
                'label' => esc_html__( 'Title', 'speaker-lite' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Title' , 'speaker-lite' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'custom_item_link',
            [
                'label' => esc_html__( 'Link', 'speaker-lite' ),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'speaker-lite' ),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $this->add_control(
            'custom_items_list',
            [
                'label' => esc_html__( 'Custom items', 'speaker-lite' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'custom_item_title' => esc_html__( 'Title #1', 'speaker-lite' ),
                    ],
                    [
                        'list_item_title' => esc_html__( 'Title #2', 'speaker-lite' ),
                    ],
                ],
                'title_field' => '{{{ custom_item_title }}}',
                'condition' => [
                        'post_type' => 'custom'
                ]
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Add widget controls: Content -> Slider Content Section.
     *
     * @since 1.0.0
     * @access private
     *
     * @return void
     **/
    private function section_content_slider()
    {

        $this->start_controls_section('section_content_slider', [
            'label' => esc_html__('Slider', 'speaker-lite'),
            'tab' => Controls_Manager::TAB_CONTENT,
            'condition' => [
                    'ticker_type' => 'slider'
            ]
        ]);

        $this->add_control(
            'show_arrows',
            [
                'label' => esc_html__( 'Arrows', 'speaker-lite' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'speaker-lite' ),
                'label_off' => esc_html__( 'No', 'speaker-lite' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'slider_arrow_next',
            [
                'label' => esc_html__( 'Next arrow', 'speaker-lite' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-chevron-right',
                    'library' => 'solid',
                ],
                'condition' => [
                    'show_arrows' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'slider_arrow_previous',
            [
                'label' => esc_html__( 'Previous arrow', 'speaker-lite' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-chevron-left',
                    'library' => 'solid',
                ],
                'condition' => [
                    'show_arrows' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'arrows_alignment',
            [
                'label' => esc_html__( 'Arrows alignment', 'speaker-lite' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'speaker-lite' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'speaker-lite' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'right',
                'toggle' => true,
                'separator' => 'after',
                'selectors' => [
                ],
                'condition' => [
                    'show_arrows' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'infinite_loop',
            [
                'label' => esc_html__( 'Infinite loop', 'speaker-lite' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'speaker-lite' ),
                'label_off' => esc_html__( 'No', 'speaker-lite' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );


        $this->add_control(
            'slide_direction',
            [
                'label' => esc_html__( 'Direction', 'speaker-lite' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left' => esc_html__( 'Left', 'speaker-lite' ),
                    'right' => esc_html__( 'Right', 'speaker-lite' ),
                ],
                'condition' => [
                    'switching_animation' => 'slide'
                ]
            ]
        );

        $this->add_responsive_control(
            'slider_items_to_show',
            [
                'label' => esc_html__( 'Items to show', 'speaker-lite' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 20,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 1,
                ],
                'condition' => [
                     'switching_animation' => 'slide'
                ]
            ]
        );

        $this->add_control(
            'slider_items_to_scroll',
            [
                'label' => esc_html__( 'Items to scroll', 'speaker-lite' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 20,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 1,
                ],
                'condition' => [
                     'switching_animation' => 'slide'
                ]
            ]
        );


        $this->add_control(
            'slider_transition_speed',
            [
                'label' => esc_html__( 'Transition speed', 'speaker-lite' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0.1,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0.3,
                ],
            ]
        );

        $this->add_control(
            'switching_animation',
            [
                'label' => esc_html__( 'Switching animation', 'speaker-lite' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'slide',
                'options' => [
                    'none' => esc_html__( 'None', 'speaker-lite' ),
                    'fade' => esc_html__( 'Fade', 'speaker-lite' ),
                    'slide' => esc_html__( 'Slide', 'speaker-lite' ),
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Function for generating margin padding controls.
     *
     * @param $section_id
     * @param $html_class
     * @return void
     * @since 1.0.0
     * @access private
     *
     */
    private function generate_margin_padding_controls( $section_id, $html_class ) {
        $this->add_responsive_control(
            $section_id.'_margin',
            [
                'label' => esc_html__( 'Margin', 'speaker-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    "{{WRAPPER}} .$html_class" => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            $section_id.'_padding',
            [
                'label' => esc_html__( 'Padding', 'speaker-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'separator' => 'after',
                'selectors' => [
                    "{{WRAPPER}} .$html_class" => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    }


    /**
     * Function for generating typography and tabs controls.
     *
     * @param $section_id
     * @param $html_class
     * @param bool $include_color
     * @param bool $include_bg
     * @param bool $include_typography
     * @param bool $include_transition
     * @param string $color_class
     * @param string $color_hover_class
     * @param string $additional_transition_selector
     * @param bool $additional_color
     * @param string $additional_color_name
     * @param string $additional_color_selector
     * @param string $additional_color_hover_selector
     * @param string $typography_class
     * @return void
     * @since 1.0.0
     * @access private
     */
    private function generate_typography_tabs_controls( $section_id, $html_class, $include_color = true,
                                                        $include_bg = true, $include_typography = true, $include_transition = true,
                                                        $color_class = '', $color_hover_class = '', $additional_transition_selector = '', $additional_color = false,
                                                        $additional_color_name = '' , $additional_color_selector = '', $additional_color_hover_selector = '', $typography_class = '' ) {

        if ( $include_typography ) {
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => $section_id . '_typography',
                    'label' => esc_html__('Typography', 'speaker-lite'),
                    'scheme' => Typography::TYPOGRAPHY_1,
                    'selector' => "{{WRAPPER}} .$typography_class",
                ]
            );
        }

        $this->start_controls_tabs( $section_id.'_style_tabs' );

        $this->start_controls_tab( $section_id.'_normal_style_tab', ['label' => esc_html__( 'NORMAL', 'speaker-lite' )] );

        if ( $include_color ) {

            $this->add_control(
                $section_id . '_normal_text_color',
                [
                    'label' => esc_html__('Color', 'speaker-lite'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Color::get_type(),
                        'value' => Color::COLOR_3,
                    ],
                    'selectors' => [
                        "{{WRAPPER}} .$color_class" => 'color: {{VALUE}} !important;',
                    ],
                ]
            );

        }

        if ( $additional_color ) {
            $this->add_control(
                $section_id . '_' . $additional_color_name . '_normal_text_color',
                [
                    'label' => esc_html__( $additional_color_name, 'speaker-lite' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Color::get_type(),
                        'value' => Color::COLOR_3,
                    ],
                    'selectors' => [
                        "{{WRAPPER}} .$additional_color_selector" => 'color: {{VALUE}} !important;',
                    ],
                ]
            );
        }

        if ( $include_bg ) {

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => $section_id . '_normal_background',
                    'label' => esc_html__('Background type', 'speaker-lite'),
                    'types' => ['classic', 'gradient', 'video'],
                    'selector' => "{{WRAPPER}} .$html_class",
                ]
            );

        }

        $this->add_control(
            $section_id . '_separate_normal',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => $section_id.'_border_normal',
                'label' => esc_html__( 'Border Type', 'speaker-lite' ),
                'selector' => "{{WRAPPER}} .$html_class",
            ]
        );

        $this->add_responsive_control(
            $section_id.'_border_radius_normal',
            [
                'label' => esc_html__( 'Border radius', 'speaker-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    "{{WRAPPER}} .$html_class" => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => $section_id.'_box_shadow_normal',
                'label' => esc_html__( 'Box Shadow', 'speaker-lite' ),
                'selector' => "{{WRAPPER}} .$html_class",
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab( $section_id.'_hover_style_tab', ['label' => esc_html__( 'HOVER', 'speaker-lite' )] );

        if ( $include_color ) {
            $this->add_control(
                $section_id . '_hover_color',
                [
                    'label' => esc_html__('Color', 'speaker-lite'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Color::get_type(),
                        'value' => Color::COLOR_3,
                    ],
                    'selectors' => [
                        "{{WRAPPER}} .$color_hover_class" => 'color: {{VALUE}} !important;',
                    ],
                ]
            );
        }

        if ( $additional_color ) {
            $this->add_control(
                $section_id . '_' . $additional_color_name . '_hover_text_color',
                [
                    'label' => esc_html__( $additional_color_name, 'speaker-lite'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Color::get_type(),
                        'value' => Color::COLOR_3,
                    ],
                    'selectors' => [
                        "{{WRAPPER}} .$additional_color_hover_selector" => 'color: {{VALUE}} !important;',
                    ],
                ]
            );
        }

        if ( $include_bg ) {
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => $section_id . '_background_hover',
                    'label' => esc_html__('Background type', 'speaker-lite'),
                    'types' => ['classic', 'gradient', 'video'],
                    'selector' => "{{WRAPPER}} .$html_class:hover",
                ]
            );
        }

        if ( $include_transition ) {
            $this->add_control(
                $section_id.'_hover_transition',
                [
                    'label' => esc_html__( 'Hover transition duration', 'speaker-lite' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 's' ],
                    'range' => [
                        's' => [
                            'min' => 0.1,
                            'max' => 5,
                            'step' => 0.1,
                        ],
                    ],
                    'default' => [
                        'unit' => 's',
                        'size' => 0,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .'.$html_class => 'transition: color {{SIZE}}{{UNIT}}, background {{SIZE}}{{UNIT}}, box-shadow {{SIZE}}{{UNIT}}, border-radius {{SIZE}}{{UNIT}}, border {{SIZE}}{{UNIT}}, filter {{SIZE}}{{UNIT}};',
                        $additional_transition_selector => 'transition: color {{SIZE}}{{UNIT}}, background {{SIZE}}{{UNIT}}, box-shadow {{SIZE}}{{UNIT}}, border-radius {{SIZE}}{{UNIT}}, border {{SIZE}}{{UNIT}}, filter {{SIZE}}{{UNIT}};'
                    ],
                ]
            );
        }

        $this->add_control(
            $section_id.'_separate_hover',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => $section_id.'_border_hover',
                'label' => esc_html__( 'Border Type', 'speaker-lite' ),
                'selector' => "{{WRAPPER}} .$html_class:hover",
            ]
        );

        $this->add_responsive_control(
            $section_id.'_border_radius_hover',
            [
                'label' => esc_html__( 'Border radius', 'speaker-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    "{{WRAPPER}} .$html_class:hover" => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => $section_id.'_box_shadow_hover',
                'label' => esc_html__( 'Box Shadow', 'speaker-lite' ),
                'selector' => "{{WRAPPER}} .$html_class:hover",
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
    }

    /**
     * Add widget controls: Style -> Section Style Ticker Item.
     *
     * @since 1.0.0
     * @access private
     *
     * @return void
     **/
    private function section_style_ticker_item() {

        $this->start_controls_section( 'section_style_ticker_item', [
            'label' => esc_html__( 'Ticker item', 'speaker-lite' ),
            'tab'   => Controls_Manager::TAB_STYLE
        ] );

        $this->generate_margin_padding_controls( 'section_style_ticker_item', 'mdp-ticker-elementor-ticker-item, {{WRAPPER}} .mdp-ticker-elementor-ticker-item-separator' );

        $this->add_responsive_control(
            'space_between_items',
            [
                'label' => esc_html__( 'Space between items', 'speaker-lite' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-ticker-elementor-slider-slide' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .mdp-ticker-elementor-ticker-ticker-type .mdp-ticker-elementor-ticker-item' => 'margin-right: {{SIZE}}{{UNIT}}; margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .mdp-ticker-elementor-ticker-ticker-type .mdp-ticker-elementor-ticker-animation-normal .mdp-ticker-elementor-ticker-item:first-child' => 'margin-left: 0;',
                    '{{WRAPPER}} .mdp-ticker-elementor-ticker-ticker-type .mdp-ticker-elementor-ticker-animation-normal .mdp-ticker-elementor-ticker-item:last-of-type' => 'margin-right: 0;',
                    '{{WRAPPER}} .mdp-ticker-elementor-ticker-ticker-type .mdp-ticker-elementor-ticker-animation-reverse .mdp-ticker-elementor-ticker-item:first-child' => 'margin-right: 0;',
                    '{{WRAPPER}} .mdp-ticker-elementor-ticker-ticker-type .mdp-ticker-elementor-ticker-animation-reverse .mdp-ticker-elementor-ticker-item:last-of-type' => 'margin-left: 0;',
                ],
            ]
        );

        $this->generate_typography_tabs_controls( 'section_style_ticker_item', 'mdp-ticker-elementor-ticker-item', true, true,
            true, true, 'mdp-ticker-elementor-ticker-item a',
            'mdp-ticker-elementor-ticker-item:hover a', '{{WRAPPER}} .mdp-ticker-elementor-ticker-item a', '', '', '',
        '', 'mdp-ticker-elementor-ticker-item a' );

        $this->end_controls_section();

    }


    /**
     * Add widget controls: Style -> Section Style Label.
     *
     * @since 1.0.0
     * @access private
     *
     * @return void
     **/
    private function section_style_label() {

        $this->start_controls_section( 'section_style_label', [
            'label' => esc_html__( 'Label', 'speaker-lite' ),
            'tab'   => Controls_Manager::TAB_STYLE,
            'condition' => [
                    'show_label' => 'yes'
            ]
        ] );

        $this->generate_margin_padding_controls( 'section_style_label', 'mdp-ticker-elementor-ticker-label' );

        $this->add_responsive_control(
            'label_width',
            [
                'label' => esc_html__( 'Width', 'speaker-lite' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-ticker-elementor-ticker-label' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__( 'Icon size', 'speaker-lite' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 16,
                ],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .mdp-ticker-elementor-ticker-label-icon' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'label_icon_spacing',
            [
                'label' => esc_html__( 'Icon spacing', 'floater-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    "{{WRAPPER}} .mdp-ticker-elementor-ticker-label-icon" => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'label_width_separate',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->generate_typography_tabs_controls( 'section_style_label', 'mdp-ticker-elementor-ticker-label', true,
            true, true, true, 'mdp-ticker-elementor-ticker-label .mdp-ticker-elementor-ticker-label-title',
            'mdp-ticker-elementor-ticker-label:hover .mdp-ticker-elementor-ticker-label-title',
            '{{WRAPPER}} .mdp-ticker-elementor-ticker-label .mdp-ticker-elementor-ticker-label-title, {{WRAPPER}} .mdp-ticker-elementor-ticker-label .mdp-ticker-elementor-ticker-label-icon',
            true, 'Icon', 'mdp-ticker-elementor-ticker-label-icon',
            'mdp-ticker-elementor-ticker-label:hover .mdp-ticker-elementor-ticker-label-icon', 'mdp-ticker-elementor-ticker-label .mdp-ticker-elementor-ticker-label-title' );

        $this->end_controls_section();

    }

    /**
     * Add widget controls: Style -> Section Style Arrows.
     *
     * @since 1.0.0
     * @access private
     *
     * @return void
     **/
    private function section_style_arrows() {

        $this->start_controls_section( 'section_style_arrows', [
            'label' => esc_html__( 'Arrows', 'speaker-lite' ),
            'tab'   => Controls_Manager::TAB_STYLE,
            'condition' => [
                'show_arrows' => 'yes',
                'ticker_type' => 'slider'
            ]
        ] );

        $this->generate_margin_padding_controls( 'section_style_arrows', 'mdp-ticker-elementor-arrows' );


        $this->add_responsive_control(
            'arrows_size',
            [
                'label' => esc_html__( 'Arrows size', 'speaker-lite' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 16,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-ticker-elementor-arrow' => 'font-size: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'space_between_arrows',
            [
                'label' => esc_html__( 'Space between arrows', 'speaker-lite' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-ticker-elementor-previous-arrow' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'arrows_size_separate',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->generate_typography_tabs_controls( 'section_style_arrows', 'mdp-ticker-elementor-arrows', true, true, false,
            true, 'mdp-ticker-elementor-arrows', 'mdp-ticker-elementor-arrow:hover' );

        $this->end_controls_section();

    }

    /**
     * Add widget controls: Style -> Section Style Arrows.
     *
     * @since 1.0.0
     * @access private
     *
     * @return void
     **/
    private function section_style_separator()
    {

        $this->start_controls_section( 'section_style_separator', [
            'label' => esc_html__('Separator', 'speaker-lite'),
            'tab' => Controls_Manager::TAB_STYLE,
            'condition' => [
                'ticker_item_separator' => 'yes',
                'ticker_type' => 'ticker'
            ]
        ] );

        $this->generate_margin_padding_controls( 'section_style_separator', 'mdp-ticker-elementor-ticker-item-separator' );

        $this->generate_typography_tabs_controls( 'section_style_separator', 'mdp-ticker-elementor-ticker-item-separator', true,
            true, true, true, 'mdp-ticker-elementor-ticker-item-separator', 'mdp-ticker-elementor-ticker-item-separator:hover',
            '', '', '', '', '', 'mdp-ticker-elementor-ticker-item-separator' );

        $this->end_controls_section();

    }


    /**
     * Get posts for render.
     *
     * @param $settings
     * @return int[]|\WP_Post[]
     * @since 1.0.0
     * @access private
     *
     */
    private function get_posts_for_render( $settings ) {

        $args = [
             'ignore_sticky_posts' => 1,
             'post_status' => 'publish',
             'posts_per_page' =>  esc_sql( $settings['posts_count'] ),
             'order' => esc_sql( $settings['order_type'] ),
             'orderby' => esc_sql( $settings['order_by'] )
        ];

        // author argument
        if ( $settings['content_author'] ) {
            $args['author__in'] = array_map( 'esc_sql', $settings['content_author'] );
        }

        // post type argument
        if ( $settings['post_type'] !== 'custom' || $settings['post_type'] !== 'manual' ) { $args['post_type'] = esc_sql( $settings['post_type'] ); }

        // manual select
        if ( $settings['post_type'] === 'manual' ) {
            $args = [
                'post_type' => 'any',
                'include' => implode( ' ', esc_sql( $settings['manual_select'] ) ),
                'ignore_sticky_posts' => 1,
                'post_status' => 'publish',
            ];
        }

        // exclude posts argument
        if ( !empty( $settings['exclude'] ) ) {
            $args['exclude'] = implode( ' ', esc_sql( $settings['exclude'] ) );
        }

        // taxonomies argument
        if ( $args['post_type'] !== 'custom' || $args['post_type'] !== 'manual' || $args['post_type'] !== 'page' ) {
            $taxonomies = get_object_taxonomies( esc_sql( $args['post_type'] ), 'object' );
            foreach ( $taxonomies as $taxonomy_object ) {
                $key = $taxonomy_object->name . '_content';
                if ( !empty( $settings[$key] ) ) {
                    $args['tax_query'][] = [
                            'taxonomy' => esc_sql( $taxonomy_object->name ),
                            'field' => 'term_id',
                            'terms' => esc_sql( $settings[$key] )
                    ];
                }
            }

            if ( !empty( $args['tax_query'] ) ) {
                $args['tax_query']['relation'] = 'AND';
            }
        }



        return get_posts( $args );

    }

    /**
     * Render Frontend Output. Generate the final HTML on the frontend.
     *
     * @access protected
     *
     * @return void
     **/
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <!-- Start Crawler for Elementor WordPress Plugin -->
        <div class="mdp-ticker-elementor-box"
        data-ticker-type="<?php esc_attr_e( $settings['ticker_type'] ); ?>"
        <?php if ( $settings['ticker_type'] === 'slider' ): ?>
           data-slides-to-show="<?php esc_attr_e( $settings['slider_items_to_show']['size'] ); ?>"
           <?php if ( array_key_exists( 'widescreen', Plugin::$instance->breakpoints->get_active_breakpoints() ) && isset( $settings['slider_items_to_show_widescreen'] ) ): ?> data-slides-to-show-widescreen="<?php esc_attr_e( $settings['slider_items_to_show_widescreen']['size'] ); ?>" <?php endif; ?>
           <?php if ( array_key_exists( 'laptop', Plugin::$instance->breakpoints->get_active_breakpoints() ) && isset( $settings['slider_items_to_show_laptop']['size'] ) ): ?> data-slides-to-show-laptop="<?php esc_attr_e( $settings['slider_items_to_show_laptop']['size'] ); ?>" <?php endif; ?>
           <?php if ( array_key_exists( 'tablet_extra', Plugin::$instance->breakpoints->get_active_breakpoints() ) && isset( $settings['slider_items_to_show_tablet_extra'] ) ): ?> data-slides-to-show-tablet-extra="<?php esc_attr_e( $settings['slider_items_to_show_tablet_extra']['size']); ?>" <?php endif; ?>
           <?php if ( array_key_exists( 'mobile_extra', Plugin::$instance->breakpoints->get_active_breakpoints() ) && isset( $settings['slider_items_to_show_mobile_extra'] ) ): ?> data-slides-to-show-mobile-extra="<?php esc_attr_e( $settings['slider_items_to_show_mobile_extra']['size'] ); ?>" <?php endif; ?>
           <?php if ( isset( $settings['slider_items_to_show_tablet'] ) ): ?> data-slides-to-show-tablet="<?php esc_attr_e( $settings['slider_items_to_show_tablet']['size'] ); ?>" <?php endif; ?>
           <?php if ( isset( $settings['slider_items_to_show_mobile'] ) ): ?> data-slides-to-show-mobile="<?php esc_attr_e( $settings['slider_items_to_show_mobile']['size'] ); ?>" <?php endif; ?>
           data-slides-to-scroll="<?php esc_attr_e( $settings['slider_items_to_scroll']['size'] ); ?>"
           data-slides-transition-speed="<?php esc_attr_e( $settings['slider_transition_speed']['size'] ); ?>"
           data-slides-direction="<?php esc_attr_e( $settings['slide_direction'] ); ?>"
           data-infinite-loop="<?php esc_attr_e( $settings['infinite_loop'] ); ?>"
           data-slider-animation="<?php esc_attr_e( $settings['switching_animation'] ); ?>"
        <?php endif; ?>
        >
            <div class="mdp-ticker-elementor-ticker <?php if ( $settings['pause_ticker_hover'] === 'yes' ): ?> mdp-ticker-elementor-ticker-hover-pause <?php endif; ?> <?php if ( $settings['ticker_type'] === 'ticker' ): ?> mdp-ticker-elementor-ticker-ticker-type <?php endif; ?> mdp-ticker-elementor-ticker-label-align-<?php esc_attr_e( $settings['label_alignment'] ); ?>">
                <?php if ( $settings['show_label'] === 'yes' ):  ?>
                <div class="mdp-ticker-elementor-ticker-label <?php if ( $settings['hide_label_mobile'] === 'yes' ): ?> mdp-ticker-elementor-label-hide-mobile <?php endif; ?>">
                    <div class="mdp-ticker-elementor-ticker-label-text-wrapper mdp-ticker-elementor-ticker-label-icon-position-<?php esc_attr_e( $settings['icon_position'] ); ?>">
                        <div class="mdp-ticker-elementor-ticker-label-icon">
                            <?php Icons_Manager::render_icon( $settings['label_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        </div>
                        <div class="mdp-ticker-elementor-ticker-label-title">
                            <?php esc_html_e( $settings['label_title'] ); ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="mdp-ticker-elementor-content-wrapper">
                    <div class="mdp-ticker-elementor-ticker-content <?php esc_attr_e( $settings['ticker_direction'] ); ?> <?php if ( $settings['ticker_type'] === 'slider' ): ?> mdp-ticker-elementor-ticker-slider <?php endif; ?>">
                        <?php foreach ( $settings['custom_items_list'] as $custom_item ): ?>
                            <?php if ( $settings['ticker_type'] === 'slider' ): ?>
                                <div class="mdp-ticker-elementor-slider-slide">
                            <?php endif; ?>
                            <div class="mdp-ticker-elementor-ticker-item">
                                <a href="<?php echo esc_url( $custom_item['custom_item_link']['url'] ) ?>"><?php esc_html_e( $custom_item['custom_item_title'] ); ?></a>
                            </div>
                            <?php if ( $settings['ticker_item_separator'] === 'yes' ): ?>
                            <span class="mdp-ticker-elementor-ticker-item-separator">
                                <?php
                                switch ( $settings['separator_type'] ) {
                                    case 'date':
                                        esc_attr_e( $custom_item['custom_item_date'] );
                                        break;
                                    case 'text':
                                        esc_attr_e( $settings['separator_text'] );
                                        break;
                                    case 'icon':
                                        Icons_Manager::render_icon( $settings['separator_icon'], [ 'aria-hidden' => 'true' ] );
                                        break;
                                }
                                ?>
                            </span>
                            <?php endif; ?>
                            <?php if ( $settings['ticker_type'] === 'slider' ): ?>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php if ( $settings['ticker_type'] === 'slider' && $settings['show_arrows'] === 'yes' ): ?>
                    <div class="mdp-ticker-elementor-arrows mdp-ticker-elementor-arrows-align-<?php esc_attr_e( $settings['arrows_alignment'] ); ?>">
                        <div class="mdp-ticker-elementor-previous-arrow mdp-ticker-elementor-arrow">
                            <?php Icons_Manager::render_icon( $settings['slider_arrow_previous'], [ 'aria-hidden' => 'true' ] ); ?>
                        </div>
                        <div class="mdp-ticker-elementor-next-arrow mdp-ticker-elementor-arrow">
                            <?php Icons_Manager::render_icon( $settings['slider_arrow_next'], [ 'aria-hidden' => 'true' ] ); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- End Crawler for Elementor WordPress Plugin -->
        <?php
        if ( is_admin() ) {
            $widget_hash = substr( hash( 'ripemd160', date('l jS \of F Y h:i:s A') ), rand( 0 , 20 ), 3 ) . rand( 11 , 99 );
            ?>
            <!--suppress JSUnresolvedFunction -->
            <script>
                try {
                    crawlerReady<?php esc_attr_e( $widget_hash ); ?>( mdpCrawler.addCrawler.bind( mdpCrawler ) );
                } catch ( msg ) {
                    const crawlerReady<?php esc_attr_e( $widget_hash ); ?> = ( callback ) => {
                        'loading' !== document.readyState ?
                            callback() :
                            document.addEventListener( 'DOMContentLoaded', callback );
                    };
                    crawlerReady<?php esc_attr_e( $widget_hash ); ?>( mdpCrawler.addCrawler.bind( mdpCrawler ) );
                }
            </script>
	    <?php
        }
    }

    /**
     * Return link for documentation
     * Used to add stuff after widget
     *
     * @access public
     *
     * @return string
     **/
    public function get_custom_help_url() {

        return 'https://docs.merkulov.design/tag/crawler';

    }

}
