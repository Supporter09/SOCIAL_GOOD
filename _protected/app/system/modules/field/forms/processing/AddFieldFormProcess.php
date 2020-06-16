<?php
/**
 * @author         Pierre-Henry Soria <hello@ph7cms.com>
 * @copyright      (c) 2013-2019, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package        PH7 / App / System / Module / Field / Form / Processing
 */

namespace PH7;

defined('PH7') or exit('Restricted access');

use PH7\Framework\Mvc\Router\Uri;
use PH7\Framework\Url\Header;

class AddFieldFormProcess extends Form
{
    public function __construct()
    {
        parent::__construct();

        $sMod = $this->httpRequest->get('mod');
        $sName = $this->httpRequest->post('name');
        $sType = $this->httpRequest->post('type');
        $iLength = $this->httpRequest->post('length');
        $sDefVal = $this->httpRequest->post('value');

        if (Field::doesExist($sMod, $sName)) {
            \PFBC\Form::setError(
                'form_add_field',
                t('Oops! The field already exists!')
            );
        } else {
            $bRet = (new FieldModel(Field::getTable($sMod), $sName, $sType, $iLength, $sDefVal))->insert();

            if ($bRet) {
                Field::clearCache();

                Header::redirect(
                    Uri::get('field', 'field', 'all', $sMod),
                    t('The field has been added.')
                );
            } else {
                \PFBC\Form::setError(
                    'form_add_field',
                    t('Oops! An error occurred while adding the field. Please try again.')
                );
            }
        }
    }
}
