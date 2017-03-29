<?php

namespace Drupal\flags\Mapping;

/**
 * Maps country code to country/territory code.
 *
 * Class Language
 */
class Country extends BaseMapping {

  /**
   * {@inheritDoc}
   */
  protected function getConfigKey() {
    return 'flags.country_flag_mapping';
  }

}
