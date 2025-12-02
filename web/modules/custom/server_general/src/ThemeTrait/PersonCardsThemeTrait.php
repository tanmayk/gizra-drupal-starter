<?php

declare(strict_types=1);

namespace Drupal\server_general\ThemeTrait;

use Drupal\server_general\ThemeTrait\Enum\AlignmentEnum;
use Drupal\server_general\ThemeTrait\Enum\BadgeColorEnum;
use Drupal\server_general\ThemeTrait\Enum\FontSizeEnum;
use Drupal\server_general\ThemeTrait\Enum\FontWeightEnum;
use Drupal\server_general\ThemeTrait\Enum\TextColorEnum;

/**
 * Helper methods for rendering Person card elements.
 */
trait PersonCardsThemeTrait {

  use ElementLayoutThemeTrait;
  use ElementWrapThemeTrait;
  use InnerElementLayoutThemeTrait;
  use CardFooterButtonThemeTrait;
  use CardThemeTrait;

  /**
   * Build Person cards element.
   *
   * @param string $title
   *   The title.
   * @param array $body
   *   The body render array.
   * @param array $items
   *   The render array built with
   *   `ElementLayoutThemeTrait::buildElementLayoutTitleBodyAndItems`.
   *
   * @return array
   *   The render array.
   */
  protected function buildElementPersonCards(string $title, array $body, array $items): array {
    return $this->buildElementLayoutTitleBodyAndItems(
      $title,
      $body,
      $this->buildCards($items),
    );
  }

  /**
   * Build a Person card.
   *
   * @param string $name
   *   The name of person.
   * @param string $email
   *   An email of person.
   * @param string|null $subtitle
   *   Optional; The subtitle (e.g. work title).
   * @param string|null $role
   *   Optional; The role of person.
   * @param string|null $phone
   *   Optional; The phone of person.
   *
   * @return array
   *   The render array.
   */
  protected function buildElementPersonCard(string $name, string $email, ?string $subtitle = NULL, ?string $role = NULL, ?string $phone = NULL): array {
    $elements = [];
    $inner_elements = [];

    $element = [
      '#theme' => 'image',
      '#uri' => $this->getPlaceholderPersonImage(100),
      '#alt' => $this->t('The image of @name', ['@name' => $name]),
      '#width' => 100,
    ];
    $inner_elements[] = $this->wrapRoundedCornersFull($element);

    $intro_elements = [];

    $element = $this->wrapTextResponsiveFontSize($name, FontSizeEnum::Sm);
    $element = $this->wrapTextFontWeight($element, FontWeightEnum::Bold);
    $intro_elements[] = $this->wrapTextCenter($element);

    if (!empty($subtitle)) {
      $element = $this->wrapTextResponsiveFontSize($subtitle, FontSizeEnum::Sm);
      $element = $this->wrapTextCenter($element);
      $intro_elements[] = $this->wrapTextColor($element, TextColorEnum::Gray);
    }

    if (!empty($role)) {
      $element = $this->wrapTextResponsiveFontSize($role, FontSizeEnum::Xs);
      $element = $this->wrapTextBadge($element, BadgeColorEnum::Green);
      $intro_elements[] = $this->wrapTextCenter($element);
    }

    $inner_elements[] = $this->wrapContainerVerticalSpacingTiny($intro_elements, AlignmentEnum::Center);

    $elements[] = $inner_elements;

    $button_elements = [];
    // Email.
    $element = $this->buildElementCardFooterEmailButton($email);
    $element = $this->wrapTextResponsiveFontSize($element, FontSizeEnum::Sm);
    $button_elements[] = $this->wrapTextColor($element, TextColorEnum::Gray);

    if (!empty($phone)) {
      // Contact.
      $element = $this->buildElementCardFooterCallButton($phone);
      $element = $this->wrapTextResponsiveFontSize($element, FontSizeEnum::Sm);
      $button_elements[] = $this->wrapTextColor($element, TextColorEnum::Gray);
    }

    $button_elements = $this->buildInnerElementLayoutHorizontal($button_elements);

    $elements[] = $button_elements;

    $elements = $this->buildInnerElementLayoutCenteredPersonCards($elements);

    return $elements;
  }

}
