<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2020 https://github.com/hyper-im All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：2020/1/14 4:17 PM
 * | Author: Quinn (798908243@qq.com) QQ：798908243
 * +----------------------------------------------------------------------
 */

namespace App\Constants;


use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;

/**
 * Class MessageType
 * @package App\Constants
 * @Constants()
 */
class MessageType extends AbstractConstants
{

    CONST SERVER_REGISTER = 'register_from_server';

    CONST USER_REGISTER = 'register_from_user';

    /**
     * @Message("广播所有im-server");
     */
    CONST BROADCAST_ALL = 'server_client_broadcast';

    CONST CHAT_TYPE_PRIVATE = '';

    CONST CHAT_TYPE_CHANNEL = '';

    CONST CHAT_TYPE_BROADCAST = '';
}
