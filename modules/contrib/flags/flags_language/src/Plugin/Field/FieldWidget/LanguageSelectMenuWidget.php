<?php

namespace Drupal\flags_language\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\Plugin\Field\FieldWidget\LanguageSelectWidget;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal;
use Drupal\Core\Language\LanguageInterface;
use Drupal\Core\Language\LanguageManager;
use Drupal\Core\Template\Attribute;

/**
 * Plugin implementation of the 'language_select_menu' widget.
 *
 * @FieldWidget(
 *   id = "language_select_menu",
 *   label = @Translation("Language select with flags"),
 *   field_types = {}
 * )
 */
class LanguageSelectMenuWidget extends LanguageSelectWidget {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element = parent::formElement($items, $delta,  $element,  $form,  $form_state);
    // Add #options to the $element.
    $element['value'] = language_process_language_select($element['value']);
    // Change language select to the out type.
    $element['value']['#type'] = 'select_icons';
    $element['value']['#options_attributes'] = $this->getOptionsAttributes($element['value']['#options']);
    $element['value']['#attached'] = array('library' => array('flags/flags'));

    // @TODO: check this language_element_info_alter.
    return $element;
  }

  /**
   * Gets array with attributes for each option element.
   *
   * @param array $options
   *   The language list options indexed by lang key.
   * @return Drupal\Core\Template\Attribute[]
   */
  protected function getOptionsAttributes(array $options = array()) {
    $attributes = array();
    $mapper = \Drupal::service('flags.mapping.language');

    foreach($options as $key => $language_name) {
      $classes = array('flag', 'flag-' . strtolower($mapper->map($key)));
      $attributes[$key] = new Attribute(array('data-class' => $classes));
    }

    return $attributes;
  }
}
