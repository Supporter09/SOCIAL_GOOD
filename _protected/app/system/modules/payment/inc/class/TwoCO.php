<?php
/**
 * @author         Pierre-Henry Soria <hello@ph7cms.com>
 * @copyright      (c) 2012-2019, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package        PH7 / App / System / Module / Payment / Inc / Class
 */

namespace PH7;

use PH7\Framework\Payment\Gateway\Api\TwoCheckOut as TwoCheckOutGateway;

class TwoCO extends TwoCheckOutGateway
{
    use Api; // Import the Api trait

    public function __construct($bSandbox)
    {
        parent::__construct($bSandbox);
    }
}
