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
   * Build a People card.
   *
   * @param array $person
   *   An array containing person data.
   *
   * @return array
   *   The render array.
   */
  protected function buildElementPersonCard(array $person): array {
    $elements = [];
    $inner_elements = [];

    $element = [
      '#theme' => 'image',
      '#uri' => $person['picture'],
      '#alt' => 'The image alt ' . $person['name'],
      '#width' => 100,
    ];
    $inner_elements[] = $this->wrapRoundedCornersFull($element);

    $intro_elements = [];

    $element = $this->wrapTextResponsiveFontSize($person['name'], FontSizeEnum::Sm);
    $element = $this->wrapTextFontWeight($element, FontWeightEnum::Bold);
    $intro_elements[] = $this->wrapTextCenter($element);

    if (!empty($person['subtitle'])) {
      $element = $this->wrapTextResponsiveFontSize($person['subtitle'], FontSizeEnum::Sm);
      $element = $this->wrapTextCenter($element);
      $intro_elements[] = $this->wrapTextColor($element, TextColorEnum::Gray);
    }

    if (!empty($person['role'])) {
      $element = $this->wrapTextResponsiveFontSize($person['role'], FontSizeEnum::Xs);
      $element = $this->wrapTextBadge($element, BadgeColorEnum::Green);
      $intro_elements[] = $this->wrapTextCenter($element);
    }

    $inner_elements[] = $this->wrapContainerVerticalSpacingTiny($intro_elements, AlignmentEnum::Center);

    $elements[] = $inner_elements;

    $button_elements = [];
    // Email.
    $element = $this->buildElementCardFooterEmailButton($person['email']);
    $element = $this->wrapTextResponsiveFontSize($element, FontSizeEnum::Sm);
    $button_elements[] = $this->wrapTextColor($element, TextColorEnum::Gray);
    // Contact.
    $element = $this->buildElementCardFooterCallButton($person['phone']);
    $element = $this->wrapTextResponsiveFontSize($element, FontSizeEnum::Sm);
    $button_elements[] = $this->wrapTextColor($element, TextColorEnum::Gray);

    $button_elements = $this->buildInnerElementLayoutHorizontal($button_elements);

    $elements[] = $button_elements;

    $elements = $this->buildInnerElementLayoutCenteredPersonCards($elements, TRUE);

    return $elements;
  }

}
