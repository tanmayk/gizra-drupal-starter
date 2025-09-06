<?php

declare(strict_types=1);

namespace Drupal\server_general\ThemeTrait;

/**
 * Helper methods for getting themed buttons for card footer.
 */
trait CardFooterButtonThemeTrait {

  /**
   * Build the email button element.
   *
   * @param string $email
   *   The email id to build a button for.
   *
   * @return array
   *   The render array.
   */
  protected function buildElementCardFooterEmailButton(string $email): array {
    return [
      '#theme' => 'server_theme_card_email_button',
      '#email' => $email,
    ];
  }

  /**
   * Build the Call button element.
   *
   * @param string $phone
   *   The phone number to build a button for.
   *
   * @return array
   *   The render array.
   */
  protected function buildElementCardFooterCallButton(string $phone): array {
    return [
      '#theme' => 'server_theme_card_call_button',
      '#phone' => $phone,
    ];
  }

}
