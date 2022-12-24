<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf2c8f18e2596efe41d2ae93a1a1f72c9
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf2c8f18e2596efe41d2ae93a1a1f72c9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf2c8f18e2596efe41d2ae93a1a1f72c9::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf2c8f18e2596efe41d2ae93a1a1f72c9::$classMap;

        }, null, ClassLoader::class);
    }
}
