<?php

namespace Drupal\flags_country\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal;
use Drupal\Core\Template\Attribute;
use Drupal\country\Plugin\Field\FieldWidget\CountryDefaultWidget;

/**
 * Plugin implementation of the 'country_select_menu' widget.
 *
 * @FieldWidget(
 *   id = "country_select_menu",
 *   label = @Translation("Country select options with flags"),
 *   field_types = {},
 *   weight = 5
 * )
 */
class CountrySelectMenuWidget extends CountryDefaultWidget {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element = parent::formElement($items, $delta, $element, $form, $form_state);

    $element['value']['#type'] = 'select_icons';
    $element['value']['#options_attributes'] = $this->getOptionsAttributes($element['value']['#options']);
    $element['value']['#attached'] = array('library' => array('flags/flags'));

    return $element;
  }

  /**
   * Gets array with attributes for each option element.
   *
   * @param array $options
   *   The language list options indexed by country key.
   * @return Drupal\Core\Template\Attribute[]
   */
  protected function getOptionsAttributes(array $options = array()) {
    $attributes = array();
    $mapper = \Drupal::service('flags.mapping.country');

    foreach($options as $key => $country_name) {
      $classes = array('flag', 'flag-' . strtolower($mapper->map($key)));
      $attributes[$key] = new Attribute(array('data-class' => $classes));
    }

    return $attributes;
  }
}
