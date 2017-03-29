<?php

namespace Drupal\flags\Mapping;

use Drupal\flags\Mapping\BaseMapping;

/**
 * Maps language code to country/territory code.
 *
 * Class Language
 */
class Language extends BaseMapping {

  /**
   * {@inheritDoc}
   */
  protected function getConfigKey() {
   return 'flags.language_flag_mapping';
  }

}
