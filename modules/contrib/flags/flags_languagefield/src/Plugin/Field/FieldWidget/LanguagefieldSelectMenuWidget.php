<?php

/**
 * This is a widget for core languagefield.
 */
namespace Drupal\flags_languagefield\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\languagefield\Plugin\Field\FieldWidget\LanguageSelectWidget;
use Drupal\Core\Form\FormStateInterface;
use Drupal;
use Drupal\Core\Template\Attribute;

/**
 * Plugin implementation of the 'languagefield_select_menu' widget.
 *
 * @FieldWidget(
 *   id = "languagefield_select_menu",
 *   label = @Translation("Language select list with flags"),
 *   field_types = {}
 * )
 */
class LanguagefieldSelectMenuWidget extends LanguageSelectWidget {

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
