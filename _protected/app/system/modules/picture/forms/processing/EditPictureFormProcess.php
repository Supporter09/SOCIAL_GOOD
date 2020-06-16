<?php
/**
 * @author         Pierre-Henry Soria <hello@ph7cms.com>
 * @copyright      (c) 2012-2019, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package        PH7 / App / System / Module / Picture / Form / Processing
 */

namespace PH7;

defined('PH7') or exit('Restricted access');

use PH7\Framework\Mvc\Router\Uri;
use PH7\Framework\Url\Header;

class EditPictureFormProcess extends Form
{
    public function __construct()
    {
        parent::__construct();

        $iAlbumId = (int)$this->httpRequest->get('album_id');
        $sPictureTitle = MediaCore::cleanTitle($this->httpRequest->post('title'));
        $iPictureId = (int)$this->httpRequest->get('picture_id');

        (new PictureModel)->updatePhoto(
            $this->session->get('member_id'),
            $iAlbumId,
            $iPictureId,
            $sPictureTitle,
            $this->httpRequest->post('description'),
            $this->dateTime->get()->dateTime('Y-m-d H:i:s')
        );

        Picture::clearCache();

        Header::redirect(
            Uri::get('picture',
                'main',
                'photo',
                $this->session->get('member_username') . ',' . $iAlbumId . ',' . $sPictureTitle . ',' . $iPictureId
            ),
            t('Your photo has been successfully updated!')
        );
    }
}
