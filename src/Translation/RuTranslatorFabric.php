<?php


namespace Victor78\SmsReg\Translation;


use Symfony\Component\Translation\Loader\XliffFileLoader;
use Symfony\Contracts\Translation\TranslatorInterface;

class RuTranslatorFabric
{
    public static function create(): TranslatorInterface
    {
        $translator = new \Symfony\Component\Translation\Translator('ru');
        $translator->addLoader("xliff_file_loader", new XliffFileLoader());

        $filepath = 'vendor/symfony/validator/Resources/translations/validators2.ru.xlf';
        if (!file_exists($filepath))
        {
            $filepath = 'src/Translation/validators.ru.xlf';

        }
        if (file_exists($filepath))
        {
            $translator->addResource('xliff_file_loader', $filepath, 'ru');
        }
        return $translator;
    }
}