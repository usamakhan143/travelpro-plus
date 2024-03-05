<?php

use Carbon_Fields\Field;
use Carbon_Fields\Container;

add_action('after_setup_theme', 'load_carbon_fields_travelproplus');
add_action('carbon_fields_register_fields', 'create_options_page_travelproplus');



function load_carbon_fields_travelproplus()
{
    \Carbon_Fields\Carbon_Fields::boot();
}

function create_options_page_travelproplus()
{

    Container::make('theme_options', __('Travelpro Plus'))
        ->set_icon('dashicons-airplane')
        ->set_page_menu_position(30)
        ->add_fields(array(

            Field::make('checkbox', 'travelproplus_active', __('Active')),

            Field::make('text', 'travelproplus_email', __('Notification Email'))
                ->set_attribute('placeholder', 'Enter Email Address')
                ->set_help_text('The booking notification will send to this email.'),

            Field::make('textarea', 'travelproplus__message', __('Confirmation Message'))
                ->set_attribute('placeholder', 'If you want to use a dynamic tag for the name field in the message, please use {name}.')
                ->set_help_text('Type your confirmation message which will be displayed when the user submit the form.'),

            Field::make('complex', 'travelproplus_id_attributes', 'ID Attributes of Form fields to display the Origin and Destinations')
                ->set_layout('tabbed-horizontal')
                ->add_fields(array(
                    Field::make('text', 'id_travelpro_plus_strg', 'CSS ID')
                        ->set_attribute('placeholder', 'Enter the CSS ID of the field where you want to show the auto-completes for cites and airports.')
                ))
        ));
}
