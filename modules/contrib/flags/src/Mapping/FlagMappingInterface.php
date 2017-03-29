<?php


namespace Drupal\flags\Mapping;

/**
 * Interface for flag mapping service to map different values to flag codes.
 *
 * Interface FlagMappingInterface
 */
interface FlagMappingInterface {

  /**
   * Maps provided string to a flag code.
   * Returned string should be lower case flag code.
   *
   * @param string $value   Value of the source data.
   *
   * @return string
   */
  function map($value);
}
