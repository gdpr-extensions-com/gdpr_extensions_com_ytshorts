<?php

declare(strict_types=1);

namespace GdprExtensionsCom\GdprExtensionsComYtshorts\Controller;


use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * This file is part of the "gdpr-extensions-com-ytshorts" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2023
 */

/**
 * gdprytshortsController
 */
class GdprYtshortsController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * ContentObject
     *
     * @var ContentObject
     */
    protected $contentObject = null;

    /**
     * Action initialize
     */
    protected function initializeAction()
    {
        $this->contentObject = $this->configurationManager->getContentObject();

        // intialize the content object
    }

    /**
     * action index
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function indexAction(): \Psr\Http\Message\ResponseInterface
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_gdprextensionscomyoutube_domain_model_gdprmanager');
        $gdprSettingYtshorts = $queryBuilder
            ->select('*')
            ->from('tx_gdprextensionscomyoutube_domain_model_gdprmanager')->where(
                $queryBuilder->expr()->like('extension_title', $queryBuilder->createNamedParameter('%' . (string)'ytshorts' . '%'))
            );
        $settings =  $gdprSettingYtshorts->execute()->fetchAssociative();

        $youtubeUrl = $this->contentObject->data['gdpr_yts_url'];
        $videoId = '';

        if (preg_match('/youtube\.com\/shorts\/(.+)/', $youtubeUrl, $matches)) {
            $videoId = $matches[1];
        }

        $embedUrl = $videoId ? "https://www.youtube.com/embed/$videoId" : '';
        if(!empty($embedUrl)){
            $this->contentObject->data['gdpr_yts_url'] = $embedUrl;
        }

        $this->view->assign('YtshortsData', $this->contentObject->data);
        $this->view->assign('YtshortsSettings', $settings);
        $this->view->assign('rootPid', $GLOBALS['TSFE']->site->getRootPageId());
        return $this->htmlResponse();
    }
}
