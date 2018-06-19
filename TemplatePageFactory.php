<?php

$template_page_boxes = [
    'categories_full',
    'categories',
    'manufacturers',
    'search',
    'information_pages',
    'shopping_cart',
    'bestsellers',
    'special_offers',
    'markets',
    'languages',
    'countries',
    'currencies',
    'news',
    'news_archive',
    'login',
    'vat_select',
    'reviews',
    'products_new',
    'custom'
];

foreach ($template_page_boxes as $template_page_box) {
    TemplatePageFactory::create(TemplatePageType::TEMPLATE_PAGE_BOX, $template_page_box);
}

TemplatePageFactory::createArray(TemplatePageType::TEMPLATE_PAGE_BOX, $template_page_boxes);

class TemplatePageFactory
{
    public function create(int $template_page_type, $template_page_name): TemplatePage
    {
        $template_page_class_name = TemplatePageType::className($template_page_type);
        return new $template_page_class_name($template_page_name);
    }

    public function createArray(int $template_page_type, array $template_page_names): array
    {
        foreach ($template_page_names as $template_page_name) {
            $template_pages[] = self::create($template_page_type, $template_page_name);
        }

        return $template_pages;
    }
}

class TemplatePageType
{
    const TEMPLATE_PAGE = 0;
    const TEMPLATE_PAGE_BOX = 1;
    const TEMPLATE_PAGE_MODULE = 2;

    private const TEMPLATE_PAGE_CLASS_NAMES = [
        self::TEMPLATE_PAGE         => 'TemplatePage',
        self::TEMPLATE_PAGE_BOX     => 'TemplatePageBox',
        self::TEMPLATE_PAGE_MODULE  => 'TemplatePageModule'
    ];

    public function className(int $template_page_type): string
    {
        return self::TEMPLATE_PAGE_CLASS_NAMES[$template_page_type];
    }
}
