<?php

declare(strict_types=1);

namespace Drupal\server_general\ThemeTrait\Enum;

/**
 * Enum for badge color options used in theme wrappers.
 */
enum BadgeColorEnum: string {
  case Green = 'green';
  case Yellow = 'yellow';
  case Red = 'red';
}
