<?php

namespace Drupal\woldtwerk_theme_helper\TwigExtension;

use Twig\TwigFilter;
use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;

/**
 * Class TwigFilterExtension.
 */
class TwigExtension extends AbstractExtension {

  /**
   * Declare your custom twig filter here.
   *
   * @return array|TwigFilter[]
   *   asv
   */
  public function getFilters() {
    return [
      new TwigFilter(
        'svg',
        [$this, 'getSvgPath'],
        ['is_safe' => [('html')]]
      ),
    ];
  }

  /**
   * Declare your custom twig filter here.
   *
   * @return array|TwigFunction[]
   *   asv
   */
  public function getFunctions() {
    return [
      new TwigFunction(
        'svg',
        [$this, 'getSvgPath'],
        ['is_safe' => [('html')]]),
    ];
  }

  /**
   * Function to return inline SVG.
   *
   * @param string $filename
   *   SVG name as string.
   *
   * @return html
   *   unescaped html
   */
  public static function getSvgPath($filename) {
    $current_theme = \Drupal::service('theme.manager')
      ->getActiveTheme()->getName();

    $svg_path = '/dist/icons/';
    $filename = preg_match('/(.svg)$/', $filename)
                  ? $filename : $filename . '.svg';

    $path = drupal_get_path('theme', $current_theme) . $svg_path;
    $svg = file_get_contents($path . $filename);

    return $svg ? $svg : '';
  }

  /**
   * {@inheritdoc}
   *
   * @return string
   *   return custom twig filters.
   */
  public function getName() {
    return 'woldtwerk_theme_helper.filter';
  }

}
