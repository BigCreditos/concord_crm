<?php
/**
 * Concord CRM - https://www.concordcrm.com
 *
 * @version   1.5.1
 *
 * @link      Releases - https://www.concordcrm.com/releases
 * @link      Terms Of Service - https://www.concordcrm.com/terms
 *
 * @copyright Copyright (c) 2022-2024 KONKORD DIGITAL
 */

use Illuminate\Support\Facades\Broadcast;
use Modules\Users\Models\User;

Broadcast::channel('Modules.Users.Models.User.{id}', function (User $user, string $id) {
    return (int) $user->id === (int) $id;
});
