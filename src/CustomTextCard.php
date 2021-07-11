<?php

namespace GilbertChiao\CustomTextCard;

use Laravel\Nova\Card;

class CustomTextCard extends Card
{
    public function __construct($id = null, $component = null)
    {
        parent::__construct($component);

        $this->id = $id ?? microtime();

        $this->withMeta([
            'content' => '',
            'contentClass' => '',
            'contentHtml' => '',
            'forceFullWidth' => false,
            'heading' => '',
            'headingAlign' => '',
            'headingHtml' => '',
            'styleBackground' => '',
            'styleBorder' => '',
            'styleColor' => '',
            'styleHeight' => 'default',
        ]);
    }

    /**
     * The unique id of the card.
     *
     * @var mixed|string
     */
    public $id = '';

    /**
     * The width of the card.
     *
     * @var string
     */
    public $width = '1/3';

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component(): string
    {
        return 'custom-text-card';
    }

    /**
     * The content of the card.
     *
     * @param string $content
     * @return CustomTextCard
     */
    public function content(string $content): CustomTextCard
    {
        return $this->setMeta('content', $content);
    }

    /**
     * The custom class of the content.
     *
     * The default class of the content block is "flex text-90 font-light items-center", the custom class would append to it.
     * If you want to replace the class, just prepend a "!" char to the $class, then the custom class would replace it.
     *
     * Example:
     *   ->contentClass("justify-center") // "flex text-90 font-light items-center justify-center"
     *   ->contentClass("!flex font-bold items-center justify-end") // "flex font-bold items-center justify-end"
     *
     * Note: This would not work for HTML-formatted content.
     *
     * @param string $class
     * @return CustomTextCard
     */
    public function contentClass(string $class): CustomTextCard
    {
        return $this->setMeta('contentClass', $class);
    }

    /**
     * The HTML-formatted content of the card.
     *
     * @param string $html
     * @return CustomTextCard
     */
    public function contentHtml(string $html): CustomTextCard
    {
        return $this->setMeta('contentHtml', $html);
    }

    /**
     * Force the card to be full width.
     *
     * A fix for nova cards order (https://github.com/laravel/nova-issues/issues/1895).
     *
     * @return CustomTextCard
     */
    public function forceFullWidth(): CustomTextCard
    {
        return $this->withMeta(['forceFullWidth' => true, 'width' => '5/6']);
    }

    /**
     * The heading of the card.
     *
     * @param string $heading
     * @return CustomTextCard
     */
    public function heading(string $heading): CustomTextCard
    {
        return $this->setMeta('heading', $heading);
    }

    /**
     * The alignment of the heading (left, center, or right).
     *
     * Note: This would not work for HTML-formatted heading.
     *
     * @param string $alignment left | center | right
     * @return CustomTextCard
     */
    public function headingAlign(string $alignment): CustomTextCard
    {
        return $this->setMeta('headingAlign', $alignment);
    }

    /**
     * The HTML-formatted heading of the card.
     *
     * @param string $html
     * @return CustomTextCard
     */
    public function headingHtml(string $html): CustomTextCard
    {
        return $this->setMeta('headingHtml', $html);
    }

    /**
     * The CSS background property of the card.
     *
     * @param string $backgroundStyle
     * @return CustomTextCard
     */
    public function background(string $backgroundStyle): CustomTextCard
    {
        return $this->setMeta('styleBackground', $backgroundStyle);
    }

    /**
     * The CSS border property of the card.
     *
     * @param string $borderStyle
     * @return CustomTextCard
     */
    public function border(string $borderStyle): CustomTextCard
    {
        return $this->setMeta('styleBorder', $borderStyle);
    }

    /**
     * The CSS color property of the card.
     *
     * @param string $color
     * @return CustomTextCard
     */
    public function color(string $color): CustomTextCard
    {
        return $this->setMeta('styleColor', $color);
    }

    /**
     * The CSS height property or the card (default, auto, or NNNpx).
     *
     * @param string $height default | auto | NNNpx
     * @return CustomTextCard
     */
    public function height(string $height): CustomTextCard
    {
        return $this->setMeta('styleHeight', $height);
    }

    /**
     * Set meta information.
     *
     * @param string $key
     * @param string $value
     * @return CustomTextCard
     */
    private function setMeta(string $key, string $value): CustomTextCard
    {
        return $this->withMeta([$key => $value]);
    }

    public function jsonSerialize()
    {
        return array_merge([
            'name' => 'custom-text-card:' . $this->id,
            'width' => $this->width,
        ], parent::jsonSerialize());
    }
}
