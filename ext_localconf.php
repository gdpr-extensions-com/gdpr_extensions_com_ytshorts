<?php
defined('TYPO3') || die();

(static function() {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'GdprExtensionsComYtshorts',
        'gdprytshorts',
        [
            \GdprExtensionsCom\GdprExtensionsComYtshorts\Controller\GdprYtshortsController::class => 'index'
        ],
        // non-cacheable actions
        [
            \GdprExtensionsCom\GdprExtensionsComYtshorts\Controller\GdprYtshortsController::class => '',
            \GdprExtensionsCom\GdprExtensionsComYtshorts\Controller\GdprManagerController::class => 'create, update, delete'
        ],
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
    );

    // register plugin for cookie widget
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'GdprExtensionsComYtshorts',
        'gdprcookiewidget',
        [
            \GdprExtensionsCom\GdprExtensionsComYtshorts\Controller\GdprCookieWidgetController::class => 'index'
        ],
        // non-cacheable actions
        [],
    );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    gdprcookiewidget {
                        iconIdentifier = gdpr_extensions_com_ytshorts-plugin-gdprytshorts
                        title = cookie
                        description = LLL:EXT:gdpr_extensions_com_ytshorts/Resources/Private/Language/locallang_db.xlf:tx_gdpr_extensions_com_ytshorts_gdprytshorts.description
                        tt_content_defValues {
                            CType = list
                            list_type = gdprextensionscomytshorts_gdprcookiewidget
                        }
                    }
                }
                show = *
            }
       }'
    );
    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod.wizards.newContentElement.wizardItems {
               gdpr.header = LLL:EXT:gdpr_extensions_com_ytshorts/Resources/Private/Language/locallang_db.xlf:tx_gdpr_extensions_com_ytshorts_gdprytshorts.name.tab
        }'
    );
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.gdpr {
                elements {
                    gdprytshorts {
                        iconIdentifier = gdpr_extensions_com_ytshorts-plugin-gdprytshorts
                        title = LLL:EXT:gdpr_extensions_com_ytshorts/Resources/Private/Language/locallang_db.xlf:tx_gdpr_extensions_com_ytshorts_gdprytshorts.name
                        description = LLL:EXT:gdpr_extensions_com_ytshorts/Resources/Private/Language/locallang_db.xlf:tx_gdpr_extensions_com_ytshorts_gdprytshorts.description
                        tt_content_defValues {
                            CType = gdprextensionscomytshorts_gdprytshorts
                        }
                    }
                }
                show = *
            }
       }'
    );
})();
