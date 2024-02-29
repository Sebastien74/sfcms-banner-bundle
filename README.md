# sfcms/banner-bundle

[![Generic badge](https://img.shields.io/badge/Sfcms-v.6.4-purple.svg)](https://github.com/Sebastien74/SFCMS-6)
[![Generic badge](https://img.shields.io/badge/Version-1-green.svg)](https://github.com/Sebastien74/SFCMS-6)
[![Generic badge](https://img.shields.io/badge/License-MIT-blue.svg)](https://github.com/Sebastien74/MIT-LICENSE/blob/main/LICENSE.md)
[![Generic badge](https://img.shields.io/badge/Author-Sébastien%20FOURNIER-blue.svg)](https://github.com/Sebastien74)
[![Generic badge](https://img.shields.io/badge/Contributor-1-blue.svg)](https://github.com/Sebastien74)
![Generic badge](https://img.shields.io/badge/PHP-8.3-red.svg)

**Module used to create and display advertising banners and retrieve statistics on the number of views and clicks.**

---

Add TAG
git tag v1.0.0
git push --tags -u origin main

Remove tags
git tag | foreach-object -process { git push origin --delete $_ }
git tag | foreach-object -process { git tag -d $_ }

https://symfony.com/doc/current/bundles/override.html

php composer.phar dump-autoload
php composer.phar require sfcms/banner-bundle
php bin/console app:copy:bundle

IN modules.html.twig sidebar
{% include 'admin/include/sidebar/include/modules/banner.html.twig' %}

Add in this table or do it automataly by active modules
    {% set modules = [
        'newscasts',
        'matches',
        'sliders',
        'events',
        'maps',
        'faqs',
        'forms',
        'forums',
        'galleries',
        'newsletters',
        'partners',
        'portfolios',
        'tables',
        'tabs',
        'searchs',
        'catalogs',
        'makings',
        'agendas',
        'forums',
        'timelines',
        'portfolios',
        'publicities',
        'contacts'
    ] %}